<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
            ])->sortByDesc('created_at');

        $response = $this->get('/');

        $response->assertViewHas(
            'books', 
            fn ($items) => $items->pluck('id')->toArray() === $books->pluck('id')->toArray(),
        );
    }

    /** @test */
    public function it_can_add_books(): void
    {
        $book = Book::factory()
            ->make([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ])->toArray();

        $response = $this->post('books', $book);

        $response->assertRedirect('/');
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function it_can_delete_a_book(): void
    {
        $book = Book::factory()
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ]);

        $response = $this->delete('books/' . $book->id);

        $response->assertRedirect('/');
        $this->assertCount(0, Book::all());
    }

    /** @test */
    public function it_can_update_an_author_on_a_book(): void
    {
        $author = $this->faker->name;

        $book = Book::factory()
            ->create([
                'title' => $this->faker->sentence,
                'author' => $author,
            ]);

        $response = $this->put('books/' . $book->id, [
            'author' => $this->faker->name,
        ]);

        $response->assertRedirect('/');
        $this->assertNotEquals($author, Book::first()->author);
    }

    /** @test */
    public function it_lists_the_books_in_sorted_order(): void
    {
        $books = Book::factory()
            ->count(15)
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ])->sortBy('title');

        $response = $this->get('/?sort_by=title');

        $response->assertViewHas(
            'books', 
            fn ($items) => $items->pluck('id')->toArray() === $books->pluck('id')->toArray(),
        );
    }

    /** @test */
    public function it_fails_when_the_sort_by_field_is_invalid(): void
    {    
        Book::factory()
            ->count(15)
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ])->sortBy('title');

        $invalid_response = $this->get('/?sort_by=test');
        $invalid_response->assertInvalid('sort_by');
    }

    /** @test */
    public function it_fails_when_the_direction_field_is_invalid(): void
    {    
        Book::factory()
            ->count(15)
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ])->sortBy('title');

        $invalid_response = $this->get('/?direction=test');
        $invalid_response->assertInvalid('direction');
    }

    /** @test */
    public function it_lists_books_filtered_by_search(): void
    {    
        Book::factory()
            ->count(15)
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ])->sortBy('title');

        Book::factory()
            ->create([
                'title' => 'Grapes of Wrath',
            ]);

        Book::factory()
            ->create([
                'title' => 'Grapes of Bath',
            ]);

        $response = $this->get('/?search=Grapes+of&column=title');
        $response->assertViewHas('books', fn ($items) => $items->count() === 2);
    }

    /** @test */
    public function it_silently_fails_and_redirects_when_either_the_column_or_search_fields_are_missing(): void
    {    
        Book::factory()
            ->count(15)
            ->create([
                'title' => $this->faker->sentence,
                'author' => $this->faker->name
            ])->sortBy('title');

        Book::factory()
            ->create([
                'title' => 'Grapes of Wrath',
            ]);

        Book::factory()
            ->create([
                'title' => 'Grapes of Bath',
            ]);

        $first_response = $this->get('/?search=Grapes+of');
        $second_response = $this->get('/?column=author');

        $first_response->assertRedirect('/');
        $second_response->assertRedirect('/');
    }
}
