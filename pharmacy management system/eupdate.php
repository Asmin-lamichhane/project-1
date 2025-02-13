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
<link rel="stylesheet" type="text/css" href="form1.css">
<title>
Employees
</title>
</head>

<body>

<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="employeedashboard.php">Dashboard</a>
			<button class="dropdown-btn">profile
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="eview.php">view profile</a>
			
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

	
	
	

	
			
		<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry1 = "SELECT * FROM employee WHERE eid='$id'";
    $result = $conn->query($qry1);
    $row = $result->fetch_row();
}

if (isset($_POST['update'])) {
    include "config.php";

    $id = mysqli_real_escape_string($conn, $_POST['eid']);
    $fname = mysqli_real_escape_string($conn, $_POST['efname']);
    $lname = mysqli_real_escape_string($conn, $_POST['elname']);
    $bdate = mysqli_real_escape_string($conn, $_POST['ebdate']);
    $age = mysqli_real_escape_string($conn, $_POST['eage']);
    $sex = mysqli_real_escape_string($conn, $_POST['esex']);
    $phno = mysqli_real_escape_string($conn, $_POST['ephno']);
    $mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $add = mysqli_real_escape_string($conn, $_POST['eadd']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $valid = true;
    $error_message = "";

    // Validate passwords match
    if ($password !== $confirm_password) {
        $valid = false;
        $error_message .= "Passwords do not match.\\n";
    }

    // Other validations (similar to your existing logic)...

    if (!$valid) {
        echo "<script>
                alert('Validation Errors:\\n$error_message');
                window.history.back();
              </script>";
        exit();
    }

    // Hash the password before saving it
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE employee 
            SET efname='$fname', elname='$lname', ebdate='$bdate', eage=$age, esex='$sex',
                ephno='$phno', e_mail='$mail', eadd='$add', username='$username', password_hash='$password_hash'
            WHERE eid='$id'";

    if ($conn->query($sql)) {
        echo "<script>
                alert('Employee details successfully updated!');
                window.location.href = 'eview.php';
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

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>

<body>
    <div class="container">
      
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="column">
            <h2>UPDATE EMPLOYEE DETAILS</h2>
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
                    <input type="date" name="ebdate" id="ebdate" value="<?php echo $row[3]; ?>" onchange="calculateAge()">
                </p>
                <p>
                    <label for="eage">Age:</label><br>
                    <input type="number" name="eage" id="eage" value="<?php echo $row[4]; ?>" readonly>
                </p>
                <p>
                    <label for="esex">Sex:</label><br>
                    <input type="text" name="esex" value="<?php echo $row[5]; ?>">
                </p>
        
            
                <p>
                    <label for="ephno">Phone Number:</label><br>
                    <input type="number" name="ephno" value="<?php echo $row[9]; ?>">
                </p>
                <p>
                    <label for="e_mail">Email ID:</label><br>
                    <input type="email" name="e_mail" value="<?php echo $row[10]; ?>">
                </p>
                <p>
                    <label for="eadd">Address:</label><br>
                    <input type="text" name="eadd" value="<?php echo $row[11]; ?>">
                </p>
                <p>
                    <label for="username">Username:</label><br>
                    <input type="text" name="username" value="<?php echo $row[12]; ?>">
                </p>
                <p>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" required>
                </p>
                <p>
                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" name="confirm_password" required>
                </p>
            </div>
            <input type="submit" name="update" value="Update">
        </form>
    </div>

    <script>
        function calculateAge() {
            const dobInput = document.getElementById('ebdate');
            const ageInput = document.getElementById('eage');
            const dob = new Date(dobInput.value);
            const today = new Date();

            if (dobInput.value) {
                let age = today.getFullYear() - dob.getFullYear();
                const monthDiff = today.getMonth() - dob.getMonth();
                const dayDiff = today.getDate() - dob.getDate();
                if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                    age--;
                }
                ageInput.value = age >= 0 ? age : 0;
            } else {
                ageInput.value = '';
            }
        }
    </script>


	<script src="a.js"></script>
</body>


</html>