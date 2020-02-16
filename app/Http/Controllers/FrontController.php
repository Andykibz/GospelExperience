<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrontController extends Controller
{
    /**
     * Show a list of artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function media()
    {
        $responseArr = [
            'media'           =>  \App\Media::get(),
            'media_active'    =>  'menu-active',
            'title'           =>  'Media'
        ];
        return view('feature.media')->with($responseArr);
    }

    /**
     * Show a list of artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function artists()
    {
        $responseArr = [
            'artists'         =>  \App\Artist::get(),
            'artist_active'   =>  'menu-active',
            'title'           =>  'Artists',
        ];
        return view('feature.artists')->with($responseArr);
    }

    /**
     * Show a list of artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function artist( $id )
    {
        $artist =  \App\Artist::find( $id );
        $img = asset('storage/artists/'.$artist->artist_image);
        $responseArr = [
            'name'         =>  $artist->name,
            'tags'         =>  implode($artist->tags()->get()->pluck('name')->toArray(),',' ),
            'body'         =>  "<div class='mx-auto text-center'><img class='img-fluid img-thumbnail' style='min-width:80%;max-height:400px;'  src='$img' /></div><hr>$artist->body",
        ];
        return response()->json($responseArr);
    }

    /**
     * Show a list of media.
     *
     * @return \Illuminate\Http\Response
     */
    public function sermons()
    {
        $responseArr = [
            'sermons'         =>  \App\Sermon::get(),
            'sermon_active'   =>  'menu-active',
            'title'           =>  'Sermons',
        ];
        return view('feature.sermons')->with($responseArr);
    }

    /**
     * Show a list of media.
     *
     * @return \Illuminate\Http\Response
     */
    public function sermon( $slug )
    {
        if(\App\Sermon::where('slug',$slug)->first()){
            $sermon = \App\Sermon::where('slug',$slug)->first();
        }else{
          abort(404,'That sermon does not exist');
        }
        $responseArr = [
            'sermon'          =>  $sermon,
            'sermon_active'   =>  'menu-active',
        ];
        return view('feature.sermon')->with($responseArr);
    }

    /**
     * Show a list of media.
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        $responseArr = [
            'events'         =>  \App\Event::get(),
            'event_active'   =>  'menu-active',
            'title'           =>  'Events',
        ];
        return view('events.events')->with($responseArr);
    }

    /**
     * Show a list of media.
     *
     * @return \Illuminate\Http\Response
     */
    public function event( $slug )
    {
        if(\App\Event::where('slug',$slug)->first()){
            $event = \App\Event::where('slug',$slug)->first();
        }else{
          abort(404,'That event does not exist');
        }
        $responseArr = [
            'event'           =>  $event,
            'event_active'    =>  'menu-active',
            'title'           =>  $event->name
        ];
        return view('events.event')->with($responseArr);
    }

    /**
     * Show a list of media.
     *
     * @return \Illuminate\Http\Response
     */
    public function tag( $slug )
    {
        if(\App\Tag::where('slug',$slug)->first()){
            $tag = App\Tag::where('slug',$slug)->first();
        }else{
          abort(404,'That event does not exist');
        }
        $responseArr = [
            'tag'         =>  $tag,
            'event_active'   =>  'menu-active',
            'title'     => $tag->name
        ];
        return view('feature.index')->with($responseArr);
    }

    public function page( $pg )
    {
        if(\App\Page::where('slug',$pg)->first()){
            $page = \App\Page::where('slug',$pg)->first();
        }else{
          abort(404,'That page does not exist');
        }
        $responseArr = [
            'page'         =>  $page,
            'title'       =>  $page->title
        ];
        return view('feature.page')->with($responseArr);
    }
}
