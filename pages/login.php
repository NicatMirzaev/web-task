<?php
// Include database connection
require_once 'config/database.php';


$errors = [];
$preservedUsername = '';


if (isset($_SESSION['login_errors'])) {
    $errors = $_SESSION['login_errors'];
    unset($_SESSION['login_errors']);
}

if (isset($_SESSION['login_username'])) {
    $preservedUsername = $_SESSION['login_username'];
    unset($_SESSION['login_username']);
}


$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['success_message']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $errors = [];
    

    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
 
    if (empty($errors)) {
        try {
            
            $user = $db->fetch("SELECT id, username, password FROM users WHERE username = ?", [$username]);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = true;
                
    
                header("Location: ?page=home");
                exit();
            } else {
                // Invalid credentials
                $errors[] = "Invalid username or password";
            }
            
        } catch (Exception $e) {
            $errors[] = "An error occurred during login. Please try again.";
        }
    }
    
    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        $_SESSION['login_username'] = $username;
        header("Location: ?page=login");
        exit();
    }
}
?>

<div class="auth">
    <div class="auth__container">
        <div class="auth__card">
            <div class="auth__header">
                <h1 class="auth__title">Login</h1>
                <p class="auth__subtitle">Welcome back to FileHub</p>
            </div>
            
            <?php if (!empty($successMessage)): ?>
                <div class="alert alert--success">
                    <p><?php echo htmlspecialchars($successMessage); ?></p>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert--error">
                    <ul class="alert__list">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form class="auth__form" action="?page=login" method="POST">
                <div class="form__group">
                    <label for="username" class="form__label">Username</label>
                    <div class="form__input-wrapper">
                        <input type="text" id="username" name="username" class="form__input" 
                               value="<?php echo htmlspecialchars($preservedUsername); ?>" required>
                    </div>
                </div>
                <div class="form__group">
                    <label for="password" class="form__label">Password</label>
                    <div class="form__input-wrapper">
                        <input type="password" id="password" name="password" class="form__input" required>
                    </div>
                </div>
                <button type="submit" class="button button--primary button--full">Login</button>
            </form>
            <div class="auth__footer">
                <p class="auth__text">Don't have an account? <a href="?page=register" class="auth__link">Register here</a></p>
            </div>
        </div>
    </div>
</div> 