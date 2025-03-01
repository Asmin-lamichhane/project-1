<?php
include "config.php";

$id = "";
$medicine = [];
$errors = [];

// Check if ID is passed in URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer for security

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT medid, medname, qty, cat, sp, loc FROM meds WHERE medid=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medicine = $result->fetch_assoc();

    // If no medicine found, redirect to view page
    if (!$medicine) {
        header("location: med_view.php");
        exit();
    }
} else {
    header("location: med_view.php");
    exit();
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['medid'];
    $name = trim($_POST['medname']);
    $qty = $_POST['qty'];
    $cat = trim($_POST['cat']);
    $price = $_POST['sp'];
    $lcn = trim($_POST['loc']);

    // Basic validation
    if (empty($name) || empty($qty) || empty($cat) || empty($price) || empty($lcn)) {
        $errors[] = "All fields are required.";
    }
    if (!is_numeric($qty) || $qty <= 0) {
        $errors[] = "Quantity must be a positive number.";
    }
    if (!is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be a positive number.";
    }

    // If no errors, update database
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE meds SET medname=?, qty=?, cat=?, sp=?, loc=? WHERE medid=?");
        $stmt->bind_param("sisssi", $name, $qty, $cat, $price, $lcn, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Medicine details updated successfully!'); window.location='med_view.php';</script>";
        } else {
            echo "<script>alert('Error updating record. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Update Medicine</title>
<script>
function validateForm() {
    let name = document.forms["medicineForm"]["medname"].value.trim();
    let qty = document.forms["medicineForm"]["qty"].value;
    let price = document.forms["medicineForm"]["sp"].value;
    let location = document.forms["medicineForm"]["loc"].value.trim();

    if (name === "" || qty === "" || price === "" || location === "") {
        alert("All fields are required.");
        return false;
    }
    if (qty <= 0 || isNaN(qty)) {
        alert("Quantity must be a positive number.");
        return false;
    }
    if (price <= 0 || isNaN(price)) {
        alert("Price must be a positive number.");
        return false;
    }
    return true;
}
</script>
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

<div class="one">
    <div class="row">
        <h2>UPDATE MEDICINE DETAILS</h2>

        <?php if (!empty($errors)) { ?>
            <div style="color: red;">
                <?php foreach ($errors as $error) {
                    echo "<p>$error</p>";
                } ?>
            </div>
        <?php } ?>

        <form name="medicineForm" action="" method="post" onsubmit="return validateForm()">
            <div class="column">
                <p>
                    <label for="medid">Medicine ID:</label><br>
                    <input type="number" name="medid" value="<?php echo htmlspecialchars($medicine['medid']); ?>" readonly>
                </p>
                <p>
                    <label for="medname">Medicine Name:</label><br>
                    <input type="text" name="medname" value="<?php echo htmlspecialchars($medicine['medname']); ?>">
                </p>
                <p>
                    <label for="qty">Quantity:</label><br>
                    <input type="number" name="qty" value="<?php echo htmlspecialchars($medicine['qty']); ?>">
                </p>
                <p>
                    <label for="cat">Category:</label><br>
                    <input type="text" name="cat" value="<?php echo htmlspecialchars($medicine['cat']); ?>">
                </p>
            </div>
            
            <div class="column">
                <p>
                    <label for="sp">Price:</label><br>
                    <input type="number" step="0.01" name="sp" value="<?php echo htmlspecialchars($medicine['sp']); ?>">
                </p>
                <p>
                    <label for="loc">Location:</label><br>
                    <input type="text" name="loc" value="<?php echo htmlspecialchars($medicine['loc']); ?>">
                </p>
            </div>

            <input type="submit" name="update" value="Update">
        </form>
    </div>
</div>

<script src="a.js"></script>
</body>
</html>
