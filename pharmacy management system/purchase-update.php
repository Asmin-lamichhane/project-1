<?php
		include "config.php";
	
		if(isset($_GET['pid'])&&isset($_GET['sid'])&&isset($_GET['mid']))
		{
			$pid=$_GET['pid'];
			$sid=$_GET['sid'];
			$mid=$_GET['mid'];
			$qry1="SELECT * FROM purchase WHERE pid='$pid' and sid='$sid' and mid='$mid'";
			$result = $conn->query($qry1);
			$row = $result -> fetch_row();
		}
		
		 if( isset($_POST['update']))
		 {
			$pid=$_POST['pid'];
			$sid=$_POST['sid'];
			$mid=$_POST['mid'];
			$qty = $_POST['pqty'];
			$cost = $_POST['pcost'];
			$pdate = $_POST['pdate'];
			$mdate = $_POST['mdate'];
			$edate = $_POST['edate'];
			 
		$sql="UPDATE purchase SET pcost='$cost',pqty='$qty',pdate='$pdate',mdate='$mdate',edate='$edate' 
				where pid='$pid' and sid='$sid' and mid='$mid'";
		if ($conn->query($sql))
		header("location:purchase-view.php");

		 }
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<title>
Purchases
</title>
</head>

<body>

		<div class="sidenav">
		
	<?php 
			if( isset($_POST['update']))
		 {
			$pid=$_POST['pid'];
			$sid=$_POST['sid'];
			$mid=$_POST['mid'];
			$qty = $_POST['pqty'];
			$cost = $_POST['pcost'];
			$pdate = $_POST['pdate'];
			$mdate = $_POST['mdate'];
			$edate = $_POST['edate'];
			
			$sql="UPDATE purchase SET pcost='$cost',pqty='$qty',pdate='$pdate',mdate='$mdate',edate='$edate' 
				where pid='$pid' and sid='$sid' and mid='$mid'";
			if (!($conn->query($sql)))
				echo "<p style='font-size:8; color:red;'>Error! Unable to update.</p>";
		 }
	?>
		
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
	

	
	
	<div class="one">
		<div class="row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
				<h2> UPDATE PURCHASE DETAILS</h2>
					<p>
						<label for="pid">Purchase ID:</label><br>
						<input type="number" name="pid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="sid">Supplier ID:</label><br>
						<input type="number" name="sid" value="<?php echo $row[1]; ?>" readonly>
					</p>
					<p>
						<label for="mid">Medicine ID:</label><br>
						<input type="number" name="mid" value="<?php echo $row[2]; ?>" readonly>
					</p>
					<p>
						<label for="pqty">Purchase Quantity:</label><br>
						<input type="number" name="pqty" value="<?php echo $row[3]; ?>">
					</p>
				</div>
				
				<div class="column">
					<p>
						<label for="pcost">Purchase Cost:</label><br>
						<input type="number" step="0.01" name="pcost" value="<?php echo $row[4]; ?>">
					</p>
					
					
					<p>
						<label for="pdate">Date of Purchase:</label><br>
						<input type="date" name="pdate" value="<?php echo $row[5]; ?>">
					</p>
					<p>
						<label for="mdate">Manufacturing Date:</label><br>
						<input type="date" name="mdate" value="<?php echo $row[6]; ?>">
					</p>
					<p>
						<label for="edate">Expiry Date:</label><br>
						<input type="date" name="edate" value="<?php echo $row[7]; ?>">
					</p>
				</div>
				
			<input type="submit" name="update" value="Update">
			</form>	
		</div>
	</div>
	<script src="a.js"></script>
		</body>
</html>