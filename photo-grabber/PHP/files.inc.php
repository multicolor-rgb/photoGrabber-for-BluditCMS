 <style>



   .sidebar {
     display: none !important;
   }

   .container {
     max-width: unset !important;
     width: 100% !important;
   }

   .col-lg-10 {
     all: unset;
     width: 100% !important;
   }
   .navbar{
   	display:none !important;
   }
 </style>

<div class="col-md-12">
<a href="<?php echo DOMAIN_ADMIN;?>plugin/photograbber?edit" class="btn btn-primary">Edit file</a>
<hr>
</div>


 <?php

  $count = 0;
  foreach (glob(PATH_UPLOADS. 'photoGrabber/*') as $img) {

    $base = pathinfo($img)['basename'];

    echo '<a href="'.DOMAIN_BASE.'bl-content/uploads/photoGrabber/'. $base. '" class="photo" onclick="event.preventDefault();submitLink(`'.DOMAIN_BASE.'bl-content/uploads/photoGrabber/'. $base. '`)">
    <img src="' .DOMAIN_BASE.'bl-content/uploads/photoGrabber/'. $base. '" style="width:100px;height:100px;object-fit:cover;margin:10px;"></a>';
    $count++;
  }; ?>


 <script>


   function submitLink(url) {
   	    window.opener.tinymce.activeEditor.execCommand('mceInsertContent', false, `<img src="${url}" />`);
     window.close();
   }


  
 </script>



 </div>
 </div>
 </div>
 </body>

 </html>