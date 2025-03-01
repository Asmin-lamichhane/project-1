<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="form.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title> Medicines </title>
<script>
    function validateForm() {
        let medid = document.forms["medicineForm"]["medid"].value;
        let medname = document.forms["medicineForm"]["medname"].value;
        let qty = document.forms["medicineForm"]["qty"].value;
        let sp = document.forms["medicineForm"]["sp"].value;
        let loc = document.forms["medicineForm"]["loc"].value;

        let errorMessage = "";

        if (medid === "" || isNaN(medid)) {
            errorMessage += "Medicine ID must be a number.\n";
        }
        if (medname.trim() === "") {
            errorMessage += "Medicine Name cannot be empty.\n";
        }
        if (qty === "" || isNaN(qty) || qty <= 0) {
            errorMessage += "Quantity must be a positive number.\n";
        }
        if (sp === "" || isNaN(sp) || sp <= 0) {
            errorMessage += "Price must be a valid number.\n";
        }
        if (loc.trim() === "") {
            errorMessage += "Location cannot be empty.\n";
        }

        if (errorMessage !== "") {
            alert(errorMessage);
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

<br><br><br><br><br><br><br><br>

<div class="one">
    <div class="row">
        <form name="medicineForm" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validateForm();">
            <div class="column">
                <h2> ADD MEDICINE DETAILS</h2>
                <p>
                    <label for="medid">Medicine ID:</label><br>
                    <input type="number" name="medid">
                </p>
                <p>
                    <label for="medname">Medicine Name:</label><br>
                    <input type="text" name="medname">
                </p>
                <p>
                    <label for="qty">Quantity:</label><br>
                    <input type="number" name="qty">
                </p>
                <p>
                    <label for="cat">Category:</label><br>
                    <select id="cat" name="cat">
                        <option>Tablet</option>
                        <option>Capsule</option>
                        <option>Syrup</option>
                    </select>
                </p>
            </div>
            <div class="column">
                <p>
                    <label for="sp">Price: </label><br>
                    <input type="number" step="0.01" name="sp">
                </p>
                <p>
                    <label for="loc">Location:</label><br>
                    <input type="text" name="loc">
                </p>
            </div>
            <input type="submit" name="add" value="Add Medicine">
        </form>

        <br>

        <?php
        include "config.php";

        if(isset($_POST['add'])) {
            $id = mysqli_real_escape_string($conn, $_POST['medid']);
            $name = mysqli_real_escape_string($conn, $_POST['medname']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);
            $category = mysqli_real_escape_string($conn, $_POST['cat']);
            $sprice = mysqli_real_escape_string($conn, $_POST['sp']);
            $location = mysqli_real_escape_string($conn, $_POST['loc']);

            // Additional server-side validation
            if(empty($id) || empty($name) || empty($qty) || empty($sprice) || empty($location)) {
                echo "<script>alert('All fields are required.');</script>";
            } elseif(!is_numeric($id) || !is_numeric($qty) || !is_numeric($sprice) || $qty <= 0 || $sprice <= 0) {
                echo "<script>alert('Invalid numeric values.');</script>";
            } else {
                $sql = "INSERT INTO meds (medid, medname, qty, cat, sp, loc) VALUES ('$id', '$name', '$qty', '$category', '$sprice', '$location')";
                
                if(mysqli_query($conn, $sql)) {
                    echo "<script>alert('Medicine details successfully added!');</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            }
        }

        $conn->close();
        ?>
    </div>
</div>
<script src="a.js"></script>     
</body>
</html>
