<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Project</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <main>
        <div class="container">
            <?php
            // Include configuration file
            require_once 'config/config.php';
            
            // Get the current page from URL parameter, default to 'home'
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            // Define the content based on the page
            switch ($page) {
                case 'home':
                    echo "<h2>Welcome to the Homepage</h2>";
                    echo "<p>This is a basic PHP project structure.</p>";
                    break;
                    
                case 'about':
                    echo "<h2>About Us</h2>";
                    echo "<p>Learn more about our project and team.</p>";
                    break;
                    
                case 'contact':
                    echo "<h2>Contact Us</h2>";
                    echo "<p>Get in touch with us for any inquiries.</p>";
                    break;
                    
                default:
                    echo "<h2>404 - Page Not Found</h2>";
                    echo "<p>The requested page could not be found.</p>";
                    break;
            }
            ?>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script src="assets/js/main.js"></script>
</body>
</html> 