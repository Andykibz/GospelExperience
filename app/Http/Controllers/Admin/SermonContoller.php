<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\TagController;
use Session;
use Storage;
use Image;
use App\Sermon;

class SermonController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sermons =  Sermon::all();
        return view('admin.sermon.index')->with([
          'sermons'  =>    $sermons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sermon.create')->with([

          ]);
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
            'title'      => 'required',
            'sermon_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1999',
        ]);
        $sermon = new Sermon();
        if($request->hasFile('sermon_image')):
            //Get Filename
            $img = $request->file('sermon_image');
            $fullname = $img->getClientOriginalName();
            $name = pathinfo($fullname,PATHINFO_FILENAME );
            $ext = $img->getClientOriginalExtension();
            $filename = $name.'_'.time().'.'.$ext;
            $img->storeAs('public/image/',$filename);
            $path = public_path('storage/image/'.$filename);
            $img = Image::make($path)->resize(800, 600)->save($path,80);
            $sermon->sermon_image    = $filename;
        endif;

        $sermon->title           = $request->title;
        $sermon->slug            = slugify($sermon,$request->title);
        $sermon->speaker         = $request->speaker;
        $sermon->body            = $request->body;
        $sermon->save();
        if( isset($request->tags)):
            $sermon->tags()->sync( TagController::taghandling( $request->input('tags') ) );
        endif;
        Session::flash('success','Sermon created successfully');
        return redirect()->route('admin.sermon.show',$sermon->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sermon = Sermon::find($id);
        return view( 'admin.sermon.view' )->with([
          'sermon' => $sermon
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sermon = Sermon::find($id);
        return view( 'admin.sermon.edit' )->with([
          'sermon' => $sermon
        ]);
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
      $sermon = Sermon::find($id);
      $request->validate([
          'title'      => 'required',
          'sermon_image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:1999',
      ]);
      if($request->hasFile('sermon_image')):
          // Delete previous Poster
          if (isset( $sermon->image )):
            Storage::delete('public/image/'.$sermon->image);
          endif;

          //Get Filename
          $img = $request->file('sermon_image');
          $fullname = $img->getClientOriginalName();
          $name = pathinfo($fullname,PATHINFO_FILENAME );
          $ext = $img->getClientOriginalExtension();
          $filename = $name.'_'.time().'.'.$ext;
          $img->storeAs('public/image',$filename);
          $path = public_path('storage/image/'.$filename);
          $img = Image::make($path)->resize(800, 600)->save($path,80);
          $sermon->sermon_image    = $filename;
      endif;

      $sermon->title           = $request->title;
      $sermon->slug            = slugify($sermon,$request->title);
      $sermon->speaker         = $request->speaker;
      $sermon->body            = $request->body;
      $sermon->save();
      if( isset($request->tags)):
          $sermon->tags()->sync( TagController::taghandling( $request->input('tags') ) );
      endif;
      Session::flash('info','Sermon updated');
      return redirect()->route('admin.sermon.show',$sermon->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $sermon = Sermon::find($id) ):
            Storage::delete('public/image/'.$sermon->sermon_image);
            $sermon->delete();
            Session::flash('info',"$sermon->title Deleted successfully");
        else:
            Session::flash('warning','Couldn\'t find the sermon in the Database');
        endif;
        return redirect()->route('admin.sermon.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function sermonHandling( $sermons )
    {
        $sermon_list = [];
        $smn = new Sermon();
        foreach ($sermons as $sermon) {
          array_push( $sermon_list, Sermon::create([
                  'title'   =>  $sermon['title'], 'slug'    =>  slugify($smn,$sermon['title']),
                  'speaker' => $sermon['speaker'], 'body' => $sermon['body']
                ])
            );
        }
        return $sermon_list;
    }

}
