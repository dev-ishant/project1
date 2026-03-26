<?php

/**
 * PROJECT1 Theme Functions
 */

/* ------------------------------------------
   1. ENQUEUE STYLES & SCRIPTS
   ------------------------------------------ */
function project1_scripts() {
    // Main stylesheet
    wp_enqueue_style( 'project1-style', get_stylesheet_uri(), array(), '1.2' );

    // Google Fonts — Inter
    wp_enqueue_style(
        'project1-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Bootstrap Icons CDN
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        array(),
        '1.11.3'
    );

    // Cookie Consent Script
    wp_enqueue_script( 'cookie-consent-js', get_template_directory_uri() . '/assets/js/cookie-consent.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'project1_scripts' );

/**
 * Handle hamburger menu toggle, scroll-to-top, user auth interactivity.
 */
function project1_footer_scripts() {
    ?>
    <script>
    (function() {
        // Hamburger menu
        var toggle = document.getElementById("nav-toggle");
        var nav    = document.getElementById("site-navigation");
        if (toggle && nav) {
            toggle.addEventListener("click", function() {
                toggle.classList.toggle("is-active");
                nav.classList.toggle("is-open");
            });
        }

        // Scroll to top
        var scrollBtn = document.getElementById("scroll-top");
        if (scrollBtn) {
            scrollBtn.style.opacity = "0";
            scrollBtn.style.transition = "opacity 0.3s";
            window.addEventListener("scroll", function() {
                scrollBtn.style.opacity = window.scrollY > 300 ? "1" : "0";
                scrollBtn.style.pointerEvents = window.scrollY > 300 ? "all" : "none";
            });
            scrollBtn.addEventListener("click", function() {
                window.scrollTo({ top: 0, behavior: "smooth" });
            });
        }

        // User avatar dropdown toggle
        var avatarWrap = document.getElementById("user-avatar-wrap");
        if (avatarWrap) {
            avatarWrap.addEventListener("click", function(e) {
                e.stopPropagation();
                avatarWrap.classList.toggle("open");
            });
            document.addEventListener("click", function() {
                avatarWrap.classList.remove("open");
            });
        }

        // Logout button
        var logoutBtn = document.getElementById("btn-logout");
        if (logoutBtn && typeof sstAuth !== "undefined") {
            logoutBtn.addEventListener("click", function(e) {
                e.preventDefault();
                fetch(sstAuth.ajaxUrl, {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({
                        action: "sst_logout_ajax",
                        nonce:  sstAuth.nonce
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) window.location.href = data.data.redirect;
                });
            });
        }
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'project1_footer_scripts' );


/* ------------------------------------------
   2. THEME SETUP
   ------------------------------------------ */
function project1_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Header Menu', 'project1' ),
        'footer-menu'  => esc_html__( 'Footer Menu',         'project1' ),
    ) );
}
add_action( 'after_setup_theme', 'project1_setup' );


/* ------------------------------------------
   3. HELPER FUNCTIONS
   ------------------------------------------ */
function sst_opt( $option, $default = '' ) {
    return $default;
}


/* ------------------------------------------
   4. AUTH AJAX HANDLERS
   ------------------------------------------ */

/** AJAX: Login */
function sst_login_ajax() {
    check_ajax_referer( 'sst_auth_nonce', 'nonce' );

    $username = sanitize_text_field( $_POST['username'] ?? '' );
    $password = $_POST['password'] ?? '';
    $remember = ! empty( $_POST['remember'] );

    if ( empty( $username ) || empty( $password ) ) {
        wp_send_json_error( array( 'message' => 'Please enter your username and password.' ) );
    }

    $user = wp_signon( array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => $remember,
    ), is_ssl() );

    if ( is_wp_error( $user ) ) {
        wp_send_json_error( array( 'message' => 'Invalid username or password. Please try again.' ) );
    }

    wp_send_json_success( array(
        'message'  => 'Login successful! Redirecting…',
        'redirect' => home_url( '/' ),
    ) );
}
add_action( 'wp_ajax_nopriv_sst_login_ajax', 'sst_login_ajax' );
add_action( 'wp_ajax_sst_login_ajax',        'sst_login_ajax' );


/** AJAX: Logout */
function sst_logout_ajax() {
    check_ajax_referer( 'sst_auth_nonce', 'nonce' );
    wp_logout();
    wp_send_json_success( array( 'redirect' => home_url( '/' ) ) );
}
add_action( 'wp_ajax_sst_logout_ajax', 'sst_logout_ajax' );


/** AJAX: Password Reset */
function sst_reset_password_ajax() {
    check_ajax_referer( 'sst_auth_nonce', 'nonce' );

    $email = sanitize_email( $_POST['email'] ?? '' );

    if ( empty( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please enter your email address.' ) );
    }

    // retrieve_password() reads $_POST['user_login']
    $_POST['user_login'] = $email;
    $result = retrieve_password();

    if ( is_wp_error( $result ) ) {
        wp_send_json_error( array( 'message' => $result->get_error_message() ) );
    }

    wp_send_json_success( array( 'message' => 'Password reset link sent! Please check your email.' ) );
}
add_action( 'wp_ajax_nopriv_sst_reset_password_ajax', 'sst_reset_password_ajax' );
add_action( 'wp_ajax_sst_reset_password_ajax',        'sst_reset_password_ajax' );


/** Inject AJAX URL + nonce into page <head> */
function sst_auth_inline_data() {
    ?>
    <script>
    var sstAuth = {
        ajaxUrl: "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>",
        nonce:   "<?php echo wp_create_nonce( 'sst_auth_nonce' ); ?>",
        homeUrl: "<?php echo esc_url( home_url( '/' ) ); ?>"
    };
    </script>
    <?php
}
add_action( 'wp_head', 'sst_auth_inline_data' );
