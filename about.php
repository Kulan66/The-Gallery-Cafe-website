<?php

// Database connection
$host = 'localhost'; // Change if different
$db = 'gallery_cafe'; // Change to your database name
$user = 'root'; // Change to your database username
$pass = ''; // Change to your database password

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Fetch team members from the database
$stmt = $pdo->query('SELECT * FROM team_members ORDER BY id ASC');
$team_members = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | The Gallery Café</title>
    <link rel="stylesheet" href="about_styles.css"> <!-- Link to external CSS -->
    <script src="about.js" defer></script> <!-- Link to external JavaScript -->
    <link rel="icon" href="icon.ico" type="image/x-icon"> <!-- Favicon for the website -->
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <h1>The Gallery Café</h1>
            <nav>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="login.html">Reservations</a></li>
                    <li><a href="login.html">Pre-Order Your Meal</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="about.php" class="active">About Us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- About Us Section -->
    <section id="about-us">
        <div class="container">
            <h2>About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Welcome to The Gallery Café</h3>
                    <p>Founded in 2015, The Gallery Café has become a cherished destination for food lovers in Colombo. Our café combines the elegance of a fine dining experience with the warmth of a cozy retreat, offering a diverse menu that caters to all tastes and preferences.</p>
                    <p>Our mission is to provide an exceptional dining experience where every visit feels special. From our carefully crafted menu to our dedicated team, we are committed to creating moments that you will cherish.</p>

                    <h3>Our Story</h3>
                    <p>The Gallery Café was established with the vision of creating a space where art, culture, and cuisine come together. Inspired by the rich cultural heritage of Colombo, we envisioned a café that not only offers delicious food but also serves as a venue for community events, art exhibitions, and cultural gatherings.</p>
                    <p>Over the years, we have grown from a small café into a beloved institution in the heart of Colombo. Our success is a testament to the support of our wonderful customers and the hard work of our dedicated team.</p>

                    <h3>Our Values</h3>
                    <ul>
                        <li><strong>Quality:</strong> We are committed to using only the finest ingredients in our dishes and delivering top-notch service to our guests.</li>
                        <li><strong>Community:</strong> We strive to be a positive force in our community, supporting local artists and participating in charitable initiatives.</li>
                        <li><strong>Innovation:</strong> We continuously seek new ways to enhance our menu and services, ensuring that every visit to The Gallery Café is a unique experience.</li>
                        <li><strong>Environment:</strong> We are dedicated to implementing sustainable practices in our operations to minimize our environmental impact.</li>
                    </ul>

                    <h3>Meet Our Team</h3>
                    <div class="team-members">
                        <?php foreach ($team_members as $member): ?>
                        <div class="team-member">
                            <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                            <h4><?php echo htmlspecialchars($member['name']); ?></h4>
                            <p><?php echo htmlspecialchars($member['position']); ?></p>
                            <p><?php echo htmlspecialchars($member['bio']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <h3>Our Future Plans</h3>
                    <p>As we look to the future, we are excited to expand our offerings and continue to enrich the community. We plan to introduce new menu items, host more cultural events, and explore opportunities for expanding our café to new locations.</p>
                    <p>Thank you for being a part of our journey. We look forward to welcoming you to The Gallery Café and sharing many more wonderful experiences together.</p>
                </div>
                <video src="video2.mp4" autoplay muted loop></video>
        
            </div>
        </div>
    </section>

    <!-- Newsletter Signup Section -->
    <section id="newsletter">
        <div class="container">
            <h2>Stay Updated</h2>
            <p>Sign up for our newsletter to get the latest updates, offers, and news from The Gallery Café.</p>
            <form action="subscribe.php" method="post">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit" class="cta-button">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Map Section -->
    <section id="map">
        <div class="container">
            <h2>Find Us</h2>
            <div id="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.931616450533!2d79.85229727448267!3d6.8987823186895705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259602cb3bc09%3A0x677419394138f674!2sThe%20Gallery%20Caf%C3%A9!5e0!3m2!1sen!2slk!4v1721249421359!5m2!1sen!2slk" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
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
</body>

</html>
