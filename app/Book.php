<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes, Searchable;//Sluggable;//use Selectable, //, Owned; 

	const IS_DRAFT = 0;//chornovyk
	const IS_PUBLIC = 1;//published
    const IS_HARD = 1;
    const IS_NOHARD = 0;
    const IS_VISIBLE_DISCONT_GLB = 1;
    const IS_UNVISIBLE_DISCONT_GLB = 0;

	protected $fillable = ['user_id', 'slug', 'name', 'autor', 'page', 'year', 'is_hard', 'is_hard_hard', 'kindof', 'size', 'price', 'old_price', 'status', 'img', 'discont_global', ];


    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function author()//isAdmin
    {
    	return $this->belongsTo(User::class, 'user_id');
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
        return $this->purchases()->where('status', 1)->get();
    }

    public static function add($fields)
    {
    	$book = new static;
    	$book->fill($fields);
    	$book->user_id = \Auth::user()->id;// not use in hidden input - everyone can change with id=1 
        //$book->orders_product_id = Orders_product::orders_product()->id;//orders_product_id = $request->get('orders_product_id');
    	$book->save();

    	return $book;
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


    // public function setDraft()//chernovik
    // {
    // 	$this->status_draft = Book::IS_DRAFT;
    // 	$this->save();
    // }

    // public function setPublic()
    // {
    // 	$this->status_draft = Book::IS_PUBLIC;
    // 	$this->save();
    // }

    // public function toggleStatus($value)
    // {
    // 	if($value == null)//$value error
    // 	{
    // 		return $this->setDraft();
    // 	}

    // 	return $this->setPublic();
    // }

    public function setHard()//chernovik
    {
        $this->is_hard_hard = Book::IS_HARD;
        $this->save();
    }

    public function setNoHard()
    {
        $this->is_hard_hard = Book::IS_NOHARD;
        $this->save();
    }

    public function toggleHard()
    {
        if($this->is_hard_hard == 0)
        {
            return $this->setNoHard();
        }

        return $this->setHard();
    }

    public function makeVisibleDiscontGLB()
    {
        $this->discont_privat = Book::IS_VISIBLE_DISCONT_GLB;
        $this->save();
    }

    public function makeUnVisibleDiscontGLB()
    {
        $this->discont_privat = Book::IS_UNVISIBLE_DISCONT_GLB;
        $this->save();
    }

    public function toggleVisibleGLB()
    {
        if($this->discont_privat != 1)//!= null default i nullable is the same?
        {
            return $this->makeVisibleDiscontGLB();
        }

        return $this->makeUnVisibleDiscontGLB();
    }  

    public function toggleVisibleGLBAll()
    {
        foreach ($books as $book) {
                if($this->discont_privat == 1)//!= null default i nullable is the same?
            {
                return $this->makeUnVisibleDiscontGLB();
            }
            
        }
        return redirect()->back();
        
    }  

    // public function setHit_book()//recomended or top5
    // {
    // 	$this->hit_book = 1;
    // 	$this->save();
    // }

    // public function setStandart()
    // {
    // 	$this->hit_book = 0;
    // 	$this->save();
    // }

    // public function toggleHit_book($value)//ban
    // {
    // 	if($value == null)
    // 	{
    // 		return $this->setStandart();
    // 	}
    	
    // 	return $this->setHit_book();
    // }
    
    // public function setHard()//recomended or top5
    // {
    //     $this->is_hard = 1;
    //     $this->save();
    // }

    // public function setNoHard()
    // {
    //     $this->is_hard = 0;
    //     $this->save();
    // }

    // public function toggleHard($value)//ban
    // {
    //     if($value == null)
    //     {
    //         return $this->setNoHard();
    //     }
        
    //     return $this->setHard();
    // }
//*****************
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



    // public function getDate()
    // {
    //     return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    // }

        // public function getCategoryTitle()
    // {
    //     return ($this->category != null) 
    //             ?   $this->category->title
    //             :   'Нет категории';
    // }

    // public function getCategoryID()
    // {
    //     return $this->category != null ? $this->category->id : null;
    // }

    // public function hasPrevious()
    // {
    //     return self::where('id', '<', $this->id)->max('id');
    // }

    // public function getPrevious()
    // {
    //     $postID = $this->hasPrevious(); //ID
    //     return self::find($postID);
    // }

    // public function hasNext()
    // {
    //     return self::where('id', '>', $this->id)->min('id');
    // }

    // public function getNext()
    // {
    //     $postID = $this->hasNext();
    //     return self::find($postID);
    // }

    // public function related()
    // {
    //     return self::all()->except($this->id);
    // }

    public static function getPopularBooks()
    {
        return self::orderBy('hit_book','desc')->take(5)->get();
    }
}
