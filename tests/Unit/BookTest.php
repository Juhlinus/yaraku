<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function it_has_a_title(): void
    {    
        $title = $this->faker->sentence;

        $book = Book::factory()->create([
            'title' => $title,
        ]);

        $this->assertEquals($title, $book->title);
    }

    /** @test */
    public function it_has_an_author(): void
    {    
        $author = $this->faker->name;

        $book = Book::factory()->create([
            'author' => $author,
        ]);

        $this->assertEquals($author, $book->author);
    }

    /** @test */
    public function it_can_be_sorted(): void
    {
        $books = Book::factory()
            ->count(10)
            ->create();

        $this->assertEquals(
            $books->sortBy('title')->pluck('id'), 
            Book::sortedOrLatest(['sort_by' => 'title'])->pluck('id'),
        );

        $this->assertEquals(
            $books->sortByDesc('title')->pluck('id'), 
            Book::sortedOrLatest(['sort_by' => 'title', 'direction' => 'desc'])->pluck('id'),
        );

        $this->assertEquals(
            $books->sortByDesc('created_at')->pluck('id'), 
            Book::sortedOrLatest([])->pluck('id'),
        );
    }

    /** @test */
    public function it_can_be_searched(): void
    {
        Book::factory()
            ->create([
                'title' => 'Grapes of Wrath',
            ]);

        Book::factory()
            ->count(10)
            ->create();

        $this->assertEquals(1, Book::filterBy(['search' => 'gRaPeS', 'column' => 'title'])->count());
    }
}
