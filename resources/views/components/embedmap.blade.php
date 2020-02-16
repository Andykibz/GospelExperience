<!-- 4:3 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
<iframe
        class="embed-responsive-item"
        frameborder="0"
        scrolling="yes"
        marginheight="0"
        marginwidth="0"
        src = "https://maps.google.com/maps?q={{ $lat }},{{ $long }}&hl=es;z=14&amp;output=embed">
       </iframe>
       <br />
       <small>
         <a
          href="https://maps.google.com/maps?q='+{{ $lat }}+','+{{ $long }}+'&hl=es;z=14&amp;output=embed"
          style="color:#0000FF;text-align:left"
          target="_blank"
         >
           See map bigger
         </a>
</div>
