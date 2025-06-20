
    <section id="contact" style="min-height:60vh;">
        <div class="auth__container">
            <div class="auth__card">
                <div class="auth__header">
                    <h1 class="auth__title">Contact Us</h1>
                </div>
                <?php
                $success = false;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $success = true;
                }
                ?>
                <?php if ($success): ?>
                    <div class="alert alert--success">Thank you for contacting us! We'll get back to you soon.</div>
                <?php else: ?>
                <form class="auth__form" method="post" action="">
                    <div class="form__group">
                        <label class="form__label" for="name">Name</label>
                        <div class="form__input-wrapper">
                            <input class="form__input" type="text" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="email">Email</label>
                        <div class="form__input-wrapper">
                            <input class="form__input" type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="message">Message</label>
                        <div class="form__input-wrapper">
                            <textarea class="form__input" id="message" name="message" rows="5" required></textarea>
                        </div>
                    </div>
                    <button class="button button--primary button--full" type="submit">Send Message</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </section>