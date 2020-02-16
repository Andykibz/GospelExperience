@extends('admin.index')
@section('content')
  @section('page-heading')
      {{ __( 'Create Page' ) }}
  @endsection
    @section('header-right')
        <a href="{{ route('admin.page.index') }}" class="btn btn-primary">Pages</a>
    @endsection

    <form method="POST" action="{{ route('admin.page.store') }}" autocomplete="off">
        @csrf
        @component('admin.page.editor',['page'=>'', 'legend' => "Create Page",'submitText'=>"Submit new Page" ])

        @endcomponent
    </form>
@endsection
