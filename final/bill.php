<?php
include "config.php";
session_start();

if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];

    // Fetch sale details
    $sale_query = "SELECT sale_date, cid FROM sales WHERE sale_id = ?";
    $stmt = $conn->prepare($sale_query);
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $sale_result = $stmt->get_result();
    $sale = $sale_result->fetch_assoc();

    // Fetch employee name
    $emp_query = "SELECT efname FROM employee WHERE eid = ?";
    $stmt = $conn->prepare($emp_query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $emp_result = $stmt->get_result();
    $emp_name = ($emp_result && $emp_row = $emp_result->fetch_assoc()) ? $emp_row['efname'] : "Unknown";

    // Fetch customer full name (cfname and clname)
    $customer_name = "Unknown";
    if ($sale && isset($sale['cid'])) {
        $cid = $sale['cid'];
        $cust_query = "SELECT cfname, clname FROM customer WHERE cid = ?";
        $stmt = $conn->prepare($cust_query);
        $stmt->bind_param("i", $cid);
        $stmt->execute();
        $cust_result = $stmt->get_result();
        
        if ($cust_row = $cust_result->fetch_assoc()) {
            $customer_name = $cust_row['cfname'] . " " . $cust_row['clname'];
        }
    }

    // Fetch items for the sale
    $items_query = "
        SELECT si.medid, si.sale_qty, si.tot_price, m.medname, m.sp 
        FROM sales_items si 
        JOIN meds m ON si.medid = m.medid 
        WHERE si.sale_id = ?";
    $stmt = $conn->prepare($items_query);
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $items_result = $stmt->get_result();

    if ($sale && $items_result) {
        // Calculate the total amount
        $grand_total = 0;
        $items = [];
        while ($item = $items_result->fetch_assoc()) {
            $grand_total += $item['tot_price'];
            $items[] = $item;

            // Auto-save each item detail (medid, medname, qty, price, grand_total, and created_at)
            $auto_save_query = "INSERT INTO bills (sale_id, sale_date, employee_name, customer_name, medid, medname, qty, price, grand_total, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt_auto = $conn->prepare($auto_save_query);
            $stmt_auto->bind_param("isssdssdi", $sid, $sale['sale_date'], $emp_name, $customer_name, $item['medid'], $item['medname'], $item['sale_qty'], $item['sp'], $grand_total);
            $stmt_auto->execute();

            // Subtract the quantity of the medicine from the inventory
            $update_query = "UPDATE meds SET qty = qty - ? WHERE medid = ?";
            $stmt_update = $conn->prepare($update_query);
            $stmt_update->bind_param("ii", $item['sale_qty'], $item['medid']);
            $stmt_update->execute();
        }

        // Display the bill
        echo "<html><head><title>Bill</title></head><body>";
        echo "<h1 style='text-align: center;'>PHARMACY</h1>";
        echo "<h2 style='text-align: center;'>Sales Invoice</h2>";
        echo "<p><strong>Sale ID:</strong> " . htmlspecialchars($sid) . "</p>";
        echo "<p><strong>Customer ID:</strong> " . htmlspecialchars($sale['cid']) . "</p>";
        echo "<p><strong>Customer Name:</strong> " . htmlspecialchars($customer_name) . "</p>";
        echo "<p><strong>Sale Date:</strong> " . htmlspecialchars($sale['sale_date']) . "</p>";
        
        echo "<table border='1' width='100%' style='border-collapse: collapse; text-align: left;'>";
        echo "<tr><th>Medicine ID</th><th>Medicine Name</th><th>Quantity</th><th>Price</th><th>Total Price</th></tr>";

        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['medid']) . "</td>";
            echo "<td>" . htmlspecialchars($item['medname']) . "</td>";
            echo "<td>" . htmlspecialchars($item['sale_qty']) . "</td>";
            echo "<td>" . htmlspecialchars($item['sp']) . "</td>";
            echo "<td>" . htmlspecialchars($item['tot_price']) . "</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='4' style='text-align: right;'><strong>Grand Total:</strong></td>";
        echo "<td>" . htmlspecialchars($grand_total) . "</td></tr>";
        echo "</table>";

        // Display the "Entered by" employee name
        echo "<p><strong>Entered by:</strong> " . htmlspecialchars($emp_name) . "</p>";

        echo "<br><button onclick='window.print()'>Print Bill</button>";
        echo "<a href='employeedashboard.php'>Return to Dashboard</a>";
        echo "</body></html>";
    } else {
        echo "No sale details found!";
    }
} else {
    echo "Invalid sale ID.";
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <style>
        /* General Reset */
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    color: #333;
}

/* Container Styles */
body > div {
    width: 80%;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Header */
h1, h2 {
    text-align: center;
    margin: 0;
}

h1 {
    font-size: 32px;
    color: #5cb85c;
    text-transform: uppercase;
}

h2 {
    font-size: 24px;
    color: #555;
    margin-bottom: 20px;
}

/* Sale Details */
p {
    font-size: 16px;
    margin: 5px 0;
}

p strong {
    color: #555;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: #fff;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    text-align: left;
}

table th {
    background-color: #5cb85c;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
}

table td {
    font-size: 14px;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Total Row */
table tr:last-child td {
    font-weight: bold;
    background-color: #f5f5f5;
}

/* Buttons */
button, a {
    display: inline-block;
    text-decoration: none;
    padding: 10px 20px;
    margin: 10px 5px 0;
    border: none;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button {
    background-color: #5cb85c;
    color: #fff;
}

button:hover {
    background-color: #4cae4c;
}

a {
    background-color: #0275d8;
    color: #fff;
}

a:hover {
    background-color: #025aa5;
}

/* Print Styles */
@media print {
    button, a {
        display: none;
    }
    body {
        background: #fff;
    }
}

    </style>
</head>
<body>
    
</body>
</html>