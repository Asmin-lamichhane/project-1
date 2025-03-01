<?php
	include "config.php";
	$sql="DELETE FROM suppliers where sid='$_GET[id]'";
	if ($conn->query($sql))
	header("location:sup_view.php");
	else
	echo "error";
?>