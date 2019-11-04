<?php
	session_start();
	include_once("../engine/database.php");
	$post_id = $_POST['like_id'];
		$currentuser = $_SESSION['user_id'];

		$query_usercheck =" SELECT * FROM blog_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
		$qini=mysqli_query($mycon, $query_usercheck);
		if (mysqli_num_rows($qini) > 0) {

			$query_delete =" DELETE FROM blog_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
			$qinidel=mysqli_query($mycon, $query_delete);
			//echo "request_canceled";
	
		}else{

		$query_insert=" INSERT INTO blog_post_likes() VALUES(NULL,$post_id,$currentuser)";
				$result_insert= mysqli_query($mycon, $query_insert);
				if ($result_insert) {
					//echo "request_sent";
				}else{
					//echo "error_occured";
				}

	   }
	   
?>