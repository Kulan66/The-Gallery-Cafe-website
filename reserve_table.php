<?php
// reserve_table.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];
$people = $_POST['people'];
$special_requests = $_POST['special_requests'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, reservation_date, reservation_time, number_of_people, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $name, $email, $phone, $date, $time, $people, $special_requests);

if ($stmt->execute()) {
    // If reservation is successful, show a success message
    echo '<script>
            alert("Reservation made successfully.");
            window.location.href = "user.html"; // Redirect to the home page or another page
          </script>';
} else {
    // If there is an error, show an error message
    echo '<script>
            alert("Error: ' . $stmt->error . '");
            window.location.href = "user.html"; // Redirect to the home page or another page
          </script>';
}

$stmt->close();
$conn->close();
?>
