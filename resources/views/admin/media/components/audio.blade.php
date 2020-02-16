{{-- @push('event_modals') --}}
<!-- Modal -->
<div class="modal fade" id="paste_audio_urls_modal" tabindex="-1" role="dialog" aria-labelledby="paste_audio_urls_Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paste_audio_urls_Label">Paste Audio Url</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="pasted_audio_urls" class="form-control" rows="8" cols="80" placeholder="Paste audio Urls here"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="audio_paste_modal_btn" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
{{-- @endpush --}}
<div hidde="hidden" class="audio_inputs">
    <input type="file" name="audio_files[]" id="audio_files" accept="audio/*" multiple>
</div>
<div class="form-group">
  <div id="audio-list" class=" mt-2 mb-2 drag-drop shadow-sm rounded upload-audio-wrapper uploadswrapper" data-mediatype="audio">
    <div class="audio-inner-wrapper inner-wrapper">
        <span class="w-100 text-center mb-2">Click to Upload Audio</span>
        <span>
            <i class="upload-icon fa fa-upload"></i>
        </span>
    </div>
  </div>
</div>
<p class="text-center">or</p>
<div class="row">
<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-dark paste_audio_urls_modal btn-block m-3" data-toggle="modal" data-target="#paste_audio_urls_modal">
  Paste Urls
</button>
</div>
