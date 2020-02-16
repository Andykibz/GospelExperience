@extends('admin.index')
@section('page-heading')
  {{ ucfirst($event->name) }}
@endsection
@section('header-right')
  <div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ route('admin.event.edit',$event->id) }}" class="btn btn-outline-info">Edit <i class="fa fa-edit"></i> </a>
    <form action="{{ route('admin.event.destroy',$event->id) }}" method="post" class="btn btn-outline-dark deleteForm" data-title="{{$event->name}}">
          {{ csrf_field() }}
          @method('DELETE')
          Delete<i class="fa fa-trash"></i>
    </form>
  </div>
@endsection
@section('content')
<div class="row">
  <main class="col-sm-12 shadow p-3 rounded">
    <div class="row">
      <div class="col-sm-8">
        <article class="text-justify">

            <blockquote class="blockquote">
              {{ $event->headline }}
            </blockquote>

          {!! $event->body !!}
        </article>
        @if ($event->artists->count() > 0)
          <hr>
          <section id="event-artists" class="artist-media p-2 shadow bg-transparent">
            <h4>Artists</h4>
              @foreach ($event->artists()->get()->chunk(4) as $artist_group)
                <div class="row mb-2">
                    @foreach ($artist_group as $artist)
                        <div class="col-sm-4">
                          <div class="artist-item" data-artist="{{ $artist->id }}" style="background-image:url('{{ asset('storage/artists/'.$artist->artist_image ) }}')">
                            <span>{{ $artist->name }}</span>
                          </div>
                        </div>
                    @endforeach
                </div>
              @endforeach
          </section>
        @endif
        @if ( $event->sermons()->count() )
          @component('admin.event.components.listsermons', ['sermons'=>$event->sermons])
          @endcomponent
        @endif
      </div>
      <div class="col-sm-4">
        <img src="{{ asset('storage/posters/'.$event->poster) }}" class="img-fluid img-thumbnail" alt="">
        <hr>
        <div class="list-group">
          <div class="list-group-item">
            <dl class="row">
              <dt class="col-sm-2">Date:</dt>
              <dd class="col-sm-10">{{ date('M j Y', strtotime($event->date)) }}</dd>
            </dl>
          </div>
          <div class="list-group-item">
            <dl class="row">
              <dt class="col-sm-2">From:</dt>
              <dd class="col-sm-10">{{ date('M j H:i', strtotime($event->from)) }}</dd>
            </dl>
          </div>
          <div class="list-group-item">
            <dl class="row">
              <dt class="col-sm-2">To:</dt>
              <dd class="col-sm-10">{{ date('M j H:i', strtotime($event->to)) }}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
