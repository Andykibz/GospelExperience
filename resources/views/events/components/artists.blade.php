      @foreach ($artists as $artist)

      <div class="col-lg-4 col-md-6">
        <div class="speaker">
          <img style="max-height:300px" src="{{  asset('storage/artists/'.$artist->artist_image) }}" alt="{{ $artist->name }}" class="img-fluid w-100">
          <div class="details">
            <h3>{{  $artist->name }}</h3>
            <p>
              @component('components.elements.tags2',[ 'tags' => $artist->tags()->get()])
              @endcomponent
            </p>
            <div class="social">
              <a href="#artist_{{ $artist->id }}" class="card-link view_artist_link text-light text-center" id="artist_{{ $artist->id }}">View More</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

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
