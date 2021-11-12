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
}
