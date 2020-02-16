@php
  $nextevent = App\Event::get()->last()
@endphp
{{-- <section id="slider" class="owl-carousel owl-theme" >
            <div class="slide " style="background-image: url(imgs/background-close-up-instrument-860662.jpg)">
                <span class="text-light">
                    Textasdasd
                </span>
            </div>
            <div class="slide " style="background: url(imgs/astro-astronomy-background-956999.jpg)">
                <span class="text-light">
                    Textasasdasdasd
                </span>
            </div>
</section> --}}

<section id="mastheader" style="background: url('{{ asset('img/mastheader2.jpg') }}')top center;background-size:cover">
  @if ($nextevent)
  <div class="mastheader-container wow fadeIn">

    <div class="container inner-container d-flex align-content-center">
      <div class="col-sm-7">
          <h2 class="text-light">{{ __('Upcoming Event') }}</h2>
          <div class="upcoming-event-poster">
              <img class="img-fluid rounded" style="max-height:70vh;min-width:90%;" src="{{ asset('storage/posters/'.$nextevent->poster) }}" alt="next_event_poster">
              <p>Some text about the next Event</p>
              <div class="overlay"></div>
          </div>
      </div>
      <div class="col-sm-5 d-flex flex-column justify-content-center">
          <h1 class="mb-4 pb-0">{{ $nextevent->name }}</h1>
          <p class="mb-4 pb-0">{{ date('F 12', strtotime($nextevent->date) ) }}, {{ $nextevent->venue->name }}</p>
      </div>
    </div>

  </div>
@endif
</section>
