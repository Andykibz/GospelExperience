<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Session;
use App\Event;
use App\Sermon;
use Image;
use Storage;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\Admin\TagController;
use File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events =  Event::get();
        return view('admin.event.index')->with([
          'events'  =>    $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create')->with([

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
        $media      = [];
        $tags       = [];
        $sermonIDs  = [];
        $audio = []; $videos=[]; $images = []; $youtube=[]; $archive_audio =[];
        $validator = $request->validate([
              'title'         => 'required',
              'poster'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
              'image_files.*' => 'mimes:jpg,jpeg,png,bmp|max:10000',
              'video_files.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
              'audio_files.*' => 'mimetypes:audio/mpeg,audio/ogg,audio/x-wav,audio/mp4	',
            ],[
              'images_files.*.required' => 'Please upload an image only',
              'images_files.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
              'videos_files.*mimetypes' => 'Only AVI and MP4',
              'audio_files.*mimetypes' => 'Only MP3,OGG,WAV,MP4 formats are allowed',
          ]);

        $event = new Event();
        // dd($request);
        if( !empty( $request->video_links )  ):
            $youtube = MediaController::youtubeHandling( $request->video_links );
        endif;
        if( !empty( $request->audio_links ) ):
            $archive_audio = MediaController::audioHandling( $request->audio_links );
        endif;
        if ($request->hasFile('image_files')):
            $images = MediaController::imageUploadHandling( $request );
        endif;
        if ($request->hasFile('video_files')):
            $videos = MediaController::videoUploadHandling( $request );
        endif;
        if ($request->hasFile('audio_files')):
            $audio = MediaController::audioUploadHandling( $request );
        endif;

        if($request->hasFile('poster')):
            //Get Filename
            $img = $request->file('poster');
            $fullname = $img->getClientOriginalName();
            $name = pathinfo($fullname,PATHINFO_FILENAME );
            $ext = $img->getClientOriginalExtension();
            $filename = $name.'_'.time().'.'.$ext;
            $img->storeAs( 'public/posters', $filename );
            $path = public_path( 'storage/posters/'.$filename );
            File::exists( public_path('/storage/posters/thumb/'.$filename) ) or
            File::makeDirectory(public_path("/storage/posters/thumb/"),$mode = 0755, $recursive = false, $force = true);
            $thumbpath = public_path( 'storage/posters/thumb/'.$filename );
            Image::make($path)->resize(800, 600,
                function($constraint) { $constraint->aspectRatio(); }
            )->save( $thumbpath, 78);
            $event->poster  = $filename;
        endif;

        $event->name      = $request->title;
        $event->slug      = slugify( $event, $request->title);
        $event->headline  = $request->headline;
        $event->body      = $request->body;
        $event->venue_id  = $request->venue;
        $event->date      = $request->date;
        $event->published = $request->publish ? True : False ;
        $event->from      = $request->from;
        $event->to        = $request->to;
        $event->save();

        if ( !empty($request->sermon) ) {
            $sermonIDs = SermonController::sermonHandling( $request->sermon );
        }
        if( isset($request->tags)):
            $event->tags()->sync( TagController::taghandling( $request->input('tags') ) );
        endif;
        $event->artists()->sync( $request->input('artist') );
        $media = array_merge( $youtube,$archive_audio, $images, $videos, $audio );
        $event->media()->saveMany( (object) $media );
        $event->sermons()->saveMany( $sermonIDs );
        // dd( array_merge( $youtube,$archive_audio, $images, $videos, $audio ) );
        Session::flash('success','Event created successfully');
        return redirect()->route('admin.event.show',$event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view( 'admin.event.view' )->with([
          'event' => $event
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
        $event = Event::find($id);
        return view( 'admin.event.edit' )->with([
          'event' => $event
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
      $event = Event::find($id);
      if( $event == NULL ){  abort(404); }
      $media      = [];
      $tags       = [];
      $sermonIDs  = [];
      $audio = []; $videos=[]; $images = []; $youtube=[]; $archive_audio =[];
      $validator = $request->validate([
            'title'         => 'required',
            // 'poster'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1999',
            'image_files.*' => 'mimes:jpg,jpeg,png,bmp|max:10000',
            'video_files.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            'audio_files.*' => 'mimetypes:audio/mpeg,audio/ogg,audio/x-wav,audio/mp4	',
          ],[
            'images_files.*.required' => 'Please upload an image only',
            'images_files.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
            'videos_files.*mimetypes' => 'Only AVI and MP4',
            'audio_files.*mimetypes' => 'Only MP3,OGG,WAV,MP4 formats are allowed',
        ]);

      // dd($request);
      if( !empty( $request->video_links )  ):
          $youtube = MediaController::youtubeHandling( $request->video_links );
      endif;
      if( !empty( $request->audio_links ) ):
          $archive_audio = MediaController::audioHandling( $request->audio_links );
      endif;
      if ($request->hasFile('image_files')):
          $images = MediaController::imageUploadHandling( $request );
      endif;
      if ($request->hasFile('video_files')):
          $videos = MediaController::videoUploadHandling( $request );
      endif;
      if ($request->hasFile('audio_files')):
          $audio = MediaController::audioUploadHandling( $request );
      endif;


      if($request->hasFile('poster')):
          if($event->poster != NULL):
              Storage::delete('public/posters/'.$event->poster);
              Storage::delete('public/posters/thumbs/'.$event->poster);
          endif;
          //Get Filename
          $img = $request->file('poster');
          $fullname = $img->getClientOriginalName();
          $name = pathinfo($fullname,PATHINFO_FILENAME );
          $ext = $img->getClientOriginalExtension();
          $filename = $name.'_'.time().'.'.$ext;
          $img->storeAs( 'public/posters', $filename );
          $path = public_path( 'storage/posters/'.$filename );
          File::exists( public_path('/storage/posters/thumb/'.$filename) ) or
          File::makeDirectory(public_path("/storage/posters/thumb/"),$mode = 0755, $recursive = false, $force = true);
          $thumbpath = public_path( 'storage/posters/thumb/'.$filename );
          Image::make($path)->resize(800, 600,
              function($constraint) { $constraint->aspectRatio(); }
          )->save( $thumbpath, 78);
          $event->poster  = $filename;
      endif;

      $event->name      = $request->title;
      $event->slug      = slugify( $event, $request->title);
      $event->headline  = $request->headline;
      $event->body      = $request->body;
      $event->venue_id  = $request->venue;
      $event->date      = $request->date;
      $event->published = $request->publish ? True : False ;
      $event->from      = $request->from;
      $event->to        = $request->to;
      $event->save();

      if ( !empty($request->sermon) ) {
          $sermonIDs = SermonController::sermonHandling( $request->sermon );
      }
      if( isset($request->tags)):
          $event->tags()->sync( TagController::taghandling( $request->input('tags') ) );
      endif;
      $event->artists()->sync( $request->input('artist') );
      $media = array_merge( $youtube,$archive_audio, $images, $videos, $audio );
      $event->media()->saveMany( (object) $media );
      $event->sermons()->saveMany( $sermonIDs );
      Session::flash('success','Event Updated successfully');
      return redirect()->route('admin.event.show',$event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $event = Event::find($id) ):
            Storage::delete('public/posters/'.$event->poster);
            Storage::delete('public/posters/thumbs/'.$event->poster);
            $event->media()->detach();
            $event->artists()->detach();
            $event->tags()->detach();
            $event->delete();
            Session::flash('info','Event removed from Database');
        else:
            Session::flash('warning','Couldn\'t find the event in the Database');
        endif;
        return redirect()->route('admin.event.index');
    }
}
