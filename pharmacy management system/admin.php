<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="1.css">
    <style>
        /* Add CSS for hamburger menu */
        .hamburger {
           
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 10px;
            z-index: 1000;
        }

        .hamburger div {
            width: 30px;
            height: 3px;
            background-color: red;
            margin: 6px 0;
            transition: 0.4s;
        }

        .sidenav {
            transition: transform 0.3s ease;
        }

        .sidenav.hidden {
            transform: translateX(-250px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidenav {
                width: 250px;
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                background-color: red;
                overflow-x: hidden;
                z-index: 999;
                padding-top: 60px;
                transform: translateX(-250px); /* Hidden by default */
            }

            .hamburger {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .sidenav.active {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Hamburger Menu -->
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
    <script src="a.js"></script>	
    <script src="ham.js"></script>	

</body>

</html>
