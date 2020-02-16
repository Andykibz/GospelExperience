@extends('admin.index')
@section('content')
    <form method="POST" action="{{ route('admin.artist.store') }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @section('page-heading')
        <legend>{{__('New Artist')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-8">

                    @component('admin.components.inputs.text',[ 'value'=>'', 'name'=>'name', 'label'=>'Artist\'s Name' ])
                    @endcomponent

                    @component('admin.components.inputs.tags',[
                      'value' =>[],
                      'name' =>'tags',
                      'label'=> 'Tags'
                    ])
                    @endcomponent

                    @component('admin.components.inputs.editor',['value'=>'', 'name'=>'body', 'label'=>'Sermon\'s Body'])
                    @endcomponent
                </fieldset>
                <fieldset class="col-sm-4 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>'',
                      'name'=>'artist_image',
                      'imgurl'=> '',
                      'imgph' => asset('img/phs/artist_placeholder.png'),
                      'label'=> 'Artist Image',
                    ])
                    @endcomponent
                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Add Artist') }}</button>
            </div>

    </form>
@endsection
