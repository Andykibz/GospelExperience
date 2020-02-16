<div id="artist_modal" class="iziModal" data-izi-modal="" data-izimodal-title="" data-iziModal-subtitle ="" data-iziModal-icon="icon-home">
</div>
<section class="wow fadeInUp mb-3">
  <div class="container">
    <div class="section-header">
      <h2>Artists</h2>
      <p>Some of the Artists we have hosted in our events</p>
    </div>
  <div class=" card-group">
    @php
        if( empty($artists) ):
            $artists = App\Artist::get()->take(3);
        endif;
    @endphp
      @foreach ($artists as $artist)
        <div class="card ">
          <img style="max-height:300px;" src="{{ asset('storage/artists/'.$artist->artist_image) }}" class="card-img-top img-fluid" alt="{{ $artist->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $artist->name }}</h5>
            <p class="card-text"> {!! substr( $artist->body, 0, 150 ) !!}... </p>
            <a href="#" class="card-link view_artist_link text-secondary text-center" id="artist_{{ $artist->id }}">View More</a>
          </div>

          <div class="card-footer">
            <small class="text-muted">
              @component('components.elements.tags2',[ 'tags'=>$artist->tags()->get() ])
              @endcomponent
            </small>
          </div>
        </div>
      @endforeach
    </div>
</div>
</section
@push('frontstylesheets')
    <link rel="stylesheet" href="{{ asset('css/iziModal.min.css') }}">
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
