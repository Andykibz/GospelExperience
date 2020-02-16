@extends('admin.index')
@section('page-heading')
    Media Index
@endsection
@section('header-right')

@endsection
@section('content')
    @foreach ($media->chunk(4) as $element)

    @endforeach
@endsection
