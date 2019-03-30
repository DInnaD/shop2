<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //trash for user create boook magaz->purch->order
    //получить всех подписчиков из списка просто вызвав свойство обьекта, с которым они связаны
        //$subscribers = $bunch->subscribers;
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function toggleAdmin($id)
    {
        $user = User::find($id);
        $user->toggleAdmin();


        return redirect()->back();
    }

    public function toggleBan($id)
    {
        $user = User::find($id);
        $user->toggleBan();


        return redirect()->back();
    }

    public function toggleDiscontId($id)
    {
        $user = User::find($id);
        $user->toggleVisibleId();//dd($user->status_discont_id);

        return redirect()->back();
    }

    public function toggleDiscontIdAll($id)
    {
        $user = User::find($id);
        $user->toggleVisibleIdAll();//dd($user->status_discont_id);

        return redirect()->back();
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users'   =>  $users]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required',
            'email' =>  'required|email|unique:users',
            'password'  =>  'required',
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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
        

        $user = User::find($id);

        $this->validate($request, [
            'name'  =>  'required',
            'email' =>  [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->edit($request->all()); 
        $user->generatePassword($request->get('password'));
        // if($user->is_admin == 1){
        //     $user->$request->get('discont_id');
        // }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->remove();

        return redirect()->route('users.index');
    }
}
