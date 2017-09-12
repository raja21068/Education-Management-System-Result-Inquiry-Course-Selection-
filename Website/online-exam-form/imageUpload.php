<?php


 $filename=$_FILES['my_files']['name'];
 $filetype=$_FILES['my_files']['type'];
 $filename = strtolower($filename);
 $filetype = strtolower($filetype);

 //check if contain php and kill it 
 $pos = strpos($filename,'php');
 if(!($pos === false)) {
  die('error');
 }




 //get the file ext

 $file_ext = strrchr($filename, '.');


 //check if its allowed or not
 $whitelist = array(".jpg",".jpeg",".gif",".png"); 
 if (!(in_array($file_ext, $whitelist))) {
    die('not allowed extension,please upload images only');
 }


 //check upload type
 $pos = strpos($filetype,'image');
 if($pos === false) {
  die('error 1');
 }
 $imageinfo = getimagesize($_FILES['my_files']['tmp_name']);
 if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg'&& $imageinfo['mime']      != 'image/jpg'&& $imageinfo['mime'] != 'image/png') {
   die('error 2');
 }

 // upload to upload direcory 
 $uploaddir = 'upload/';

if (file_exists($uploaddir)) {  
} else {  
    mkdir( $uploaddir, 0777);  
}  
  //change the image name
  
  
  ?>