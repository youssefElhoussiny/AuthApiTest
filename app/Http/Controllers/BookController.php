<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    protected $image_path  = "app/public/images/covers";
    protected $img_height = 600;
    protected $img_width = 600;

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $image = $request->file('image');

        $imageName = time().'.'.$image->extension();

        $image->storeAs('public', $imageName);

        $imagePath = '/storage/'.$imageName;


        $book = Book::create($data);
        return response()->json(['message' => 'Image uploaded successfully', 'image_path' => $imagePath]);
        // return $book;
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json(['message' => 'Book returned successfully', 'book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

}
