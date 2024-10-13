<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the item data based on item_id
$item_id = $_POST['item_id'];
$sql = "SELECT * FROM menu_items WHERE id=$item_id";
$item_result = $conn->query($sql);
$item = $item_result->fetch_assoc();

$sql_categories = "SELECT * FROM menu_categories";
$categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item - The Gallery Café</title>
    <link rel="stylesheet" href="edit_item.css"> <!-- Link to external CSS for admin functionality -->
</head>
<body>
    <header>
        <h1>Edit Menu Item</h1>
    </header>

    <section id="edit-item">
        <h2>Edit Menu Item</h2>
        <form method="POST" action="manage_menu.php">
            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
            <input type="text" name="item_name" value="<?php echo $item['name']; ?>" required>
            <textarea name="item_description" required><?php echo $item['description']; ?></textarea>
            <input type="text" name="item_price" value="<?php echo $item['price']; ?>" required>
            <input type="text" name="item_image" value="<?php echo $item['image']; ?>" required>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php while ($row = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $item['category_id']) ? 'selected' : ''; ?>>
                        <?php echo $row['name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="edit_item">Update Item</button>
        </form>
    </section>

    <?php $conn->close(); ?>
</body>
</html>
