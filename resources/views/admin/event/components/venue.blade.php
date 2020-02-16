@push('adminstyles')
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endpush
@push('adminscripts')
  <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
  <script type="text/javascript">
  $('#venue').select2({
      placeholder: "{{ $label }}",
  })
  </script>
@endpush
<div class="form-group">
    <label for="model-{{ str_slug( $label ) }}">{{ ucfirst($label) }}</label>
    <select id="{{ str_slug( $label ) }}" class="form-control" name="{{ $name }}" >
    @foreach (App\Venue::get() as $venue)
        @if ( !empty( $value ) )
            @if ( in_array( $venue->id, $value->pluck('id')->toArray() ) )
                <option selected="selected" value="{{ $venue->id }}">{{ $venue->name }}</option>
            @else
                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
            @endif
        @else
            <option value="{{ $venue->id }}">{{ $venue->name }}</option>
        @endif
    @endforeach
    </select>
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
