  
<style>

.grider{
  display:flex;
  gap:10px;
}

.navbar{
  display: none !important;
}

</style>

<button class="alldel btn btn-primary">Select all</button>
<a href="<?php echo DOMAIN_ADMIN;?>plugin/photograbber?files" class="alldel btn btn-dark" >Back to uploader</a>
<hr>
<form method="POST">
  <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF;?>">



<div class="grider">

 <?php

  $count = 0;
  foreach (glob(PATH_UPLOADS. 'photoGrabber/*') as $img) {

    $base = pathinfo($img)['basename'];

echo '
<label style="border:solid 1px #000;padding:5px; box-sizing:border-box;display:flex;flex-direction:column;text-align:center;">
<input type="checkbox" name="delphoto[]" class="delphoto" value="'.$base.'">';

    echo '
     <img src="'.DOMAIN_UPLOADS .'photoGrabber/'. $base . '" style="width:100;height:100px;object-fit:cover;margin:10px;">
    <p>'.$base.'</p>
</label>
    ';
 


  }; ?>


</div>

<input type="submit" name="delthisimage" value="delete this" onclick="return confirm(`Are you sure you want to delete this images?`);" class="btn btn-primary">

</form>


<script type="text/javascript">
  document.querySelector('.alldel').addEventListener('click',x=>{
    x.preventDefault();
document.querySelectorAll('.delphoto').forEach(c=>{c.checked=true});
  });
</script>