@extends('layouts.base')
@section('title')
  {{ $title ?? '' }}
@endsection
@section('intro')
  @include('components.mini-header')
@endsection
@section('content')
  <div class="section-header">
    <h2>{{ __('Artists') }}</h2>
    <p>{{__('Artists Hosted by Gospel Experience')}}</p>
  </div>
  <div id="artist_modal" class="iziModal" data-izi-modal="" data-izimodal-title="" data-iziModal-subtitle ="" data-iziModal-icon="icon-home">
  </div>
  <div class="container">
  @foreach ($artists->chunk(2) as $artist_group)
    <div class="row animated fadeInUp">
      @foreach ($artist_group as $artist)
        <div class="col-md-6 col-12 " style="position:relative;">

          {{-- <section class="cards"> --}}
          <article  class="card card--1 mb-3">
          {{-- <div class="card__info-hover">
          </div> --}}
          <span class="readmoreLink">
              @component('components.elements.viewmore', ['link'=>'', 'id'=>"artist_$artist->id", 'class' => 'view_artist_link btn-outline-primary','text' =>'View Artist' ])
              @endcomponent
          </span>

          <div class="card__img" style="background-image: url({{ asset('storage/artists/'.$artist->artist_image) }})"></div>

          <a href="#" class="card_link">
             <div class="card__img--hover" style="background-image: url({{ asset('storage/artists/'.$artist->artist_image) }})"></div>
           </a>
          <div class="card__info">
            <span class="card__category">Artist</span>
            <h3 class="card__title">{{ $artist->name }}</h3>
            <span class="card__by"> <a href="#" class="card__author" ></a>
              @component('components.elements.tags2',[ 'tags'=> $artist->tags()->get() ])
              @endcomponent
            </span>
          </div>
          </article>

{{-- </section> --}}
        </div>
      @endforeach
    </div>{{-- End of Row --}}
    <div class="clear-float">

    </div>

  @endforeach
  </div>
@endsection
@push('frontstylesheets')
    <link rel="stylesheet" href="{{ asset('/css/iziModal.min.css') }}">
@endpush
@push('frontscripts')
    <script type="text/javascript" src="{{ asset('js/iziModal.min.js') }}"></script>
@endpush
@push('jssnippets')
  $("#artist_modal").iziModal({
    width: 700,
  radius: 5,
  padding: 20,
  loop: true});
@endpush
