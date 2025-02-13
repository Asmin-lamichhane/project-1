<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="table.css"> -->
<title>Medicines</title>
</head>

<body>

<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="admin.php">Dashboard</a>
			<button class="dropdown-btn">Medicines
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="med_add.php">Add New Medicine</a>
				<a href="med_view.php">Manage Inventory</a>
			</div>
			<button class="dropdown-btn">Suppliers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="sup_add.php">Add New Supplier</a>
				<a href="sup_view.php">Manage Suppliers</a>
			</div>
			<!-- <button class="dropdown-btn">Stock Purchase
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="purchase-add.php">Add New Purchase</a>
				<a href="purchase-view.php">Manage Purchases</a>
			</div>		 -->
			<button class="dropdown-btn">Employees
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="emp_add.php">Add New Employee</a>
				<a href="emp_view.php">Manage Employees</a>
			</div>			
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="cus_add.php">Add New Customer</a>
				<a href="cus_view.php">Manage Customers</a>
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
	<h2> MEDICINE INVENTORY </h2>
	</div>
	</center>
	
	<table id="table1" ">
		<tr>
			<th>Medicine ID</th>
			<th>Medicine Name</th>
			<th>Quantity Available</th>
			<th>Category</th>
			<th>Price</th>
			<th>Location in Store</th>
			<th>Action</th>
		</tr>
	
	<?php
	include "config.php";
	
	$sql = "SELECT medid, medname, qty,cat, sp, loc FROM meds";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {

		echo "<tr>";
			echo "<td>" . $row["medid"]. "</td>";
			echo "<td>" . $row["medname"] . "</td>";
			echo "<td>" . $row["qty"]. "</td>";
			echo "<td>" . $row["cat"]. "</td>";
			echo "<td>" . $row["sp"] . "</td>";
			echo "<td>" . $row["loc"]. "</td>";
			echo "<td align=center>";
						 
			echo "<a class='button1 edit-btn' href='med_update.php?id=".$row['medid']."' onclick='return confirm(\"Are you sure you want to edit this item?\");'>Edit</a>";

			
				echo "<a class='button1 del-btn' href='med_delete.php?id=" . $row['medid'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>";
				
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
