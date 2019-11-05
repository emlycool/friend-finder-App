<?php
	require_once '../classControllers/init.php';
	if (isset($_GET['token'])&& isset($_GET['email'])) {
		User::activate($_GET['email'], $_GET['token']);
	}
?>