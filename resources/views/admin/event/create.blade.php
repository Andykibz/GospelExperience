@extends('admin.index')
@section('content')
  @component('admin.event.components.sermons')
  @endcomponent
    <form method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @section('page-heading')
        <legend>{{__('Create Event')}}</legend>
        @endsection
            <div class="row">
            <fieldset class="col-sm-9">
                    @component('admin.components.inputs.text',[ 'value'=> isset($request->title) ? $request->title: '' , 'name'=>'title', 'label'=>'Event Name' ])
                    @endcomponent

                    @component('admin.components.inputs.tags',[
                      'value' => [],
                      'name'  => 'tags',
                      'label' => 'Tags'
                    ])
                    @endcomponent

                    @component('admin.components.inputs.textarea',['value'=>'', 'name'=>'headline','label'=>'Headline' ])
                    @endcomponent

                    @component('admin.components.inputs.editor',['value'=>'', 'name'=>'body','label'=>'Event Contents' ])
                    @endcomponent

                    @component('admin.event.components.venue',[ 'model'=>'', 'name'=>'venue', 'label'=>'Venue' ])
                    @endcomponent

                    @component('admin.event.components.listsermons', ['sermons'=>''])
                    @endcomponent

                    @component('admin.event.components.artists')
                    @endcomponent


                    <section id="sermon-section" class="mb-3">
                        <div id="sermons" class="mb-2">
                            <div id="sermon-inputs"></div>
                            <div id="sermons-list" class="row"></div>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                          Add Sermon
                        </button>
                    </section>

                    @component( 'admin.event.components.media', [ 'media' => '' ] )
                    @endcomponent


                </fieldset>
                <fieldset class="col-sm-3 col-12">
                    @component('admin.components.inputs.image',[
                      'imgname'=>'',
                      'name'=>'poster',
                      'imgurl'=> '',
                      'imgph' => asset('img/phs/poster-placeholder.jpg'),
                      'label' => 'Event Poster',
                    ])
                    @endcomponent

                    <div class="form-group">
                      <label for="date">Date</label>
                      <input type="date" name="date" id="date" class="form-control">
                      @if ($errors->has('date'))
                          <span class="invalid-feedback d-inline-block" role="alert">
                              <strong>{{ $errors->first($name) }}</strong>
                          </span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="datetime-picker-from">From</label>
                      <input type="datetime-local" name="from" id="datetime-picker-from" class="form-control">
                      @if ($errors->has('date'))
                          <span class="invalid-feedback d-inline-block" role="alert">
                              <strong>{{ $errors->first('to') }}</strong>
                          </span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="datetime-picker-from">To</label>
                      <input type="datetime-local" name="to" id="datetime-picker-from" class="form-control">
                      @if ($errors->has('date'))
                          <span class="invalid-feedback d-inline-block" role="alert">
                              <strong>{{ $errors->first('to') }}</strong>
                          </span>
                      @endif
                    </div>

                    @component('admin.components.inputs.checkbox',[ 'name'=>'publish','value'=> '','label'=>'Publish' ])
                    @endcomponent

                </fieldset>

            </div>
            <div class="mx-auto mb-5">
                <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ __('Create Event') }}</button>
            </div>

    </form>
@endsection
@push('adminscripts')
  <script type="text/javascript">

  </script>
@endpush
