@extends('layouts.base')
@php
$title = "Home"

@endphp
@section('intro')
    @component('components.masthead')
    @endcomponent

    @component('events.components.next')
    @endcomponent
@endsection

{{-- Main Contetent --}}
@section('content')
    <section class="container wow fadeInUp">
      @component('events.components.lastEvent')

      @endcomponent
      {{-- @component('components.twitterEmbed')
      @endcomponent --}}

    </section>

    @component('components.owlgallery')
    @endcomponent

    @component('components.artists')
    @endcomponent
    
@endsection

@push('jssnippets')
  // Initialize Venobox
  $('.venobox').venobox({
    bgcolor: '',
    overlayColor: 'rgba(6, 12, 34, 0.85)',
    closeBackground: '',
    closeColor: '#fff'
  });
@endpush
