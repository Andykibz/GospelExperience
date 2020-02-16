
<div class="row animated fadeInUp mb-3 mt-2 event-card">
  <div class="col-md-10 col-sm-12 mx-auto">
      <div class="poster-holder position-relative mb-2" style="background:url('{{ asset('storage/posters/'.$event->poster) }}'); background-size:cover;background-position:center top">
        @if ($event->date < date('Y-m-d'))
          <span class="position-absolute text-light text-shadow"><i class="fa fa-check fa-3x"></i></span>
        @endif
          {{-- <img class="img-fluid" style="max-height:300px" src="" alt=""> --}}
      </div>
  </div>
  {{-- <div class="col-sm-10"> --}}
    <div class="col-md-10 offset-sm-1 event-heading">
        <h3 class="">{{ $event->name }}</h3>
    </div>
  {{-- </div> --}}
  <div class="col-sm-10 offset-sm-1">
      <div class="row">
          <div class="col-sm-6 col-12 headline">
            {{ $event->headline }}
          </div>
          <div class="col-sm-6 col-12">
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
          </div>
      </div>
  </div>
  <div class="col-md-10 col-sm-12 mx-auto text-center">
      @component('components.elements.viewmore',['link'=> route('front.event',$event->slug), 'text'=>'View More' ])
      @endcomponent
  </div>
</div>
