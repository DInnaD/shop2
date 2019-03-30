<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Purchase::class, 'purchase');
    }
    
	public function index()
    {

        $purchases = Purchase::all();//dd($purchases);
        return view('admin.purchases.index', ['purchases'=>$purchases]);
        // return $user->id === $purchase->update_by;
    }
    
    public function toggle($id)
    {
        $purchase = Purchase::find($id);
        $purchase->toggleStatus();


        return redirect()->back();
    }

    public function indexDayBefore()
    {
        $day = new \DateTime('now');
        $day = $day->sub(new \DateInterval('P1D'));
        //dd(time() - 1 * 24 *60 * 60);
        $purchases = Purchase::where('created_at', '>', $day)->get();
        // $date = time();
        // foreach ($purchases as $purchase) {
        //     $date = $purchase->date;
        // }
        return view('admin.purchases.index', ['purchases'=>$purchases]);
    }

    public function indexWeekBefore()
    {

        $day = new \DateTime('now');
        $day = $day->sub(new \DateInterval('P7D'));

        $purchases = Purchase::where('created_at', '>', $day)->get();
        
        
        return view('admin.purchases.index', ['purchases'=>$purchases]);
    }

    public function indexMonthBefore()
    {
        $day = new \DateTime('now');
        $day = $day->sub(new \DateInterval('P1M0D'));

        $purchases = Purchase::where('created_at', '>', time() - 30 * 24 *60 * 60)->get();
        return view('admin.purchases.index', ['purchases'=>$purchases]);
    }
    
}
