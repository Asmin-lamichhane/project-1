<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="form1.css">
    <link rel="stylesheet" type="text/css" href="1.css">

    <title>New Sales</title>
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

   
    $stmt = $conn->prepare("SELECT eid FROM employee WHERE eid = ?");
    $stmt->bind_param("s", $_SESSION['user']);
    $stmt->execute();
    $stmt->bind_result($ename);
    $stmt->fetch();
    $stmt->close();

    if (!$ename) {
        $ename = "Unknown";
    }
    ?>

   
   
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

    <div class="one row" style="margin-right: 160px;">
        <form method="post">
        <h2>POINT OF SALE</h2>
            <div class="column">
           <p></p>
            <label for="cid">Customer ID:</label>
            <select id="cid" name="cid">
                <option value="0" selected="selected">*Select Customer ID</option>
                <?php $qry = "SELECT cid FROM customer"; $result = $conn->query($qry); if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) { echo "<option>" . htmlspecialchars($row["cid"]) . "</option>";  } } ?>
            </select>
            </p>
           
           <p>
           <label for="med">Select Medicine:</label>
                 <select id="med" name="med"> <option value="0" selected="selected">Select Medicine</option> <?php  $qry = "SELECT medname FROM meds"; $result = $conn->query($qry); if ($result->num_rows > 0) {   while ($row = $result->fetch_assoc()) {     echo "<option>" . htmlspecialchars($row["medname"]) . "</option>";    }   } ?>  </select>
                 &nbsp;&nbsp;
                 <input type="submit" name="search" value="Search">  
           
           </p>
                
           <p>
           <label for="medid">Medicine ID:</label>
                <input type="number" name="medid" value="<?php echo htmlspecialchars($row4[0] ?? ''); ?>" readonly><br><br>
                <label for="medname">Medicine Name:</label>
                <input type="text" name="medname" value="<?php echo htmlspecialchars($row4[1] ?? ''); ?>" readonly><br><br>
           </p>
               
           <p>
           <label for="cat">Category:</label>
                <input type="text" name="cat" value="<?php echo htmlspecialchars($row4[3] ?? ''); ?>" readonly><br><br>
                <label for="loc">Location:</label>
                <input type="text" name="loc" value="<?php echo htmlspecialchars($row4[5] ?? ''); ?>" readonly><br><br>
           </p>
               
            <p>
            <label for="qty">Quantity Available:</label>
                <input type="number" name="qty" value="<?php echo htmlspecialchars($row4[2] ?? ''); ?>" readonly><br><br>
                <label for="sp">Price of One Unit:</label>
                <input type="number" name="sp" value="<?php echo htmlspecialchars($row4[4] ?? ''); ?>" readonly><br><br>
            </p>
             <p>
             <label for="mcqty">Quantity Required:</label>
            <input type="number" name="mcqty">
            &nbsp;&nbsp;&nbsp;
             </p>  
          
            <input type="submit" name="add" value="Add Medicine">&nbsp;&nbsp;&nbsp;
            </div>
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

                 
                    $qry5 = "SELECT sale_id FROM sales ORDER BY sale_id DESC LIMIT 1";
                    $result5 = $conn->query($qry5);

                    if ($result5->num_rows > 0) {
                        $row5 = $result5->fetch_assoc();
                        $sid = $row5['sale_id'];
                    } else {
                        $stmt = $conn->prepare("INSERT INTO sales (cid, eid) VALUES (NULL, ?)");
                        $stmt->bind_param("s", $_SESSION['user_id']);
                        $stmt->execute();
                        $sid = $conn->insert_id;
                        $stmt->close();
                    }

                    $stmt = $conn->prepare("INSERT INTO sales_items (sale_id, medid, sale_qty, tot_price) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiid", $sid, $medid, $mcqty, $price);

                    if ($stmt->execute()) {
                        echo "<br><br><center>";
                        echo "<a class='button1 view-btn' href='pharm-pos2.php?sid=" . htmlspecialchars($sid) . "' 
                        style='display: inline-block; padding: 10px 20px; background-color:rgb(39, 3, 217); color: white; text-align: center; font-size: 16px; font-weight: bold; border-radius: 8px; text-decoration: none; transition: background-color 0.3s ease;'>View Order</a>";
                        
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
	<script src="a.js"></script>
   
</body>

</html>
