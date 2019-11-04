<?php

function activeU($newtime,$mycon){
	$sql = "SELECT COUNT(*) FROM user_time WHERE user_id = {$_SESSION['user_id']}";
	$result = mysqli_query($mycon, $sql);
	$table = mysqli_fetch_array($result)[0];
	if ($table == 1) {
		$sql2 = "UPDATE user_time SET last_active = '$newtime' WHERE user_id = {$_SESSION['user_id']}";
				$result2 = mysqli_query($mycon, $sql2);	
					
	}
	else{
		$sql2 = "INSERT INTO user_time() VALUES(NULL, '', '$newtime', '{$_SESSION['user_id']}')";
				$result2 = mysqli_query($mycon, $sql2);
				
	}
}
?>