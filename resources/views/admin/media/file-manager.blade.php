@extends('admin.index')
@section('page-heading')

@endsection
@section('header-right')

@endsection
@section('content')
    <div style="height: 600px;">
      <div id="fm"></div>
    </div>
@endsection
@push('adminscripts')
  <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endpush
@push('adminstyles')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush
