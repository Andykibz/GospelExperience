<!--Edit Modal -->
@push('modal')
<div class="modal fade" id="editMediaModal" tabindex="-1" role="dialog" aria-labelledby="editMediaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="" action="" method="post" id="edit_media_form">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMediaModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
              @csrf
              @method('PUT')
              <div class="form-group" id="editPreview-media" class="d-flex justify-content-center align-content-center align-items-center text-centered">

              </div>
              <div class="form-group">
                  <input type="text" id="mediaInp-name" class="form-control mb-2" name="name" value="" placeholder="Name">
                  <textarea name="caption" id="mediaInp-caption" rows="5" cols="80" class="form-control mb-2" placeholder="Caption"></textarea>
                  <input type="hidden" id="mediaInp-source" name="source" value="">
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update-media-btn" class="btn btn-primary">Update Media</button>
      </div>
    </div>
  </form>
  </div>
</div>
@endpush
@foreach ($media->chunk(4) as $mediaGroup)
    <div class="row mb-3">
        @foreach ($mediaGroup as $mediaElement)
          <div class="col-md-3 col-sm-3 col-6 display-media display-{{ $mediaElement->mediatype->slug }}" id="{{ $mediaElement->id }}" >
            <div class="links">
                <a date-route="{{ route( 'admin.media.edit',$mediaElement->id ) }}" data-ID="{{ $mediaElement->id }}" class="edit-media"> <i class="btn btn-outline-info btn-sm fa fa-edit "></i> </a>
                <form action="{{ route('admin.media.destroy',$mediaElement->id) }}" method="post" class="btn btn-outline-danger btn-sm deleteForm"  data-title="{{ $mediaElement->name }}">
                      {{ csrf_field() }}
                      @method('DELETE')
                      <i class="fa fa-trash"></i>
                </form>
            </div>
            @component('admin.media.components.single'.$mediaElement->mediatype->slug,
            [ 'element' => $mediaElement ] )
            @endcomponent
          </div>
        @endforeach
    </div>
@endforeach
@push('adminscripts')
  <script type="text/javascript">
      $('.edit-media').on('click',function(e){
          e.preventDefault()
          let route     = $(this).attr('data-route')
          let media_id  = $(this).attr('data-ID')
          $.get('/admin/media/'+media_id,function( resp ){
              data      = resp.success,
              name      = data.name,
              caption   = data.caption
              source    = data.source
              type      = data.type
              url       = data.url
              $('#mediaInp-name').val(data.name)
              $('#mediaInp-caption').val(data.caption)
              $('#mediaInp-source').val(data.source)
              $('form#edit_media_form').attr('href',data.url)
              switch (data.type) {
                case 'image':
                  $('#editPreview-media').html(`<img class="img-fluid" src="${data.source}">`)
                  break;

                case 'audio':
                  $('#editPreview-media').html(`
                    <iframe hidden src="https://archive.org/embed/${ data.source }&autoplay=0"
                      frameborder="0" webkitallowfullscreen="true" mozallowfullscreen="true"
                      class="embed-responsive-item" allowfullscreen ></iframe>
                    `)

                  case 'video':
                    $('#editPreview-media').html(`
                      <iframe class="embed-responsive-item"
                      src="https://www.youtube.com/embed/${ data.source }"
                      frameborder="0" allow="accelerometer;
                      encrypted-media; gyroscope; picture-in-picture"
                      allowfullscreen></iframe>
                      `)
                  break;

                default:
                    break;
              }
              $('#editMediaModal').modal('show')
          });
      });

      $('#update-media-btn').on('click',function(e){
          e.preventDefault()
          alert( $('form#edit_media_form').attr('href') )
          $.ajax({
              url     : $('form#edit_media_form').attr('href',data.url),
              type    : 'PUT',
              data    : $('form#edit_media_form').serialize(),
              success : function( response ){
                  console.log(respose);
              },
              error   : function( err ){
                  console.log(err);
              }
          })
      });
  </script>
@endpush
