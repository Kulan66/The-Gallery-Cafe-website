<?php
session_start();
require 'config.php';  // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database
    $stmt = $conn->prepare("SELECT id, password, role_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $stored_password, $role_id);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && $password === $stored_password) {
        // Fetch the role name
        $stmt_role = $conn->prepare("SELECT role_name FROM roles WHERE id = ?");
        $stmt_role->bind_param("i", $role_id);
        $stmt_role->execute();
        $stmt_role->store_result();
        $stmt_role->bind_result($role_name);
        $stmt_role->fetch();

        // Set session variables
        $_SESSION['user_id'] = $id;
        $_SESSION['user_type'] = $role_name;

        // Redirect based on user type
        if ($role_name == 'Customer') {
            header("Location: user.html");
        } elseif ($role_name == 'Operational Staff') {
            header("Location: staff_interface.html");
        } elseif ($role_name == 'Admin') {
            header("Location: admin.html");
        }
    } else {
        echo "Invalid login credentials!";
    }

    $stmt->close();
    $stmt_role->close();
    $conn->close();
}
?>
