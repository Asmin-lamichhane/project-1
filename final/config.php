<?php
		$conn = mysqli_connect("localhost", "root", "", "pharmacy_system");
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
?>