<x-layout>
  @if ($errors->count() > 0)
  <div class="rounded-md bg-red-50 p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <!-- Heroicon name: solid/x-circle -->
        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="ml-3">
        <h3 class="text-sm font-medium text-red-800">
          There were {{ $errors->count() }} errors with your submission
        </h3>
        <div class="mt-2 text-sm text-red-700">
          <ul role="list" class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endif
  <form action="/books" method="POST" class="mb-6 px-3 xl:px-0">
    @csrf
    <div class="shadow sm:rounded-md sm:overflow-hidden">
      <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
        <div>
          <h3 class="text-lg leading-6 font-medium text-gray-900">Add a book</h3>
          <p class="mt-1 text-sm text-gray-500">A great place for you to jot down all the books you want to read.</p>
        </div>

        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-3">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" autocomplete="book-title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>

          <div class="col-span-6 sm:col-span-3">
            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
            <input type="text" name="author" id="author" autocomplete="author" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>
      </div>
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Save
        </button>
      </div>
    </div>
  </form>

  <div class="flex flex-col justify-between px-3 mb-2 xl:px-0 md:flex-row">
    <div class="md:max-w-sm flex-grow">
      <form action="/" method="GET">
        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
        <div class="mt-1 relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 flex items-center">
            <label for="column" class="sr-only">Column</label>
            <select id="column" name="column" autocomplete="column" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
              <option value="title">Title</option>
              <option value="author">Author</option>
            </select>
          </div>
          <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-24 sm:text-sm border-gray-300 rounded-md" placeholder="Grapes of wrath" value="{{ request()->search }}">
          <div class="absolute inset-y-0 right-0 flex items-center">
            <input type="submit" name="submit" value="Search" class="cursor-pointer bg-indigo-600 border border-transparent rounded-r-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          </div>
        </div>
      </form>
    </div>

    <form method="GET" action="/download" class="flex items-end py-2 sm:py-0">
      <fieldset class="w-full">
        <legend class="sr-only">File format</legend>
        <div class="space-x-1 flex items-center justify-between sm:space-x-10">
          <div class="flex items-center">
            <input id="csv" name="format" type="radio" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="csv">
            <label for="csv" class="ml-3 block text-sm font-medium text-gray-700">
              CSV
            </label>
          </div>

          <div class="flex items-center">
            <input id="xml" name="format" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="xml">
            <label for="xml" class="ml-3 block text-sm font-medium text-gray-700">
              XML
            </label>
          </div>

          <fieldset>
            <div class="relative flex items-start">
              <div class="flex items-center h-5">
                <input id="title" name="fields[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="title" checked>
              </div>
              <div class="ml-3 text-sm">
                <label for="title" class="font-medium text-gray-700">Title</label>
              </div>
            </div>
            <div class="relative flex items-start">
              <div class="flex items-center h-5">
                <input id="author" name="fields[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="author" checked>
              </div>
              <div class="ml-3 text-sm">
                <label for="author" class="font-medium text-gray-700">Author</label>
              </div>
            </div>
          </fieldset>

          <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Download
          </button>
        </div>
      </fieldset>
    </form>
  </div>

  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <a href="{{ url()->append(['sort_by' => 'title', 'direction' => $direction]) }}">Title</a>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <a href="{{ url()->append(['sort_by' => 'author', 'direction' => $direction]) }}">Author</a>
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Delete</span>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($books as $key => $book)
                <tr
                @if ($key % 2 === 0)
                  class="bg-white"
                @else
                  class="bg-gray-50"
                @endif
                  >
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $book->title }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <form action="/books/{{ $book->id }}" method="POST">
                      @method('PUT')
                      @csrf
                      <input type="text" name="author" value="{{ $book->author }}" class="outline-none border-0 bg-transparent p-0">
                    </form>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="/books/{{ $book->id }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <input type="submit" name="submit" value="Delete" class="bg-transparent font-semibold cursor-pointer text-indigo-600 hover:text-indigo-900">
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    No books added as of yet!
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-layout>