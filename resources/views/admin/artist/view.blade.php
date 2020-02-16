@extends('admin.index')
@section('page-heading')
  {{ ucfirst($artist->name) }}
@endsection
@section('header-right')
  <div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ route('admin.artist.edit',$artist->id) }}" class="btn btn-outline-info">Edit <i class="fa fa-edit"></i> </a>
    <form action="{{ route('admin.artist.destroy',$artist->id) }}" method="post" class="btn btn-outline-dark deleteForm" data-title="{{$artist->name}}">
          {{ csrf_field() }}
          @method('DELETE')
          Delete<i class="fa fa-trash"></i>
    </form>
  </div>
@endsection
@section('content')
<div class="row">
  <main class="col-sm-10 shadow pt-3 px-3 rounded">
    <div class="row">
      <div class="col-sm-8">
        <article class="text-justify">
          {!! $artist->body !!}
        </article>
      </div>
      <div class="col-sm-4">
        <img src="{{ asset('storage/artists/'.$artist->artist_image) }}" class="img-fluid img-thumbnail" alt="">

      </div>
    </div>
  </main>
</div>
@endsection
