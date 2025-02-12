<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="1.css">
<title>
Customers
</title>
</head>

<body>

<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="admin.php">Dashboard</a>
			<button class="dropdown-btn">Inventory
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="inventory-add.php">Add New Medicine</a>
				<a href="inventory-view.php">Manage Inventory</a>
			</div>
			<button class="dropdown-btn">Suppliers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="supplier-add.php">Add New Supplier</a>
				<a href="supplier-view.php">Manage Suppliers</a>
			</div>
			<button class="dropdown-btn">Stock Purchase
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="purchase-add.php">Add New Purchase</a>
				<a href="purchase-view.php">Manage Purchases</a>
			</div>		
			<button class="dropdown-btn">Employees
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="employee-add.php">Add New Employee</a>
				<a href="employee-view.php">Manage Employees</a>
			</div>			
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="customer-add.php">Add New Customer</a>
				<a href="customer-view.php">Manage Customers</a>
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
	<h2>  CUSTOMER LIST</h2>
	</div>
	</center>

	
	<table id="table1" ">
		
		<tr>
			<th>Customer ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Age</th>
			<th>Sex</th>
			<th>Phone Number</th>
			<th>Email Address</th>
			<th>Action</th>
		
		</tr>
	<?php
		
	include "config.php";
	$sql = "SELECT cid,cfname,clname,age,sex,phno,emid FROM customer";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	
		while($row = $result->fetch_assoc()) {

		echo "<tr>";
			echo "<td>" . $row["cid"]. "</td>";
			echo "<td>" . $row["cfname"] . "</td>";
			echo "<td>" . $row["clname"]. "</td>";
			echo "<td>" . $row["age"]. "</td>";
			echo "<td>" . $row["sex"] . "</td>";
			echo "<td>" . $row["phno"]. "</td>";
			echo "<td>" . $row["emid"]. "</td>";
			echo "<td align=center>";
			echo "<a class='button1 edit-btn' href='customer-update.php?id=".$row['cid']."' onclick='return confirm(\"Are you sure you want to edit this customer?\");'>Edit</a>";
			echo "<a class='button1 del-btn' href='customer-delete.php?id=".$row['cid']."' onclick='return confirm(\"Are you sure you want to delete this customer? .\");'>Delete</a>";
			
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
