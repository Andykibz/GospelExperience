<!--==========================
  Next Event
============================-->
@php
  $nextevent = App\Event::all()->last();
@endphp
@if ($nextevent)
<section id="about" class="mb-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2>{{ $nextevent->name }}</h2>
        <p>{{ $nextevent->headline }}</p>
      </div>
      <div class="col-lg-3">
        <h3>{{ __('Venue') }}</h3>
        <h5 class="text-light">{{ $nextevent->venue->name }}</h5>
        <p>{{ $nextevent->venue->description }}</p>
      </div>
      <div class="col-lg-3">
        <h3>{{ ('Date') }}</h3>
        <p>{{ date( 'l jS',strtotime($nextevent->date) ) }}<br>{{ date( 'F Y',strtotime($nextevent->date) ) }}</p>
        <a href="{{ route('front.events',$nextevent->name ) }}" class="text-secondary">View More</a>
      </div>
    </div>
  </div>
</section>
@endif
