<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - PHP Project</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Contact Us</h1>
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

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

                if ($name && $email && $message) {
                    // Here you would typically send an email or save to database
                    echo "<div class='success'>Thank you for your message! We'll get back to you soon.</div>";
                } else {
                    echo "<div class='error'>Please fill in all fields correctly.</div>";
                }
            }
            ?>

            <form method="POST" action="contact.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> PHP Project. All rights reserved.</p>
    </footer>

    <script src="../assets/js/main.js"></script>
</body>
</html> 