<?php

namespace Tests\Feature;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BookListingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_list_books(): void
    {
        $books = Book::factory()
            ->count(2)
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ]);

        $response = $this->get('/');

        $response->assertViewHas(
            'books', 
            fn ($items) => $items->pluck('id')->toArray() === $books->pluck('id')->toArray(),
        );
    }
}
