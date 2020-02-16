@extends('admin.index')
@section('page-heading')
{{ ucfirst('artists')}}
@endsection
@section('header-right')
<a href="{{ route('admin.artist.create') }}" class="btn btn-dark">New Artist</a>
@endsection
@section('content')
<table class="table">
  <thead class="thead-light">
    <tr class="row">
      <th class="col-sm-3" scope="col">{{ __('Artist Image') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Name') }}</th>
      <th class="col-sm-5" scope="col">{{ __('Body') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Action') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($artists as $artist)
      <tr class="row">
        <th class="col-sm-3 mx-auto"><img class="img-fluid" style="max-height:20rem" src="{{ asset('storage/artists/'.$artist->artist_image) }}" /></th>
        <td class="col-sm-2"><h3> {{ $artist->name }} </h3></td>
        <td class="col-sm-5">{!! substr($artist->body,0,240) !!}</td>
        <td class="col-sm-2">
          <a href="{{ route('admin.artist.show',$artist->id) }}" class="btn btn-outline-dark btn-sm btn-block">
            <i class="fa fa-eye"></i>
          </a>
          <a href="{{ route('admin.artist.edit',$artist->id) }}" class="btn btn-outline-info btn-sm btn-block">
            <i class="fa fa-edit"></i>
          </a>
          <form action="{{ route('admin.artist.destroy',$artist->id) }}" method="post" class="btn btn-outline-warning btn-sm btn-block deleteForm" data-title="{{ $artist->name }}">
                {{ csrf_field() }}
                @method('DELETE')
                <i class="fa fa-trash"></i>
          </form>

        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
