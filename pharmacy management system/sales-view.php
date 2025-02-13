<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav2.css">
    <link rel="stylesheet" type="text/css" href="table1.css">
    <title>Sales Invoice</title>
</head>

<body>
    
    <center>
        <div class="head">
            <h2>SALES INVOICE DETAILS</h2>
        </div>
    </center>

    <table align="center" id="table1">
        <tr>
            <th>Sale ID</th>
            <th>Customer ID</th>
            <th>Date and Time</th>
            <th>Sale Amount</th>
            <th>Employee ID</th>
        </tr>

        <?php
        include "config.php";

        $sql = "SELECT sale_id, cid, sale_date, eid FROM sales";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query Failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["sale_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cid"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sale_date"]) . "</td>";
                // echo "<td>" . htmlspecialchars($row["sale_amount"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["eid"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center;'>No records found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>

<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    for (var i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

</html>
