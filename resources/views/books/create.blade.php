@extends('layouts.app')

@section('content')

<div class="card">        
     <div class="card-body">
                       


<h1>Create Book</h1>

<form action="{{ route('books.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
        @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" value="{{ old('author') }}" class="form-control">
        @if ($errors->has('author'))
            <span class="text-danger">{{ $errors->first('author') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" name="year" id="year" value="{{ old('year') }}" class="form-control">
        @if ($errors->has('year'))
            <span class="text-danger">{{ $errors->first('year') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        @if ($errors->has('description'))
            <span class="text-danger">{{ $errors->first('description') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control">
        @if ($errors->has('quantity'))
            <span class="text-danger">{{ $errors->first('quantity') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" id="category" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
        @endif
    </div>
    <div class="mt-3 d-block">
    <button type="submit" class="btn btn-success">Create Book</button>
               
<a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Book List</a>


    </div>
    
</form>            
     </div>
</div>
@endsection