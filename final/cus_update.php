<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
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
                window.location.href = 'cus_view.php';
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
                window.location.href = 'cus_view.php';
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
                window.location.href = 'cus_view.php';
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