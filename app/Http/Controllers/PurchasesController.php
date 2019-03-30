<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Magazin;
use App\Book;
use App\Order;
use App\Purchase;

class PurchasesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Purchase::class, 'purchase');
    }

    public function toggleBeforeToggle($id)
    {
        $purchase = Purchase::find($id);//where it got// order in toggle
        $purchase->toggleStatusBuy();

        
        return redirect()->back();
    }

    $summa = 0;
    public function summa($summa)
    {
        //             //$summa += $purchase->book->price * qty + $purchase->magazin->price * qty_m;///count() from purch to order///

    // $summa = 0;    

        foreach ($purchases as $purchase) {

            if($purchase->first()->book->author->status_discont_id == 1 && $purchase->first()->book->discont_privat != null && $purchase->magazin->author->status_discont_id == 1 && $purchase->magazin->discont_privat != null)

            {

                if ($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id && $purchase->magazin->discont_global >= $purchase->magazin->author->discont_id) 

                {

                    $summa += ($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty + ($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m;

                } else {

                        $summa += ($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty + $purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m;
                        }

            } elseif($purchase->first()->book->discont_privat != null && $purchase->magazin->discont_privat != null)

                {
                    $summa += ($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty + ($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m;

                } elseif($purchase->first()->book->author->status_discont_id == 1 && $purchase->magazin->author->status_discont_id == 1)

                    {

                        $summa += ($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty + ($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m;

                    } else {
                            $summa += $purchase->first()->book->price  * $purchase->qty + $purchase->magazin->price * $purchase->qty_m;
                            }   
}
    }
    //Pay button on the cart
    public function buy(Request $request, $summa)

    {

        $user_id = \Auth::user()->id;
        $purchases = Purchase::where('user_id', $user_id)->where('status_bought', '!=', 'null')->where('status_paied', '!=', '1')->get();

        $order = new Order(); 
        $order = Order::add($request->get('id'));
        $order->user_id = \Auth::user()->id; 
        $order->sum = $summa;


        foreach ($purchases as $purchase) {

            $purchase->order_id = $order->id;
            $qty = 0;
            $qty_m = 0;
            if($purchase->order_id == $order->id)
            {
                $qty = $purchase->qty->count();
                $qty_m = $purchase->qty_m->count();
            }
            $purchase->toggleStatus();
            if($purchase->status_bought == 1)
            {
                $purchase->remove();
            }
        } 

        $order->qty = $qty;
        $order->qty_m = $qty_m;
        $order->save();
            
        return redirect()->route('cart');//to pay service
    }             
                 
            
                                    

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexCart()
    {
        $user_id = \Auth::user()->id;
        //clean cart auto account paid confirm
        if(true)
        {
            $purchases = Purchase::where('user_id', $user_id)->where('status_bought', '!=', 'null')->where('status_paied', '==', '0')->get();
        }    
            return view('purchases.index', ['purchases'=>$purchases]);
        

        //return view('purchases.thanksForPaid');//?on

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Purchase $purchase, Book $book, Magazin $magazin)
    {

         $user_id = \Auth::user()->id;
         $purchases = Purchase::all();//->orderBy('created_at', 'desc')->paginate(10);//query()->with(['book', 'magazin'])->get();//->toArray();
        return view('homes.pay', ['purchases'=>$purchases]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($purchase->book_id != null){
                $this->validate($request, [
                    'qty'   =>  'required'
                ]);//not 0
        }
        else{
                $this->validate($request, [
                    'qty_m'   =>  'required'
                ]);//not 0
        }

        $purchase = new Purchase;
        $purchase->qty = $request->get('qty');
        $purchase->qty_m = $request->get('qty_m');
        $purchase->book_id = $request->get('book_id');
        $purchase->magazin_id = $request->get('magazin_id');
        //$purchase->order_id = $request->get('order_id');//make buy button
        $purchase->user_id = \Auth::user()->id;
        $purchase->save();

        
        return redirect()->route('purchases.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);

       // return view('purchases.edit', compact(
       //     'purchase'
       // ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // { 
    //     $purchase = Purchase::find($id);
    //     $purchase->edit($request->get('qty'));
    //     $purchase->edit($request->get('qty_m'));

    //     return redirect()->route('cart');
        
    // }
        public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::find($id)->remove();
        return redirect()->back();
    }

    public function destroyAll()
    {
        foreach ($purchases as $purchase) {
            $purchase->remove();
        }
        return redirect()->back();
    }
}
