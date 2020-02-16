@section('admin-heading')
<legend>{{ $legend }}</legend>
@endsection
    <div class="row">
    <fieldset class="col-sm-8">

            @component('admin.components.inputs.text',[ 'model'=>$event, 'name'=>'title' ])
            @endcomponent

            @component('admin.components.inputs.editor',['event'=>$event, 'name'=>'body'])
            @endcomponent
        </fieldset>
        <fieldset class="col-sm-4 col-12">
            @component('admin.components.inputs.image',[
              'imgname'=>$event->poster ?? '',
              'name'=>'poster',
              'imgurl'=> asset('storage/posters/'.$event->poster ?? ''),
              'imgph' => asset('img/phs/poster-placeholder.jpg')
            ])
            @endcomponent
            <div class="form-group">
              <label for="date">Date</label>
              <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
              <label for="datetime-picker-from">From</label>
              <input type="datetime-local" name="from" id="datetime-picker-from" class="form-control">
            </div>
            <div class="form-group">
              <label for="datetime-picker-from">To</label>
              <input type="datetime-local" name="to" id="datetime-picker-from" class="form-control">
            </div>
        </fieldset>

    </div>
    <div class="mx-auto mb-5">
        <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ $submitText }}</button>
    </div>
