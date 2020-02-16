@extends('admin.index')
@section('content')
    <form method="POST" action="{{ route('admin.venue.store') }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @section('page-heading')
        <legend>{{__('New Venue')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-8">

                    @component('admin.components.inputs.text',[ 'value'=>'', 'name'=>'name', 'label'=>'Venue\'s Name' ])
                    @endcomponent

                    @component('admin.components.inputs.number',[ 'value'=>'', 'name'=>'latitude', 'label'=>'Latitude' ])
                    @endcomponent

                    @component('admin.components.inputs.number',[ 'value'=>'', 'name'=>'longitude', 'label'=>'Longitude' ])
                    @endcomponent

                    @component('admin.components.inputs.textarea',[ 'value'=>'', 'name'=>'description', 'label'=>'Description' ])
                    @endcomponent

                </fieldset>
                <fieldset class="col-sm-4 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>'',
                      'name'=>'photo',
                      'imgurl'=> '',
                      'imgph' => asset('img/phs/venue_placeholder.png'),
                      'label'=> 'Venue Image',
                    ])
                    @endcomponent
                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Add Venue') }}</button>
            </div>

    </form>
@endsection
