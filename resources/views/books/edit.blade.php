@extends('layouts.app')

@section('content')

<div class="card">        
     <div class="card-body">


<h1>Edit Book</h1>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $book->title }}" class="form-control">
        @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" value="{{ $book->author }}" class="form-control">
        @if ($errors->has('author'))
            <span class="text-danger">{{ $errors->first('author') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" name="year" id="year" value="{{ $book->year }}" class="form-control">
        @if ($errors->has('year'))
            <span class="text-danger">{{ $errors->first('year') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $book->description }}</textarea>
        @if ($errors->has('description'))
            <span class="text-danger">{{ $errors->first('description') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" min="0" name="quantity" id="quantity" value="{{ $book->quantity }}" class="form-control">
        @if ($errors->has('quantity'))
            <span class="text-danger">{{ $errors->first('quantity') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" id="category" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == $book->category_id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
        @endif
    </div>
    <div class="mt-3 d-block">
    <button type="submit" class="btn btn-primary">Update Book</button>
<a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Book List</a>


    </div>
   
</form>           
     </div>
</div>

@endsection
