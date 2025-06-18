<!DOCTYPE html>

    <div id="header">
        <div class="header__nav">
            <div class="header__logo">
                <a href="?page=home" class="header__logo-link">
                    <img src="assets/images/logo.svg" alt="Logo" class="header__logo-image">
                </a>
            </div>
            <div class="header__menu">
                <a href="?page=home" class="header__menu-link">Home</a>
                <a href="?page=contact" class="header__menu-link">Contact us</a>
                <a href="?page=faq" class="header__menu-link">FAQ</a>
            </div>
            <div class="header__actions">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <span class="header__welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <a href="?page=dashboard" class="button button--outline">Dashboard</a>
                    <a href="?page=logout" class="button button--primary">Logout</a>
                <?php else: ?>
                    <a href="?page=login" class="button button--outline">Login</a>
                    <a href="?page=register" class="button button--primary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
