@extends('admin.index')
@section('page-heading')
    {{ __('Edit ') }} {{ $page->title }}
@endsection
@section('content')
@section('header-right')
<a href="{{ route('admin.page.index') }}" class="btn btn-primary">Pages</a>
@endsection

<form method="POST" action="{{ route('admin.page.update',$page->id) }}" autocomplete="off">
    @csrf
    @method('PUT')

    @component('admin.page.editor',['page'=>$page, 'legend' => "Edit $page->title", 'submitText'=>"Update $page->title" ])
    @endcomponent
</form>

@endsection
