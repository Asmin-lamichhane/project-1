<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>
Customers
</title>
</head>

<body>
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="employeedashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
            
			<button class="dropdown-btn"><i class="fa-solid fa-capsules"></i> Medicines
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
            <a href="med_add.php"><i class="fa-solid fa-plus"></i> Add New Medicine</a>
            <a href="med_view.php"><i class="fa-solid fa-key"></i> Manage Inventory</a>

			</div>
			<button class="dropdown-btn"> <i class="fa-solid fa-truck"></i> Suppliers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
            <a href="sup_add.php"><i class="fa-solid fa-plus"></i> Add New Supplier</a>
            <a href="sup_view.php"><i class="fa-solid fa-key"></i> Manage Suppliers</a>

			</div>
			<button class="dropdown-btn"><i class="fa-solid fa-user-minus"></i> Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="cus_add.php"><i class="fa-solid fa-plus"></i> Add New Customer</a>
            <a href="cus_view.php"><i class="fa-solid fa-key"></i> Manage Customers</a>
			</div>
			
			<button class="dropdown-btn"><i class="fa-solid fa-cart-shopping"></i> Sale 
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="pharm-pos1.php"><i class="fa-solid fa-handshake"></i> new sale</a>
				<a href="sale_view.php"><i class="fa-solid fa-magnifying-glass"></i> view sale</a>
			</div>
            <button class="dropdown-btn"><i class="fa-solid fa-user"></i>Yours profile
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="eview.php"><i class="fa-solid fa-user"></i>view profile</a>
                
			</div>
			<div class="logout-container">
            <a href="logout1.php" class="logout" onclick="return confirmLogout();" ><i class="fa-solid fa-right-to-bracket"></i> Logout</a>

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
			echo "<a class='button1 edit-btn' href='cus_update.php?id=".$row['cid']."' onclick='return confirm(\"Are you sure you want to edit this customer?\");'>Edit</a>";
			echo "<a class='button1 del-btn' href='cus_del.php?id=".$row['cid']."' onclick='return confirm(\"Are you sure you want to delete this customer? .\");'>Delete</a>";
			
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
