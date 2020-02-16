@push('adminstyles')
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endpush
@push('adminscripts')
  <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
  <script type="text/javascript">
  $('#tags-select').select2({
      placeholder: "{{ $label }}",
      tags: true,
      tokenSeparators:[',']
  })
  </script>
@endpush
<div class="form-group">
    <label for="model-{{str_slug($label)}}">{{ ucfirst($label) }}</label>
    <select id="tags-select" class="form-control" name="tags[]"  multiple="multiple" {{ $required ?? '' }}>
    @foreach (App\Tag::get() as $tag)
        @if ( !empty( $value ) )
            @if ( in_array( $tag->id, $value->pluck('id')->toArray() ) )
                <option selected="selected" value="{{ $tag->id }}">{{ $tag->name }}</option>
            @else
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endif
        @else
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endif
    @endforeach
    </select>
    @if ($errors->has('tags'))
        <span class="invalid-feedback d-inline-block" role="alert">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    @endif
</div>
