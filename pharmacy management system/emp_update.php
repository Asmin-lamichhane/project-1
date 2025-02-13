<?php
		include "config.php";
		
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$qry1="SELECT * FROM employee WHERE eid='$id'";
			$result = $conn->query($qry1);
			$row = $result -> fetch_row();
		}

		 ?>
		 
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<title>
Employees
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
	
	
	

	<div class="one">
		<div class="row">
			
		<?php
if (isset($_POST['update'])) {
    include "config.php";

    // Sanitize and validate inputs
    $id = mysqli_real_escape_string($conn, $_POST['eid']);
    $fname = mysqli_real_escape_string($conn, $_POST['efname']);
    $lname = mysqli_real_escape_string($conn, $_POST['elname']);
    $bdate = mysqli_real_escape_string($conn, $_POST['ebdate']);
    $age = mysqli_real_escape_string($conn, $_POST['eage']);
    $sex = mysqli_real_escape_string($conn, $_POST['esex']);
    $etype = mysqli_real_escape_string($conn, $_POST['etype']);
    $jdate = mysqli_real_escape_string($conn, $_POST['ejdate']);
    $sal = mysqli_real_escape_string($conn, $_POST['esal']);
    $phno = mysqli_real_escape_string($conn, $_POST['ephno']);
    $mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $add = mysqli_real_escape_string($conn, $_POST['eadd']);

    // Initialize validation flag and error messages
    $valid = true;
    $error_message = "";

    // Validate ID (numeric)
    if (empty($id) || !is_numeric($id)) {
        $valid = false;
        $error_message .= "Employee ID is required and must be numeric.\\n";
    }

    // Validate first name (only letters and spaces)
    if (empty($fname) || !preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $valid = false;
        $error_message .= "First name is required and must contain only letters and spaces.\\n";
    }

    // Validate last name (only letters and spaces)
    if (empty($lname) || !preg_match("/^[a-zA-Z ]*$/", $lname)) {
        $valid = false;
        $error_message .= "Last name is required and must contain only letters and spaces.\\n";
    }

    // Validate birthdate (valid date format)
    if (empty($bdate) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $bdate)) {
        $valid = false;
        $error_message .= "Birthdate is required and must be in YYYY-MM-DD format.\\n";
    }

    // Validate age (numeric, reasonable range)
    if (empty($age) || !is_numeric($age) || $age < 18 || $age > 65) {
        $valid = false;
        $error_message .= "Age is required and must be a number between 18 and 65.\\n";
    }

    // Validate sex (Male, Female, Other)
    $valid_sexes = ['Male', 'Female', 'Other'];
    if (empty($sex) || !in_array($sex, $valid_sexes)) {
        $valid = false;
        $error_message .= "Sex is required and must be Male, Female, or Other.\\n";
    }

    // Validate employment type
    if (empty($etype)) {
        $valid = false;
        $error_message .= "Employment type is required.\\n";
    }

    // Validate joining date (valid date format)
    if (empty($jdate) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $jdate)) {
        $valid = false;
        $error_message .= "Joining date is required and must be in YYYY-MM-DD format.\\n";
    }

    // Validate salary (numeric)
    if (empty($sal) || !is_numeric($sal)) {
        $valid = false;
        $error_message .= "Salary is required and must be numeric.\\n";
    }

    // Validate phone number (10-15 digits)
    if (empty($phno) || !preg_match("/^\d{10,15}$/", $phno)) {
        $valid = false;
        $error_message .= "Phone number is required and must be between 10 and 15 digits.\\n";
    }

    // Validate email address
    if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error_message .= "A valid email address is required.\\n";
    }

    // Validate address (non-empty)
    if (empty($add)) {
        $valid = false;
        $error_message .= "Address is required.\\n";
    }

    // Check validation flag
    if (!$valid) {
        // Display error message in an alert box
        echo "<script>
                alert('Validation Errors:\\n$error_message');
                window.history.back();
              </script>";
        exit();
    }

    // Proceed with SQL update if validation passes
    $sql = "UPDATE employee 
            SET efname='$fname', elname='$lname', ebdate='$bdate', eage=$age, esex='$sex', 
                etype='$etype', ejdate='$jdate', esal=$sal, ephno='$phno', e_mail='$mail', eadd='$add' 
            WHERE eid='$id'";

    if ($conn->query($sql)) {
        echo "<script>
                alert('Employee details successfully updated!');
                window.location.href = 'employee-view.php';
              </script>";
    } else {
        echo "<script>
                alert('Error! Unable to update. Please try again.');
                window.history.back();
              </script>";
    }

    $conn->close();
}
?>

		 
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
				<h2> UPDATE EMPLOYEE DETAILS</h2>
					<p>
						<label for="eid">Employee ID:</label><br>
						<input type="number" name="eid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="efname">First Name:</label><br>
						<input type="text" name="efname" value="<?php echo $row[1]; ?>">
					</p>
					<p>
						<label for="elname">Last Name:</label><br>
						<input type="text" name="elname" value="<?php echo $row[2]; ?>">
					</p>
					
					<p>
   					 <label for="ebdate">Date of Birth:</label><br>
 					   <input type="date" id="ebdate" name="ebdate" value="<?php echo isset($_POST['ebdate']) ? $_POST['ebdate'] : ''; ?>" onchange="calculateAge()">
					</p>

					<p>
   					 <label for="eage">Age:</label><br>
   					 <input type="number" name="eage" id="eage" value="<?php echo isset($row[4]) ? $row[4] : ''; ?>" readonly>
					</p>

					<p>
						<label for="esex">Sex:</label><br>
						<input type="text" name="esex" value="<?php echo $row[5]; ?>">
					</p>
				</div>
				<div class="column">
					<p>
						<label for="etype">Employee Type:</label><br>
						<input type="text" name="etype"  value="<?php echo $row[6]; ?>">
					</p>
					<p>
						<label for="ejdate">Date of Joining:</label><br>
						<input type="date" name="ejdate" value="<?php echo $row[7]; ?>">
					</p>
					<p>
						<label for="esal">Salary:</label><br>
						<input type="number" step="0.01" name="esal" value="<?php echo $row[8]; ?>">
					</p>
					<p>
						<label for="ephno">Phone Number:</label><br>
						<input type="number" name="ephno" value="<?php echo $row[9]; ?>">
					</p>
					
					<p>
						<label for="e_mail">Email ID:</label><br>
						<input type="text" name="e_mail"  value="<?php echo $row[10]; ?>">
					</p>
					<p>
						<label for="eadd">Address:</label><br>
						<input type="text" name="eadd"  value="<?php echo $row[11]; ?>">
					</p>
					
				</div>
				
			
			<input type="submit" name="update" value="Update">
			</form>
		</div>
	</div>

<script>
function calculateAge() {
    const dobInput = document.getElementById('ebdate');
    const ageInput = document.getElementById('eage');
    const dob = new Date(dobInput.value); // Get the selected date
    const today = new Date(); // Current date

    if (dobInput.value) {
        // Calculate the difference in years
        let age = today.getFullYear() - dob.getFullYear();

        // Adjust if the birthday hasn't occurred yet this year
        const monthDiff = today.getMonth() - dob.getMonth();
        const dayDiff = today.getDate() - dob.getDate();
        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            age--;
        }

        // Update the age input field
        ageInput.value = age >= 0 ? age : 0; // Ensure non-negative values
    } else {
        ageInput.value = ''; // Clear age if no valid DOB
    }
}
</script>
	<script src="a.js"></script>
</body>


</html>