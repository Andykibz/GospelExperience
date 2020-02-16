{{-- @push('event_modals') --}}
<!-- Modal -->
<div class="modal fade" id="paste_image_urls_modal" tabindex="-1" role="dialog" aria-labelledby="paste_media_urlsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paste_media_urlsLabel">Paste Image Urls</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="pasted_image_urls" class="form-control" rows="8" cols="80" placeholder="Paste Image Urls here"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
{{-- @endpush --}}
<div hidde="hidden" class="image_inputs">
    <input type="file" name="image_files[]" id="image_files" accept="image/*" multiple>
</div>

<div class="form-group">
  <div id="image-list" class=" mt-2 mb-2 drag-drop shadow-sm rounded uploaded-files-wrapper uploadswrapper ">
    <div class="image-inner-wrapper inner-wrapper">
        <span class="w-100 text-center mb-2">Click to Upload Images</span>
        <span>
            <i class="upload-icon fa fa-upload"></i>
        </span>
    </div>
  </div>
</div>
<p class="text-center">or</p>
<div class="row">
  <button type="button" class="btn btn-outline-dark paste_image_urls_modal btn-block m-3" data-toggle="modal" data-target="#paste_image_urls_modal">
      Paste Urls
  </button>
</div>
