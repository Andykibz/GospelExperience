@extends('layouts.base')
@include('components.mini-header')
@php
   $title = $sermon->title
@endphp
<div class="container mb-5">
  <div class="mx-auto text-center">
      <div class="section-header">
        <h2>{{ $sermon->title}}</h2>
      </div>
      <hr>
      @if ($sermon->sermon_image)
        <div class="">
          <img class="img-fluid" src="{{ asset('storage/image/'.$sermon->sermon_image) }}" alt="">
        </div>
        <hr>
      @endif
      <article id="sermon-{{ $sermon->id }}" class="text-justify">
          {!! $sermon->body !!}
      </article>
      <hr>
      <div class="sermon-meta d-flex justify-content-between">
          @if ($sermon->speaker)
            <span class="sermon-speaker text-muted"> By : <cite title="Sermon Speaker">{{ $sermon->speaker }}</cite></span>
          @endif
          @if ($sermon->event)
              <span>
                <i class="fa fa-calendar"></i>
                <a href="{{ route('front.event',$sermon->event->slug ) }}" class="">{{ $sermon->event->name }}</a>
              </span>
          @endif
          @if ($sermon->tags->count())
              @component('components.elements.tags',[ 'tags' => $sermon->tags()->get() ])
              @endcomponent
          @endif
      </div>
    </div>
</div>
