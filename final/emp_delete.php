<?php
include "config.php";

// Check if `id` is set and validate it
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = mysqli_real_escape_string ($conn, $_GET['id']);
    
    // Confirm the record exists before attempting deletion
    $checkSql = "SELECT * FROM employee WHERE eid='$id'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Perform the delete operation
        $sql = "DELETE FROM employee WHERE eid='$id'";
        if ($conn->query($sql)) {
            echo "<script>
                    alert('Employee successfully deleted!');
                    window.location.href = 'emp_view.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error! Unable to delete the employee. Please try again.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error! Employee record not found.');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request! Employee ID is missing or invalid.');
            window.history.back();
          </script>";
}

$conn->close();
?>
