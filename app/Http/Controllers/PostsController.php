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

use App\Video;

use App\News;

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


                $status = Post::create([
                    'user_id' => Auth::user()->id,
                    'content'=>$request->input('content'),
                    ]);

                foreach($files as $file) {
                    $rules = array('file' => 'required|image|max:1000'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                    $validator = Validator::make(array('file'=> $file), $rules);
                        if($validator->passes()){

                            $destinationPath = base_path() . '/public/status/';
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

        }
        else if($request->hasFile('video'))
        {
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:20000',
            ]);

            $status = Post::create([
                    'user_id' => Auth::user()->id,
                    'content'=>$request->input('content'),
                    ]);

            /*handling uploading the image*/
            $video = $request->video;

            $video_new_name = time().$video->getClientOriginalName();

            /*moving the image to public/uploads/post*/
            $video->move('videos', $video_new_name);

            Video::create([
                'user_id' => Auth::user()->id,
                'post_id' => $status->id,
                'videos' => 'videos/'.$video_new_name,
            ]);

            Session::flash('success', 'Post created successfully');
            return redirect()->back();

        }
        else if($request->hasFile('text'))
        {
                //dd($request->file('text')->getMimeType());
                $this->validate($request, [
                'text' => 'required|mimes:pdf,doc,text/rtf,docx,xlxs,xls,zip,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ]);

            $status = Post::create([
                    'user_id' => Auth::user()->id,
                    'content'=>$request->input('content'),
                    ]);

            /*handling uploading the image*/
            $text = $request->text;

            $text_new_name = time().$text->getClientOriginalName();

            /*moving the image to public/uploads/post*/
            $text->move('files', $text_new_name);

            News::create([
                'user_id' => Auth::user()->id,
                'post_id' => $status->id,
                'files' => 'files/'.$text_new_name,
            ]);

            Session::flash('success', 'Post created successfully');
            return redirect()->back();
        }
        else{
            $this->validate($request, [
            'content' => 'required',
            // 'see' => 'required',
             ]);

            Post::create([
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);
            
            Session::flash('success', 'Post created successfully');
            return redirect()->back();


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
