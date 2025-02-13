<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="stylesheet" type="text/css" href="1.css">
<link rel="stylesheet" type="text/css" href="table1.css"> -->
<title>
New Sales
</title>
</head>

<body>

		  
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="employeedashboard.php">Dashboard</a>
			<button class="dropdown-btn">profile
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="eview.php">view profile</a>
			
			</div>
			<button class="dropdown-btn">sale
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="pharm-pos1.php">sale</a>
				<a href="1.php">se</a>
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
						
						
						
						echo "</tr>";
					}
				}
			} else {
				echo "<tr><td colspan='6'>No items found for this sale.</td></tr>";
			}
		}
		
		
	?>
		
		<div class="one" style="background-color:white;">
		<form method=post>
		<a name='pos1' class='button1 view-btn' href='pharm-pos1.php?sid=<?php echo htmlspecialchars($sid); ?>'>Go Back to Sales Page</a> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='submit' name='calculate_total' value='Calculate Total'><br>

		<a name='generate_bill' class='button1 view-btn' href='bill.php?sid=<?php echo htmlspecialchars($sid); ?>'>Generate Bill</a>
		</form>
		</div>
		
	<?php
		
		if (isset($_POST['custadd'])) {
			// Calculate total amount using stored procedure
			$res = mysqli_query($conn, "SET @p0=$sid;");
			$res = mysqli_query($conn, "CALL `TOTAL_AMT`(@p0,@p1);") or die(mysqli_error($conn));
			$res = mysqli_query($conn, "SELECT @p1 as TOTAL;");
			
			while ($row = mysqli_fetch_array($res)) {
				$tot = $row['TOTAL'];
			}
		
			// Fetch all items for the sale
			$items_query = "SELECT medid, sale_qty FROM sales_items WHERE sale_id=$sid";
			$items_result = $conn->query($items_query);
		
			if ($items_result && $items_result->num_rows > 0) {
				while ($item = $items_result->fetch_assoc()) {
					$medid = $item['medid'];
					$sale_qty = $item['sale_qty'];
		
					
				}
			}
			
					
			echo "<table align='right' id='table1'>
			<tr style='background-color:rgb(162, 12, 12);'>
			<td>Total</td>
			<td>" . htmlspecialchars($tot) . "</td>
			</tr>
		</table>";
	
		}
		
					
	?>
	<?php
if (isset($_POST['calculate_total'])) {
    // Calculate total amount using stored procedure
    $res = mysqli_query($conn, "SET @p0=$sid;");
    $res = mysqli_query($conn, "CALL `TOTAL_AMT`(@p0,@p1);") or die(mysqli_error($conn));
    $res = mysqli_query($conn, "SELECT @p1 as TOTAL;");
    
    while ($row = mysqli_fetch_array($res)) {
        $tot = $row['TOTAL'];
    }
    
    // Display the calculated total
    echo "<table align='right' id='table1'>
        <tr style='background-color:rgb(162, 12, 12);'>
        <td>Total</td>
        <td>" . htmlspecialchars($tot) . "</td>
        </tr>
    </table>";
}
?>

</body>
<script src="a.js"></script>

</html>
