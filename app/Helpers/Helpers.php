<?php
use Intervention\Image\Facades\Image;

if( !function_exists('slugify') ){
    function slugify( $object, $str ){
        $slug = str_slug( $str );
        $kount = 0;
        while($object->where('slug',$slug)->first()){
            $kount++;
            $slug = $slug.'-'.$kount;
        }
        return $slug;
    }
}

if( !function_exists('preview_image') ){
    function preview_image( $url ){
        $img = Image::cache(function($image) use($url) {
            $image->make(file_get_contents(asset("storage/$url")))->resize(300, 300, function($constraint) { $constraint->aspectRatio(); });
        });
        // $img = Image::make( file_get_contents(public_path("storage/$url")) )->resize(300, 300, function($constraint) { $constraint->aspectRatio(); });
        $arr =  explode('.',$url );
        $img->encode(array_pop($arr));
        $type = retTyp( array_pop($arr) );
        return $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
    }
}

if( !function_exists('retTyp') ){
    function retTyp( $typ ){
        $var = strtolower($typ);
        switch ($var) {
            case 'png':
                return 'png';
                break;

            case 'jpg':
                return 'jpg';
                break;

            case 'jpeg':
                return 'jpeg';
                break;

            case 'svg':
                return 'svg';
                break;

            case 'gif':
                return 'gif';
                break;


            default:
                return $var;
                break;
        }

    }
}

if( !function_exists('mediathumburl') ){
    function mediathumburl( $source ){
        $tmparr   = explode('/',$source);
        $sourceID = array_pop($tmparr);
        return asset( 'storage/media/image/thumb/'.$sourceID );
    }
}

if( !function_exists('get_file') ){
    function get_file( $source ){
        $tmparr   = explode('/',$source);
        return $sourceID = array_pop($tmparr);
    }
}


if( !function_exists('gallery_preview') ){
    function gallery_preview( $source ){
        // $img = Image::cache(function($image) use($source) {
        //     $image->make(public_path("storage/$source"))->resize(300, 300, function($constraint) { $constraint->aspectRatio(); });
        // });
        // $img = Image::make( public_path("storage/$source") )->resize(800, 800,
        //     function($constraint) { $constraint->aspectRatio(); }
        // );
        $img = Image::make( public_path("storage/media/image/$source") )->resize(800, 800,
            function($constraint) { $constraint->aspectRatio(); }
        );
        $arr =  explode('.',$source );
        $img->encode(array_pop($arr));
        $type = retTyp( array_pop($arr) );
        return $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
    }
}

if( !function_exists('check_image_height') ){
    function check_image_height( $path ){
        $height = Image::make( $path )->height();
        return $height;
    }
}
