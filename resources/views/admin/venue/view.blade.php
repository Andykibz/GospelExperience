@extends('admin.index')
@section('page-heading')
  {{ ucfirst($venue->name) }}
@endsection
@section('header-right')
  <div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ route('admin.venue.edit',$venue->id) }}" class="btn btn-outline-info">Edit <i class="fa fa-edit"></i> </a>
    <form action="{{ route('admin.venue.destroy',$venue->id) }}" method="post" class="btn btn-outline-dark deleteForm" data-title="{{$venue->name}}">
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
      <div class="col-sm-12">
        <div class="text-center mb-3">
          <img class="img-fluid img-thumbnail" src="{{ asset('storage/venue/'.$venue->photo) }}" alt="{{ $venue->name }}">
        </div>
        <article class="text-justify">
          <div class="card mb-3">
              <div class="card-header">{{ __('Latitude') }}</div>
              <div class="card-body">
                  <blockquote class="blockquote mb-0" cite="">
                      <p> {{ $venue->latitude }} </p>
                  </blockquote>
              </div>
          </div>
          <div class="card mb-3">
              <div class="card-header">{{ __('Longitude') }}</div>
              <div class="card-body">
                  <blockquote class="blockquote mb-0" cite="">
                      <p> {{ $venue->longitude }} </p>
                  </blockquote>
              </div>
          </div>
          <div class="card mb-3">
              <div class="card-header">{{ __('Description') }}</div>
              <div class="card-body">
                  <blockquote class="blockquote mb-0" cite="">
                      <p> {{ $venue->description }} </p>
                  </blockquote>
              </div>
          </div>
        </article>
      </div>
    </div>
  </main>
</div>
@endsection
