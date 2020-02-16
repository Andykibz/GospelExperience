<div class="form-group">
  <label for="model-{{ str_slug($label) }}">{{ ucfirst($label) }}</label>
    <div class="{{ $name }}_image_wrapper mb-4" id="{{ str_slug($label) }}_image_wrapper">
        <img class="img-fluid w-100 " style="max-height:350px;" id="model-{{ str_slug($label) }}" src="
        @if (!empty( $imgname ))
            {{ $imgurl }}
        @else
            {{ $imgph }}
        @endif
        " alt="placeholder {{$name}}">
    </div>
    <div class="custom-file">
        <input type="file" name="{{ $name }}" class="custom-file-input" onchange="readURL(this,'#{{ str_slug($label) }}_image_wrapper')" {{ $required ?? '' }}>
        <label class="custom-file-label text-secondary" for="profpic">Choose file</label>
        @if ($errors->has($name))
            <span class="invalid-feedback d-inline-block" role="alert">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
  </div>
