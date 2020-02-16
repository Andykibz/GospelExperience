<div class="form-group">
    <label for="model-{{str_slug($label)}}">{{ ucfirst($label) }}</label>
    <textarea name="{{ $name }}" id="model-{{ str_slug($label) }}" maxlength="{{ $maxlength ?? '300' }}" aria-describedby="model-{{ $name }}" class="form-control" cols="10" {{ $required ?? '' }} placeholder="{{ucfirst($label)}} ({{ __('Limited to')}} {{ $maxlength ?? '300' }} {{__('characters')}})">{{ $value ?? '' }}</textarea>
    @if ($errors->has($name))
        <span class="invalid-feedback d-inline-block" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
