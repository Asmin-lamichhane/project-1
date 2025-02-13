<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<title>
Suppliers
</title>
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
	

	

	
	
	<div class="one row">
		
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
				<h2> ADD SUPPLIER DETAILS</h2>
					<p>
						<label for="sid">Supplier ID:</label><br>
						<input type="number" name="sid">
					</p>
					<p>
						<label for="sname">Supplier Company Name:</label><br>
						<input type="text" name="sname">
					</p>
					<p>
						<label for="sadd">Address:</label><br>
						<input type="text" name="sadd">
					</p>
					
					
				</div>
				<div class="column">
					<p>
						<label for="sphno">Phone Number:</label><br>
						<input type="number" name="sphno">
					</p>
					
					<p>
						<label for="smail">Email Address </label><br>
						<input type="text" name="smail">
					</p>
					
				</div>
				
			
			<input type="submit" name="add" value="Add Supplier">
			</form>
		<br>
		
		
		<?php
include "config.php";      

if(isset($_POST['add']))
{
    $id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $name = mysqli_real_escape_string($conn, $_REQUEST['sname']);
    $add = mysqli_real_escape_string($conn, $_REQUEST['sadd']);
    $phno = mysqli_real_escape_string($conn, $_REQUEST['sphno']);
    $mail = mysqli_real_escape_string($conn, $_REQUEST['smail']);

    // Validate phone number (only digits and length between 7 and 15)
    if (!preg_match('/^[0-9]{7,15}$/', $phno)) {
        echo "<p style='font-size:8; color:red;'>Invalid phone number. Please enter a valid number.</p>";
        exit;
    }

    // Validate email
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='font-size:8; color:red;'>Invalid email address. Please enter a valid email.</p>";
        exit;
    }

    // If validation passes, execute the SQL query
    $sql = "INSERT INTO suppliers (sid, sname, sadd, sphno, smail) VALUES ($id, '$name', '$add', $phno, '$mail')";
    if(mysqli_query($conn, $sql)){
        echo "<p style='font-size:8;'>Supplier details successfully added!</p>";
    } else{
        echo "<p style='font-size:8; color:red;'>Error! Check details.</p>";
    }
}

$conn->close();
?>

	
	</div>
	<script src="a.js"></script>		
</body>



</html>