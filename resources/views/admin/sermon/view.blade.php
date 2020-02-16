@extends('admin.index')
@section('page-heading')
  {{ ucfirst($sermon->title) }}
@endsection
@section('header-right')
  <div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ route('admin.sermon.edit',$sermon->id) }}" class="btn btn-outline-info">Edit <i class="fa fa-edit"></i> </a>
    <form action="{{ route('admin.sermon.destroy',$sermon->id) }}" method="post" class="btn btn-outline-dark deleteForm" data-title="{{$sermon->title}}">
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
          {!! $sermon->body !!}
        </article>
      </div>
      <div class="col-sm-4">
        <div class="">
        <img src="{{ asset('storage/image/'.$sermon->sermon_image) }}" class="img-fluid img-thumbnail" alt="">
          <dl class="mt-4">
            <dt>By: </dt>
            <dd>{{ $sermon->speaker }}</dd>
          </dl>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
