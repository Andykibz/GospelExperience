@extends('admin.index')
@section('page-heading')
Events
@endsection
@section('header-right')
<a href="{{ route('admin.event.create') }}" class="btn btn-dark">New Event</a>
@endsection
@section('content')

<table class="table">
  <thead class="thead-light">
    <tr class="row">
      <th class="col-sm-2" scope="col">{{ __('Poster') }}</th>
      <th class="col-sm-2" scope="col">{{ __('Name') }}</th>
      <th class="col-sm-4" scope="col">{{ __('Body') }}</th>
      <th class="col-sm-3" scope="col">{{ __('date') }}</th>
      <th class="col-sm-1" scope="col">{{ __('Action') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($events as $event)
      <tr class="row">
        <th class="col-sm-2"><img class="img-fluid" src="{{ asset('storage/posters/'.$event->poster) }}" /></th>
        <td class="col-sm-2"><h3> {{ $event->name }} </h3></td>
        <td class="col-sm-4">{!! substr($event->body,0,240) !!}</td>
        <td class="col-sm-3">
          <dl class="">
              <dt class="">{{ __('Date') }}</dt>
              <dd class="">{{ $event->date }}.</dd>
              <dt class="">{{ __('From') }}</dt>
              <dd class="">{{ date('M y, H:i',strtotime($event->from)) }}</dd>
              <dt class="">{{ __('To') }}</dt>
              <dd class="">{{ date('M y, H:i',strtotime($event->to)) }}</dd>
          </dl>
        </td>
        <td class="col-sm-1">
          <a href="{{ route('admin.event.show',$event->id) }}" class="btn btn-outline-dark btn-sm btn-block">
            <i class="fa fa-eye"></i>
          </a>
          <a href="{{ route('admin.event.edit',$event->id) }}" class="btn btn-outline-info btn-sm btn-block">
            <i class="fa fa-edit"></i>
          </a>
          <form action="{{ route('admin.event.destroy',$event->id) }}" method="post" class="btn btn-outline-warning btn-sm btn-block deleteForm"  data-title="{{ $event->name }}">
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
