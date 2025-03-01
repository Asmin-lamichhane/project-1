<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="1.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	
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
   
    
   
    <div class="main-content">
       
   

    <script src="a.js"></script>

</body>

</html>