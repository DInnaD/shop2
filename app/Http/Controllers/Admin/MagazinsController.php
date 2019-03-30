<?php

namespace App\Http\Controllers\Admin;

use App\Magazin;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MagazinsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Magazin::class, 'magazin');
    }

    public function toggleDiscontGLM($id)
    {
        $user = Magazin::find($id);
        $user->toggleVisibleGLM();//dd($user->status_discont_id);

        return redirect()->back();
    }

    public function toggleDiscontGLMAll($id)
    {
        $user = Magazin::find($id);
        $user->toggleVisibleGLMAll();//dd($user->status_discont_id);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magazins = Magazin::all();
        return view('admin.magazins.index', ['magazins'=>$magazins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.magazins.create');
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
            'autor'   =>  'required',
            'number_per_year' =>  'required',
            'year' =>  'required',
            'number' =>  'required',
            'size' =>  'required',
            'price' =>  'required',
            'sub_price' =>  'required',
            'old_price' =>  'required',
            'img' =>  'nullable|image',
            
        ]);

        $magazin = Magazin::add($request->all());
        $magazin->uploadImage($request->file('img'));
        $magazin->toggleStatus($request->get('status'));
        //$magazin->toggleHit_magazin($request->get('hit_magazin'));

        return redirect()->route('magazins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
        //$magazin = Magazin::find($id);
        //return view('admin.magazins.show', compact('magazin'));
    //}
    /**
     * Display the specified resource.
     *
     * TODO: $id -> $magazin
     *
     * @param  Magazin  $magazin
     * @return \Illuminate\Http\Response
     */
    public function show(Magazin $magazin)
    {
        return view('homes.showM', compact('magazin'));
    }


    /**
     * Display the specified resource.
     *
     * TODO: $id -> $book
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    // public function showBook($slug)
    // {
    //     $book = Book::where('slug', $slug)->firstOrFail();
    //     return view('homes.showBook', compact('book'));
    // }
    
    public function showBook(Book $book)
    {
        return view('homes.showBook', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magazin = Magazin::find($id);
        
        return view('admin.magazins.edit', compact(
            
            'magazin'
           
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
            'autor'   =>  'required',
            'number_per_year' =>  'required',
            'year' =>  'required',
            'number' =>  'required',
            'size' =>  'required',
            'price' =>  'required',
            'sub_price' =>  'required',
            'old_price' =>  'required',
            'img' =>  'nullable|image',
            
        ]);

        $magazin = Magazin::find($id);
        $magazin->edit($request->all());
        $magazin->uploadImage($request->file('img'));
        $magazin->toggleStatus($request->get('status'));
        $magazin->toggleHit_magazin($request->get('hit_magazin'));

        return redirect()->route('magazins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Magazin::find($id)->remove();
        return redirect()->route('magazins.index');
    }
}
