<?php
	include "config.php";
	$sql="DELETE FROM meds where medid='$_GET[id]'";
	if ($conn->query($sql))
	header("location:inventory-view.php");
	else
	echo "error";
?>