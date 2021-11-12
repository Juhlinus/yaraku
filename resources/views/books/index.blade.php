<x-layout>
  <form action="/books" method="POST" class="mb-6">
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

  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <a href="/?sort_by=title&direction={{ $direction }}">Title</a>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <a href="/?sort_by=author&direction={{ $direction }}">Author</a>
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