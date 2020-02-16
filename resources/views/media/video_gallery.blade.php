  <div class="row ">
    @if ($videos)

  @foreach ($videos as $video)
    <div class="col-lg-4 col-md-6">
      <div class="position-relative video-wrap mb-2" data-title="{{ $video->title }}">
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->source }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          @if (isset($video->mediable->name))            
            <a style="font-size:.8em" class="venobox_video text-muted" title="{{ $video->mediable->name }}&nbsp;:&nbsp;{{ $video->title }}" data-gall="video_gallery" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/embed/{{ $video->source }}">{{ $video->title }}</a>
          @endif

      </div>
    </div>
  @endforeach
@endif
  @push('jssnippets')
    // Initialize Venobox
    $('.venobox_video').venobox({
      bgcolor: '',
      overlayColor: 'rgba(6, 12, 34, 0.85)',
      closeBackground: '',
      closeColor: '#fff'
    });
  @endpush
