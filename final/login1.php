<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="log.css">
<div class="header">
<h1 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); font-size: 30px;">PHARMACY MANAGEMENT SYSTEM</h1>

</div>
<title>
Pharmacy
</title>
</head>

<body>
<!-- <div class="video-background">
    Video that will act as the background
    <video autoplay muted loop plays-inline class="back-video">
      <source src="Healthcare .mp4" type="video/mp4">

    </video></div> -->

	<br><br><br><br>
	<div class="container">
		<form method="post" action="">
			<div id="div_login">
				<h1>Pharmacist Login</h1>
				
				<div>
					<input type="text" class="textbox" id="uname" name="uname" placeholder="Username" />
				</div>
				<div>
					<input type="password" class="textbox" id="pwd" name="pwd" placeholder="Password"/>
				</div>
				<div>
					<input type="submit" value="Submit" name="submit" id="submit" />
					<input type="submit" value="Click here for Admin Login" name="psubmit" id="submit" />
				</div>
			 
				
				<?php
include "config.php"; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if psubmit is set, redirect to login.php
    if (isset($_POST['psubmit'])) {
        header("Location: login.php");
        exit(); // Ensure no further code is executed
    }

    $loginInput = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);
    
    $error_message = "";
    
    // Check if the input is a numeric Employee ID or a username
    if (is_numeric($loginInput)) {
        $query = "SELECT * FROM employee WHERE eid = ?";
    } else {
        $query = "SELECT * FROM employee WHERE username = ?";
    }
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $loginInput);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Login successful
            session_start();
            $_SESSION['user_id'] = $user['eid'];
            $_SESSION['username'] = $user['username'];
            echo "<script>
                    window.location.href = 'employeedashboard.php'; // Redirect to dashboard
                  </script>";
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>


				
			</div>
		</form>
	</div>
	
	</div>

</body>

</html>