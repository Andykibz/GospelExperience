@php
  $lastevent = App\Event::all()->where('date', '<', date('Y-m-d'))->first()
@endphp
@if ($lastevent)
<div class="section-header">
  <h2>{{ $lastevent->name}}</h2>
  <p>{{__('The latest Event Hosted by Gospel Experience')}}</p>
</div>
<section id="last-event">
  <div class="row mb-2">
    <div class="col-sm-7">
      <img class="img-fluid" src="{{ asset('storage/posters/'.$lastevent->poster) }}" alt="">
    </div>
    <div class="col-sm-5">
      {{-- <div class="col-md-10 offset-sm-1 heading3">
          <h3 class="text-center">{{ $lastevent->name }}</h3>
      </div> --}}
        {{-- <hr> --}}
        <div class="row">
              <span class="col-3 label">Venue</span>
              <span class="col-9">
                  <span class="row">{{ $lastevent->venue->name }}</span>
                  <span class="row">{{ $lastevent->venue->description }}</span>
                </div>
              </span>
        <div class="row">
              <span class="col-3 label">Date</span>
              <span class="col-9">
                  <span class="row">{{ date('M j Y',strtotime($lastevent->date)) }}</span>
                  <span class="row">{{ date('jS H:i A',strtotime($lastevent->from)) }} - {{ date('jS H:i A',strtotime($lastevent->to)) }}</span>
              </span>
        </div>
        <div class="row">
            @component('components.elements.tags2',[ 'tags'=>$lastevent->tags()->get() ])

            @endcomponent
        </div>
        <div class="row">
          <div class="mx-auto">
            @component('components.elements.viewmore',
            [ 'link'=>route('front.event',$lastevent->slug), 'text'=>'View More' ])
          @endcomponent

          </div>
        </div>
    </div>

  </div>
  <div class="row">
    <div id="last-event-media" class="col-10">
      <div class="owl-carousel owl-theme">
      @foreach ($lastevent->media->take(5) as $media)
      <div class="item" style="max-height:220px;overflow:hidden">
        @component('admin.media.components.single'.$media->mediatype->slug,[ 'element' => $media ])
        @endcomponent
      </div>
      @endforeach
    </div>
    </div>
  </div>
</section>
<hr>
@endif
@push('jssnippets')
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    items:3,
    autoplay: true,
})
@endpush
