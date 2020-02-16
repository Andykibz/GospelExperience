<!--==========================
  Gallery Section
============================-->
<section id="gallery" class="wow fadeInUp">

  <div class="container">
    <div class="section-header">
      <h2>Media</h2>
      <p>Check our galleries from the recent events</p>
    </div>
    <div class="owl-carousel gallery-carousel">
      @foreach (App\MediaType::where('slug','image')->first()->media()->get()->take(6) as $media)
      <a href="{{ asset('storage/'.$media->source) }}" class="venobox" data-gall="gallery-carousel">
        <img src="{{ mediathumburl( $media->source ) }}" alt="{{ $media->title }}">
      </a>
      @endforeach
  </div>
</div>

</section>
