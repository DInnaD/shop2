<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Purchase extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['book_id', 'magazin_id', 
        'user_id', 'order_id', 'status_bought','status_paied', 'date', 'qty_m', 'qty', 'price', 'sum', 'sum_m', 'book_or_mag',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

        public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function magazin()
    {
        return $this->belongsTo(Magazin::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function author()//isAdmin
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public static function add($fields)
    {// var_dump(get_called_class());
    	$purchase = new static;
    	$purchase->fill($fields);
    	$purchase->book_id = Book::book()->id;
    	$purchase->magazin_id = Magazin::magazin()->id;
    	$purchase->user_id = Auth::user()->id;
    	$purchase->save();

    	return $purchase;

    }

    public function edit($fields)
    {
    	$this->fill($fields);
        //$this->qty = $fields['qty'];
        //$this->qty_m = $fields['qty_m'];
    	$this->save();
    }

    public function remove()
    {
    	//$this->removeImage();
    	$this->delete();
    }


    public function Buy()
    {
    	
    	$this->status_bought = 1;
    	$this->save();
    	
    }

    public function disBuy()
    {
    	$this->status_bought = 0;
    	$this->save();
    }

    public function toggleStatusBuy()
    {
    	if($this->status_bought == 0)
    	{
    		return $this->Buy();
    	}

    	return $this->disBuy();
    }    
    //for admin controller
    public function pay()
    {
    	
    	$this->status_paied = 1;
    	$this->save();
    	
    }

    public function disPay()
    {
    	$this->status_paied = 0;
    	$this->save();
    }

    public function toggleStatus()
    {
    	if($this->status_paied == 0)
    	{
    		return $this->pay();
    	}

    	return $this->disPay();
    }

    public function getDate()
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    }

    // public function isBook(){

    //     $this->book_or_magazin == 1;
    //     $this->save();    
    // }   

    // public function isMagazin(){

    //     $this->book_or_magazin == null;
    //     $this->save();    
    // } 

    // public function toggleBookOrMagazin()
    // {
    //     if($this->book_or_magazin == 1){
    //         return $this->isBook();
    //     }

    //     return $this->isMagazin();
        

    // }



    

 
    // // public function getSum()
    // {
    //     $user_id = \Auth::user()->id;
        //$orders = Order::where('user_id', $user_id)->where('status_bought', '1')->get();
    // $sum = 0;
    //     foreach ($orders as $order) {
    //         $sum += $order->qty * $order->book->price;
    //     return $this->getSum();
    // }
}
