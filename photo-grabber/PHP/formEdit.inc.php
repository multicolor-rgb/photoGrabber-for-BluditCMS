
<?php 

global $pages;
 



;?>


 
<script type="text/javascript">

if(document.querySelector('#jseditorToolbarRight')!==null ){

const pictureBTN = document.createElement('button');
pictureBTN.classList.add('pictureBTN','btn','btn-light');
pictureBTN.innerHTML = 'PG 📷';
document.querySelector('#jseditorToolbarRight').append(pictureBTN);

	pictureBTN.addEventListener('click',(e)=>{
		e.preventDefault();
	window.open('<?php echo DOMAIN_ADMIN;?>plugin/photograbber?cke','','width=800px,height=600px');
});



const pictureListBTN = document.createElement('button');
pictureListBTN.classList.add('pictureBTN','btn','btn-light');
pictureListBTN.innerHTML = 'PG List 📷';
document.querySelector('#jseditorToolbarRight').append(pictureListBTN);

	pictureListBTN.addEventListener('click',(e)=>{
		e.preventDefault();
	window.open('<?php echo DOMAIN_ADMIN;?>plugin/photograbber?files','','width=800px,height=600px');
});


 

};

 	
</script>


