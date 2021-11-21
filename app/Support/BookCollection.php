<?php

namespace App\Support;

use SimpleXMLElement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class BookCollection extends Collection
{
    public function toCsvOrXml(array $validated_input, string $filename): Collection
    {
        $this->when($validated_input['format'] === 'csv', function ($books) use ($filename) {
            $file_pointer = fopen(Storage::path($filename), 'w');

            fputcsv($file_pointer, array_keys($books->first()->toArray()));

            $books->each(fn ($book) => fputcsv($file_pointer, $book->toArray()));

            fclose($file_pointer);
        }, function ($books) use ($filename) {
            $xml = new SimpleXMLElement('<?xml version="1.0"?><root></root>');

            foreach ($books->toArray() as $book) {
                $node = $xml->addChild('book');
                
                foreach ($book as $key => $value) {
                    $node->addChild($key, $value);
                }
            }

            $xml->asXml(Storage::path($filename));
        });

        return $this;
    }
}