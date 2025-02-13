<?php
include "config.php";

// Initialize variables to retain form data after validation failure
$id = $fname = $lname = $age = $sex = $phno = $mail = "";
$error_message = "";
$valid = true;

if (isset($_POST['add'])) {
    // Get user inputs
    $id = mysqli_real_escape_string($conn, $_REQUEST['cid']);
    $fname = mysqli_real_escape_string($conn, $_REQUEST['cfname']);
    $lname = mysqli_real_escape_string($conn, $_REQUEST['clname']);
    $age = mysqli_real_escape_string($conn, $_REQUEST['age']);
    $sex = mysqli_real_escape_string($conn, $_REQUEST['sex']);
    $phno = mysqli_real_escape_string($conn, $_REQUEST['phno']);
    $mail = mysqli_real_escape_string($conn, $_REQUEST['emid']);

    // Validate ID (numeric value)
    if (!is_numeric($id)) {
        $valid = false;
        $error_message = "Invalid ID.";
    }

    // Validate first name (only letters and spaces)
    if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $valid = false;
        $error_message = "Invalid first name.";
    }

    // Validate last name (only letters and spaces)
    if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
        $valid = false;
        $error_message = "Invalid last name.";
    }

    // Validate age (numeric, between 0 and 120)
    if (!is_numeric($age) || $age < 0 || $age > 120) {
        $valid = false;
        $error_message = "Invalid age.";
    }

    // Validate sex (must be one of the specified values)
    $valid_sexes = ['Male', 'Female', 'Other'];
    if (!in_array($sex, $valid_sexes)) {
        $valid = false;
        $error_message = "Invalid sex.";
    }

    // Validate phone number (numeric and length between 10-15 digits)
    if (!preg_match("/^\d{10,15}$/", $phno)) {
        $valid = false;
        $error_message = "Invalid phone number.";
    }

    // Validate email address
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error_message = "Invalid email address.";
    }

    // If validation fails, show error message but keep form data
    if (!$valid) {
        echo "<script type='text/javascript'>alert('$error_message');</script>";
    } else {
        // // Success message (validation passed)
        // echo "<script type='text/javascript'>alert('Form submitted successfully!');</script>";

        // Proceed with database insertion
        $sql = "INSERT INTO customer (cid, cfname, clname, age, sex, phno, emid) 
                VALUES ($id, '$fname', '$lname', $age, '$sex', $phno, '$mail')";

            if (mysqli_query($conn, $sql)) {
				echo "<script>
						alert('Customer successfully added!');
						window.location.href = '" . $_SERVER['PHP_SELF'] . "';
					  </script>";
				exit(); 
        } else {
            echo "<script>alert('Error! Check details.');</script>";    
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="1.css">
    <link rel="stylesheet" type="text/css" href="form.css">
    <link rel="stylesheet" type="text/css" href="ham.css">
    <title>Customers</title>
</head>

<body>
<div class="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

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
	
    

    <br><br><br><br><br><br><br><br>

    <div class="one">
        <div class="row">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="column">
                    <h2> ADD CUSTOMER DETAILS</h2>
                    <p>
                        <label for="cid">Customer ID:</label><br>
                        <input type="number" name="cid" value="<?= $id ?>">
                    </p>
                    <p>
                        <label for="cfname">First Name:</label><br>
                        <input type="text" name="cfname" value="<?= $fname ?>">
                    </p>
                    <p>
                        <label for="clname">Last Name:</label><br>
                        <input type="text" name="clname" value="<?= $lname ?>">
                    </p>
                    <p>
                        <label for="age">Age:</label><br>
                        <input type="number" name="age" value="<?= $age ?>">
                    </p>

                    <p>
                        <label for="sex">Sex: </label><br>
                        <select id="sex" name="sex">
                            <option value="selected" <?= ($sex == 'selected') ? 'selected' : '' ?>>Select</option>
                            <option <?= ($sex == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option <?= ($sex == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option <?= ($sex == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </p>

                </div>
                <div class="column">

                    <p>
                        <label for="phno">Phone Number: </label><br>
                        <input type="number" name="phno" value="<?= $phno ?>">
                    </p>
                    <p>
                        <label for="emid">Email ID:</label><br>
                        <input type="text" name="emid" value="<?= $mail ?>">
                    </p>

                </div>

                <input type="submit" name="add" value="Add Customer">
            </form>
        <br>
        </div>
    </div>
    <script src="a.js"></script>	
    <script src="ham.js"></script>	

</body>

</html>
