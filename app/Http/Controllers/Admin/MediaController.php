<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\MediaType;
use App\Media;
use Session;
use Image;
use Illuminate\Support\Facades\File;
use Youtube;

class MediaController extends Controller
{
    public static $thmbdir = 'media/image/thumb/';
    public static $imgdir  = 'media/image/';
    public static $auddir  = 'media/audio/';
    public static $viddir  = 'media/video/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = App\Media()->get();
        return view('admin.view.index')->with([
              'media'   =>  $media,
        ]);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media      = Media::find( $id );
        if ($media->mediatype->slug == 'image') {
            $tmpArr     = explode('/' ,$media->source);
            $sourceID   = array_pop($tmpArr);
            $source     = asset('storage/media/image/thumb/'.$sourceID );
        }else{
          $source       = $media->source;
        }
        $response   = [
              'name'      => $media->title,
              'caption'   => $media->caption,
              'url'       => route('admin.media.update',$media->id),
              'source'    => $source,
              'type'      => $media->mediatype->slug
        ];
        return response()->json( ['success' => $response ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
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
            'name'    => 'required',
            'source'  => 'required',
        ]);
        $media = Media::find($id);
        $media->name      = $request->name;
        $media->source    = $request->source;
        $media->caption   = $request->caption;
        $media->save();
        return response()->json( [ 'success' => "$media->name updated Successfully" ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $media = Media::find() ) {
            $media->destroy();
            return respose()->json( [ 'info' => "$media->name deleted Successfully" ] );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function imageUploadHandling(Request $request)
    {
        $dummyMedia = new Media();
        $images = [];
        // dd($request->image_files);
        if ($request->hasFile('image_files')):
            $media_type = MediaType::where('slug','image')->first();
            for ($i=0; $i < count($request->image_files) ; $i++):
                $image = $request->image_files[$i];
                $filename = $image->getClientOriginalName();

                // Upload file to the respectiva dirctory
                $image->storeAs("public/".MediaController::$imgdir,$filename);
                $path = public_path('storage/'.MediaController::$imgdir.'/'.$filename);
                File::exists( public_path('/storage/'.MediaController::$thmbdir) ) or
                File::makeDirectory(public_path('/storage/'.MediaController::$thmbdir),$mode = 0755, $recursive = true, $force = true);
                if ( check_image_height($path) > 640 ) {
                    $imgthmb = Image::make($path)->resize(960, 640,
                        function($constraint) { $constraint->aspectRatio(); }
                    )->save( $path,98);
                }
                $imgthmb = Image::make($path)->resize(290, 290,
                    function($constraint) { $constraint->aspectRatio(); }
                )->save( public_path('/storage/'.MediaController::$thmbdir.$filename),70);

                // $imgthmb->storeAs("public/$this->thmbdir",$filename);
                if( Media::where('source',MediaController::$imgdir.$filename)->first() == NULL):
                    $inst = Media::Create([
                        'title'=> $filename, 'slug'  => slugify($dummyMedia,$filename),
                        'media_type_id' => $media_type->id,
                        'source' => MediaController::$imgdir.$filename, 'local' => TRUE,
                    ]);
                    if($media_type != NULL):
                        $media_type->media()->save( $inst );
                    endif;
                    array_push( $images, $inst );
                else:
                    array_push( $images, Media::where('source',MediaController::$imgdir.$filename)->first() );
                endif;
            endfor;
        endif;
        return $images;

      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function videoUploadHandling(Request $request)
    {

      $videos = [];
      $dummyMedia = new Media();

      $media_type = MediaType::where('slug','video')->first();
      for ($i=0; $i < count($request->video_files) ; $i++):
          $video = $request->videos[$i];
          $filename = $video->getClientOriginalName();

          // Upload file to the respectiva dirctory
          if ( File::exists( public_path("/storage/".MediaController::viddir.$filename) ) ){
                $video->storeAs("public/MediaController::viddir",$filename);
            }

          $inst = Media::Create([
                  'title'=> $filename, 'slug'  => slugify($dummyMedia,$filename),
                  'media_type_id' => $media_type->id,
                  'source' => "MediaController::viddir$filename", 'local' => TRUE
          ]);
          if($media_type != NULL):
              $media_type->media()->save( $inst );
          endif;
          array_push( $videos, $inst );
      endfor;
      return $videos;
    }


    public static function audioUploadHandling(Request $request){

      $audio = [];
      $media_type = MediaType::where('slug','audio')->first();
      for ($i = 0; $i < count($request->audio_files) ; $i++):
          $audio = $request->audio[$i];
          $filename = $audio->getClientOriginalName();

          // Upload file to the respectiva dirctory
          $audio->storeAs("public/".MediaController::auddir,$filename);
          $path = public_path("storage/MediaController::auddir$filename");

          // Create Instance
          $inst = Media::Create([
                  'title'=> $filename, 'slug'  => slugify($dummyMedia,$filename),
                  'media_type_id' => $media_type->id,
                  'source' => "MediaController::viddir$filename", 'local' => TRUE
              ]);

          // Assing to respective Media Type
          if($media_type != NULL):
              $media_type->media()->save( $inst );
          endif;

          array_push( $audio, $nst );
      endfor;
      return $audio;
    }

    public static function youtubeHandling( $video_links ){
        $youtube_vids = [];
        $dummyMedia = new Media();
        $media_type = MediaType::where('slug','video')->first();
        $keys = array_keys( $video_links );
        for ($i=0; $i < count($video_links); $i++) {
          $video = $video_links[ $keys[$i] ];
          $vid  = Media::create([ 'title'   => $video['title'],
                          'slug'    => slugify($dummyMedia, $video['title']),
                          'source'  =>  $video['source'],
                          'local'   =>  FALSE,
                          'media_type_id' => $media_type->id,
                          'caption' => $video['description'] ]);
          array_push( $youtube_vids, $vid );
        }
        return $youtube_vids;
    }

    public static function audioHandling( $audio_links ){
        $archive_audio = [];
        $dummyMedia = new Media();
        $media_type = MediaType::where('slug','audio')->first();
        $keys = array_keys( $audio_links );

        for ($i=0; $i < count( $audio_links ) ; $i++) {
            $audio = $audio_links[ $keys[$i] ];
            $aud = Media::create([ 'title'   => $audio['title'],
                            'slug' => slugify( $dummyMedia , $audio['title'] ),
                            'source' => $audio['source'],
                            'local'=>FALSE,
                            'media_type_id' => $media_type->id,
                            'caption' => $audio['title'] ]);
            array_push( $archive_audio, $aud );
        }
        return $archive_audio;
    }
}
