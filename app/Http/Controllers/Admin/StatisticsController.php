<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Magazin;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
	public function index()
	{
	
	    $books = Book::where('qty')->orderBy('qty','desc')->take(5)->get();
	    $magazins = Magazin::where('qty_m')->orderBy('qty_m','desc')->take(5)->get();
	    //$currentData === $purchase->create_at;
	        return view('admin.statistics.index')->with('books', $books)->with('magazins', $magazins);
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('purchases.show', compact('purchase'));
    }
}
