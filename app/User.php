<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    const IS_ADMIN = 1;
    const IS_USER = 0;
    const IS_BANNED = 1;
    const IS_ACTIVE = 0;
    const IS_VISIBLE_DISCONT_ID = 1;
    const IS_UNVISIBLE_DISCONT_ID = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function magazins()
    {//est one data for curr table
        return $this->hasMany(Magazin::class);
    }

    public function books()
    {//est one data for curr table
        return $this->hasMany(Book::class);
    }

     public function purchases()
    {//est one data for curr table
        return $this->hasMany(Purchase::class);
    }

     public function orders()
    {//est one data for curr table
        return $this->hasMaany(Order::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->password = bcrypt($fields['password']);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields); //name,email
        $this->password = bcrypt($fields['password']);
        //if($this->is_admin == 1){
            //$this->discont_id = $fields['discont_id'];
        //}
       
        $this->save();
    }

    public function generatePassword($password)
    {
        if($password != null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove()
    {
        //$this->removeAvatar();
        $this->delete();
    }
//add migration image
    // public function uploadAvatar($image)
    // {
    //     if($image == null) { return; }

    //     $this->removeAvatar();

    //     $filename = str_random(10) . '.' . $image->extension();
    //     $image->storeAs('uploads', $filename);
    //     $this->avatar = $filename;
    //     $this->save();
    // }

    // public function removeAvatar()
    // {
    //     if($this->avatar != null)
    //     {
    //         Storage::delete('uploads/' . $this->avatar);
    //     }
    // }

    // public function getImage()
    // {
    //     if($this->avatar == null)
    //     {
    //         return '/img/no-image.png';
    //     }

    //     return '/uploads/' . $this->avatar;
    // }

    public function makeAdmin()
    {
        $this->is_admin = User::IS_ADMIN;
        $this->save();
    }

    public function makeNormal()
    {
        $this->is_admin = User::IS_USER;
        $this->save();
    }

    public function toggleAdmin()
    {
        if($this->is_admin == 0)
        {
            return $this->makeAdmin();
        }

        return $this->makeNormal();
    }

    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    public function toggleBan()
    {
        if($this->status == 0)
        {
            return $this->unban();
        }

        return $this->ban();
    }

    public function makeVisibleDiscontId()
    {
        $this->status_discont_id = User::IS_VISIBLE_DISCONT_ID;
        $this->save();
    }

    public function makeUnVisibleDiscontId()
    {
        $this->status_discont_id = User::IS_UNVISIBLE_DISCONT_ID;
        $this->save();
    }

    public function toggleVisibleId()
    {
        if($this->status_discont_id == 0)
        {
            return $this->makeVisibleDiscontId();
        }

        return $this->makeUnVisibleDiscontId();
    }

    public function toggleVisibleIdAll()
    {
        foreach($users as $user) {

            if($this->status_discont_id == 1)
            {
                return $this->makeUnVisibleDiscontId();
            }

        }
        

        
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

    // public function visibleDiscontId(){
    //     $this->status_discont_id = 1;//User::IS_VISIBLE_DISCONT_ID;
    //     $this->save;
    // }

    // public function unvisibleDiscontId(){
    //     $this->status_discont_id = 0;//User::IS_UNVISIBLE_DISCONT_ID;
    //     $this->save;
    // }

    // public function toggleDiscont(){
    //     if($this->status_discont_id == 0){
    //         return $this->unvisibleDiscontId();
    //     }
    //     return $this->visibleDiscontId();
    // }
}
