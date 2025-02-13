<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="table.css">
<title>Employee Profile</title>
</head>

<body>

<div class="sidenav">
    <h2 style="font-family:Arial; color:white; text-align:center;">PHARMACY</h2>
    <a href="employeedashboard.php">Dashboard</a>
    <button class="dropdown-btn">Profile
        <i class="down"></i>
    </button>
    <div class="dropdown-container">
        <a href="eview.php">View Profile</a>
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
