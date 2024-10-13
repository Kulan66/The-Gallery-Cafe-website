<?php
require 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderDate = $_POST['order_date'];
    $orderTime = $_POST['order_time'];
    $meal = $_POST['meal'];
    $specialRequest = $_POST['special_request'];

    $sql = "UPDATE pre_orders SET order_date=?, order_time=?, meal=?, special_request=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $orderDate, $orderTime, $meal, $specialRequest, $id);

    if ($stmt->execute()) {
        echo '<script>
                alert("Pre-order updated.");
                window.location.href = "view_pre_orders.php";
              </script>';
    } else {
        echo '<script>
                alert("Error: ' . $stmt->error . '");
                window.location.href = "view_pre_orders.php";
              </script>';
    }

    $stmt->close();
} else {
    $sql = "SELECT * FROM pre_orders WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $preOrder = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pre-Order</title>
    <link rel="stylesheet" href="modify_pre_order.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Update Pre-Order</h2>
        <label>Order Date:</label>
        <input type="date" name="order_date" value="<?php echo htmlspecialchars($preOrder['order_date']); ?>" required>
        <label>Order Time:</label>
        <input type="time" name="order_time" value="<?php echo htmlspecialchars($preOrder['order_time']); ?>" required>
        <label>Meal:</label>
        <input type="text" name="meal" value="<?php echo htmlspecialchars($preOrder['meal']); ?>" required>
        <label>Special Request:</label>
        <textarea name="special_request"><?php echo htmlspecialchars($preOrder['special_request']); ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="view_pre_orders.php" class="btn-back">Back to Pre-Orders</a>
</body>
</html>

    <?php
}

$stmt->close();
$conn->close();
?>
