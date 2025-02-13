<?php
	include "config.php";
	$sql="DELETE FROM suppliers where sid='$_GET[id]'";
	if ($conn->query($sql))
	header("location:supplier-view.php");
	else
	echo "error";
?>