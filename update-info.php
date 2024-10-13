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

// Add a new team member
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_member'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $bio = $_POST['bio'];
    $image = $_POST['image'];
    
    $stmt = $pdo->prepare('INSERT INTO team_members (name, position, bio, image) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $position, $bio, $image]);
    header('Location:update-info.php');
    exit;
}

// Edit a team member
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_member'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $bio = $_POST['bio'];
    $image = $_POST['image'];
    
    $stmt = $pdo->prepare('UPDATE team_members SET name = ?, position = ?, bio = ?, image = ? WHERE id = ?');
    $stmt->execute([$name, $position, $bio, $image, $id]);
    header('Location: update-info.php');
    exit;
}

// Delete a team member
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM team_members WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: update-info.php');
    exit;
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
    <title>Admin | The Gallery Café</title>
    <link rel="stylesheet" href="update-info.css"> <!-- Link to external CSS -->
</head>

<body>
    <header>
        <h1>Admin - The Gallery Café</h1>
        <nav>
            <ul>
                <li><a href="admin.html">Go to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Manage Team Members</h2>
            <form method="post" action="update-info.php">
                <h3>Add New Team Member</h3>
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="position" placeholder="Position" required>
                <textarea name="bio" placeholder="Bio" required></textarea>
                <input type="text" name="image" placeholder="Image Path (e.g., chef.jpeg)" required>
                <button type="submit" name="add_member">Add Member</button>
            </form>
            <h3>Existing Team Members</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Bio</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($team_members as $member): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($member['name']); ?></td>
                        <td><?php echo htmlspecialchars($member['position']); ?></td>
                        <td><?php echo htmlspecialchars($member['bio']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" style="width: 100px;"></td>
                        <td>
                            <a href="update-info.php?edit=<?php echo $member['id']; ?>">Edit</a>
                            <a href="update-info.php?delete=<?php echo $member['id']; ?>" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (isset($_GET['edit'])): ?>
            <?php
                $id = $_GET['edit'];
                $stmt = $pdo->prepare('SELECT * FROM team_members WHERE id = ?');
                $stmt->execute([$id]);
                $member = $stmt->fetch();
            ?>
            <form method="post" action="update-info.php">
                <h3>Edit Team Member</h3>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($member['id']); ?>">
                <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
                <input type="text" name="position" value="<?php echo htmlspecialchars($member['position']); ?>" required>
                <textarea name="bio" required><?php echo htmlspecialchars($member['bio']); ?></textarea>
                <input type="text" name="image" value="<?php echo htmlspecialchars($member['image']); ?>" required>
                <button type="submit" name="edit_member">Update Member</button>
            </form>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>
