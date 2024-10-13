<?php
session_start();
require 'config.php';  // Include your database connection file

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    die("Access denied!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Fetch role ID for the selected user_type
    $stmt = $conn->prepare("SELECT id FROM roles WHERE role_name = ?");
    $stmt->bind_param("s", $user_type);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($role_id);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $username, $password, $role_id);
        if ($stmt->execute()) {
            echo "User added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid user type!";
    }

    $stmt->close();
    $conn->close();
}
?>

