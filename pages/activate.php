<?php
session_start();
require_once('../classControllers/init.php');
	$email = $_GET['email'];
	$token = $_GET['token'];
	$sql = "SELECT * FROM users WHERE email = '$email' AND token = '$token'";
    $result = $conn->query($sql);
    
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if ($user) {
    	if ($user['status'] == 1) { 
    		echo "Account is already verified";   	
	    	exit();
	    }
	    else{
	    	if ($user['token'] = $token) {
	    		$sql2 = "UPDATE `users` SET status = 1 WHERE user_id = {$user['user_id']}";
				$result2 = $conn->query($sql2);
				if ($result2) {
					$_SESSION['success'] = "Account verified, proceed to login";
					echo "verified";
					header("location: login.php");
				}
				
				die;
	    	}
	    	else{
	    		echo "Link is expired";
	    	}
	    }

    }
    else{
    	echo "Account not found";
	    exit();
    }

?>
