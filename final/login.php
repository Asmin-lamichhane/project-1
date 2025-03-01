<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Sanitize input to prevent SQL injection
        $uname = mysqli_real_escape_string($conn, $_POST['uname']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);

        if ($uname != "" && $password != "") {
            // Query to check if the username exists
            $sql = "SELECT * FROM admin WHERE a_username = '$uname'";
            $result = $conn->query($sql);
            
            // Check if the username exists
            $count = $result->num_rows;

            if ($count > 0) {
                // Username found, fetch the hashed password
                $row = $result->fetch_assoc();
                $hashedPassword = $row['a_password'];

                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['user'] = $uname;
                    header('Location: admin.php');
                    exit();
                } else {
                    // Invalid password, show alert
                    echo "<script>alert('Invalid username or password!');</script>";
                }
            } else {
                // Invalid username, show alert
                echo "<script>alert('Invalid username or password!');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pharmacy Management System</title>
    <link rel="stylesheet" type="text/css" href="log.css">
    <script>
        // Function to handle pharmacist login redirection without validation
        function goToPharmacistLogin() {
            window.location.href = "login1.php"; // Redirect to Pharmacist Login page
        }
    </script>
</head>

<body>

    <div class="header">
        <h1 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); font-size: 40px;">
            PHARMACY MANAGEMENT SYSTEM
        </h1>
    </div>

    <div class="video-background">
        <video autoplay muted loop plays-inline class="back-video">
            <source src="Healthcare.mp4" type="video/mp4">
        </video>
    </div>

    <br><br><br><br>
    <div class="container">
        <form method="post" action="">
            <div id="div_login">
                <h1>Admin Login</h1>
                <div>
                    <input type="text" class="textbox" id="uname" name="uname" placeholder="Username" required />
                </div>
                <div>
                    <input type="password" class="textbox" id="pwd" name="pwd" placeholder="Password" required />
                </div>
                <div>
                    <input type="submit" value="Login" name="submit" id="submit" />
                    <input type="button" value="Pharmacist Login" onclick="goToPharmacistLogin()" id="submit" />
                </div>
            </div>
        </form>
    </div>

</body>
</html>
