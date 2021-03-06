<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct(Request $request)
    {
        if (!$request->isJson()){
            $this->middleware('auth');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->isJson()){
            return $users;
        } else {
            return view ('users.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $groups = Group::all();
        return view('users.create', compact('user', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);

        $user = new User;
        $user->group_id = $request->get('group_id');
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();

        if ($request->isJson()){
            return response()->json($user, 200);
        } else {
            return redirect('/admin/users')->with('success', 'User created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->isJson()){
            return response()->json($user, 200);
        } else {
            return view('users.show', compact('user'));
        }
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
        $groups = Group::all();
        return view('users.edit', compact('user', 'groups'));
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
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $user = User::find($id);
        $user->group_id = $request->get('group_id');
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();

        if ($request->isJson()){
            return response()->json($user, 200);
        } else {
            return redirect('/admin/users')->with('success', 'User updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::find($id);
        $user->delete();

        if ($request->isJson()){
            return response()->json("", 200);
        } else {
            return redirect('/admin/users')->with('success', 'User deleted!');
        }
    }
}
