<section class="event-media-wrapper container-fluid pt-2">
  <div style="display:none;" id="ajax-loading" class="lds-dual-ring"></div>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="true">Image</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="false">Video</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-audio-tab" data-toggle="pill" href="#pills-audio" role="tab" aria-controls="pills-audio" aria-selected="false">Audio</a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link" id="pills-galleries-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-audio" aria-selected="false">Galleries</a>
  </li> --}}
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade row show active" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">
    @component('admin.media.components.image')
    @endcomponent

  </div>
  <div class="tab-pane fade row" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
    @component('admin.media.components.video')
    @endcomponent

  </div>
  <div class="tab-pane fade row" id="pills-audio" role="tabpanel" aria-labelledby="pills-audio-tab">
    @component('admin.media.components.audio')
    @endcomponent

  </div>
  <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
    @component('admin.media.components.gallery')

    @endcomponent
  </div>
</div>
</section>
