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

// Fetch menu categories
$sql = "SELECT * FROM menu_categories";
$result = $conn->query($sql);
$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - The Gallery Café</title>
    <link rel="stylesheet" href="menu styles.css"> <!-- Link to external CSS -->
    <script src="menu script.js" defer></script> <!-- Link to external JavaScript for menu functionality -->
    <link rel="icon" href="icon.ico" type="image/x-icon"> <!-- Favicon for the website -->
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <h1>The Gallery Café</h1>
            <nav>
                <ul>
                    <li><a href="menu.php" class="active">Menu</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="about.php">About Us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Menu Hero Section -->
    <section id="menu-hero">
        <div class="hero-content">
            <h2>Explore Our Delicious Menu</h2>
            <p>Discover a range of cuisines from Sri Lankan to Japanese, all crafted to perfection.</p>
        </div>
    </section>
    

    <!-- Menu Search Bar Section -->
    <section id="menu-search">
        <div class="container">
            <input type="text" id="search-bar" placeholder="Search for dishes..." oninput="filterMenu()">
        </div>
    </section>

    <!-- Menu Sections -->
    <section id="menu">
        <div class="container">
            <?php foreach ($categories as $category): ?>
                <div class="menu-category" id="<?php echo htmlspecialchars($category['id']); ?>">
                    <h2><?php echo htmlspecialchars($category['name']); ?></h2>
                    <div class="menu-items">
                        <?php
                        // Fetch menu items for the current category
                        $category_id = $category['id'];
                        $item_sql = "SELECT * FROM menu_items WHERE category_id = $category_id";
                        $item_result = $conn->query($item_sql);
                        while ($item = $item_result->fetch_assoc()):
                        ?>
                            <div class="menu-item">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                <div class="menu-info">
                                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                                    <span class="price">Rs. <?php echo htmlspecialchars($item['price']); ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>About Us: The Gallery Café is dedicated to providing the best dining experience in Colombo.</p>
            <p>Head Office Address: 115, Sir Chittampalam A Gardiner Mawatha, 00200, Colombo, Sri Lanka</p>
            <p>Telephone: +940760082003</p>
            <p>Email: <a href="mailto:info@gallerycafe.com">gallerycafe@gmail.com</a></p>
            <ul class="social-icons">
                <li><a href="https://facebook.com/gallerycafe" target="_blank"><img src="facebook.png" alt="Facebook"></a></li>
                <li><a href="https://twitter.com/gallerycafe" target="_blank"><img src="twitter.png" alt="Twitter"></a></li>
                <li><a href="https://instagram.com/gallerycafe" target="_blank"><img src="instagram.jpg" alt="Instagram"></a></li>
                <li><a href="https://linkedin.com/company/gallerycafe" target="_blank"><img src="linkedin.png" alt="LinkedIn"></a></li>
            </ul>
        </div>
    </footer>

    <?php $conn->close(); ?>
</body>
</html>
