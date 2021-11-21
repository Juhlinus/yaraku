<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class CollectionTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_parses_csv_and_xml(): void
    {
        Storage::fake();

        $books = Book::factory()
            ->count(15)
            ->create();

        $books->toCsvOrXml(['format' => 'csv'], 'filename.csv');
        $books->toCsvOrXml(['format' => 'xml'], 'filename.xml');

        Storage::assertExists('filename.csv');
        Storage::assertExists('filename.xml');
    }
}
