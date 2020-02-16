@extends('admin.index')

@section('content')
  @component('admin.event.components.sermons')
  @endcomponent
  @stack('modal')
<form method="POST" id="update-event-form" action="{{ route('admin.event.update',$event->id) }}" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @method('PATCH')
    @section('admin-heading')
    <legend>{{__('Create Event')}}</legend>
    @endsection
        <div class="row">
        <fieldset class="col-sm-8 col-12">
            @component('admin.components.inputs.text',[ 'value'=>$event->name, 'name'=>'title','label'=>'Event Name' ])
            @endcomponent

            @component('admin.components.inputs.tags',[
              'value'=>$event->tags()->get(),
              'name' =>'tags',
              'label'=> 'Tags'
            ])
            @endcomponent

            @component('admin.components.inputs.textarea',['value'=>$event->headline, 'name'=>'headline','label'=>'Headline' ])
            @endcomponent

            {{-- CONTENT BODY INPUT --}}
            @component('admin.components.inputs.editor',['value'=>$event->body, 'name'=>'body','label'=>'Event Contents'])
            @endcomponent

            {{-- VENUE INPUT --}}
            @component('admin.event.components.venue',[ 'value'=>$event->venue()->get(), 'name'=>'venue', 'label'=>'Venue' ])
            @endcomponent

            @component('admin.event.components.listsermons', ['sermons'=>$event->sermons])
            @endcomponent

            @component('admin.event.components.artists',[ 'model'=>$event ])
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

            @component( 'admin.event.components.media',['media' => $event->media()->get(), '' ] )
            @endcomponent

        </fieldset>
        <fieldset class="col-sm-4 col-12">
            @component('admin.components.inputs.image',[
              'imgname'=>$event->poster,
              'name'=>'poster',
              'imgurl'=> asset("storage/posters/$event->poster"),
              'imgph' => asset('img/phs/poster-placeholder.jpg'),
              'label' => 'Event Poster',
            ])
            @endcomponent

            <div class="form-group">
              <label for="date">Date</label>
              <input type="date" name="date" id="date" class="form-control"
                value="{{ date( 'Y-m-d', strtotime($event->date)) }}"
                />
            </div>

            <div class="form-group">
              <label for="datetime-picker-from">From</label>
              <input type="datetime-local" name="from" id="datetime-picker-from" class="form-control"
               value="{{Carbon\Carbon::parse(strtotime($event->from))->format('Y-m-d')."T".Carbon\Carbon::parse(strtotime($event->from))->format('H:i')}}">
            </div>

            <div class="form-group">
              <label for="datetime-picker-to">To</label>
              <input type="datetime-local" name="to" id="datetime-picker-to" class="form-control"
              value="{{Carbon\Carbon::parse(strtotime($event->to))->format('Y-m-d')."T".Carbon\Carbon::parse(strtotime($event->to))->format('H:i')}}">
            </div>

            @component('admin.components.inputs.checkbox',[ 'name'=>'publish','value'=> $event->published ? 'checked' : '', 'label'=>'Publish' ])
            @endcomponent

        </fieldset>

        </div>
        <div class="mx-auto mb-5">
            <button hidden class="btn btn-primary btn-block col-sm-8" role="button" id="submit-updated-event" type="submit">{{ __('Update Event') }}</button>
        </div>
</form>
<div class="col-sm-8">
    @component( 'admin.event.components.mediaIndex',['media' => $event->media()->get(), '' ] )
    @endcomponent
</div>


<button class="btn btn-primary btn-block col-sm-8" role="button"
        onclick="event.preventDefault();document.getElementById('update-event-form').submit();"
    >{{ __("Update Event $event->name") }}</button>
@endsection
