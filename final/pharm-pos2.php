<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="2.css">
<link rel="stylesheet" type="text/css" href="pos2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>
New Sales
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
				<a href="sale_view.php"><i class="fa-solid fa-magnifying-glass"></i> view sale</a>
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

	<?php
		include "config.php";
		session_start();
	
		$sql="SELECT efname FROM employee WHERE eid='$_SESSION[user_id]'";
		$result=$conn->query($sql);
		if ($result) {
			$row=$result->fetch_row();
			$ename=$row[0];
		} else {
			$ename="Unknown";
		}
	?>

	<div class="topnav">
		<a href="logout.php">Logout (signed in as <?php echo htmlspecialchars($ename); ?>)</a>
	</div>
	
	<center>
	<div class="head">
	<h2> SALES INVOICE</h2>
	</div>
	</center>

	<table align='right' id='table1'>
		<tr>
			<th>Medicine ID</th>
			<th>Medicine Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total Price</th>
			<th>Action</th>
		</tr>
       
	
	<?php
	
		if(isset($_GET['sid'])) {
		$sid=$_GET['sid'];}
		
		if(empty($sid))
		{
			$sql ="SHOW TABLE STATUS LIKE 'sales'";

			if(!$result = $conn->query($sql)){
			die('There was an error running the query [' . $conn->error . ']');
				}

			$row = $result->fetch_assoc();
			$sid=$row['Auto_increment']-1;
		}
		if (!empty($sid)) {
			$qry1 = "SELECT medid, sale_qty, tot_price FROM sales_items WHERE sale_id=$sid";
			$result1 = $conn->query($qry1);
			if ($result1 && $result1->num_rows > 0) {
				while ($row1 = $result1->fetch_assoc()) {
					$medid = $row1["medid"];
					$qry2 = "SELECT medname, sp FROM meds WHERE medid=$medid";
					$result2 = $conn->query($qry2);
					if ($result2 && $row2 = $result2->fetch_row()) {
						echo "<tr>";
						echo "<td>" . htmlspecialchars($row1["medid"]) . "</td>";
						echo "<td>" . htmlspecialchars($row2[0]) . "</td>";
						echo "<td>" . htmlspecialchars($row1["sale_qty"]) . "</td>";
						echo "<td>" . htmlspecialchars($row2[1]) . "</td>";
						echo "<td>" . htmlspecialchars($row1["tot_price"]) . "</td>";
						echo "<td align=center>";
						
						echo "<a name='delete' class='button1 del-btn' href=pharm-pos-delete.php?mid=" . htmlspecialchars($row1['medid']) . "&slid=" . htmlspecialchars($sid) . ">Delete</a>";	
						echo "</td>";
						echo "</tr>";
					}
				}
			} else {
				echo "<tr><td colspan='6'>No items found for this sale.</td></tr>";
			}
		}
	?>
    </table>
		
    <div class="button-container">
    <form method="post">
        <a name='pos1' class='button1 view-btn' href='pharm-pos1.php?sid=<?php echo htmlspecialchars($sid); ?>'>Go Back to Sales Page</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="button1 view-btn" href="bill.php?sid=<?php echo htmlspecialchars($sid); ?>">Generate Bill</a>
    </form>
</div>

<?php
	// Trigger after clicking "Generate Bill"
	if (isset($_GET['sid']) && isset($_GET['bill'])) {
		$sid = $_GET['sid'];

		// Fetch all items for the sale
		$items_query = "SELECT medid, sale_qty FROM sales_items WHERE sale_id=$sid";
		$items_result = $conn->query($items_query);

		if ($items_result && $items_result->num_rows > 0) {
			while ($item = $items_result->fetch_assoc()) {
				$medid = $item['medid'];
				$sale_qty = $item['sale_qty'];

				// Reduce the quantity of the medicine in the meds table
				$update_query = "UPDATE meds SET qty = qty - $sale_qty WHERE medid = $medid";
				if (!$conn->query($update_query)) {
					echo "Error updating medicine quantity: " . $conn->error;
				}
			}
		}

		// Clear data from sales_items table
		$delete_items_query = "DELETE FROM sales_items WHERE sale_id = $sid";
		if (!$conn->query($delete_items_query)) {
			echo "Error clearing sales items: " . $conn->error;
		}

		// Clear data from sales table
		$delete_sales_query = "DELETE FROM sales WHERE sale_id = $sid";
		if (!$conn->query($delete_sales_query)) {
			echo "Error clearing sales data: " . $conn->error;
		}

		// // Redirect to a confirmation or reset page after clearing
		// header("Location: pharm-pos1.php");
		// exit(); // Ensure no further code is executed after redirection
	}
?>

</body>

<script>
	var dropdown = document.getElementsByClassName("dropdown-btn");
	for (var i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
		});
	}
</script>

</html>
