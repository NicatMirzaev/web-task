<div class="auth">
    <div class="auth__container">
        <div class="auth__card">
            <div class="auth__header">
                <h1 class="auth__title">Create Account</h1>
                <p class="auth__subtitle">Join and upload files</p>
            </div>
            <form class="auth__form" action="/register" method="POST">
                <div class="form__group">
                    <label for="username" class="form__label">Username</label>
                    <div class="form__input-wrapper">
                        <input type="text" id="username" name="username" class="form__input" required>
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