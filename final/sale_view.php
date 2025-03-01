<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>View Bills</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding-left: 300;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        #search {
            padding: 10px;
            width: 300px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #225bb9;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sale view</h1>
        
   
<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
			<a href="Admin.php"><i class="fa-solid fa-house"></i> Dashboard</a>
			<button class="dropdown-btn"><i class="fa-solid fa-person"></i> Employees <i class="down"></i></button>
        <div class="dropdown-container">
            <a href="emp_add.php"><i class="fa-solid fa-plus"></i> Add New Employee</a>
            <a href="emp_view.php"><i class="fa-solid fa-key"></i> Manage Employees</a>
        </div>

			<button class="dropdown-btn"><i class="fa-solid fa-user"></i>Sale Record
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="sale_view.php"><i class="fa-solid fa-cart-shopping"></i>view sales</a>
			
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
   
    
        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="search" placeholder="Search by Customer, Employee, Medicine..." onkeyup="filterTable()">
        </div>

        <table id="billsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sale ID</th>
                    <th>Sale Date</th>
                    <th>Employee Name</th>
                    <th>Customer Name</th>
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Grand Total</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('127.0.0.1', 'root', '', 'pharmacy_system');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch bills data
                $sql = "SELECT * FROM bills";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['sale_id']}</td>
                                <td>{$row['sale_date']}</td>
                                <td>{$row['employee_name']}</td>
                                <td>{$row['customer_name']}</td>
                                <td>{$row['medid']}</td>
                                <td>{$row['medname']}</td>
                                <td>{$row['qty']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['grand_total']}</td>
                                <td>{$row['created_at']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No bills found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function filterTable() {
            let searchValue = document.getElementById('search').value.toLowerCase();
            let rows = document.querySelectorAll("#billsTable tbody tr");

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    row.style.display = "";
                    highlightMatches(row, searchValue);
                } else {
                    row.style.display = "none";
                }
            });
        }

        function highlightMatches(row, searchValue) {
            row.innerHTML = row.innerHTML.replace(/<span class="highlight">|<\/span>/g, ''); // Remove old highlights

            if (searchValue) {
                let regex = new RegExp(searchValue, "gi");
                row.innerHTML = row.innerHTML.replace(regex, match => `<span class="highlight">${match}</span>`);
            }
        }
    </script>
    	<script src="a.js"></script>
</body>
</html>
