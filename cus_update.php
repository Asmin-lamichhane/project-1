<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<title>
Customers
</title>
</head>

<body>

		<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACIA </h2>
			<a href="adminmainpage.php">Dashboard</a>
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
			<a href="sales-view.php">View Sales Invoice Details</a>
			<a href="salesitems-view.php">View Sold Products Details</a>
			<a href="pos1.php">Add New Sale</a>		
			<button class="dropdown-btn">Reports
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="stockreport.php">Medicines - Low Stock</a>
				<a href="expiryreport.php">Medicines - Soon to Expire</a>
				<a href="salesreport.php">Transactions Reports</a>				
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
		
        <?php
include "config.php";

// Check if `id` is set in the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate ID (numeric)
    if (!is_numeric($id)) {
        echo "<script>
                alert('Invalid Customer ID.');
                window.location.href = 'customer-view.php';
              </script>";
        exit();
    }

    // Fetch customer details
    $qry1 = "SELECT * FROM customer WHERE cid='$id'";
    $result = $conn->query($qry1);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
    } else {
        echo "<script>
                alert('Customer not found.');
                window.location.href = 'customer-view.php';
              </script>";
        exit();
    }
}

// Check if the form is submitted
if (isset($_POST['update'])) {
    // Retrieve form data
    $id = $_POST['cid'];
    $fname = $_POST['cfname'];
    $lname = $_POST['clname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $phno = $_POST['phno'];
    $mail = $_POST['emid'];

    // Initialize validation flag and error message
    $valid = true;
    $error_message = "";

    // Validate ID
    if (empty($id) || !is_numeric($id)) {
        $valid = false;
        $error_message .= "Customer ID is required and must be numeric.\\n";
    }

    // Validate first name
    if (empty($fname) || !preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $valid = false;
        $error_message .= "First name is required and must contain only letters and spaces.\\n";
    }

    // Validate last name
    if (empty($lname) || !preg_match("/^[a-zA-Z ]*$/", $lname)) {
        $valid = false;
        $error_message .= "Last name is required and must contain only letters and spaces.\\n";
    }

    // Validate age
    if (empty($age) || !is_numeric($age) || $age < 1 || $age > 120) {
        $valid = false;
        $error_message .= "Age is required and must be a number between 1 and 120.\\n";
    }

    // Validate sex
    $valid_sexes = ['Male', 'Female', 'Other'];
    if (empty($sex) || !in_array($sex, $valid_sexes)) {
        $valid = false;
        $error_message .= "Sex is required and must be Male, Female, or Other.\\n";
    }

    // Validate phone number
    if (empty($phno) || !preg_match("/^\\d{10,15}$/", $phno)) {
        $valid = false;
        $error_message .= "Phone number is required and must be between 10 and 15 digits.\\n";
    }

    // Validate email
    if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error_message .= "A valid email address is required.\\n";
    }

    // If validation fails, show an alert and exit
    if (!$valid) {
        echo "<script>
                alert('Validation Errors:\\n$error_message');
                window.history.back();
              </script>";
        exit();
    }

    // If validation passes, proceed with the update
    $sql = "UPDATE customer 
            SET cfname='$fname', clname='$lname', age='$age', sex='$sex', phno='$phno', emid='$mail' 
            WHERE cid='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Customer details successfully updated!');
                window.location.href = 'customer-view.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating customer details. Please try again.');
                window.history.back();
              </script>";
    }
}

$conn->close();
?>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
                <h2> UPDATE CUSTOMER DETAILS</h2>
					<p>
						<label for="cid">Customer ID:</label><br>
						<input type="number" name="cid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="cfname">First Name:</label><br>
						<input type="text" name="cfname" value="<?php echo $row[1]; ?>">
					</p>
					<p>
						<label for="clname">Last Name:</label><br>
						<input type="text" name="clname" value="<?php echo $row[2]; ?>">
					</p>
					<p>
						<label for="age">Age:</label><br>
						<input type="number" name="age" value="<?php echo $row[3]; ?>">
					</p>
					
					<p>
						<label for="sex">Sex: </label><br>
						<input type="text" name="sex" value="<?php echo $row[4]; ?>">
					</p>
					
				</div>
				<div class="column">
					
					<p>
						<label for="phno">Phone Number: </label><br>
						<input type="number" name="phno" value="<?php echo $row[5]; ?>">
					</p>
					<p>
						<label for="emid">Email ID:</label><br>
						<input type="text" name="emid" value="<?php echo $row[6]; ?>">
					</p>
				</div>
			
			<input type="submit" name="update" value="Update">
			
			</form>
		</div>
	</div>
	
</body>	


	
</html>