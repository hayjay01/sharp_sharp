<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Auth;

use Illuminate\Support\Facades\Input;

use Session;

use App\Image;

use App\User;

use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         
        if($request->hasFile('image'))
        {
            if(count($request->image) > 2)
            {
                Session::flash('error', 'You cannot upload more than two picture per post');
                return redirect()->back();
            }
            else
            {
                
                // getting all of the post data
                $files = Input::file('image');

                // Making counting of uploaded images
                $file_count = count($files);

                // start count how many uploaded
                $uploadcount = 0;

                $status = Auth::user()->posts()->create([
                    'content'=>$request->input('post'),
                    ]);

                foreach($files as $file) {
                    $rules = array('file' => 'required|image|max:1000'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                    $validator = Validator::make(array('file'=> $file), $rules);
                        if($validator->passes()){
                            $destinationPath = base_path() . 'status/';
                                $filename = $file->getClientOriginalName();
                                $upload_success = $file->move($destinationPath, $filename);
                                $uploadcount ++;
                            
                            Image::create([
                                'user_id' => Auth::user()->id,
                                'post_id' => $status->id,
                                'images' => 'status/' . $filename,
                            ]);

                        }
                }

                if($uploadcount == $file_count){
                    Session::flash('success', 'Post created successfully');
                    return redirect()->back();
                }
                else {
                    Session::flash('error', 'Could not upload your images, please make sure they are of the type image');
                    return redirect()->back();
                }
            }
        }else{
            $this->validate($request, [
            'post' => 'required',
            'see' => 'required',
        ]);

        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
