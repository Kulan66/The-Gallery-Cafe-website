<?php
require 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$name = $conn->real_escape_string(trim($_POST['name']));
$email = $conn->real_escape_string(trim($_POST['email']));
$phone = $conn->real_escape_string(trim($_POST['phone']));
$orderDate = $conn->real_escape_string(trim($_POST['order-date']));
$orderTime = $conn->real_escape_string(trim($_POST['order-time']));
$meal = $conn->real_escape_string(trim($_POST['meal']));
$specialRequest = $conn->real_escape_string(trim($_POST['special-request']));
$cardName = $conn->real_escape_string(trim($_POST['card-name']));
$cardNumber = $conn->real_escape_string(trim($_POST['card-number']));
$cardExpiry = $conn->real_escape_string(trim($_POST['card-expiry']));
$cardCvc = $conn->real_escape_string(trim($_POST['card-cvc']));

// Prepare an SQL statement to prevent SQL injection
$sql = "INSERT INTO pre_orders (name, email, phone, order_date, order_time, meal, special_request, card_name, card_number, card_expiry, card_cvc) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}

// Bind parameters to the SQL statement
$stmt->bind_param('sssssssssss', $name, $email, $phone, $orderDate, $orderTime, $meal, $specialRequest, $cardName, $cardNumber, $cardExpiry, $cardCvc);

// Execute the SQL statement
if ($stmt->execute()) {
    $success = true;
    $message = "Order successfully submitted!";
} else {
    $success = false;
    $message = "Error submitting your order: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Submission</title>
    <style>
        /* Basic styles for the popup card */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- The Modal -->
    <div id="orderModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $message; ?></p>
        </div>
    </div>

    <script>
        // JavaScript to handle the modal popup
        var modal = document.getElementById("orderModal");
        var span = document.getElementsByClassName("close")[0];

        // Show the modal if the order was successfully submitted
        <?php if ($success): ?>
        window.onload = function() {
            modal.style.display = "block";
        };
        <?php endif; ?>

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
