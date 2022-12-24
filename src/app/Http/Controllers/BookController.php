<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $published_year = $request->query('published_year');
        if ($published_year) {
            $books = Book::where('published_year', $published_year)->get();
        } else {
            $books = Book::all();
        }
        return response()->json(
            $books,
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json(
            $book,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::where('id', $id)->first();
        if ($book) {
            return response()->json(
                $book,
                200
            );
        } else {
            return response()->json(
                [
                    'message' => "Book $id not found"
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = [
            'title' => $request->title, 'author' => $request->author, 'published_year' => $request->published_year
        ];
        $book = Book::where('id', $id)->update($update);
        if ($book) {
            return response()->json(
                $book,
                201
            );
        } else {
            return response()->json([
                'message' => 'Book not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::where('id', $id)->delete();
        if ($book) {
            return response()->json([
                'message' => 'Book deleted successfully',
            ], 202);
        } else {
            return response()->json([
                'message' => 'Book not found',
            ], 404);
        }
    }
}
