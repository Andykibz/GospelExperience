<div class="col-auto my-1">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="{{ str_slug($label) }}" name="{{ $name }}" {{ $value }} value=1>
        <label class="custom-control-label" for="{{ str_slug($label) }}">{{ $label }}</label>
      </div>
      @if ($errors->has($name))
          <span class="invalid-feedback d-inline-block" role="alert">
              <strong>{{ $errors->first($name) }}</strong>
          </span>
      @endif
</div>
