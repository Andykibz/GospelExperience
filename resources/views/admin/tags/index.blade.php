@extends('admin.index')
@section('page-heading')
{{ __('Tags')}}
@endsection
@section('content')
  <form class="col-sm-12" action="{{ route('admin.tag.store') }}" method="post">
    @csrf
    <div class="form-row">
      <div class="form-group col-sm-4">
        @component('admin.components.inputs.text',['name'=>'name', 'value'=>'','label'=>'Tag name'])
        @endcomponent
        <input type="submit" class="btn btn-outline-info" value="Add Tag">
      </div>
      <div class="col-sm-6">
        @component('admin.components.inputs.textarea',['name'=>'description', 'value'=>'','label'=>'Description'])
        @endcomponent
      </div>
      <div class="col-sm-2 d-flex align-items-end">

      </div>
    </form>
  <div class="col-sm-12 row">
    @if ( $tags )
      <div class="col-sm-4">
        <div class="list-group tag-list" id="list-tab" role="tablist">
            @foreach ($tags as $tag)
                <a class="list-group-item list-group-item-action" id="list-{{ $tag->slug }}-list" data-toggle="list" href="#list-{{ $tag->slug }}" role="tab" aria-controls="home">{{ $tag->name }}</a>
            @endforeach
        </div>
      </div>
      <div class="col-sm-6">
        <div class="tab-content" id="nav-tabContent">
          @foreach ($tags as $tag)
                <div class="tab-pane fade show p-4 rounded bg-white" id="list-{{$tag->slug}}" role="tabpanel" aria-labelledby="list-{{  $tag->slug }}-list">

                  <form class="" action="{{   route('admin.tag.update',$tag->id) }}" id="updateForm-{{$tag->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        @component('admin.components.inputs.text',['name'=>'name', 'value'=>$tag->name,'label'=>'Tag name' ])
                        @endcomponent
                      </div>
                      <div class="col-sm-6">
                        @component('admin.components.inputs.textarea',['name'=>'description', 'value'=>$tag->description, 'label'=>'Description'])
                        @endcomponent
                      </div>
                      <div class="col-sm-2 d-flex flex-column align-items-end ">
                        <button type="submit" class="btn btn-outline-info btn-block" data-target="updateForm-{{$tag->id}}" >Update</button>
                        <button type="button" class="btn btn-outline-danger btn-block delFormBtn" data-title="{{ $tag->name }}"
                          data-target="#deleteForm-{{ $tag->id }}">Delete</button>
                      </div>
                    </div>
                  </form>
                  <form hidden="hidden" action="{{ route('admin.tag.destroy',$tag->id) }}" method="post" class="btn btn-outline-danger btn-block" id="deleteForm-{{ $tag->id }}">
                    @csrf
                    @method('DELETE')
                  </form>
                </div>
          @endforeach
        </div>
      </div>
  @endif
  </div>

@endsection
@push('adminscripts')
<script type="text/javascript">
    $(document).ready(function() {
       // Toggle Tag Tabs for individual tags
       $('.tag-list a').on('click', function (e) {
         e.preventDefault()
         $(this).tab('show')
       })

       //Trigger Tag Delete
       $('.delFormBtn').on('click',function(){
         title = $(this).attr('data-title')
         form = $(this).attr('data-target')
         if( confirm(`Are you sure you want to delete ${title} ?`) ){
            $(form).submit()
         }
       });


});
</script>
@endpush
