<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Book;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

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

    public function index(Request $request)
    {
        $selectedCategory = $request->input('category');
        $searchQuery = $request->input('search');
        $books = Book::when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->where('category_id', $selectedCategory);
            })
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->search($searchQuery);
            })->select('id', 'title', 'author', 'description','year', 'quantity', 'category_id')
            ->paginate(10);
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $book = new Book();
        if ($this->validateAndSaveBook($book, $request)) {
            return response()->json(['message' => 'Book added successfully'], 200);
        }
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $request->validator->errors(),
            'input' => $request->all()
        ], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('category')->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $book = Book::with('category')->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        if ($this->validateAndSaveBook($book, $request)) {
            return response()->json(['message' => 'Book updated successfully'], 200);
        }
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $request->validator->errors(),
            'input' => $request->all()
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::with('category')->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
