<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;

use App\Category;

use Validator;

use Auth;

use Session;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group::orderBy('created_at', 'desc')->get();
        return view('dashboard.group.index')->with('group', $group);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.group.create')->with('category', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:groups',
            'category' => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()->all()]);
        }else{

            Group::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'category_id' => $request->category,
                'details' => $request->details,
                'slug' => str_slug($request->title),
            ]);

            return response()->json(['success'=>'Success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myGroup()
    {
        $group = Group::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.group.mygroup')->with('group', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function groupSingle($slug)
    {
        $group = Group::where('slug', $slug)->first();
        return view('dashboard.group.single_group')->with('group', $group);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
