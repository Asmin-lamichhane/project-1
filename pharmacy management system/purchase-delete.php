<?php
	include "config.php";
	$pid=$_GET['pid'];
	$sid=$_GET['sid'];
	$mid=$_GET['mid'];
				
	$sql="DELETE FROM purchase where pid='$pid' and sid='$sid' and mid='$mid'";

	if ($conn->query($sql))
	header("location:purchase-view.php");
	else
	echo "error";
?>