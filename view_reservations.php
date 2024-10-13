<?php
require 'config.php';

$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reservations</title>
        <link rel="stylesheet" href="view_reservations.css">  <!-- Updated CSS link -->
        
    </head>
    <body>
        <div class="container">  <!-- Added container div -->
            <h1>Reservations</h1>
            <div class="button-container">  <!-- Added container for the button -->
                <a href="staff_interface.html" class="cta-button">Go to Dashboard</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>People</th>
                        <th>Special Requests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["name"] . '</td>
                <td>' . $row["email"] . '</td>
                <td>' . $row["phone"] . '</td>
                <td>' . $row["reservation_date"] . '</td>
                <td>' . $row["reservation_time"] . '</td>
                <td>' . $row["number_of_people"] . '</td>
                <td>' . $row["special_requests"] . '</td>
                <td>' . $row["status"] . '</td>
                <td>
                    <a href="confirm_reservation.php?id=' . $row["id"] . '">Confirm</a> |
                    <a href="modify_reservation.php?id=' . $row["id"] . '">Modify</a> |
                    <a href="cancel_reservation.php?id=' . $row["id"] . '">Cancel</a>
                </td>
            </tr>';
    }
    echo '</tbody>
        </table>
    </div>
    </body>
    </html>';
} else {
    echo "No reservations found.";
}

$conn->close();
?>
