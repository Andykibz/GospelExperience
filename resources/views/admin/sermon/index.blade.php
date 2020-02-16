@extends('admin.index')
@section('page-heading')
{{ ucfirst('sermons')}}
@endsection
@section('header-right')
<a href="{{ route('admin.sermon.create') }}" class="btn btn-dark">New Sermon</a>
@endsection
@section('content')
<table class="table">
  <thead class="thead-light">
    <tr class="row">
      <th class="col-sm-3" scope="col">{{ __('Sermon Image') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Title') }}</th>
      <th class="col-sm-5" scope="col">{{ __('Body') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Action') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sermons as $sermon)
      <tr class="row">
        <th class="col-sm-3"><img class="img-fluid" src="
          @if (isset($sermon->sermon_image))
            {{ asset('storage/image/'.$sermon->sermon_image) }}
          @else
            {{ asset('img/phs/sermon_placeholder.jpg') }}
          @endif
          " /></th>
        <td class="col-sm-2">
            <h3> {{ $sermon->title }}</h3>
            <p>By: {{$sermon->speaker }}</p>
        </td>
        <td class="col-sm-5">{!! substr($sermon->body,0,240) !!}</td>
        <td class="col-sm-2">
          <a href="{{ route('admin.sermon.show',$sermon->id) }}" class="btn btn-outline-dark btn-sm btn-block">
            <i class="fa fa-eye"></i>
          </a>
          <a href="{{ route('admin.sermon.edit',$sermon->id) }}" class="btn btn-outline-info btn-sm btn-block">
            <i class="fa fa-edit"></i>
          </a>
          <form action="{{ route('admin.sermon.destroy',$sermon->id) }}" method="post" class="btn btn-outline-warning btn-sm btn-block deleteForm" data-title="{{ $sermon->title }}">
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
