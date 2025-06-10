<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - PHP Project</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>About Us</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            require_once '../config/config.php';
            ?>
            <h2>About Our Project</h2>
            <p>This is a sample PHP project that demonstrates a basic web application structure with PHP, CSS, and JavaScript.</p>
            <p>Features include:</p>
            <ul>
                <li>Organized folder structure</li>
                <li>Responsive design</li>
                <li>Basic form validation</li>
                <li>Modern CSS styling</li>
            </ul>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> PHP Project. All rights reserved.</p>
    </footer>

    <script src="../assets/js/main.js"></script>
</body>
</html> 