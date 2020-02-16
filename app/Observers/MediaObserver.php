<?php

namespace App\Observers;

use App\Media;
use App\Http\Controllers\Admin\MediaController;

use Storage;

class MediaObserver
{
    /**
     * Handle the media "created" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function created(Media $media)
    {
        //
    }

    /**
     * Handle the media "updated" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function updated(Media $media)
    {
        //
    }

    /**
     * Handle the media "deleted" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function deleted(Media $media)
    {
        if ( $media->local ) {
              $type = $media->mediatype->slug;
              switch ('image') {
                case 'value':
                    Storage::delete( 'public/'.$media->source );
                    $arr = explode( '/', $media->source );
                    $thmb = array_pop( $arr );
                    Storage::delete( MediaController::$thmbdir.$thmb );
                  break;

                default:
                  // code...
                  break;
              }
        }
    }

    /**
     * Handle the media "restored" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function restored(Media $media)
    {
        //
    }

    /**
     * Handle the media "force deleted" event.
     *
     * @param  \App\Media  $media
     * @return void
     */
    public function forceDeleted(Media $media)
    {
        //
    }
}
