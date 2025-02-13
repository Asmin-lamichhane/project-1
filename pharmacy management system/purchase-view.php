<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="table.css">
<title>
Purchases
</title>
</head>

<body>

<div class="sidenav">
			<h2 > PHARMACY </h2>
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
	<h2> STOCK PURCHASE LIST</h2>
	</div>
	</center>
	
	<table  id="table1" >
		<tr>
			<th>Purchase ID</th>
			<th>Supplier ID</th>
			<th>Medicine ID</th>
			<th>Medicine Name</th>
			<th>Quantity</th>
			<th>Cost of Purchase</th>
			<th>Date of Purchase</th>
			<th>Manufacturing Date</th>
			<th>Expiry Date</th>
			<th>Action</th>
		</tr>
		
	<?php
 	
	include "config.php";
	$sql = "SELECT pid,sid,mid,pqty,pcost,pdate,mdate,edate FROM purchase";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		
		$sql1="SELECT medname from meds where medid=".$row["mid"]."";
		$result1 = $conn->query($sql1);
		
		while($row1 = $result1->fetch_assoc()) {

			echo "<tr>";
				echo "<td>" . $row["pid"]. "</td>";
				echo "<td>" . $row["sid"]. "</td>";
				echo "<td>" . $row["mid"]. "</td>";
				echo "<td>" . $row1["medname"] . "</td>";
				echo "<td>" . $row["pqty"]. "</td>";
				echo "<td>" . $row["pcost"]. "</td>";
				echo "<td>" . $row["pdate"]. "</td>";
				echo "<td>" . $row["mdate"] . "</td>";
				echo "<td>" . $row["edate"]. "</td>";
				echo "<td align=center>";		 
				echo "<a class='button1 edit-btn' href='purchase-update.php?pid=".$row['pid']."&sid=".$row['sid']."&mid=".$row['mid']."' onclick='return confirmEdit()'>Edit</a>";
echo "<a class='button1 del-btn' href='purchase-delete.php?pid=".$row['pid']."&sid=".$row['sid']."&mid=".$row['mid']."' onclick='return confirmDelete()'>Delete</a>";

				echo "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
} 
	$conn->close();
	
	?>
	  <script src="a.js"></script>
</body>



</html>
