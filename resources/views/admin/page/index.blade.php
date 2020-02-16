@extends('admin.index')
@section('page-heading')
{{ __('All Pages') }}
@endsection
@section('header-right')
    <a href="{{ route('admin.page.create') }}" class="btn btn-dark">Create Page</a>
@endsection
@section('content')
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Group</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
        <tr>
            <th scope="row">{{ $page->id }}</th>
            <td>{{ $page->title }}</td>
            <td >{!! substr($page->body,0,80) !!}[...]</td>
            <td>{{ $page->group }}</td>
            <td>
                <a href="{{ route('admin.page.show',$page->id) }}" class="btn btn-success">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('admin.page.edit',$page->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <form method="POST" role="button" class="btn btn-danger deleteForm" action="{{ route('admin.page.destroy',$page->id) }}" data-title="{{ $page->title }}">
                    @csrf
                    @method('DELETE')
                    <i class="fa fa-trash"></i>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
