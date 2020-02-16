<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">New Sermon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="event.sermon.form">
            <div class="row">
            <div class="col-12">
              @component('admin.components.inputs.text',[ 'name'=>'', 'value'=>'', 'label'=>'Sermon Title' ])
              @endcomponent

              @component('admin.components.inputs.text',[ 'name'=>'', 'value'=>'', 'label'=>'Sermon Speaker'  ])
              @endcomponent

              @component('admin.components.inputs.editor',[ 'name' => '', 'value'=>'', 'label'=>'Sermon Body'])
              @endcomponent
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i class="fa fa-cancel"></i> </button>
        <button type="button" class="btn btn-primary add-sermon" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>


@push('adminscripts')
  <script type="text/javascript">
      $(document).ready(function() {


        var sermonKount = 0
        $('.add-sermon').on('click',function(e){
            e.preventDefault()
            for (instance in CKEDITOR.instances) {
              CKEDITOR.instances.editor_sermon_body.updateElement();
            }
             sermonTitle   = $("#{{ str_slug('Sermon Title') }}").val()
             sermonSpeaker = $("#{{ str_slug('Sermon Speaker') }}").val()
             sermonBody    = $("#editor_{{ str_slug('Sermon Body','_') }}").val()

             if( sermonTitle.replace(/\s/g,'').length > 0 ){
               sermonKount+=1
             sermon = `
               <div id="${sermonTitle.replace(/\s/g,'')+sermonKount}-sermon">
                <input hidden="hidden" name="sermon[${sermonKount}][title]" value="${sermonTitle}"/>
                <input hidden="hidden" type="text" name="sermon[${sermonKount}][speaker]" value="${sermonSpeaker}"/>
                <textarea hidden="hidden" name="sermon[${sermonKount}][body]">${sermonBody}</textarea>
                </div>`

              $('#sermon-inputs').append(sermon)
              $('#sermons-list').append(`
                <div class="col-sm-6 col-12" id="${sermonTitle.replace(/\s/g,'')+sermonKount}-card">
                  <div class="card">
                      <div class="card-header">
                      ${ sermonTitle }
                      <button type="button" class="close closeSermonCard" data-target="#${sermonTitle.replace(/\s/g,'')+sermonKount}" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="card-body">
                          <p>${ sermonBody.replace(/<(?:.|\n)*?>/gm, '').substring(0,50) }</p>
                          <footer class="blockquote-footer"><cite title="Speaker">by ${ sermonSpeaker }</cite></footer>
                        </blockquote>
                      </div>
                    </div>
                </div>
                `)
                $("#{{ str_slug('Sermon Title') }}").val('')
                $("#{{ str_slug('Sermon Speaker') }}").val('')
                $("#editor_{{ str_slug('Sermon Body') }}").val('')
                for (instance in CKEDITOR.instances) {
                  CKEDITOR.instances.editor_sermon_body.setData('');
                }
            }else{
              alert('You do not have a valid title for the Sermon')
            }

            $('button.closeSermonCard').on('click',function(){
                var mainId = $(this).attr('data-target')
                $(mainId+'-sermon').remove()
                $(mainId+'-card').remove()
            });
        });
      });
  </script>

@endpush
