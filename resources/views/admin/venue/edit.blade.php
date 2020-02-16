@extends('admin.index')
@section('content')
    <form method="POST" action="{{ route('admin.venue.update',$venue->id) }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        @section('page-heading')
        <legend>{{__('Edit Venue Info')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-7">

                    @component('admin.components.inputs.text',[ 'value'=>$venue->name, 'name'=>'name', 'label'=>'Venue\'s Name' ])
                    @endcomponent

                    @component('admin.components.inputs.number',[ 'value'=>$venue->longitude, 'name'=>'longitude', 'label'=>'Longitude' ])
                    @endcomponent

                    @component('admin.components.inputs.number',[ 'value'=>$venue->latitude, 'name'=>'latitude', 'label'=>'Latitude' ])
                    @endcomponent

                    @component('admin.components.inputs.textarea',[ 'value'=>$venue->description, 'name'=>'description', 'label'=>'Description' ])
                    @endcomponent

                </fieldset>
                <fieldset class="col-sm-5 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>$venue->photo,
                      'name'=>'photo',
                      'imgurl'=> asset("storage/venue/$venue->photo"),
                      'imgph' => asset('img/phs/venue_placeholder.png'),
                      'label' => 'Venue Image',
                    ])
                    @endcomponent
                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Update Venue') }}</button>
            </div>
    </form>
@endsection
