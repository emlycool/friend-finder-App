<?php
session_start();
include_once("database.php");
include_once("../processes/functions.php");
if (isset($_POST['old_password'])) {
		$old_password = protect_value($_POST['old_password']);
		$new_password = protect_value($_POST['new_password']);
		$confirm_password = protect_value($_POST['confirm_password']);
		if ($new_password != $confirm_password) {
			echo "password does not match";
			die();
		}
		if (strlen($new_password) < 7) {
			echo "password does not meet the requirements";
			die();
		}
		$query_admincheck ="SELECT * FROM users WHERE id = {$_SESSION['user_id']} ";
			$qexe= mysqli_query($mycon, $query_admincheck);
			if(mysqli_num_rows($qexe) == 1){

		     
		        $response = mysqli_fetch_array($qexe);
		        if(password_verify($old_password, $response['password'])){
		        	if ($old_password == $new_password) {
							echo "cant use old password";
							die();
					}
		        	$encrpt_password = password_hash("$new_password", PASSWORD_DEFAULT);
					$update_password = "UPDATE users
										SET password = '$encrpt_password' WHERE id = {$_SESSION['user_id']}";
					$passwordexe = mysqli_query($mycon, $update_password);
					if ($passwordexe) {
						echo "password";
					}else{
						die(mysqli_error($mycon));
					}
				}else{
					echo "wrong password";
				}
			}
	}
?>