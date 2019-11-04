<?php
session_start();
include_once("engine/const.php");
include_once("processes/functions.php");
require_once('engine/ImageManipulator.php');

// file name
	if (isset($_FILES['file'])) {
     if(!empty(array_filter($_FILES['file']['name']))){
        $newNamePrefix = time() . '_';
        $count=0;
        $location = "";
        foreach($_FILES['file']['name'] as $key=>$val){
        	$tmp = $_FILES['file']['tmp_name'][$count]; 
		$filename = $newNamePrefix . basename($_FILES['file']['name'][$key]); // Get the name of the file (including file extension).
		$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
		//$fileName = $newNamePrefix . $_FILES['file']['name'];
		
		//check for extension.
			if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif" or $ext == ".mp4"){
              	
					
                //$picture = $db->mysql_prep($filePath);
				//if file was moved succesfully
				move_uploaded_file($tmp, 'images/upload/'.$val );
                $location .= "images/upload/".$val."||";

				//$sql_query01 = "INSERT INTO pictures()Values(Null,{$post_id},'{$picture}')";
                //$inserter = $db->query($sql_query01);

		   }

		    $count=$count + 1;
        }
       $locationprt = protect_value($location);
      
         
       $text = $_POST['pic_caption'];
       $currentuser = $_SESSION['user_id'];
       $querypic = "INSERT INTO social_posts() VALUES(NULL, $currentuser, '$locationprt', '$text', NOW() )";
       $picexe = mysqli_query($mycon, $querypic);
       if ($picexe) {
       	echo "done";
       }else{
       	$error = die(mysqli_error($mycon));
       	echo $error;
       }
		
			//$user_id_log = $_SESSION['otamidiuser_id'];
			//$user_g = User::find_by_id("users",$user_id_log);
			//$activity = $user_g->firstname . " ".$user_g->lastname . " added a  product titled " . $title."<br> Content: ".$content;
		

	//echo "Posted";
	//echo $response;

	}
}
?>