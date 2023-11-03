<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    private function validateAndSaveBook(Book $book, BookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $book->fill($validatedData)->save();
            return true;
        } catch (ValidationException $e) {
            return false;
        }
    }

    private function getBooks($request)
    {
        $categories = Category::all();
        $selectedCategory = $request->input('category');
        $searchQuery = $request->input('search');

        return Book::with('category')
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->where('category_id', $selectedCategory);
            })
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->search($searchQuery);
            })
            ->paginate(10);
    }

    private function prepareViewData($request)
    {
        $categories = Category::all();
        $selectedCategory = $request->input('category');
        $searchQuery = $request->input('search');
        $books = $this->getBooks($request);
        return compact('books', 'categories', 'selectedCategory', 'searchQuery');
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            return view('books.index', $this->prepareViewData($request));
        } else {
            return view('books.guest', $this->prepareViewData($request));
        } 
    }

    public function store(BookRequest $request)
    {
        $book = new Book();
        if ($this->validateAndSaveBook($book, $request)) {
            return redirect()->route('books.edit', compact('book'))->with('success', 'Book added successfully');
        }
        return redirect()->back()->withErrors($request->validator)->withInput();
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);
       
        if (!$book){
            return redirect()->route('books.index')->with('error', 'Book not found');
        }

        if ($this->validateAndSaveBook($book, $request)) {
            return redirect()->route('books.edit', compact('book'))->with('success', 'Book updated successfully');
        }
        return redirect()->back()->withErrors($request->validator)->withInput();
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book){
            return redirect()->route('books.index')->with('error', 'Book not found');
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        if (!$book){
            return redirect()->route('books.index')->with('error', 'Book not found');
        }
        $categories = Category::all();

        return view('books.edit', compact('book','categories'));
    }

    public function show($id)
    {
        $book = Book::find($id);  
        if (!$book){
            return redirect()->route('books.index')->with('error', 'Book not found');
        }
        $categories = Category::all();
        return view('books.edit', compact('book','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

}
