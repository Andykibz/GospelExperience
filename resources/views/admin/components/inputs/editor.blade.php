<div class="form-group">
    <label for="editor-{{ str_slug($label,'_') }}">{{ ucfirst($label)}}</label>
    <textarea class="form-control" id="editor_{{ str_slug($label,'_') }}" name="{{ $name }}" rows="10" placeholder="{{ucfirst($label)}}" required>{{ $value ?? '' }}</textarea>
    @if ($errors->has( $name ))
        <span class="invalid-feedback d-inline-block" role="alert">
            <strong>{{ $errors->first( $name ) }}</strong>
        </span>
    @endif
</div>
@push('adminscripts')
  <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
  <script>
  CKEDITOR.replace( 'editor_{{ str_slug($label,'_') }}',{
            uiColor: '#eeeeee',
            language: 'en',
            height: '30em',
            removePlugins: 'easyimage, cloudservices'
            // filebrowserImageBrowseUrl: '/file-manager/ckeditor'
  });
  </script>
@endpush
