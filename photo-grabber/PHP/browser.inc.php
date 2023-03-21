<?php 


 global $security;
$tokenCSRF = $security->getTokenCSRF();

;?>

<h3>PhotoGrabber</h3>


<style>

.navbar{
    display: none !important;
}

.foto-grid{
    width: 100%;
    flex-wrap: wrap;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    box-sizing: border-box;
    gap: 5px;
}

.foto-item{
    display: flex;
    flex-direction: column;
}


.searchbar{
    width: 100%;
display:grid;
grid-template-columns: 1fr;
gap:10px;
background: #fafafa;
border:solid 1px #ddd;
padding: 10px;
box-sizing: border-box;
}

.searchbar :is(select,input){
    width: 100%;
    padding: 10px;
    margin:0;
box-sizing: border-box;
}

.searchbar :is(input[name="submit"]){
width:200px;
background: #000;
border:none;
color:#fff;
cursor: pointer;
}

.foto-item-btn{
    width: 100%;
    padding: 10px;
    margin:0;
    background: #000;
    color:#fff;
    margin:3px;
    border:none;
    cursor: pointer;
}

.foto-item form{
    margin:0;
    padding: 0;
}

.foto-item{
width: 100%;
padding:10px;
box-sizing: border-box;
border:solid 1px #ddd;
}

    </style>




<form method="POST" class="searchbar">
             <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF;?>">
    <label for="query" >Search Images</label>
    <input type="text" required  name="query" 


<?php if(isset($_POST['query'])){

echo 'value="'.$_POST['query'].'"' ;

};?>

    placeholder="Image key words">

<label for="page"

>Page Number</label>

<input type="text" 


<?php if(isset($_POST['page'])){

echo 'value="'.$_POST['page'].'"' ;

};?>

 name="page" placeholder="page number">

<label for="resolution">Image Size</label>
<select name="resolution">
<option value="640" 


<?php if(isset($_POST['resolution']) && $_POST['resolution']=='640'){
echo 'selected';
};?>

>small</option>
<option value="1920"

<?php if(isset($_POST['resolution']) && $_POST['resolution']=='1920'){
echo 'selected';
};?>

>regular</option>
<option value="2400"

<?php if(isset($_POST['resolution']) && $_POST['resolution']=='2400'){
echo 'selected';
};?>

>full</option>
</select>

    <input type="submit" value="Search Photos" name="submit">
</form>


 

 <?php 



if (isset($_POST['submit'])) {

    $page = 1;



    if (isset($_POST['page'])) {
        $page = $_POST['page'] ?? 1;
    };


    $url = 'https://api.unsplash.com/search/photos?page='.$page.'&per_page=30&query=' . str_replace(' ','+',$_POST['query']) . '&client_id=y5fZ83-viHmyRH-Rfe0OkZfh-zOvWtK08BoDQKoZX70&w=1920';

    $curl = curl_init();

    if ($_SERVER['HTTP_HOST'] == 'localhost') {
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    }

    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_HEADER, false);

    $data = curl_exec($curl);

    curl_close($curl);


    $json = json_decode($data, true);




        
 global $security;
        $tokenCSRF = $security->getTokenCSRF();

 
    $fotItem =  '<div class="foto-grid">';

    for ($i = 0; $i < 30; $i++) {


        $fotItem .=' <div class="foto-item">';
        $fotItem .= '
        <a href="'.$json['results'][$i]['links']['html'].'">
        <img style="width:100%;max-height:130px;display:block;object-fit:contain;margin:0 auto;" src="' . $json['results'][$i]['urls']['thumb'] . '"></a>
        ';

    
    $fotItem .= '<p style="text-align:center;font-size:13px;">Photo by '.$json['results'][$i]['user']['username'].' on <a href="https://unsplash.com/">Unsplash</a></p>


<form method="POST" action="#">
    <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="'.$tokenCSRF.'">
<input type="hidden" name="downloadurl" value="'.$json['results'][$i]['urls']['full'].'&w='.$_POST['resolution'].'">
<input type="hidden" name="downloadurlthumb" value="'.$json['results'][$i]['urls']['full'].'&w=80">
<input type="hidden" name="downloadid" value="'.$json['results'][$i]['id'].'-'.$_POST['resolution'].'">
<input type="submit" class="foto-item-btn" value="Download" name="download">
</form>
    ';


        $fotItem .= '<button class="useCKE foto-item-btn" data-url="'.$json['results'][$i]['urls']['full'].'&w='.$_POST['resolution'].'">Use directly in tinyMCE</button>';
        

        $fotItem .= '</div>';
    };

    $fotItem .= '</div>';

echo $fotItem;

};

;?>



<script>


document.querySelectorAll('.useCKE').forEach((x,i)=>{

x.addEventListener('click',(e)=>{
  
 e.preventDefault();
    window.opener.tinymce.activeEditor.execCommand('mceInsertContent', false, '<img src='+x.dataset.url+'/>');

window.close();
});
 
});

</script>