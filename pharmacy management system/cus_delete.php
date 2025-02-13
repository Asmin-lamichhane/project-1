<?php
include "config.php";

// Check if the ID is set in the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate the ID (to prevent SQL injection)
    if (!is_numeric($id)) {
        echo "<script>
                alert('Invalid Customer ID.');
                window.location.href = 'customer-view.php';
              </script>";
        exit();
    }

    // Perform the deletion query
    $sql = "DELETE FROM customer WHERE cid='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Customer successfully deleted!');
                window.location.href = 'customer-view.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting customer. Please try again.');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('No Customer ID specified.');
            window.location.href = 'customer-view.php';
          </script>";
}

$conn->close();
?>
