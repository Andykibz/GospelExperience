@extends('layouts.base')
@section('title')
    {{ $title }}
@endsection
@component('components.mini-header')

@endcomponent
@section('content')
    <div class="container">
      <h3>{{ $page->title }}</h3>
      <article id="{{ $page->slug.'-'.$page->id }}" class="">
          {!! $page->body !!}
    </article>
  </div>
@endsection
