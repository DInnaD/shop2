<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    
    public function __construct()
    {
        $this->authorizeResource(Book::class, 'book');
    }

    public function toggleDiscontGLB($id)
    {
        $user = Book::find($id);
        $user->toggleVisibleGLB();

        return redirect()->back();
    }

    public function toggleDiscontGLBAll($id)
    {
        $user = Book::find($id);
        $user->toggleVisibleGLBAll();

        return redirect()->back();
    }

    public function toggleHard($id)
    {
        $book = Book::find($id);
        $book->toggleHard();

        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', ['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $this->validate($request, [
            'name' =>'required',
            'author_name'   => 'required',
            'page' => 'required',
            'autor'   => 'required',
            'year' => 'required',
            'is_hard_hard' => 'required',
            'kindof' => 'required',
            'size'  => 'required',
            'price'   => 'required',
            'old_price' => '',
            'img' =>  'nullable|image',
        ]);

        $book = Book::add($request->all());

        $book->uploadImage($request->file('img'));
        //$book->toggleStatus($request->get('status'));//is draft
        $book->toggleDiscontGLB($request->get('discont_privat'));
        $book->toggleHard($request->get('is_hard_hard'));
        // $book->toggleHit_book($request->get('hit_book'));

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
         //$book = Book::find($id);
        //return view('admin.books.show', compact('book'));
    //}
    /**
     * Display the specified resource.
     *
     * TODO: $id -> $book
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('homes.showB', compact('book'));
    }
    /**
     * Display the specified resource.
     *
     * TODO: $id -> $magazin
     *
     * @param  Magazin  $magazin
     * @return \Illuminate\Http\Response
     */
    // public function showMagazin($slug)
    // {
    //     $magazin = Magazin::where('slug', $slug)->firstOrFail();
    //     return view('homes.showMagazin', compact('magazin'));
    // }
    // public function showMagazin($id)
    // {
    //     return view('homes.showMagazin', compact('magazin'));
    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);

        return view('admin.books.edit', compact(
            'book'
        ));

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
        $this->validate($request, [
            'name' =>'required',
            'author_name'  =>  'required',
            'page' => 'required',
            'autor' => 'required',
            'year' => 'required',
            'is_hard_hard' => 'required',
            'kindof' => 'required',
            'size'  => 'required',
            'price'   => 'required',
            'old_price' => '',
            'img' =>  'nullable|image',
        ]);

        $book = Book::find($id);
        $book->edit($request->all());
        $book->uploadImage($request->file('img'));
        //$book->toggleStatus($request->get('status_draft'));
        $book->toggleDiscontGLB($request->get('discont_privat'));
        $book->toggleHard($request->get('is_hard'));
        //$book->toggleHit_book($request->get('hit_book'));

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->remove();
        return redirect()->route('books.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Book $book)
    // {
    //     $book->delete();

    //     return redirect()->route('books.index');
    // }
}
