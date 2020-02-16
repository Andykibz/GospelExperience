@extends('admin.index')
@section('page-heading')
{{ $page->title }}
@if ($page->group)
    <small class="text-muted pb-0 mb-0">{{ "($page->group group)" }}</small>
@endif
@endsection
@section('admin-header-right')
<a href="{{ route('admin.page.index') }}" class="btn btn-primary"><i data-feather="skip-back" ></i></a>
<a href="{{ route('admin.page.edit',$page->id) }}" class="btn btn-info"><i data-feather="edit"></i></a>
<form method="POST" role="button" class="btn btn-danger deleteForm" action="{{ route('admin.page.destroy',$page->id) }}" data-title="{{ $page->title }}">
        @csrf
        @method('DELETE')
        <i data-feather="trash"></i>
    </form>
@endsection
@section('content')
@include('admin.components.flash-message')
<article id="page-{{ $page->id }}" class="col-sm-8 col-12 bg-white rounded">
    {!! $page->body !!}
</article>

@endsection
