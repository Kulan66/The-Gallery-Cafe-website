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

// Handle form submissions for adding, editing, and deleting items or categories
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $name = $_POST['category_name'];
        $sql = "INSERT INTO menu_categories (name) VALUES ('$name')";
        $conn->query($sql);
    } elseif (isset($_POST['add_item'])) {
        $name = $_POST['item_name'];
        $description = $_POST['item_description'];
        $price = $_POST['item_price'];
        $image = $_POST['item_image'];
        $category_id = $_POST['category_id'];
        $sql = "INSERT INTO menu_items (name, description, price, image, category_id) VALUES ('$name', '$description', '$price', '$image', '$category_id')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_item'])) {
        $id = $_POST['item_id'];
        $name = $_POST['item_name'];
        $description = $_POST['item_description'];
        $price = $_POST['item_price'];
        $image = $_POST['item_image'];
        $category_id = $_POST['category_id'];
        $sql = "UPDATE menu_items SET name='$name', description='$description', price='$price', image='$image', category_id='$category_id' WHERE id=$id";
        $conn->query($sql);
    } elseif (isset($_POST['delete_item'])) {
        $id = $_POST['item_id'];
        $sql = "DELETE FROM menu_items WHERE id=$id";
        $conn->query($sql);
    } elseif (isset($_POST['delete_category'])) {
        $id = $_POST['category_id'];
        $sql = "DELETE FROM menu_categories WHERE id=$id";
        $conn->query($sql);
        $sql = "DELETE FROM menu_items WHERE category_id=$id";
        $conn->query($sql);
    }
}

// Fetch menu categories and items
$sql_categories = "SELECT * FROM menu_categories";
$categories = $conn->query($sql_categories);

$sql_items = "SELECT * FROM menu_items";
$items = $conn->query($sql_items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu - The Gallery Café</title>
    <link rel="stylesheet" href="manage_menu.css"> <!-- Link to external CSS for admin functionality -->
</head>
<body>
    <header>
        <h1>Manage Menu</h1>
        <!-- Admin Button -->
        <a href="admin.html" class="admin-button">Go to Dashboard</a>
    </header>

    <!-- Add Category Form -->
    <section id="add-category">
        <h2>Add New Category</h2>
        <form method="POST">
            <input type="text" name="category_name" placeholder="Category Name" required>
            <button type="submit" name="add_category">Add Category</button>
        </form>
    </section>

    <!-- Add Menu Item Form -->
    <section id="add-item">
        <h2>Add New Menu Item</h2>
        <form method="POST">
            <input type="text" name="item_name" placeholder="Dish Name" required>
            <textarea name="item_description" placeholder="Description" required></textarea>
            <input type="text" name="item_price" placeholder="Price" required>
            <input type="text" name="item_image" placeholder="Image URL" required>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php while ($row = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="add_item">Add Item</button>
        </form>
    </section>

    <!-- Menu Items List -->
    <section id="items-list">
        <h2>Menu Items</h2>
        <?php
        // Reset the $categories result set for the category dropdown
        $categories = $conn->query($sql_categories);
        while ($item = $items->fetch_assoc()): ?>
            <div class="item">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                <div>
                    <h3><?php echo $item['name']; ?></h3>
                    <p><?php echo $item['description']; ?></p>
                    <span class="price">Rs. <?php echo $item['price']; ?></span>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" name="delete_item" class="delete">Delete</button>
                    </form>
                    <!-- Edit Button and Form -->
                    <form method="POST" action="edit_item.php" style="display: inline;">
                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" name="edit_item_form">Edit</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </section>

    <!-- Categories List -->
    <section id="categories-list">
        <h2>Menu Categories</h2>
        <?php while ($category = $categories->fetch_assoc()): ?>
            <div class="category">
                <h3><?php echo $category['name']; ?></h3>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                    <button type="submit" name="delete_category" class="delete">Delete Category</button>
                </form>
            </div>
        <?php endwhile; ?>
    </section>

    <?php $conn->close(); ?>
</body>
</html>
