<?php
// Database configuration
$host = 'localhost';      // Your MySQL host (e.g., 'localhost' or a remote server)
$dbname = 'gallery_cafe'; // The name of your database
$username = 'root';       // Your MySQL username
$password = '';           // Your MySQL password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and validate the email from the POST request
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare the SQL statement
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM subscribers WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->fetchColumn() > 0) {
                $message = "<div class='card'><p>This email is already subscribed.</p></div>";
            } else {
                $stmt = $pdo->prepare("INSERT INTO subscribers (email) VALUES (:email)");
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $message = "<div class='card'><p>Subscription successful!</p></div>";
                } else {
                    $message = "<div class='card'><p>Failed to subscribe. Please try again.</p></div>";
                }
            }
        } else {
            $message = "<div class='card'><p>Invalid email address.</p></div>";
        }
    }
} catch (PDOException $e) {
    $message = "<div class='card'><p>Error: " . htmlspecialchars($e->getMessage()) . "</p></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .card p {
            margin: 0;
            color: #333333;
        }
    </style>
</head>
<body>
    <?php if (isset($message)) echo $message; ?>
</body>
</html>
