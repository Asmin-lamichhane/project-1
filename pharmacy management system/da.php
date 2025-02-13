<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="1.css"> 
    <style>
        /* Basic Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .topnav {
            background-color: #333;
            overflow: hidden;
        }

        .topnav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            float: left;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .dropdown-container {
            display: none;
            background-color: #333;
            padding-left: 20px;
        }

        .dropdown-btn {
            font-size: 20px;
            background-color: #111;
            color: white;
            border: none;
            cursor: pointer;
            text-align: left;
            width: 100%;
            padding: 14px 16px;
            border: none;
            outline: none;
        }

        .dropdown-btn:hover {
            color: #f1f1f1;
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            background-color: #333;
            color: white;
            font-size: 30px;
            padding: 14px;
            cursor: pointer;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            .topnav a {float: none; width: 100%; text-align: left;}
            .sidenav {width: 0; height: 100%; position: fixed;}
            .sidenav a {padding: 8px 8px 8px 16px;}
            .hamburger {display: block; position: absolute; top: 10px; right: 10px; z-index: 2;}
        }
    </style>
</head>

<body>

    <div class="topnav">
        <a href="logout.php">Logout (Logged in as Admin)</a>
        <div class="hamburger" onclick="toggleMenu()">&#9776;</div> <!-- Hamburger Icon -->
    </div>

    <div class="sidenav" id="mySidenav">
        <h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
        <a href="admin.php">Dashboard</a>
        <button class="dropdown-btn">Inventory
            <i class="down"></i>
        </button>
        <div class="dropdown-container">
            <a href="inventory-add.php">Add New Medicine</a>
            <a href="inventory-view.php">Manage Inventory</a>
        </div>
        <button class="dropdown-btn">Suppliers
            <i class="down"></i>
        </button>
        <div class="dropdown-container">
            <a href="supplier-add.php">Add New Supplier</a>
            <a href="supplier-view.php">Manage Suppliers</a>
        </div>
        <button class="dropdown-btn">Stock Purchase
            <i class="down"></i>
        </button>
        <div class="dropdown-container">
            <a href="purchase-add.php">Add New Purchase</a>
            <a href="purchase-view.php">Manage Purchases</a>
        </div>       
        <button class="dropdown-btn">Employees
            <i class="down"></i>
        </button>
        <div class="dropdown-container">
            <a href="employee-add.php">Add New Employee</a>
            <a href="employee-view.php">Manage Employees</a>
        </div>           
        <button class="dropdown-btn">Customers
            <i class="down"></i>
        </button>
        <div class="dropdown-container">
            <a href="customer-add.php">Add New Customer</a>
            <a href="customer-view.php">Manage Customers</a>
        </div>
    </div>

    <div class="main-content">
        <!-- Main content goes here -->
    </div>

    <script>
        function toggleMenu() {
            var sidenav = document.getElementById("mySidenav");
            if (sidenav.style.width === "250px") {
                sidenav.style.width = "0";
            } else {
                sidenav.style.width = "250px";
            }
        }

        // Toggle dropdown menus
        var dropdowns = document.querySelectorAll(".dropdown-btn");
        dropdowns.forEach(function(button) {
            button.addEventListener("click", function() {
                var dropdownContainer = this.nextElementSibling;
                dropdownContainer.style.display = (dropdownContainer.style.display === "block" ? "none" : "block");
            });
        });
    </script>

</body>

</html>
