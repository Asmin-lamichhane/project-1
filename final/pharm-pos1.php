<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="2.css">
    <link rel="stylesheet" type="text/css" href="form1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>New Sales</title>
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

    // Fetch employee name using prepared statement
    $stmt = $conn->prepare("SELECT efname FROM employee WHERE eid = ?");
    $stmt->bind_param("s", $_SESSION['user']);
    $stmt->execute();
    $stmt->bind_result($ename);
    $stmt->fetch();
    $stmt->close();

    if (!$ename) {
        $ename = "Unknown";
    }
    ?>

    <div class="topnav">
        <a href="logout.php">Logout (signed in as <?php echo htmlspecialchars($ename); ?>)</a>
    </div>

    
<center>
    <!-- Customer Selection -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <form method="post">
        <!-- Customer Selection -->
        <select id="cid" name="cid" style="padding: 6px 12px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd; background-color: #fff; width: 200px;">
            <option value="0" selected="selected">*Select Customer ID </option>
            <?php
            $qry = "SELECT cid FROM customer";
            $result = $conn->query($qry);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option>" . htmlspecialchars($row["cid"]) . "</option>";
                }
            }
            ?>
        </select>
        &nbsp;&nbsp;
        <input type="submit" name="custadd" value="Add to Proceed" style="padding: 6px 12px; font-size: 14px; border-radius: 5px; border: none; background-color: #225bb9; color: white; cursor: pointer; transition: background-color 0.3s ease; width: auto;">
    </form>
</center>

    <?php
    if (isset($_POST['custadd']) && isset($_POST['cid'])) {
        $cid = $_POST['cid'];

        if ($cid == 0 || empty($cid)) {
            echo "<p style='font-size: 8; color: red;'>Please select a valid Customer ID to record sales.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO sales (cid, eid) VALUES (?, ?)");
            $stmt->bind_param("is", $cid, $_SESSION['user']);
            if (!$stmt->execute()) {
                echo "<p style='font-size: 8; color: red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
    }
    ?>

    <!-- Medicine Selection -->
   
<center>
    <form method="post">
        <!-- Medicine Selection -->
        <select id="med" name="med" style="padding: 6px 12px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd; background-color: #fff; width: 200px;">
            <option value="0" selected="selected">Select Medicine</option>
            <?php
            $qry = "SELECT medname FROM meds";
            $result = $conn->query($qry);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option>" . htmlspecialchars($row["medname"]) . "</option>";
                }
            }
            ?>
        </select>
        &nbsp;&nbsp;
        <input type="submit" name="search" value="Search" style="padding: 6px 12px; font-size: 14px; border-radius: 5px; border: none; background-color: #225bb9; color: white; cursor: pointer; transition: background-color 0.3s ease; width: auto;">
    </form>
</center>


    <?php
    $row4 = [];
    if (isset($_POST['search']) && !empty($_POST['med'])) {
        $med = $_POST['med'];

        $stmt = $conn->prepare("SELECT * FROM meds WHERE medname = ?");
        $stmt->bind_param("s", $med);
        $stmt->execute();
        $result = $stmt->get_result();
        $row4 = $result->fetch_row();
        $stmt->close();
    }
    ?>
<center></center>
    <div class="one row" style="margin-right: 160px;">
        <form method="post">
            <div class="column">
                <label for="medid">Medicine ID:</label>
                <input type="number" name="medid" value="<?php echo htmlspecialchars($row4[0] ?? ''); ?>" readonly><br><br>
                <label for="medname">Medicine Name:</label>
                <input type="text" name="medname" value="<?php echo htmlspecialchars($row4[1] ?? ''); ?>" readonly><br><br>
            </div>
            <div class="column">
                <label for="cat">Category:</label>
                <input type="text" name="cat" value="<?php echo htmlspecialchars($row4[3] ?? ''); ?>" readonly><br><br>
                <label for="loc">Location:</label>
                <input type="text" name="loc" value="<?php echo htmlspecialchars($row4[5] ?? ''); ?>" readonly><br><br>
            </div>
            <div class="column">
                <label for="qty">Quantity Available:</label>
                <input type="number" name="qty" value="<?php echo htmlspecialchars($row4[2] ?? ''); ?>" readonly><br><br>
                <label for="sp">Price of One Unit:</label>
                <input type="number" name="sp" value="<?php echo htmlspecialchars($row4[4] ?? ''); ?>" readonly><br><br>
            </div>
            <label for="mcqty">Quantity Required:</label>
            <input type="number" name="mcqty">
            &nbsp;&nbsp;&nbsp;
            <input type="submit" name="add" value="Add Medicine">&nbsp;&nbsp;&nbsp;

            <?php
            if (isset($_POST['add'])) {
                $medid = $_POST['medid'];
                $mcqty = $_POST['mcqty'];
                $sp = $_POST['sp'];
                $qtyAvailable = $_POST['qty'];

                if ($mcqty > $qtyAvailable || $mcqty <= 0) {
                    echo "Quantity Invalid!";
                } else {
                    $price = $sp * $mcqty;

                    // Fetch the latest sale_id or create a new one if missing
                    $qry5 = "SELECT sale_id FROM sales ORDER BY sale_id DESC LIMIT 1";
                    $result5 = $conn->query($qry5);

                    if ($result5->num_rows > 0) {
                        $row5 = $result5->fetch_assoc();
                        $sid = $row5['sale_id'];
                    } else {
                        $stmt = $conn->prepare("INSERT INTO sales (cid, eid) VALUES (NULL, ?)");
                        $stmt->bind_param("s", $_SESSION['user']);
                        $stmt->execute();
                        $sid = $conn->insert_id;
                        $stmt->close();
                    }

                    $stmt = $conn->prepare("INSERT INTO sales_items (sale_id, medid, sale_qty, tot_price) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiid", $sid, $medid, $mcqty, $price);

                    if ($stmt->execute()) {
                        echo "<br><br><center>";
                        echo "<a class='button1 view-btn' href='pharm-pos2.php?sid=" . htmlspecialchars($sid) . "' style='display: inline-block; padding: 10px 20px; font-size: 16px; text-align: center; text-decoration: none; background-color: #28a745; color: white; border-radius: 25px; border: 1px solid #28a745; transition: background-color 0.3s ease, color 0.3s ease; cursor: pointer;'>View Order</a>";
                        echo "</center>";
                    } else {
                        echo "Error adding medicine: " . $stmt->error;
                    }
                    $stmt->close();
                }
            }
            ?>
        </form>
    </div>
    </center>
    <script>
        const dropdown = document.getElementsByClassName("dropdown-btn");
        for (let i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
                this.classList.toggle("active");
                const dropdownContent = this.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
            });
        }
    </script>
</body>

</html>