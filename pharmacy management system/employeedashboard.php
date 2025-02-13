<!-- employeedashboard.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="1.css"> 
	
</head>

<body>

   
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="employeedashboard.php">Dashboard</a>
			<button class="dropdown-btn">Yours profile
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="eview.php">view profile</a>
			
			</div>
			<button class="dropdown-btn">sale management
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="pharm-pos1.php">new sale</a>
			
				<!-- <a href="1.php">se</a> -->
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
