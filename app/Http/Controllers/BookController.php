<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::where("status", 1)->orderBy("id", "DESC")->paginate(3);
        return view("books.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("books.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "year_published" => "required|integer",
        ]);

        Book::create([
            "title" => $request->title,
            "author" => $request->author,
            "year_published" => $request->year_published,
        ]);

        return redirect()->route("books.index")->with("success", "تم إضافة الكتاب بنجاح.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view("books.create", compact("book"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "year_published" => "required|integer",
        ]);

        $book = Book::findOrFail($id);
        $book->update([
            "title" => $request->title,
            "author" => $request->author,
            "year_published" => $request->year_published,
        ]);

        return redirect()->route("books.index")->with("success", "تم تحديث الكتاب بنجاح.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->update(["status" => 0]);

        return redirect()->route("books.index")->with("success", "تم حذف الكتاب بنجاح.");
    }
}
