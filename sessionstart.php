<?php
	if (!isset($_SESSION['started'])) {
		session_start();
		$_SESSION['started'] = "true";
	}
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$type = $_SESSION['type'];
	}
?>
