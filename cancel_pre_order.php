<?php
require 'config.php';

$id = $_GET['id'];
$sql = "UPDATE pre_orders SET status='Canceled' WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo '<script>
            alert("Pre-order canceled.");
            window.location.href = "view_pre_orders.php";
          </script>';
} else {
    echo '<script>
            alert("Error: ' . $stmt->error . '");
            window.location.href = "view_pre_orders.php";
          </script>';
}

$stmt->close();
$conn->close();
?>
