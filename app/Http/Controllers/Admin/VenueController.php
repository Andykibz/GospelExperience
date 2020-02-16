<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Venue;
use Storage;
use Session;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::get();
        return view('admin.venue.index')->with(compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.venue.create');
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
            'name' => 'required',
        ]);

        $venue = new Venue();
        if($request->hasFile('photo')):
            //Get Filename
            $img = $request->file('photo');
            $fullname = $img->getClientOriginalName();
            $name = pathinfo($fullname,PATHINFO_FILENAME );
            $ext = $img->getClientOriginalExtension();
            $filename = $name.'_'.time().'.'.$ext;
            $img->storeAs('public/venue/',$filename);
            $path = public_path('storage/venue/'.$filename);
            Image::make( $path )->resize(600, 400, function($constraint) { $constraint->aspectRatio(); })->save($path, 70);
            $venue->photo   =  $filename;
        endif;

        $venue->name        =  $request->name;
        $venue->latitude    =  $request->latitude;
        $venue->longitude   =  $request->longitude;
        $venue->description =  $request->description;
        $venue->save();
        return redirect()->route('admin.venue.show',$venue->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venue = Venue::find($id);
        return view('admin.venue.view')->with([ 'venue' => $venue ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venue = Venue::find($id);
        return view('admin.venue.edit')->with([ 'venue' => $venue ]);
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
          'name' => 'required',
      ]);

      $venue = Venue::find($id);
      if($request->hasFile('photo')):
          if (isset( $venue->photo )):
            Storage::delete('public/venue/'.$venue->photo);
          endif;
          //Get Filename
          $img = $request->file('photo');
          $fullname = $img->getClientOriginalName();
          $name = pathinfo($fullname,PATHINFO_FILENAME );
          $ext = $img->getClientOriginalExtension();
          $filename = $name.'_'.time().'.'.$ext;
          $img->storeAs('public/venue',$filename);
          $path = public_path('storage/venue/'.$filename);
          Image::make( $path )->resize(600, 400, function($constraint) { $constraint->aspectRatio(); })->save($path, 70);
          $venue->photo   =  $filename;
      endif;

      $venue->name        =  $request->name;
      $venue->latitude    =  $request->latitude;
      $venue->longitude   =  $request->longitude;
      $venue->description =  $request->description;
      $venue->save();
      return redirect()->route('admin.venue.show',$venue->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $venue = Venue::find($id) ):
            Storage::delete('public/venue/'.$venue->photo);
            $venue->delete();
            Session::flash('info','Venue deleted from Database');
        else:
            Session::flash('warning','Couldn\'t find the venue in the Database');
        endif;
        return redirect()->route('admin.venue.index');
    }
}
