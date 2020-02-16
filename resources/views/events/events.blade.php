@extends('layouts.base')
@section('title')
  {{ $title }}
@endsection
@section('intro')
    @component('components.mini-header')
    @endcomponent
@endsection
@section('content')
<div class="container mb-3 mt-1">
  <div class="section-header">
    <h2>{{ __('Events') }}</h2>
    <p>{{__('Events hosted by Gospel Experience')}}</p>
  </div>
  @foreach ($events as $event)

    @component('events.components.list-item',['event'=> $event])
    @endcomponent
    <hr class="break mb-3">

  @endforeach
</div>

@endsection
