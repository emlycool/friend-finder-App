<?php
	session_start();
	include_once("database.php");
	include_once("../processes/functions.php");
	//social media login
	if (isset($_POST['email'])){
		$email = protect_value($_POST['email']);
		$password = protect_value($_POST['password']);
	 	$query_usernamecheck =" SELECT * FROM users WHERE email = '$email' ";
		$qexe= mysqli_query($mycon, $query_usernamecheck);
		if(mysqli_num_rows($qexe) == 1){
			$response = mysqli_fetch_array($qexe);
			if(password_verify($password, $response['password'])){
				$_SESSION['user_id'] = $response['id'];
				

				header("location:../pages/newsfeed.php?l_message=Login Successful");
				exit;
			}
			else{
			
			
				header("location:../index.php?l_message=Email exists but wrong password");
				exit;
							
			}
		}	
		else{
		
			header("location:../index.php?l_message=login failed#login");
			exit;
		}

	}
	if (isset($_POST['admin_login'])){
		$email = protect_value($_POST['admin_email']);
		$password =protect_value($_POST['admin_password']);
	 	$query_emailcheck =" SELECT * FROM admin WHERE email = '$email' ";
		$qexe= mysqli_query($mycon, $query_emailcheck);
		if(mysqli_num_rows($qexe) == 1){
			$response = mysqli_fetch_array($qexe);
			if(password_verify($password, $response['password'])){
				$_SESSION['admin_id'] = $response['id'];
				header("location:../admin/index.php");
				exit;
			}
			else{
			
			
				header("location:../admin/login.php?l_message=Email exists but wrong password");
				exit;
							
			}
		}	
		else{
		
			header("location:../index.php?l_message=login failed#login");
			exit;
		}

	}
	// login to blog (same account)
	if(isset($_POST['login_button'])) {
		$user_email = protect_value($_POST['b_email']);
		$user_password = protect_value($_POST['b_password']);
		
		$sql = "SELECT * FROM users WHERE email='$user_email'";
		$resultset = mysqli_query($mycon, $sql) or die("database error:". mysqli_error($conn));
		$row = mysqli_fetch_array($resultset);		
		if(password_verify($user_password, $row['password'])){				
			echo "ok";
			$_SESSION['user_id'] = $row['id'];
		} else {				
			echo "email or password does not exist."; // wrong details 
		}		
	}



?>