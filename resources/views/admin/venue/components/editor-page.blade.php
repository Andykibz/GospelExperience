@section('admin-heading')
<legend>{{ $legend }}</legend>
@endsection
    <div class="row">
    <fieldset class="col-sm-8">
            <div class="form-group">
                <label for="model-title">{{ __('Title') }}</label>
            <input type="text" class="form-control" name="title" id="model-title" aria-describedby="model-title" placeholder="Title"  value="{{ $event->title ?? '' }}" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            @component('admin.components.inputs.editor',['event'=>$event, 'name'=>'body'])

            @endcomponent
      </fieldset>
        <fieldset class="col-sm-4 col-12">
          <div class="form-group">
            <label for="poster">{{ __('Image') }}</label>
              <div class="profile_image_wrapper mb-4" id="poster_image_wrapper">
                  <img class="img-fluid w-100 " style="max-height:350px;" id="profpic" src="
                  @if (!empty($event->poster))
                      {{ asset('storage/posters/'.$event->poster) }}
                  @else
                      {{ asset('img/phs/poster-placeholder.jpg') }}
                  @endif
                  " alt="placeholder Poster">
              </div>
              <div class="custom-file">
                  <input type="file" name="poster" class="custom-file-input" onchange="readURL(this,'#poster_image_wrapper')">
                  <label class="custom-file-label text-secondary" for="profpic">Choose file</label>
                  @if ($errors->has('poster'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('poster') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
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
