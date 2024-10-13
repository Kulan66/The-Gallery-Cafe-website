<?php
require 'config.php';

$id = $_GET['id'];
$sql = "UPDATE reservations SET status='Confirmed' WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo '<script>
            alert("Reservation confirmed.");
            window.location.href = "view_reservations.php";
          </script>';
} else {
    echo '<script>
            alert("Error: ' . $stmt->error . '");
            window.location.href = "view_reservations.php";
          </script>';
}

$stmt->close();
$conn->close();
?>
