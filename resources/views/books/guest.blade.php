@extends('layouts.app')

@section('content')

<h1>Welcome, Guest!</h1>
<a class="btn btn-primary" href="{{ route('login') }}">Login as Librarian</a>
    <a class="btn btn-success" href="{{ route('register') }}">Register as Librarian</a>
   <hr>
   <h2>Lista Książek</h2>

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

                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $books->appends(['category' => $selectedCategory, 'search' => $searchQuery])->links() }}
    </div>

@endsection
