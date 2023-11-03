
@extends('layouts.app')

@section('content')


<h1>Welcome, {{ Auth::user()->name }}!</h1>


<a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>

   <hr>
   <h2>Lista Książek</h2>

    <a href="{{ route('books.create') }}" class="btn btn-success">Add New Book</a>

    <form action="{{ route('books.index') }}" method="GET">
    <div class="form-group">
        <label for="category">Select Category:</label>
        <select name="category" id="category" class="form-control" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                        {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search book..."
               value="{{ $searchQuery }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </div>
</form>


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Year</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($books->isEmpty())
                <tr>
                    <td colspan="7">No books found.</td>
                </tr>
            @else
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->description }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bookid="{{ $book->id }}" data-bookname="{{ $book->title }}">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $books->appends(['category' => $selectedCategory, 'search' => $searchQuery])->links() }}
</div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the book: <span id="bookName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
          $(document).ready(function() {
            $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var bookId = button.data('bookid');
            var form = $('#deleteForm');
            form.attr('action', '/books/' + bookId); 

            var bookName = button.data('bookname');
            var modal = $(this);
            modal.find('#bookName').text(bookName);
        });
        });

    </script>

@endsection
