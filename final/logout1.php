<?php
	include "config.php";
	session_start();
	unset($_SESSION["user"]);
	if(session_destroy()) {
	header("Location:login1.php");
	}
?>