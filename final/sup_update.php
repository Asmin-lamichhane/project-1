<?php
		include "config.php";
	
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$qry1="SELECT * FROM suppliers WHERE sid='$id'";
			$result = $conn->query($qry1);
			$row = $result -> fetch_row();
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
<title>
Suppliers
</title>
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
		<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Use prepared statement for fetching supplier details
    $stmt = $conn->prepare("SELECT * FROM suppliers WHERE sid = ?");
    $stmt->bind_param("i", $id); // 'i' means integer
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    $stmt->close();
}

if (isset($_POST['update'])) {
    $id = $_POST['sid'];
    $name = $_POST['sname'];
    $add = $_POST['sadd'];
    $phno = $_POST['sphno'];
    $mail = $_POST['smail'];

    // Simple server-side validation
    if (empty($name) || empty($add) || empty($phno) || empty($mail)) {
        echo "<p style='font-size:14px; color:red;'>Error! All fields are required.</p>";
    } else {
        // Use prepared statement for the update operation
        $stmt = $conn->prepare("UPDATE suppliers SET sname = ?, sadd = ?, sphno = ?, smail = ? WHERE sid = ?");
        $stmt->bind_param("ssssi", $name, $add, $phno, $mail, $id); // 's' for strings and 'i' for integer
        if ($stmt->execute()) {
            header("location:sup_view.php"); // Redirect to view suppliers page
        } else {
            echo "<p style='font-size:14px; color:red;'>Error! Unable to update.</p>";
        }
        $stmt->close();
    }
}
?>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
				<h2> UPDATE SUPPLIER DETAILS</h2>
					<p>
						<label for="sid">Supplier ID:</label><br>
						<input type="number" name="sid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="sname">Supplier Company Name:</label><br>
						<input type="text" name="sname" value="<?php echo $row[1]; ?>">
					</p>
					<p>
						<label for="sadd">Address:</label><br>
						<input type="text" name="sadd" value="<?php echo $row[2]; ?>">
					</p>
					
					
				</div>
				<div class="column">
					<p>
						<label for="sphno">Phone Number:</label><br>
						<input type="number" name="sphno" value="<?php echo $row[3]; ?>">
					</p>
					
					<p>
						<label for="smail">Email Address </label><br>
						<input type="text" name="smail" value="<?php echo $row[4]; ?>">
					</p>
					
				</div>
				
			
			<input type="submit" name="update" value="Update">
			</form>
			
	
		</div>
	</div>
	<script src="a.js"></script>
</body>


</html>