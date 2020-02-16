$(document).ready(function() {
     // Stuff to do as soon as the DOM is ready
     $('.deleteForm').on('click',function(e){
       e.preventDefault()
       name = $(this).attr('data-title') ;
       if (confirm(`Are you sure you want to delete ${name}`)) {
          $(this).submit()
       }
     });
     // Artists Input
     let artists_wrapper = $('#event-artists')
     $('.artist-item').on('click',function(e){
          e.preventDefault()
          if ($(this).hasClass('selected')) {
              $(this).removeClass('selected')
              artist_id=$(this).attr('data-artist')
              $(`#event_artist-${artist_id}`).remove()
          }else{
              $(this).addClass('selected')
              artist_id=$(this).attr('data-artist')
              $('#event-artists').append(`<input id="event_artist-${artist_id}" name="artist[]" value="${artist_id}"  hidden='hidden' />`)

          }
          // $(this).addClass('selected')
     })



});
var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}
