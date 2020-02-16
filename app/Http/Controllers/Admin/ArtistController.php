<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artist;
use Session;
use Image;
use Storage;
use App\Http\Controllers\Admin\TagController;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists =  Artist::all();
        return view('admin.artist.index')->with([
          'artists'  =>    $artists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artist.create')->with([

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
            'name'      => 'required',
            'artist_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1999',
        ]);
        $artist = new Artist();
        if($request->hasFile('artist_image')):
            //Get Filename
            $img = $request->file('artist_image');
            $fullname = $img->getClientOriginalName();
            $name = pathinfo($fullname,PATHINFO_FILENAME );
            $ext = $img->getClientOriginalExtension();
            $filename = $name.'_'.time().'.'.$ext;
            $img->storeAs('public/artists/',$filename);
            $path = public_path('storage/artists/'.$filename);
            $img = Image::make($path)->resize(800, 600, function($constraint) { $constraint->aspectRatio(); })->save($path,80);
            $artist->artist_image    = $filename ? $filename : NULL ;
        endif;


        $artist->name     = $request->name;
        $artist->body     = $request->body;
        $artist->save();
        if( isset($request->tags)):
            $artist->tags()->sync( TagController::taghandling( $request->input('tags') ) );
        endif;
        Session::flash('success','Artist added to Database successfully');
        return redirect()->route('admin.artist.show',$artist->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Artist::findOrFail($id);
        return view( 'admin.artist.view' )->with([
          'artist' => $artist
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
        $artist = Artist::findOrFail($id);
        return view( 'admin.artist.edit' )->with([
          'artist' => $artist
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
      $request->validate([
          'name'      => 'required',
          'artist_image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:1999',
      ]);
      $artist = Artist::find($id);
      if($request->hasFile('artist_image')):
          if (isset( $artist->image )):
            Storage::delete('public/artists/'.$artist->artist_image);
          endif;
          //Get Filename
          $img = $request->file('artist_image');
          $fullname = $img->getClientOriginalName();
          $name = pathinfo($fullname,PATHINFO_FILENAME );
          $ext = $img->getClientOriginalExtension();
          $filename = $name.'_'.time().'.'.$ext;
          $img->storeAs('public/artists/',$filename);
          $path = public_path('storage/artists/'.$filename);
          $img = Image::make($path)->resize(800, 600, function($constraint) { $constraint->aspectRatio(); })->save($path,80);
          $artist->artist_image = $filename;
      endif;

      $artist->name    = $request->name;
      $artist->body = $request->body;
      $artist->save();
      if( isset($request->tags) ):
          $artist->tags()->sync( TagController::taghandling( $request->input('tags') ) );
      endif;
      Session::flash('info','Artist details updated');
      return redirect()->route('admin.artist.show',$artist->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $artist = Artist::find($id) ):
            Storage::delete('public/artist/'.$artist->artist_image);
            $artist->tags()->detach();
            $artist->delete();
            Session::flash('info','Artist deleted from Database');
        else:
            Session::flash('warning','Couldn\'t find the artist in the Database');
        endif;
        return redirect()->route('admin.artist.index');
    }
}
