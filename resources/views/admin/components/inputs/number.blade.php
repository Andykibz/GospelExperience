<div class="form-group">
    <label for="model-{{str_slug($label)}}">{{ ucfirst($label) }}</label>
<input type="number" step="any" class="form-control" name="{{ $name }}" id="{{ str_slug($label) }}" placeholder="{{ucfirst($label)}}"  value="{{ $value ?? '' }}" {{ $required ?? '' }}>
    @if ($errors->has($name))
        <span class="invalid-feedback d-inline-block" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
