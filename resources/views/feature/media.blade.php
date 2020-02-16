@extends('layouts.base')
@section('title')
    {{ $title }}
@endsection
@include('components.mini-header')
@section('content')
<div class="container shadow mt-2 pb-2">
    <div class="section-header">
      <h2>{{ __('Images Gallery') }}</h2>
      <p>{{ __('Some of the Photographs taken during our events') }}</p>
    </div>
    <div class="container-fluid image-gallery-container ">
        @component('media.image_gallery',[ 'images' => App\MediaType::where('slug','image')->first()->media->take(8) ])
        @endcomponent
        <div class="text-center ">
          <span class="load-more">
              <a href="#load-all-images" class="text-light"> <i class="fa fa-2x fa-chevron-down"></i> </a>
          </span>
        </div>
    </div>
</div>
<hr>
<div class="container shadow mt-2 pb-2">
  <div class="section-header">
    <h2>{{ __('Video Gallery') }}</h2>
    <p>{{ __('Some of the Videos taken during our events') }}</p>>
  </div>
    <div class="container-fluid audio-gallery-container">
        @component('media.video_gallery',[ 'videos' => App\MediaType::where('slug','video')->first()->media->take(6) ])
        @endcomponent
        <div class="text-center ">
          <span class="load-more">
              <a href="#load-all-videos" class="text-light"> <i class="fa fa-2x fa-chevron-down"></i> </a>
          </span>
        </div>
    </div>
</div>
<hr>
<div class="container shadow mt-2 pb-2">
    <div class="section-header">
      <h2>{{ __('Audio Gallery') }}</h2>
      <p>{{ __('Audio Recordings') }}</p>>
    </div>
    <div class="container-fluid audio-gallery-container">
        @component('media.audio_gallery',[ 'audios' => App\MediaType::where('slug','audio')->first()->media->take(6) ])
        @endcomponent
        <div class="text-center ">
          <span class="load-more">
              <a href="#load-all-audio" class="text-light"> <i class="fa fa-2x fa-chevron-down"></i> </a>
          </span>
        </div>
    </div>
</div>

@endsection
@push('frontstylesheets')
    <link rel="stylesheet" href="{{ asset('lib/venobox/venobox.css') }}">
@endpush
@push('frontscripts')
    <script type="text/javascript" src="{{ asset('lib/venobox/venobox.js') }}"></script>
@endpush
@push('jssnippets')
  // Initialize Venobox
  $('.venobox_images').venobox({
    bgcolor: '',
    overlayColor: 'rgba(6, 12, 34, 0.85)',
    closeBackground: '',
    closeColor: '#fff'
  });
@endpush
