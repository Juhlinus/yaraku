<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\DownloadRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortValidator = Validator::make($request->all(['sort_by', 'direction']), [
            'sort_by' => [
                'nullable',
                Rule::in(['author', 'title']),
            ],
            'direction' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ]);

        $searchValidator = Validator::make($request->all(['column', 'search']), [
            'column' => 'required_unless:search,null',
            'search' => 'required_unless:column,null',
        ]);

        if ($searchValidator->fails()) {
            return redirect('/');
        }

        $books = \App\Models\Book::sortedOrLatest(array_filter($sortValidator->validated()))
            ->filterBy(array_filter($searchValidator->validated()))
            ->get();

        return view('books.index', [
            'books' => $books,
            'direction' => $request->get('direction', 'desc') === 'desc' 
                ? 'asc' 
                : 'desc',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Book::create(
            $request->validate([
                'title' => 'required|min:3',
                'author' => 'required|min:3',
            ])
        );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update(
            $request->validate([
                'author' => 'required|min:3',
            ])
        );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back();
    }

    /**
     * Download the listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function download(DownloadRequest $request)
    {
        $validated = $request->validated();

        $filename = sprintf('books.%s', $validated['format']);

        Book::when(! empty($validated['fields']), fn ($books) => $books->select($validated['fields']))
            ->get()
            ->toCsvOrXml($validated, $filename);

        return Storage::download($filename);
    }
}
