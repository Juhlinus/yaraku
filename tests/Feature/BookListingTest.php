<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
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

    /** @test */
    public function it_can_download_the_book_listing_in_xml_or_csv_format(): void
    {
        Storage::fake();

        Book::factory()
            ->count(15)
            ->create();
    
        $first_response = $this->get('/download?format=xml&fields[]=author&fields[]=title');
        $second_response = $this->get('/download?format=csv&fields[]=author&fields[]=title');
    
        $first_response->assertDownload('books.xml');
        $second_response->assertDownload('books.csv');
    }

    /** @test */
    public function it_can_only_download_predetermined_or_all_fields(): void
    { 
        Storage::fake();

        Book::factory()
            ->count(15)
            ->create();
    
        $first_valid_response = $this->get('/download?format=csv&fields[]=author');
        $second_valid_response = $this->get('/download?format=csv&fields[]=title');
        $third_valid_response = $this->get('/download?format=csv&fields[]=author&fields[]=title');
    
        $first_invalid_response = $this->get('/download?format=csv&fields[]=id');
        $second_invalid_response = $this->get('/download?format=csv&fields[]=created_at');
        $third_invalid_response = $this->get('/download?format=csv&fields[]=id&fields[]=created_at');
    
        $first_valid_response->assertOk();
        $second_valid_response->assertOk();
        $third_valid_response->assertOk();

        $first_invalid_response->assertInvalid('fields');
        $second_invalid_response->assertInvalid('fields');
        $third_invalid_response->assertInvalid('fields');
    }

    /** @test */
    public function it_converts_the_book_listing_to_valid_csv_with_a_header(): void
    {
        Storage::fake();

        Book::factory()
            ->count(15)
            ->create();
    
        $response = $this->get('/download?format=csv&fields[]=author');

        $response->assertDownload('books.csv');
        Storage::assertExists('books.csv');

        $expected = array_map('array_values', Book::select(['author'])->get()->toArray());

        array_unshift($expected, ['author']);

        $actual = array_map('str_getcsv', file(Storage::path('books.csv')));

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_converts_the_book_listing_to_valid_xml(): void
    {
        Storage::fake();

        $books = Book::factory()
            ->count(15)
            ->create();

        $this->get('/download?format=xml&fields[]=author');
        $first_actual = Storage::get('books.xml');

        $this->get('/download?format=xml&fields[]=title');
        $second_actual = Storage::get('books.xml');

        $this->get('/download?format=xml&fields[]=title&fields[]=author');
        $third_actual = Storage::get('books.xml');

        Storage::assertExists('books.xml');

        $first_expected = $books->map(function ($book) {
            return '<book><author>' . $book->author .  '</author></book>';
        })->push("</root>\n")
        ->prepend("<?xml version=\"1.0\"?>\n<root>")
        ->join("");

        $second_expected = $books->map(function ($book) {
            return '<book><title>' . $book->title .  '</title></book>';
        })->push("</root>\n")
        ->prepend("<?xml version=\"1.0\"?>\n<root>")
        ->join("");

        $third_expected = $books->map(function ($book) {
            return '<book><title>' . $book->title .  '</title><author>' . $book->author .  '</author></book>';
        })->push("</root>\n")
        ->prepend("<?xml version=\"1.0\"?>\n<root>")
        ->join("");

        $this->assertEquals($first_expected, $first_actual);
        $this->assertEquals($second_expected, $second_actual);
        $this->assertEquals($third_expected, $third_actual);
    }
}
