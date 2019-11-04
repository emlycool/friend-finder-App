<?php 
session_start();
include_once("database.php");
include_once("../processes/functions.php");
if(isset($_POST['firstname']) && !empty($_POST['firstname']) AND isset($_POST['email']) && !empty($_POST['email'])){
        // Form Submited
	$firstname = protect_value(ucfirst($_POST['firstname']));
	$lastname = protect_value(ucfirst($_POST['lastname']));
	$email = protect_value($_POST['email']);
	$gender = $_POST['optradio'];
	$city = protect_value($_POST['city']);
	$country  = $_POST['country'];
	$DOB = $_POST['dob_day']."/". $_POST['dob_month'].'/'. $_POST['dob_year'];
	$password = $_POST['password'];
	$error_message = "";
	$verify = "no";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  	if(!preg_match($email_exp,$email)) {
    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    	header("location:../index.php?message=$error_message");
				exit;
  	}
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  	if(!preg_match($string_exp,$firstname)) {
    	$error_message .= 'The First Name you entered does not appear to be valid.<br />';
     	header("location:../index.php?message=$error_message");
				exit;
  	}
  	if(!preg_match($string_exp,$lastname)) {
    	$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    	header("location:../index.php?message=$error_message");
				exit;
  	}
  	if(strlen($password) < 7){
  		$error_message .= 'Password does not meet the requirement.<br />';
    	header("location:../index.php?message=$error_message");
				exit;
  	}
  	$query_usercheck ="SELECT * FROM users WHERE email = '$email' LIMIT 1";
  		$qini = $mycon->query($query_usercheck);
		if (mysqli_num_rows($qini) > 0) {
			header("location:../index.php?message=email already exist | Try another");
				exit;
		}else{
			echo $verify;
			if (isset($_POST['password'])) {
				$token = md5(rand(0,1000) );
				$encrpt_password = password_hash("$password", PASSWORD_DEFAULT);
				$user_sql = "INSERT INTO users()
				 VALUES(NULL, '$firstname', '$lastname', NULL, '$email', '$encrpt_password', 'images/default.jpg', '$gender', '$city', '$country', '$DOB', '$token',  '$verify', NOW() )";
				 $cusexe = $mycon->query($user_sql);
				if($cusexe){
				 	// mail to verify link to user
				 header("location:send_form_email.php?email=$email&message=");
				exit;
				}
				else{
				 
				die(mysqli_error($mycon));
				}
			}

		}

$test = " john ";
$test1 = trim($test);
echo $test1;



}

    /*
	

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];

		$query_usercheck =" SELECT * FROM users WHERE email = '$email' ";
		$qini=mysqli_query($mycon, $query_usercheck);
		if (mysqli_num_rows($qini) > 0) {
			header("location:../index.php?message=email already exist | Try another");
				exit;
	
		}

		$query_insert=" INSERT INTO users() VALUES(NULL,'$firstname','$lastname','$email','$password',' ', ' ', NOW() )";
				$result_insert= mysqli_query($mycon, $query_insert);
				if ($result_insert) {
					header("location:../edit-profile-basic.php?message=Account Created");
					exit;
				}else{
					die(mysqli_error($mycon));
				}


}else{

	echo "yaga";
}
*/
?>