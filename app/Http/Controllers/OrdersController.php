<?php

namespace App\Http\Controllers;

use Auth;
use App\Magazin;
use App\Book;
use App\Order;
use App\Purchase;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function indexAll(Purchase $purchase->order_id Order $order)
    {

         $user_id = \Auth::user()->id;
         $orders = Order::all();
       //$purchases = $order->purchases; 
        return view('ordersAll.index', compact('order'));
    }
    
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(Order $order, Purchase $purchase)
    {
         return view('homes.payBuy', [
          'orders' => Order::orderBy('created_at', 'desc')->paginate(10)
        ]);
        // $orders = Order::all();
        // $purchases = Purchase::all();
        // return view('homes.payBuy', ['orders'=>$orders])->with('purchases', $purchases);
    }

    // public function show($id)
    // {
    //     return view('', compact('order'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {//is it true?
        $order = Order::find($id);
        $purchases = $order->purchases;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->remove();
        return redirect()->back();
    }


}
