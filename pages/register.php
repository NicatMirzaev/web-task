<?php
// Include database connection
require_once 'config/database.php';

// Initialize variables
$errors = [];
$preservedUsername = '';

// Get error messages and preserved data from session
if (isset($_SESSION['register_errors'])) {
    $errors = $_SESSION['register_errors'];
    unset($_SESSION['register_errors']);
}

if (isset($_SESSION['register_username'])) {
    $preservedUsername = $_SESSION['register_username'];
    unset($_SESSION['register_username']);
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $errors = [];
    
    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    } elseif (strlen($username) > 50) {
        $errors[] = "Username must be less than 50 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }
    
    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    } elseif (strlen($password) > 255) {
        $errors[] = "Password must be less than 255 characters";
    }
    
    // Check if username already exists
    if (empty($errors)) {
        $existingUser = $db->fetch("SELECT id FROM users WHERE username = ?", [$username]);
        if ($existingUser) {
            $errors[] = "Username already exists. Please choose a different username.";
        }
    }
    
    // If no errors, register the user
    if (empty($errors)) {
        try {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user into database
            $userId = $db->insert("INSERT INTO users (username, password) VALUES (?, ?)", [$username, $hashedPassword]);
            
            if ($userId) {
                // Registration successful
                $_SESSION['success_message'] = "Registration successful! You can now login.";
                header("Location: ?page=login");
                exit();
            } else {
                $errors[] = "Registration failed. Please try again.";
            }
            
        } catch (Exception $e) {
            $errors[] = "An error occurred during registration. Please try again.";
        }
    }
    
    // If there are errors, store them in session and redirect back to register page
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        $_SESSION['register_username'] = $username; // Preserve username for form
        header("Location: ?page=register");
        exit();
    }
}

?>

<div class="auth">
    <div class="auth__container">
        <div class="auth__card">
            <div class="auth__header">
                <h1 class="auth__title">Create Account</h1>
                <p class="auth__subtitle">Join and upload files</p>
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert--error">
                    <ul class="alert__list">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form class="auth__form" action="?page=register" method="POST">
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
                <button type="submit" class="button button--primary button--full">Create Account</button>
            </form>
            <div class="auth__footer">
                <p class="auth__text">Already have an account? <a href="?page=login" class="auth__link">Login here</a></p>
            </div>
        </div>
    </div>
</div> 