<?php
    class PhotoGrabber extends Plugin {

     

    public function adminController()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {



if(isset($_GET['cke'])==false){
    echo '<style>
.useCKE{display:none !important};
    </style>';
}else{

echo ' <style>

.header,#sidebar,#footer,.buttons{
    display:none !important;
}
#maincontent{
    width:100%;
}


 </style>';

};


if(isset($_POST['delthisimage'])){

$imgs = $_POST['delphoto'];

foreach($imgs as $items){
unlink(PATH_UPLOADS. 'photoGrabber/'.$items);
};

};

 



if(isset($_POST['download'])){


$urlImage = $_POST['downloadurl'];
$urlImageThumb = $_POST['downloadurlthumb'];

$base = basename($urlImage);
 

if(file_exists(PATH_UPLOADS.'photoGrabber/')==false){
mkdir(PATH_UPLOADS.'photoGrabber/',0755);
};



if(

file_put_contents(PATH_UPLOADS.'photoGrabber/'.$_POST['downloadid'].'.jpg', file_get_contents($urlImage))
){
        echo '<div style="box-sizing:border-box;width:100%;background:green;padding:10px;text-align:center;color:#fff;">File downloaded successfully on image folder  - close this window and go to PG list</div>';
    }
    else
    {
        echo '<div style="box-sizing:border-box;width:100%;background:red;padding:10px;text-align:center;color:#fff;">File downloading failed.</div>';
    }

};



        

        };

    }

    public function adminView()
    {
      

 global $security;
        $tokenCSRF = $security->getTokenCSRF();


if(isset($_GET['cke'])){
    include $this->phpPath().'PHP/browser.inc.php';
}elseif(isset($_GET['edit'])){
    include $this->phpPath().'PHP/edit.inc.php';
}elseif(isset($_GET['files'])){
include $this->phpPath().'PHP/files.inc.php';

}




echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="box-sizing:border-box;display:grid; width:100%;grid-template-columns:1fr auto; border-radius:5px;padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
            <p style="margin:0;padding:0;"> Do you like using my plugin? Buy me a ☕ </p>
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" border="0">
            <img alt="" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" border="0" sjeufj9v4="">
        </form>';



    }

 
    public  function adminBodyEnd(){
include($this->phpPath().'PHP/formEdit.inc.php');
    }

    }
?>