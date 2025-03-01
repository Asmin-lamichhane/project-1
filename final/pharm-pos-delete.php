<?php
include "config.php";

if (isset($_GET['slid']) && isset($_GET['mid'])) {
    $slid = $_GET['slid'];
    $mid = $_GET['mid'];

    $sql = "DELETE FROM sales_items WHERE sale_id = ? AND medid = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $slid, $mid);
        if ($stmt->execute()) {
            header("Location: pharm-pos2.php");
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
