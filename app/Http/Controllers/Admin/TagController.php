<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();
        return view('admin.tags.index')->with(compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'  => 'required'
        ]);
        $tag =  new Tag();
        $tag->name  = $request->name;
        $tag->slug  = slugify($tag,$request->name);
        $tag->description  = $request->description;
        $tag->save();
        Session::flash('info','Tag created successfully');
        return redirect()->route('admin.tag.index');
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
        $tag = Tag::find($id);
        $tag->name  = $request->name;
        $tag->slug  = slugify($tag,$request->name);
        $tag->description  = $request->description;
        $tag->save();
        Session::flash('info','Tag updated successfully');
        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Tag::destroy($id) ):
          Session::flash('warning','Deleted tag successfully');
        else:
          Session::flash('danger','Tag could not be deleted');
        endif;
        return redirect()->route('admin.tag.index');
    }

    public static function addTag($tag) {
       $tg =  new Tag();
        $tag = Tag::Create([
            'name'    => $tag,
            'slug'    => slugify($tg,$request->name),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \$arrayName = array('' => , );
     */
    public static function tagHandling($tags)
    {
        $tags_array = [];
        // $dummyTag = new Tag();
        for ($i=0; $i < count($tags) ; $i++) {
            if( !Tag::find( $tags[$i] ) ){
                $tg = Tag::create([
                    'name'    => $tags[$i],
                    'slug'    => slugify( new Tag(), $tags[$i] )
                ]);
                array_push( $tags_array,$tg->id );
            }else{
                array_push( $tags_array,$tags[$i] );
            }
        }
        // dd($tags_array);
        return $tags_array;
    }

}
