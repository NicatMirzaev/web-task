<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileHub</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php

session_start();

include_once 'components/header.php';


$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if (file_exists('pages/'.$page.'.php')) {
    $include_page = 'pages/'.$page.'.php';
} else {
    $include_page = 'pages/404.php';
}


echo '<main class="main">';


include_once $include_page;

echo '</main>';

// Include footer
include 'components/footer.php';
?>

    <script src="assets/js/main.js"></script>
</body>
</html> 