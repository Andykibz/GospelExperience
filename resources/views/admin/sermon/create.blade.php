@extends('admin.index')
@section('content')
    <form method="POST" action="{{ route('admin.sermon.store') }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @section('page-heading')
        <legend>{{__('New Sermon')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-8">

                    @component('admin.components.inputs.text',[ 'value'=>'', 'name'=>'title','label'=>'Sermon title' ])
                    @endcomponent

                    @component('admin.components.inputs.text',[ 'value'=>'', 'name'=>'speaker', 'label'=>'Sermon Speaker' ])
                    @endcomponent

                    @component('admin.components.inputs.tags',[
                      'value'=>[],
                      'name' =>'tags',
                      'label'=>'Tags'
                    ])
                    @endcomponent

                    @component('admin.components.inputs.editor',['value'=>'', 'name'=>'body','label'=>'Sermon Body'])
                    @endcomponent
                </fieldset>
                <fieldset class="col-sm-4 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>'',
                      'name'=>'sermon_image',
                      'imgurl'=> '',
                      'imgph' => asset('img/phs/artist_placeholder.png'),
                      'label' =>'Sermon Image'
                    ])
                    @endcomponent

                    @component('admin.sermon.components.sermon-media',[ 'media' => '' ])

                    @endcomponent

                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Add Sermon') }}</button>
            </div>
    </form>
@endsection
