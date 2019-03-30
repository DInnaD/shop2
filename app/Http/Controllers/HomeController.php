<?php

namespace App\Http\Controllers;


use App\Book;
use App\Magazin;
use Auth;
use App\User;
use App\Purchase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        $magazins = Magazin::paginate(10);
        $users = User::all();
        $purchases = Purchase::all();
        return view('homes.index')->with('books', $books)->with('magazins', $magazins)->with('purchases', $purchases)->with('users', $users);
    }

    //public function top5

}
