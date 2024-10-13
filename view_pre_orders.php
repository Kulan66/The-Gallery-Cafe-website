<?php
require 'config.php';

// Include the CSS file
echo '<link rel="stylesheet" type="text/css" href="view_pre_orders.css">';
 
$sql = "SELECT * FROM pre_orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Meal</th>
                    <th>Special Request</th>
                    <th>Card Name</th>
                    <th>Card Number</th>
                    <th>Card Expiry</th>
                    <th>CVC</th>
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
                <td>' . $row["order_date"] . '</td>
                <td>' . $row["order_time"] . '</td>
                <td>' . $row["meal"] . '</td>
                <td>' . $row["special_request"] . '</td>
                <td>' . $row["card_name"] . '</td>
                <td>' . $row["card_number"] . '</td>
                <td>' . $row["card_expiry"] . '</td>
                <td>' . $row["card_cvc"] . '</td>
                <td>' . $row["status"] . '</td>
                <td class="action-buttons">
                    <a href="confirm_pre_order.php?id=' . $row["id"] . '" class="confirm">Confirm</a>
                    <a href="modify_pre_order.php?id=' . $row["id"] . '" class="modify">Modify</a>
                    <a href="cancel_pre_order.php?id=' . $row["id"] . '" class="cancel">Cancel</a>
                </td>
            </tr>';
    }
    echo '</tbody>
        </table>';
} else {
    echo "No pre-orders found.";
}

// Close the connection
$conn->close();
?>

<!-- Button to go to dashboard -->
<a href="staff_interface.html" class="dashboard-button">Go to Dashboard</a>
