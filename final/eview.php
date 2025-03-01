<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Employee Profile</title>
</head>

<body>
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="employeedashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
            
			<button class="dropdown-btn"><i class="fa-solid fa-capsules"></i> Medicines
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
            <a href="med_add.php"><i class="fa-solid fa-plus"></i> Add New Medicine</a>
            <a href="med_view.php"><i class="fa-solid fa-key"></i> Manage Inventory</a>

			</div>
			<button class="dropdown-btn"> <i class="fa-solid fa-truck"></i> Suppliers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
            <a href="sup_add.php"><i class="fa-solid fa-plus"></i> Add New Supplier</a>
            <a href="sup_view.php"><i class="fa-solid fa-key"></i> Manage Suppliers</a>

			</div>
			<button class="dropdown-btn"><i class="fa-solid fa-user-minus"></i> Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="cus_add.php"><i class="fa-solid fa-plus"></i> Add New Customer</a>
            <a href="cus_view.php"><i class="fa-solid fa-key"></i> Manage Customers</a>
			</div>
			
			<button class="dropdown-btn"><i class="fa-solid fa-cart-shopping"></i> Sale 
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="pharm-pos1.php"><i class="fa-solid fa-handshake"></i> new sale</a>
				<a href="sale_view1.php"><i class="fa-solid fa-magnifying-glass"></i> view sale</a>
			</div>
            <button class="dropdown-btn"><i class="fa-solid fa-user"></i>Yours profile
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="eview.php"><i class="fa-solid fa-user"></i>view profile</a>
                
			</div>
			<div class="logout-container">
            <a href="logout1.php" class="logout" onclick="return confirmLogout();" ><i class="fa-solid fa-right-to-bracket"></i> Logout</a>

            <script>
                 function confirmLogout() {
                 return confirm("Are you sure you want to logout?");
                    }
            </script>
   	        </div>
	</div>


<table id="table1">
    <tr>
        <th>Employee ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Date of Joining</th>
        <th>Phone Number</th>
        <th>Email Address</th>
        <th>Home Address</th>
        <th>Username</th>
        <th>Action</th>
    </tr>

<?php
session_start(); // Start the session to use session variables
include "config.php";

// Assuming the logged-in username is stored in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to fetch only the logged-in user's data
    $sql = "SELECT eid, efname, elname, ebdate, eage, esex, ejdate, ephno, e_mail, eadd, username 
            FROM employee 
            WHERE username = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["eid"] . "</td>";
            echo "<td>" . $row["efname"] . "</td>";
            echo "<td>" . $row["elname"] . "</td>";
            echo "<td>" . $row["ebdate"] . "</td>";
            echo "<td>" . $row["eage"] . "</td>";
            echo "<td>" . $row["esex"] . "</td>";
            echo "<td>" . $row["ejdate"] . "</td>";
            echo "<td>" . $row["ephno"] . "</td>";
            echo "<td>" . $row["e_mail"] . "</td>";
            echo "<td>" . $row["eadd"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td align=center>";
            echo "<a class='button1 edit-btn' href='eupdate.php?id=" . $row['eid'] . "' onclick=\"return confirm('Are you sure you want to edit?');\">Edit</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='12' style='text-align:center;'>No data found for the logged-in user.</td></tr>";
    }

    $stmt->close();
} else {
    echo "<tr><td colspan='12' style='text-align:center;'>User not logged in. Please log in to view your profile.</td></tr>";
}

$conn->close();
?>

</table>

<script src="a.js"></script>
</body>
</html>
