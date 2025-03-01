
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="sidenav">
    <h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
    <a href="employeedashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>

    <button class="dropdown-btn"><i class="fa-solid fa-capsules"></i> Medicines <i class="down"></i></button>
    <div class="dropdown-container">
        <a href="med_add.php"><i class="fa-solid fa-plus"></i> Add New Medicine</a>
        <a href="med_view.php"><i class="fa-solid fa-key"></i> Manage Inventory</a>
    </div>

    <button class="dropdown-btn"><i class="fa-solid fa-truck"></i> Suppliers <i class="down"></i></button>
    <div class="dropdown-container">
        <a href="sup_add.php"><i class="fa-solid fa-plus"></i> Add New Supplier</a>
        <a href="sup_view.php"><i class="fa-solid fa-key"></i> Manage Suppliers</a>
    </div>

    <button class="dropdown-btn"><i class="fa-solid fa-user-minus"></i> Customers <i class="down"></i></button>
    <div class="dropdown-container">
        <a href="cus_add.php"><i class="fa-solid fa-plus"></i> Add New Customer</a>
        <a href="cus_view.php"><i class="fa-solid fa-key"></i> Manage Customers</a>
    </div>

    <button class="dropdown-btn"><i class="fa-solid fa-cart-shopping"></i> Sale <i class="down"></i></button>
    <div class="dropdown-container">
        <a href="pharm-pos1.php"><i class="fa-solid fa-handshake"></i> New Sale</a>
        <a href="sale_view1.php"><i class="fa-solid fa-magnifying-glass"></i> View Sale</a>
    </div>

    <button class="dropdown-btn"><i class="fa-solid fa-user"></i> Your Profile <i class="down"></i></button>
    <div class="dropdown-container">
        <a href="eview.php"><i class="fa-solid fa-user"></i> View Profile</a>
    </div>

    <div class="logout-container">
        <a href="logout1.php" class="logout" onclick="return confirmLogout();">
            <i class="fa-solid fa-right-to-bracket"></i> Logout
        </a>
        <script>
            function confirmLogout() {
                return confirm("Are you sure you want to logout?");
            }
        </script>
    </div>
</div>

<script src="a.js"></script>  
</body>
</html>
