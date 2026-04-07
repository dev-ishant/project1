<?php
/**
 * Template Name: Login
 */

// Redirect already-logged-in users to home
if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/' ) );
    exit;
}

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Login Hero Section — same style as contact/services hero -->
    <section class="login-hero-section">
        <div class="container">
            <h1 class="login-hero-title">Member Login</h1>
            <p class="login-hero-subtitle">Access your account and member-only resources</p>
        </div>
    </section>

    <!-- Login Form Section -->
    <section class="login-form-section">
        <div class="login-card">

            <!-- LOGIN PANEL -->
            <div id="panel-login" class="login-panel active-panel">
                <h2 class="login-card-title">Sign In to Your Account</h2>
                <p class="login-card-subtitle">Enter your credentials below to continue.</p>

                <div id="login-message" class="auth-message" style="display:none;"></div>

                <form id="sst-login-form" class="sst-auth-form" novalidate>
                    <div class="form-field">
                        <label for="login-username">Username or Email *</label>
                        <input type="text" id="login-username" name="username" placeholder="Enter your username or email" required>
                    </div>
                    <div class="form-field">
                        <label for="login-password">Password *</label>
                        <div class="password-wrap">
                            <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" aria-label="Show password" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-check-row">
                        <label class="check-label">
                            <input type="checkbox" id="login-remember" name="remember"> Remember me
                        </label>
                        <a href="#" class="link-forgot" id="show-forgot">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn-send-pill btn-full" id="btn-login-submit">
                        <span class="btn-text">Sign In</span>
                        <span class="btn-loader" style="display:none;"><i class="bi bi-arrow-repeat spin"></i></span>
                    </button>
                </form>
            </div>

            <!-- FORGOT PASSWORD PANEL -->
            <div id="panel-forgot" class="login-panel" style="display:none;">
                <h2 class="login-card-title">Reset Your Password</h2>
                <p class="login-card-subtitle">Enter the email address associated with your account and we'll send you a reset link.</p>

                <div id="reset-message" class="auth-message" style="display:none;"></div>

                <form id="sst-reset-form" class="sst-auth-form" novalidate>
                    <div class="form-field">
                        <label for="reset-email">Email Address *</label>
                        <input type="email" id="reset-email" name="email" placeholder="e.g. you@example.com" required>
                    </div>
                    <button type="submit" class="btn-send-pill btn-full" id="btn-reset-submit">
                        <span class="btn-text">Send Reset Link</span>
                        <span class="btn-loader" style="display:none;"><i class="bi bi-arrow-repeat spin"></i></span>
                    </button>
                    <p class="back-to-login">
                        <a href="#" id="show-login"><i class="bi bi-arrow-left"></i> Back to Login</a>
                    </p>
                </form>
            </div>

        </div><!-- /.login-card -->
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const panelLogin  = document.getElementById('panel-login');
    const panelForgot = document.getElementById('panel-forgot');
    const showForgot  = document.getElementById('show-forgot');
    const showLogin   = document.getElementById('show-login');

    // Toggle panels
    if (showForgot) {
        showForgot.addEventListener('click', function (e) {
            e.preventDefault();
            panelLogin.style.display  = 'none';
            panelForgot.style.display = 'block';
        });
    }
    if (showLogin) {
        showLogin.addEventListener('click', function (e) {
            e.preventDefault();
            panelForgot.style.display = 'none';
            panelLogin.style.display  = 'block';
        });
    }

    // Password visibility toggle
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = btn.previousElementSibling;
            var icon  = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });

    // Helper: show message
    function showMsg(el, msg, isError) {
        el.textContent = msg;
        el.style.display = 'block';
        el.className = 'auth-message ' + (isError ? 'auth-error' : 'auth-success');
    }

    // Helper: loading state
    function setLoading(btn, loading) {
        btn.querySelector('.btn-text').style.display   = loading ? 'none' : 'inline';
        btn.querySelector('.btn-loader').style.display = loading ? 'inline' : 'none';
        btn.disabled = loading;
    }

    // Login form submit
    var loginForm   = document.getElementById('sst-login-form');
    var loginMsg    = document.getElementById('login-message');
    var loginSubmit = document.getElementById('btn-login-submit');

    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            setLoading(loginSubmit, true);
            loginMsg.style.display = 'none';

            var body = new URLSearchParams({
                action:   'sst_login_ajax',
                nonce:    sstAuth.nonce,
                username: document.getElementById('login-username').value,
                password: document.getElementById('login-password').value,
                remember: document.getElementById('login-remember').checked ? '1' : ''
            });

            fetch(sstAuth.ajaxUrl, { method: 'POST', body: body })
                .then(r => {
                    if (!r.ok) {
                        return r.text().then(text => {
                            throw new Error('HTTP ' + r.status + ': ' + text);
                        });
                    }
                    return r.text().then(text => {
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.error('Invalid JSON response:', text);
                            throw new Error('Invalid server response. Please check the logs.');
                        }
                    });
                })
                .then(data => {
                    setLoading(loginSubmit, false);
                    if (data && data.success) {
                        showMsg(loginMsg, data.data.message, false);
                        setTimeout(() => { window.location.href = data.data.redirect; }, 800);
                    } else if (data && data.data && data.data.message) {
                        showMsg(loginMsg, data.data.message, true);
                    } else {
                        showMsg(loginMsg, 'Server returned an error without a message.', true);
                    }
                })
                .catch(err => {
                    setLoading(loginSubmit, false);
                    console.error('Login error:', err);
                    showMsg(loginMsg, 'Something went wrong. Error: ' + err.message, true);
                });
        });
    }

    // Password reset form submit
    var resetForm   = document.getElementById('sst-reset-form');
    var resetMsg    = document.getElementById('reset-message');
    var resetSubmit = document.getElementById('btn-reset-submit');

    if (resetForm) {
        resetForm.addEventListener('submit', function (e) {
            e.preventDefault();
            setLoading(resetSubmit, true);
            resetMsg.style.display = 'none';

            var body = new URLSearchParams({
                action: 'sst_reset_password_ajax',
                nonce:  sstAuth.nonce,
                email:  document.getElementById('reset-email').value
            });

            fetch(sstAuth.ajaxUrl, { method: 'POST', body: body })
                .then(r => r.json())
                .then(data => {
                    setLoading(resetSubmit, false);
                    if (data.success) {
                        showMsg(resetMsg, data.data.message, false);
                        resetForm.reset();
                    } else {
                        showMsg(resetMsg, data.data.message, true);
                    }
                })
                .catch(() => {
                    setLoading(resetSubmit, false);
                    showMsg(resetMsg, 'Something went wrong. Please try again.', true);
                });
        });
    }
});
</script>

<?php get_footer(); ?>
