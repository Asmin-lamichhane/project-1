<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>
Employees
</title>
</head>

<body>
  
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="Admin.php"><i class="fa-solid fa-house"></i> Dashboard</a>
			<button class="dropdown-btn"><i class="fa-solid fa-person"></i> Employees <i class="down"></i></button>
        <div class="dropdown-container">
            <a href="emp_add.php"><i class="fa-solid fa-plus"></i> Add New Employee</a>
            <a href="emp_view.php"><i class="fa-solid fa-key"></i> Manage Employees</a>
        </div>

			<button class="dropdown-btn"><i class="fa-solid fa-user"></i>Sale Record
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="sale_view.php"><i class="fa-solid fa-cart-shopping"></i>view sales</a>
			
			</div>
				
				<div class="logout-container">
                 <a href="logout.php" class="logout" onclick="return confirmLogout();">Logout</a>

            <script>
                 function confirmLogout() {
                 return confirm("Are you sure you want to logout?");
                    }
            </script>
   	        </div>
			</div>
	

	
	
	<center>
	<div class="head">
	<h2> EMPLOYEE LIST</h2>
	</div>
	</center>
	
	<table  id="table1" >
		<tr>
			
			<th>Employee ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Date of Birth</th>
			<th>Age</th>
			<th>Sex</th>
			<th>Employee Type</th>
			<th>Date of Joining</th>
			<th>Salary</th>
			<th>Phone Number</th>
			<th>Email Address</th>
			<th>Home Address</th>
			<th>username</th>
			
			<th>Action</th>
		</tr>
		
	<?php

	
	include "config.php";
	$sql = "SELECT eid, efname, elname, ebdate, eage, esex, etype, ejdate, esal, ephno, e_mail, eadd, username, password_hash FROM employee where eid<>1";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {

	echo "<tr>";
		echo "<td>" . $row["eid"]. "</td>";
		echo "<td>" . $row["efname"] . "</td>";
		echo "<td>" . $row["elname"] . "</td>";
		echo "<td>" . $row["ebdate"] . "</td>";
		echo "<td>" . $row["eage"]. "</td>";
		echo "<td>" . $row["esex"]. "</td>";
		echo "<td>" . $row["etype"]. "</td>";
		echo "<td>" . $row["ejdate"]. "</td>";
		echo "<td>" . $row["esal"]. "</td>";
		echo "<td>" . $row["ephno"]. "</td>";
		echo "<td>" . $row["e_mail"]. "</td>";
		echo "<td>" . $row["eadd"]. "</td>";
		echo "<td>" . $row["username"]. "</td>";
	
		echo "<td align=center>";
		echo "<a class='button1 edit-btn' href='emp_update.php?id=".$row['eid']."' onclick=\"return confirm('Are you sure you want to edit?');\">Edit</a>";

echo "<a onclick=\"return confirm('Are you sure to delete?');\" class='button1 del-btn' href='emp_delete.php?id=".$row['eid']."'>Delete</a>";

		echo "</td>";
	echo "</tr>";
	}
	echo "</table>";
} 

	$conn->close();
	
	?>
	  <script src="a.js"></script>
</body>


</html>

