<!-- Modal -->
<div class="modal fade" id="paste_gallery_urls_modal" tabindex="-1" role="dialog" aria-labelledby="paste_gallery_urls_Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paste_gallery_urls_Label">Paste Gallery Url</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="pasted_gallery_urls" name="name" class="form-control" rows="8" cols="80" placeholder="Paste gallery Urls here"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="gallery_paste_modal_btn" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <div id="gallery-list" class=" mt-2 mb-2 drag-drop shadow-sm rounded upload-gallery-wrapper uploadswrapper" data-mediatype="gallery">
    <div class="gallery-inner-wrapper inner-wrapper">
        <span class="w-100 text-center mb-2">No Galleries added</span>
    </div>
  </div>
</div>
<button id="async-upload-btn" role="button" class="btn btn-outline-secondary btn-sm async-upload-btn"><i class="fa fa-upload"></i></button>
<p class="text-center">or</p>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-dark paste_gallery_urls_modal btn-block m-3" data-toggle="modal" data-target="#paste_gallery_urls_modal">
  Paste Urls
</button>>
