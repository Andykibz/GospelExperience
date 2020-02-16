@if ( !empty($sermons) )
<hr>
<section class="sermons">
  <h4>Sermonettes</h4>
  <div class="row">
    @foreach ($sermons as $sermon)
      <div class="col-sm-4 col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            {{ $sermon->title }}
            <a href="{{ route( 'admin.sermon.edit',$sermon->id ) }}" target="_blank">
              <i class="fa fa-edit"></i>
            </a>
          </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              <p>{!! substr($sermon->body, 0,100) !!}</p>
              <footer class="blockquote-footer"> <cite title="speaker">{{ $sermon->speaker }}</cite></footer>
            </blockquote>
          </div>
        </div>
    </div>
    @endforeach
  </div>
</section>
@endif
