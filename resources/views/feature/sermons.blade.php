@extends('layouts.base')
@include('components.mini-header')
<div class="container">
  <div class="section-header">
    <h2>{{ __('Sermons') }}</h2>
    <p>{{__('Sermonettes hosted by GospelExperience')}}</p>
  </div>
@foreach ($sermons as $sermon)
  <div class="animated slideInUp mb-5">
    <div id="sermon-{{ $sermon->id }}" class="sermon-card hvr-float shadow row">

      <div style="background:url('{{ asset('storage/image/'.$sermon->sermon_image) }}');background-size: cover;" class="{{ $sermon->sermon_image ? 'col-12 col-sm-4 ' : 'd-none' }} img-wrapper">
          {{-- <img class="img-fluid" src="{{ asset('storage/image/'.$sermon->sermon_image) }}" alt=""> --}}
      </div>{{-- Image Wrapper --}}

      <div class="{{ $sermon->sermon_image ? ' col-12 col-sm-8' : 'col-12' }} sermon-info ">
        @component('components.elements.viewlink',[ 'text'=>'View Sermon', 'link'=>route('front.sermon',$sermon->slug) ])
        @endcomponent
        <div class="heading3">
          <h3>{{ $sermon->title }}</h3>
        </div>
          <p> {!! substr( $sermon->body, 0, 300 ) !!}... </p>
          <hr>
          <div class="sermon-meta">
              @if ($sermon->speaker)
                <span class="sermon-speaker text-muted"> By : <cite title="Sermon Speaker">{{ $sermon->speaker }}</cite></span>
              @endif
              @if ($sermon->event)
                  <span>
                    <i class="fa fa-calendar"></i>
                    <a  href="{{ route('front.event',$sermon->event->slug ) }}" class="text-secondary">{{ $sermon->event->name }}</a>
                  </span>
              @endif
              @if ($sermon->tags->count())
                  @component('components.elements.tags',[ 'tags' => $sermon->tags()->get() ])
                  @endcomponent
              @endif
          </div>
      </div>{{-- Post Content --}}
    </div>
  </div>
@endforeach
</div>
