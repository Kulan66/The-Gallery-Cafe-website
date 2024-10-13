<?php
require 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $special_requests = $_POST['special_requests'];

    $sql = "UPDATE reservations SET reservation_date=?, reservation_time=?, number_of_people=?, special_requests=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $date, $time, $people, $special_requests, $id);

    if ($stmt->execute()) {
        echo '<script>
                alert("Reservation updated.");
                window.location.href = "view_reservations.php";
              </script>';
    } else {
        echo '<script>
                alert("Error: ' . $stmt->error . '");
                window.location.href = "view_reservations.php";
              </script>';
    }

    $stmt->close();
} else {
    $sql = "SELECT * FROM reservations WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservation = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Reservation</title>
        <link rel="stylesheet" href="modify reservation.css">
    </head>
    <body>
        <div class="container">
            <h2>Update Reservation</h2>
            <form method="POST" action="">
                <label>Date:</label>
                <input type="date" name="date" value="<?php echo $reservation['reservation_date']; ?>" required>
                <label>Time:</label>
                <input type="time" name="time" value="<?php echo $reservation['reservation_time']; ?>" required>
                <label>Number of People:</label>
                <input type="number" name="people" value="<?php echo $reservation['number_of_people']; ?>" required>
                <label>Special Requests:</label>
                <textarea name="special_requests"><?php echo $reservation['special_requests']; ?></textarea>
                <button type="submit">Update</button>
                <a href="view_reservations.php"><button type="button" class="secondary">Go to View Reservations</button></a>
            </form>
        </div>
    </body>
    </html>
    <?php
}

$stmt->close();
$conn->close();
?>
