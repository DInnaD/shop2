<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Magazin extends Model
{
   use Sluggable;// use Selectable, SoftDeletes;//, Owned;

	const IS_DRAFT = 0;
	const IS_PUBLIC = 1;
    const IS_VISIBLE_DISCONT_GLM = 1;
    const IS_UNVISIBLE_DISCONT_GLM = 0;

	protected $fillable = ['user_id', 'category_id', 'slug', 'name', 'autor', 'number_per_year', 'year', 'number', 'size', 'price', 'sub_price', 'old_price', 'status', 'img', 'hit_magazin', 'discont_global',];



    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ]; 
    }

    public function getStatus()
    {
        return $this->purchases()->where('status', 0)->get();
    }


    public static function add($fields)
    {
    	$magazin = new static;
    	$magazin->fill($fields);
       // $magazin->orders_product_id = Orders_product::orders_product()->id;
    	$magazin->user_id = \Auth::user()->id;
    	$magazin->save();

    	return $magazin;
    }

    public function edit($fields)
    {
    	$this->fill($fields);
    	$this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage()
    {
        if($this->img != null)
        {
            Storage::delete('uploads/' . $this->img);
        }
    }

    public function uploadImage($img)
    {
        if($img == null) { return; }

        $this->removeImage();
        $filename = str_random(10) . '.' . $img->extension();
        $img->storeAs('uploads', $filename);
        $this->img = $filename;
        $this->save();
    }

    public function getImage()
    {
        if($this->img == null)
        {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->img;

    }
    

    //*******************
    public function setDraft()
    {
    	$this->status = Magazin::IS_DRAFT;
    	$this->save();
    }

    public function setPublic()
    {
    	$this->status = Magazin::IS_PUBLIC;
    	$this->save();
    }

    public function toggleStatus($value)
    {
    	if($value == null)
    	{
    		return $this->setDraft();
    	}

    	return $this->setPublic();
    }

    public function makeVisibleDiscontGLM()
    {
        $this->discont_privat = Magazin::IS_VISIBLE_DISCONT_GLM;
        $this->save();
    }

    public function makeUnVisibleDiscontGLM()
    {
        $this->discont_privat = Magazin::IS_UNVISIBLE_DISCONT_GLM;
        $this->save();
    }

    public function toggleVisibleGLM()
    {
        if($this->discont_privat != 1)//!= null default i nullable is the same?
        {
            return $this->makeVisibleDiscontGLM();
        }

        return $this->makeUnVisibleDiscontGLM();
    } 

    public function toggleVisibleGLMAll()
    {
        foreach ($magazins as $magazin) {
           
            if($this->discont_privat == 1)//!= null default i nullable is the same?
            {
                return $this->makeUnVisibleDiscontGLM();
            }
            
        }    
    }      

    public function setHit_magazin()
    {
    	$this->hit_magazin = 1;
    	$this->save();
    }

    public function setStandart()
    {
    	$this->hit_magazin = 0;
    	$this->save();
    }

    public function toggleHit_magazin($value)
    {
    	if($value == null)
    	{
    		return $this->setStandart();
    	}
    	
    	return $this->setFeatured();
    }

    // public function setDateAttribute($value)
    // {
    //     $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
    //     $this->attributes['date'] = $date;
    // }

    // public function getDateAttribute($value)
    // {
    //     $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');

    //     return $date;
    // }

    public function getCategoryTitle()
    {
        return ($this->category != null) 
                ?   $this->category->title
                :   'Нет категории';
    }

    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }

    // public function getDate()
    // {
    //     return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    // }

    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious(); //ID
        return self::find($postID);
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }

    public static function getPopularMagazins()
    {
        return self::orderBy('hit_magazin','desc')->take(5)->get();
    }

    
}
