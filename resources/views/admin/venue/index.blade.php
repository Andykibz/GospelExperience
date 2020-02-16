@extends('admin.index')
@section('page-heading')
{{ ucfirst('venues')}}
@endsection
@section('header-right')
<a href="{{ route('admin.venue.create') }}" class="btn btn-dark">New Venue</a>
@endsection
@section('content')
<table class="table col-8">
  <thead class="thead-light">
    <tr class="row">
      <th class="col-sm-3" scope="col">{{ __('Venue Photo') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Name') }}</th>
      <th class="col-sm-5" scope="col">{{ __('Latitude') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Longitude') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($venues as $venue)
      <tr class="row">
        <th class="col-sm-5"><img class="img-fluid img-thumbnail" style="max-height:16rem;min-width:80%;" src="{{ asset('storage/venue/'.$venue->photo) }}" /></th>
        <td class="col-sm-5">
          <h3> {{ $venue->name }} </h3>
          <div> <label for="latitude">{{ __('Latitude') }}</label> <span id="latitude">{{ $venue->latitude }}</span> </div>
          <div> <label for="latitude">{{ __('Longitude') }}</label> <span id="longitude">{{ $venue->longitude }}</span> </div>
        </td>
        <td class="col-sm-2">
          <a href="{{ route('admin.venue.show',$venue->id) }}" class="btn btn-outline-dark btn-sm btn-block">
            <i class="fa fa-eye"></i>
          </a>
          <a href="{{ route('admin.venue.edit',$venue->id) }}" class="btn btn-outline-info btn-sm btn-block">
            <i class="fa fa-edit"></i>
          </a>
          <form action="{{ route('admin.venue.destroy',$venue->id) }}" method="post" class="btn btn-outline-warning btn-sm btn-block deleteForm" data-title="{{ $venue->name }}">
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
