<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class GroupsController extends Controller
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
        $groups = Group::all();
        if ($request->isJson()){
            return $groups;
        } else {
            return view ('groups.index', compact('groups'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group;
        return view('groups.create', compact('group'));
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
            'name'=>'required|unique:groups'
        ]);

        $group = new Group;
        $group->name =  $request->get('name');
        $group->save();

        if ($request->isJson()){
            return response()->json($group, 200);
        } else {
            return redirect('/admin/groups')->with('success', 'Group created!');
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
        $group = Group::find($id);

        if($group->users->count() > 0 ){
            if ($request->isJson()){
                return response()->json("", 405);
            } else {
                return redirect('/admin/groups')->with('error', 'Not deleted!');
            }

        } else {
            $group->delete();

            if ($request->isJson()){
                return response()->json("", 200);
            } else {
                return redirect('/admin/groups')->with('success', 'Group deleted!');
            }
        }

    }

}
