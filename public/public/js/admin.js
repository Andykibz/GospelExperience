function readURL(input,phdst) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        console.log(input.files[0].type);
        reader.onload = function (e) {
            switch ( input.files[0].type.split('/')[0] ) {
                case 'image':
                    let imagwrapper = '<img style="max-height:250px" class="img-fluid" src="'+e.target.result+'" alt="Preivew Image"/>';
                    $(`${phdst}`).html(imagwrapper);
                    break;
                case 'audio':
                    console.log("Audio");
                    break;
                case 'video':
                    vidplyr='<video class="embed-responsive" playsinline controls>\
                                <source src="'+e.target.result+'" type="video/'+input.files[0].type.split('/')[1]+'" />\
                            </video>'
                            $('.medpreviewia-wrapper').html(vidplyr);
                    break;

                default:
                    break;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$('#image_files').on('change',function(){
  // vals = $(this).val()
  // readFiles($(this)[0])
  for (let index = 0; index < $(this.files).length; index++) {
        console.log($(this));
    }
    handleFiles( $(this)[0].files )
});

// Preview Files before upload
window.URL = window.URL || window.webkitURL;
fileElem = document.getElementById("fileElem")
function handleFiles( files) {
    fileList = document.getElementById('image-list');
    if (!files.length) {
      fileList.innerHTML = "<p>No files selected!</p>";
    } else {
      fileList.innerHTML = "";
      var list = document.createElement("div");
    //   fileList.appendChild(list);
      for (let i = 0; i < files.length; i++) {
        var li = document.createElement("div");
        li.className='col-3 pb-1 pr-1 pl-1'
        fileList.appendChild(li);

        var img = document.createElement("img");
        img.src = window.URL.createObjectURL(files[i]);
        img.height = 60;
        img.className='img-fluid img-thumbnail';
        img.onload = function() {
          window.URL.revokeObjectURL(this.src);
        }
        li.appendChild(img);
      }
    }
  }

// Trigger file browser fot image selection
$('.uploaded-files-wrapper').on('click',function(){
    $('#image_files').click()
})

// Trigger media form to submit
$('#async-upload-btn').on('click',function(){
    $('form#media-upload-form').trigger('submit')
});


$('form#media-upload-form').on('submit',function(e){
    console.log('mediaUpload');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const formdata = new FormData($(this)[0]);
    $.ajax({
        url : $('#media-upload-form').attr('action'),
        method: 'POST',
        enctype: $('#media-upload-form').attr('enctype'),
        data: formdata,
        beforeSend: function(){
            $('#ajax-loading').show();
        },
        complete: function(){
            $('#ajax-loading').hide();
        },
        processData: false,
        contentType: false,
        cache: false,
        success: function(results){
          console.log(results);
            $('#fileList').html(`
            <div class="inner-wrapper">
                <span class="w-100 text-center mb-2">Click to Upload Other Images</span>
                <span >
                    <i class="upload-icon fa fa-upload"></i>
                </span>
            </div>
            `);

            med_list = ''
            size = 3
            dataArr = chunkArray(results,size)
            dataArr.forEach(element => {
                med_list +='<div class="form-row mb-3">'
                element.forEach(elem => {
                    med_list+=addImagetoList( elem )
                });
                med_list +='</div>'
            });
            $('.media_elements_wrapper').append(med_list)

        },
        error(xhr,status,error){
          console.log(xhr);
          err= xhr;
            jQuery.each(err.responseJSON.errors, function(key, value){
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>'+value+'</p>');
            });

        }
    });
});

function chunkArray(myArray, chunk_size){
    var arrs = [];
    while (myArray.length) {
        arrs.push(myArray.splice(0, chunk_size));
    }
    return arrs;
}

function addImagetoList(data){
  return `<div class="col-sm-4 col-12 media-instance">
      <div class="row ">
          <input type="hidden" name="media[]id" value="${data.id}"/>
          <div class="col-sm-12 col-12 imagewrap">
              <img src="${data.image}" class="img-fluid">
          </div>
          <div class="col-sm-12 col-12 image_wrap">
              <input type="text" name="image[][name]" id="" class="form-control mb-1" value="${data.title}">
              <textarea name="image[][caption]" id="" cols="30" rows="3" class="form-control" placeholder="Caption Here"></textarea>
          </div>
      </div>
  </div>`
}

// Handle Paste Image URLS
$('#pasted_image_urls').on('change',function(){
    links = $(this).val().split(',')
    var count = 0
    for (link of links) {
      $('.dummywrap').append(`<div>
              ${ count+=1 }
              <div class="col-sm-12 col-12 imagewrap"><img src="${link}" class="img-fluid"></div>
              <div class="col-sm-12 col-12 image_wrap">
                  <input type="text" name="image[][name]" id="" class="form-control mb-1" value="Image-${count}">
                  <textarea name="image[][caption]" id="" cols="30" rows="3" class="form-control" placeholder="Caption Here"></textarea>
              </div>
          </div>`)
    }
});

// VIDEOS UPLOAD
$('.upload-video-wrapper').on('click',function(){
  // if( $P('.vidElement').length )
    $('input#video_files').click().on('change',function(){
        files = $(this)[0].files
        video_list = $('#video-list')
        if (files.length) {
          if( ('.video-inner-wrapper').length  ){ video_list.html('') }
          for (let i = 0; i < files.length; i++) {
              if( [ 'mp4','mpg','mpeg','ogv','avi' ].includes( files[i].name.split('.').pop().toLowerCase() ) ){
                  $('#video-list').append(
                    `<figure class="col-sm-4  pb-1 pr-1 pl-1 vidElement">
                          <video class="embed-responsive embed-responsive-16by9" controls>
                              <source src="${window.URL.createObjectURL(files[i])}" type="${files[i].type}">
                              Your browser does not support the video tag.
                          </video>
                      </figure>`
                   )
              }
          }
        }
    });
  });

// https://www.googleapis.com/youtube/v3/videos?part=snippet&id={VIDEO_ID}&fields=items/snippet/title,items/snippet/description&key={YOUR_API_KEY}
// url =`https://www.googleapis.com/youtube/v3/videos?part=snippet&id=UnUq2AQww8U&key=${ytubAPI}&fields=items/snippet/title,items/snippet/description`
// UnUq2AQww8U
// url2="https://www.googleapis.com/youtube/v3/videos?part=snippet&id=3-aQZpLRNIw&key="+youtube_api_key+"&fields=items/snippet/title,items/snippet/description"
function getVideoId(url){
  var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
  var match = url.match(regExp);
  if (match && match[2].length == 11) {
    return match[2];
  } else {
    //error
  }
}

// PASTED VIDEO URLS
$('#videos_paste_modal_btn').on('click',function(e){
  e.preventDefault()
  vidlinks = $('#pasted_video_urls').val().split(',')
  if( vidlinks.length ){
      if($('.video-inner-wrapper').length){ $('#video-list').html('') }
      for (vidlink of vidlinks) {
        let videoid = getVideoId(vidlink)
        console.log( videoid );
          api_key = $('#you.tub_api_key').val();
          $.ajax({
              dataType: "json",
              url     : `https://www.googleapis.com/youtube/v3/videos?part=snippet&id=${videoid}&key=${youtube_api_key}&fields=items/snippet/title,items/snippet/description`,
              beforeSend: function(){   $('#ajax-loading').show()   },
              success : function( result ){
                  video = result['items'][0]["snippet"]
                  console.log(result);
                      $('.video_inputs').append(`
                        <div class="video_input_wrapper" id="vinput-${videoid}">
                          <input type="text" name="video_links[${videoid}][title]" id="video_links" value="${video.title}" >
                          <input type="text" name="video_links[${videoid}][description]" id="video_links" value="${video.description}" >
                          <input type="text" name="video_links[${videoid}][source]" id="video_links" value="${videoid}" >
                        </div>
                      `)
              },
              complete: function(){ $('#ajax-loading').hide() },
          });
          $('#video-list').append(`
                <figure class="col-sm-4 col-12" id="vid-${videoid}">
                  <div class="embed-responsive embed-responsive-16by9">
                  <button type="button" class="close removeMed" data-dismiss="modal" aria-label="Close" data-videoid="${videoid}" onclick="rmMedEl( '#vid-${videoid}','#vinput-${videoid}' )">
                  <span aria-hidden="true">&times;</span>
                  </button>
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${videoid}" frameborder="0"></iframe>
                  </div>
                </figure>`)
          $('#pasted_video_urls').val('')
        }
      }
  });

function wrap_video( src, ext ){
  format={
    'mp4'   : 'video/mpeg-4',
    'avi'   : 'video/x-msvideo',
    'mpg'   : 'video/mpeg',
    'mpeg'  : 'video/mpeg',
    'ogv'   : 'video/ogg',
    'video/mpeg-4'    :   'video/mpeg-4',
    'video/x-msvideo' :   'video/x-msvideo',
    'video/mpeg'      :   'video/mpeg',
    'video/ogg'       :   'video/ogg'
  }
  return `<figure class="col-sm-4  pb-1 pr-1 pl-1 embed-responsive embed-responsive-16by9">
              <video controls>
                  <source src="${src}" type="${format[ext]}">
                  Your browser does not support the video tag.
              </video>
          </figure>`
}


// AUDIO UPLOAD
$('.upload-audio-wrapper').on('click',function(){
    $('input#audio_files').click().on('change',function(){
        files = $(this)[0].files
        audio_list = $('#audio-list')
        if (files.length) {
          if( ('.audio-inner-wrapper').length  ){ audio_list.html('') }
          for (let i = 0; i < files.length; i++) {
              if( [ 'mp3','wav','m4a','amr','aac','ogg' ].includes( files[i].name.split('.').pop().toLowerCase() ) ){
                  $('.audio-list').append( wrap_audio(window.URL.createObjectURL(files[i]),files[i].name.split('.').pop().toLowerCase()) )
              }
              audio_list.append(  )
              console.log(files[i]);
          }
        }
    });
});

  // PASTED AUDIO URLS
  $('#audio_paste_modal_btn').on('click',function(e){
    e.preventDefault()
    audlinks = $('#pasted_audio_urls').val().split(',')
    if( audlinks.length ){
        if($('.audio-inner-wrapper').length){ $('#audio-list').html('') }
        for (audlink of audlinks) {
          let audiolink = audlink
            $.ajax({
                dataType: "json",
                url     : "http://archive.org/metadata/"+audlink+"/metadata?&callback=?",
                beforeSend: function(){   $('#ajax-loading').show()    },
                success : function( result ){
                    let audio =  result['result']
                    console.log(audio);
                    $('.audio_inputs').append(`
                      <div class="audio_input_wrapper" id="ainput">
                          <input type="text" name="audio_links[${audiolink}][title]" id="audio_links" value="${audio.title}" >
                          <input type="text" name="audio_links[${audiolink}][caption]" id="audio_links" value="${audio.description}" >
                          <input type="text" name="audio_links[${audiolink}][source]" id="audio_links" value="${ audio.identifier }" >
                      </div>
                      `)
                },
                complete: function(){   $('#ajax-loading').hide()    },
            });
            $('#audio-list').append(`<div id="aud-${audlink}">
                <button type="button" class="close removeMed" data-dismiss="modal" aria-label="Close" data-videoid="${audlink}" onclick="rmMedEl( '#aud-${audlink}','#ainput-${audlink}' )">
                <span aria-hidden="true">&times;</span></button>
              <iframe src="https://archive.org/embed/${ audlink }" width="500" height="30" frameborder="0"></iframe></div>`)
            $('#pasted_audio_urls').val('')
          }
        }
    });

function wrap_audio( src, ext ){
  format={
    'mp3' : 'audio/mpeg',
    'm4a' : 'audio/mp4',
    'wav' : 'audio/x-wav',
    'amr' : 'audio/amr',
    'aac' : 'audio/x-aac',
    'ogg' : 'audio/ogg',
    'audio/mpeg'  : 'audio/mpeg',
    'audio/mp4'   : 'audio/mp4',
    'audio/x-wav' : 'audio/x-wav',
    'audio/amr'   : 'audio/amr',
    'audio/x-aac' : 'audio/x-aac',
    'audio/ogg'   : 'audio/ogg',
  }
  return `<div class="col-sm-4"><audio controls>
              <source src="${src}" type="${format[ext]}">
              Your browser does not support the audio tag.
          </audio></div>`
}

// $('.close.removeMed').on('click',function(){
//     media_id = $vide$(this).attr('data-mediaid')
//     $('#'+media_id).remove()
// });

function rmMedEl( element,wrapper ){
    $(element).remove()
    $(wrapper).remove()
}
