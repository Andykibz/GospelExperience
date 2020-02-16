@extends('layouts.base')
@php
  $title = $event->name
@endphp
@section('intro')
  @include('components.mini-header')
@endsection
@section('content')
  <div class="container">
      <div class="section-header">
        <h2>{{ $event->name }}</h2>
      </div>
      <div class="venue-img-wrapper mb-3 text-center">
          <img  style="max-height:60vh;" class="img-fluid" src="{{ asset('storage/posters/'.$event->poster ) }}" alt="">
          <hr>
      </div>
      <section class="wow fadeInUp">
        <div class="row mb-3">
            <em class="text-muted"> {{ $event->headline }} </em>
        </div>
        <div class="row mb-3">
          <article id="{{ $event->id }}" class="col-sm-7">
            {!! $event->body !!}
          </article>
          <aside class="col-sm-5 ">
              <div class="row">
                <span class="col-3 label">Venue</span>
                <span class="col-9">
                  <span class="row">{{ $event->venue->name }}</span>
                  <span class="row">{{ $event->venue->description }}</span>
                </span>
              </div>
              <div class="row">
                <span class="col-3 label">Date</span>
                <span class="col-9">
                  <span class="row">{{ date('M j Y',strtotime($event->date)) }}</span>
                  <span class="row">{{ date('jS H:i A',strtotime($event->from)) }} - {{ date('jS H:i A',strtotime($event->to)) }}</span>
                </span>
              </div>
          </aside>
        </div>
        <hr>
      </section>
      <section id="venue-section" class="wow fadeInUp">
        <div class="sub-section-header">
          <h3>{{ "Venue: " . $event->venue->name }}</h3>
          <p>{{ $event->venue->description }}</p>
        </div>
            <div class="row">
              <div class="col-sm-5 offset-sm-1">
                  <img class="img-fluid" src="{{ asset('storage/venue/'.$event->venue->photo) }}" alt="">
              </div>
              <div class="col-sm-5">
                  @component('components.embedmap',[
                    'lat'   => $event->venue->latitude,
                    'long'  => $event->venue->longitude,
                  ])
                  @endcomponent
              </div>
          </div>
          <hr>
      </section>
      @if ($event->artists()->count())
      <section id="speakers" class="wow fadeInUp">
        <div id="artist_modal" class="iziModal" data-izi-modal="" data-izimodal-title="" data-iziModal-subtitle ="" data-iziModal-icon="icon-home">
        </div>
        <div class="container">
            <div class="sub-section-header">
              <h3>{{__('Artists')}}</h3>
              <p>{{__('Performing Artists for the Event')}}</p>
            </div>
            <div class="row no-gutters">
                @component('events.components.artists',[ 'artists' => App\Artist::get() ])
                @endcomponent
            </div>
          </div>
      </section>
      @endif
      <hr>
      @if ($event->media()->count())
      <section id="event-media-wrapper" class="wow fadeInUp mb-3">
        <div class="sub-section-header">
          <h3>{{ ('Media Gallery') }}</h3>
          <p>{{ __('Captured media related to the event') }}</p>
        </div>
        <div class="row no-gutters">
            @foreach ($event->media()->get() as $media)
              @if ($media->mediatype->slug == 'image' )
                @component('media.image',[ "image"=>$media ])
                @endcomponent
              @endif
              @if ($media->mediatype->slug == 'video' )
                @component('media.video',[ "video"=>$media ])
                @endcomponent
              @endif
            @endforeach
        </div>
      </section>
    @endif

  </div>
@endsection
@push('jssnippets')
  // Initialize Venobox
  $('.venobox_vid').venobox({
    bgcolor: '',
    overlayColor: 'rgba(6, 12, 34, 0.85)',
    closeBackground: '',
    closeColor: '#fff'
  });

  // Initialize Venobox
  $('.venobox_img').venobox({
    bgcolor: '',
    overlayColor: 'rgba(6, 12, 34, 0.85)',
    closeBackground: '',
    closeColor: '#fff'
  });
@endpush
