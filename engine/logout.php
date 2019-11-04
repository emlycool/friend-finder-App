<?php
session_start();
include_once("database.php");

$login_time = time();
				$sql = "SELECT COUNT(*) FROM user_time WHERE user_id = {$_SESSION['user_id']}";
				$result = mysqli_query($mycon, $sql);
				$table = mysqli_fetch_array($result)[0];
				if ($table == 1) {
					$sql2 = "UPDATE user_time SET login_time = '$login_time' WHERE user_id = {$_SESSION['user_id']}";
							$result2 = mysqli_query($mycon, $sql2);
							if ($result2) {
								}	
							else{
								die(mysqli_error($mycon));
							}		
				}
				else{
					$sql2 = "INSERT INTO user_time() VALUES(NULL, '$login_time', '', '{$_SESSION['user_id']}')";
							$result2 = mysqli_query($mycon, $sql2);
							if ($result2) {
							}
							else{
								die(mysqli_error($mycon));
							}
				}
session_destroy();
 header("location:../index.php");
      exit;







?>