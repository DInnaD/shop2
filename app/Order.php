<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;


class Order extends Model
{
	//use SoftDeletes;//Selectable, Owned;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'qty', 'qty_m', 'status', 'note', 'date', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function author()//isAdmin
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add($id)
    {// var_dump(get_called_class());
        $order = new static;
        //$order->fill($fields);
        $order->id = $id;
        $order->user_id = \Auth::user()->id;
        $order->sum = $summa;
        $order->sum = $qty;
        $order->sum = $qty_m;
        $order->save();

        return $order;

    }

    public function allow()
    {
    	$this->status = 1;
    	$this->save();
    }

    public function disAllow()
    {
    	$this->status = 0;
    	$this->save();
    }

    public function toggleStatus()
    {
    	if($this->status == 0)
    	{
    		return $this->allow();
    	}

    	return $this->disAllow();
    }

    public function getDate()
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    }
 
    
}
