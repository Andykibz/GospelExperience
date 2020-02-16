@extends('admin.index')
@section('content')
    <form method="POST" action="{{ route('admin.artist.update',$artist->id) }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        @section('page-heading')
        <legend>{{__('Edit Artist Info')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-8">

                    @component('admin.components.inputs.text',[ 'value'=>$artist->name, 'name'=>'name', 'label'=>'Artist\'s Name' ])
                    @endcomponent

                    @component('admin.components.inputs.tags',[
                      'value'=>$artist->tags()->get(),
                      'name' =>'tags',
                      'label'=>'Tags',
                    ])
                    @endcomponent

                    @component('admin.components.inputs.editor',['value'=>$artist->body, 'name'=>'body', 'label'=>'Sermon\'s Body'])
                    @endcomponent
                </fieldset>
                <fieldset class="col-sm-4 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>$artist->artist_image,
                      'name'=>'artist_image',
                      'imgurl'=> asset("storage/artists/$artist->artist_image"),
                      'imgph' => asset('img/phs/artist_placeholder.png'),
                      'label' => 'Artist Image',
                    ])
                    @endcomponent
                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Update Artist') }}</button>
            </div>

    </form>
@endsection
