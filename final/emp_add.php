<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>
Employees
</title>
</head>

<body>

   
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="Admin.php"><i class="fa-solid fa-house"></i> Dashboard</a>
			<button class="dropdown-btn"><i class="fa-solid fa-person"></i> Employees <i class="down"></i></button>
        <div class="dropdown-container">
            <a href="emp_add.php"><i class="fa-solid fa-plus"></i> Add New Employee</a>
            <a href="emp_view.php"><i class="fa-solid fa-key"></i> Manage Employees</a>
        </div>

			<button class="dropdown-btn"><i class="fa-solid fa-user"></i>Sale Record
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="sale_view.php"><i class="fa-solid fa-cart-shopping"></i>view sales</a>
			
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
	
	
	<div class="one row">
	
	<?php
include "config.php";

if (isset($_POST['add'])) {
    // Sanitize and validate inputs
    $id = mysqli_real_escape_string($conn, $_POST['eid']);
    $fname = mysqli_real_escape_string($conn, $_POST['efname']);
    $lname = mysqli_real_escape_string($conn, $_POST['elname']);
    $bdate = mysqli_real_escape_string($conn, $_POST['ebdate']);
    $sex = mysqli_real_escape_string($conn, $_POST['esex']);
    $etype = mysqli_real_escape_string($conn, $_POST['etype']);
    $jdate = mysqli_real_escape_string($conn, $_POST['ejdate']);
    $sal = mysqli_real_escape_string($conn, $_POST['esal']);
    $phno = mysqli_real_escape_string($conn, $_POST['ephno']);
    $mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $add = mysqli_real_escape_string($conn, $_POST['eadd']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Auto-calculate age based on birthdate
    $age = null;
    if (!empty($bdate)) {
        $dob = new DateTime($bdate);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
    }

    // Validation
    $valid = true;
    $error_message = "";

    // Existing validations...

    // Validate username (alphanumeric, 3-20 chars)
    if (empty($username) || !preg_match("/^[a-zA-Z0-9]{3,20}$/", $username)) {
        $valid = false;
        $error_message .= "Username is required and must be 3-20 alphanumeric characters.\\n";
    }

    // // Validate password (at least 8 characters, include a number, uppercase, and special character)
    // if (empty($password) || !preg_match("/^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
    //     $valid = false;
    //     $error_message .= "Password must be at least 8 characters long, include at least one number, one uppercase letter, and one special character.\\n";
    // }

    if (!$valid) {
        echo "<script>
                alert('Validation Errors:\\n$error_message');
                window.history.back();
              </script>";
        exit();
    }

    // Hash password securely
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // SQL Insert with username and hashed password
    $sql = "INSERT INTO employee 
            (eid, efname, elname, ebdate, eage, esex, etype, ejdate, esal, ephno, e_mail, eadd, username, password_hash) 
            VALUES 
            ($id, '$fname', '$lname', '$bdate', $age, '$sex', '$etype', '$jdate', $sal, $phno, '$mail', '$add', '$username', '$password_hash')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Employee successfully added!');
                window.location.href = '" . $_SERVER['PHP_SELF'] . "';
              </script>";
    } else {
        echo "<script>
                alert('Error adding employee. Please check the details and try again.');
                window.history.back();
              </script>";
    }
}

$conn->close();
?>



		
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
				<h2> ADD EMPLOYEE DETAILS</h2>
					<p>
						<label for="eid">Employee ID:</label><br>
						<input type="number" name="eid">
					</p>
					<p>
						<label for="efname">First Name:</label><br>
						<input type="text" name="efname">
					</p>
					<p>
						<label for="elname">Last Name:</label><br>
						<input type="text" name="elname">
					</p>
					<p>
    <label for="ebdate">Date of Birth:</label><br>
    <input type="date" id="ebdate" name="ebdate" value="<?php echo isset($_POST['ebdate']) ? $_POST['ebdate'] : ''; ?>" onchange="calculateAge()">
</p>
<p>
    <label for="eage">Age:</label><br>
    <input type="number" id="eage" name="eage" value="<?php echo $age; ?>" readonly>
</p>
					<p>
						<label for="esex">Sex:</label><br>
						<select id="esex" name="esex">
								<option value="selected">Select</option>
								<option>Female</option>
								<option>Male</option>
								<option>Others</option>
						</select>
					</p>
				</div>
				<div class="column">
					<p>
						<label for="etype">Employee Type:</label><br>
						<select id="etype" name="etype">
							<option value="selected">Select</option>
								<option>Pharmacist</option>
								<option>Manager</option>
						</select>
					</p>
					<p>
						<label for="ejdate">Date of Joining:</label><br>
						<input type="date" name="ejdate">
					</p>
					<p>
						<label for="esal">Salary:</label><br>
						<input type="number" step="0.01" name="esal">
					</p>
					<p>
						<label for="ephno">Phone Number:</label><br>
						<input type="number" name="ephno">
					</p>
					
					<p>
						<label for="e_mail">Email ID:</label><br>
						<input type="text" name="e_mail">
					</p>
					<p>
						<label for="eadd">Address:</label><br>
						<input type="text" name="eadd">
					</p>
					<p>
            <label for="username">Username:</label><br>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password:</label><br>
            <input type="password" name="password" required>
        </p>
					
				</div>
				
			
			<input type="submit" name="add" value="Add Employee">
			</form>
		<br>
	</div>
    <script>
        function calculateAge() {
    const dobInput = document.getElementById('ebdate');
    const ageInput = document.getElementById('eage');
    const dob = new Date(dobInput.value); // Get the selected date
    const today = new Date(); // Current date

    if (dob) {
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