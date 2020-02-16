@extends('admin.index')
@section('content')
    <form method="POST" action="{{ route('admin.sermon.update',$sermon->id) }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        @section('page-heading')
        <legend>{{__('Edit Sermon')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-8">

                    @component('admin.components.inputs.text',[ 'value'=>$sermon->title, 'name'=>'title','label'=>'Sermon title' ])
                    @endcomponent

                    @component('admin.components.inputs.text',[ 'value'=>$sermon->speaker, 'name'=>'speaker', 'label'=>'Sermon Speaker' ])
                    @endcomponent

                    @component('admin.components.inputs.tags',[
                      'value'=>$sermon->tags()->get()->pluck('name')->toArray(),
                      'name' =>'tags',
                      'label'=>'Tags'
                    ])
                    @endcomponent
                    
                    @component('admin.components.inputs.editor',['value'=>$sermon->body, 'name'=>'body','label'=>'Sermon Body'])
                    @endcomponent
                </fieldset>
                <fieldset class="col-sm-4 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>$sermon->sermon_image,
                      'name'=>'sermon_image',
                      'imgurl'=> asset("storage/image/$sermon->sermon_image"),
                      'imgph' => asset('img/phs/artist_placeholder.png'),
                      'label' =>'Sermon Image'
                    ])
                    @endcomponent

                    @component('admin.sermon.components.sermon-media',[ 'media' => $sermon->media ])

                    @endcomponent

                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Update Sermon') }}</button>
            </div>
    </form>
@endsection
