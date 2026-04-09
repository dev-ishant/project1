<?php

/**
 * PROJECT1 Theme Functions
 */

/* ------------------------------------------
 1. ENQUEUE STYLES & SCRIPTS
 ------------------------------------------ */
function project1_scripts()
{
    // Main stylesheet
    wp_enqueue_style('project1-style', get_stylesheet_uri(), array(), '1.3');

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
    wp_enqueue_script('cookie-consent-js', get_template_directory_uri() . '/assets/js/cookie-consent.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'project1_scripts');

/**
 * Handle hamburger menu toggle, scroll-to-top, user auth interactivity.
 */
function project1_footer_scripts()
{
    ?>
    <script>
        (function () {
            // Hamburger menu
            var toggle = document.getElementById("nav-toggle");
            var nav = document.getElementById("site-navigation");
            if (toggle && nav) {
                toggle.addEventListener("click", function () {
                    toggle.classList.toggle("is-active");
                    nav.classList.toggle("is-open");
                });
            }

            // Scroll to top
            var scrollBtn = document.getElementById("scroll-top");
            if (scrollBtn) {
                scrollBtn.style.opacity = "0";
                scrollBtn.style.transition = "opacity 0.3s";
                window.addEventListener("scroll", function () {
                    scrollBtn.style.opacity = window.scrollY > 300 ? "1" : "0";
                    scrollBtn.style.pointerEvents = window.scrollY > 300 ? "all" : "none";
                });
                scrollBtn.addEventListener("click", function () {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                });
            }

            // User avatar dropdown toggle
            var avatarWrap = document.getElementById("user-avatar-wrap");
            if (avatarWrap) {
                avatarWrap.addEventListener("click", function (e) {
                    e.stopPropagation();
                    avatarWrap.classList.toggle("open");
                });
                document.addEventListener("click", function () {
                    avatarWrap.classList.remove("open");
                });
            }

            // Logout button
            var logoutBtn = document.getElementById("btn-logout");
            if (logoutBtn && typeof sstAuth !== "undefined") {
                logoutBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    fetch(sstAuth.ajaxUrl, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: new URLSearchParams({
                            action: "sst_logout_ajax",
                            nonce: sstAuth.nonce
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
add_action('wp_footer', 'project1_footer_scripts');


/* ------------------------------------------
 2. THEME SETUP
 ------------------------------------------ */
function project1_setup()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));
    register_nav_menus(array(
        'primary-menu' => esc_html__('Primary Header Menu', 'project1'),
        'footer-menu' => esc_html__('Footer Menu', 'project1'),
    ));
}
add_action('after_setup_theme', 'project1_setup');


/* ------------------------------------------
 3. AUTH AJAX HANDLERS
 ------------------------------------------ */

/** AJAX: Login */
function sst_login_ajax()
{
    // Start output buffering to capture any stray notices/warnings
    ob_start();

    $nonce = $_POST['nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'sst_auth_nonce')) {
        if (ob_get_length())
            ob_clean();
        wp_send_json_error(array('message' => 'Security check failed. Please refresh the page.'));
    }

    $username = sanitize_text_field($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = !empty($_POST['remember']);

    if (empty($username) || empty($password)) {
        if (ob_get_length())
            ob_clean();
        wp_send_json_error(array('message' => 'Please enter your username and password.'));
    }

    $user = wp_signon(array(
        'user_login' => $username,
        'user_password' => $password,
        'remember' => $remember,
    ), is_ssl());

    if (is_wp_error($user)) {
        if (ob_get_length())
            ob_clean();
        wp_send_json_error(array('message' => 'Invalid username or password. Please try again.'));
    }

    // Explicitly set the auth cookie and current user to be double sure
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, $remember);

    // Clear buffer and send success
    if (ob_get_length())
        ob_clean();
    wp_send_json_success(array(
        'message' => 'Login successful! Redirecting…',
        'redirect' => home_url('/'),
    ));
}
add_action('wp_ajax_nopriv_sst_login_ajax', 'sst_login_ajax');
add_action('wp_ajax_sst_login_ajax', 'sst_login_ajax');


/** AJAX: Logout */
function sst_logout_ajax()
{
    $nonce = $_POST['nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'sst_auth_nonce')) {
        wp_send_json_error(array('message' => 'Security check failed.'));
    }
    wp_logout();
    wp_send_json_success(array('redirect' => home_url('/')));
}
add_action('wp_ajax_sst_logout_ajax', 'sst_logout_ajax');


/** AJAX: Password Reset */
function sst_reset_password_ajax()
{
    check_ajax_referer('sst_auth_nonce', 'nonce');

    $email = sanitize_email($_POST['email'] ?? '');

    if (empty($email)) {
        wp_send_json_error(array('message' => 'Please enter your email address.'));
    }

    // retrieve_password() reads $_POST['user_login']
    $_POST['user_login'] = $email;
    $result = retrieve_password();

    if (is_wp_error($result)) {
        wp_send_json_error(array('message' => $result->get_error_message()));
    }

    wp_send_json_success(array('message' => 'Password reset link sent! Please check your email.'));
}
add_action('wp_ajax_nopriv_sst_reset_password_ajax', 'sst_reset_password_ajax');
add_action('wp_ajax_sst_reset_password_ajax', 'sst_reset_password_ajax');


/** AJAX: Update Password */
function sst_update_password_ajax()
{
    $nonce = $_POST['_nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'sst_auth_nonce')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh the page.'));
    }

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Session expired. Please log in again.'));
    }

    $current_pwd = $_POST['current_password'] ?? '';
    $new_pwd = $_POST['new_password'] ?? '';
    $user = wp_get_current_user();

    // Verify current password
    if (!wp_check_password($current_pwd, $user->user_pass, $user->ID)) {
        wp_send_json_error(array('message' => 'The current password you entered is incorrect.'));
    }

    // Password must be at least 8 chars
    if (strlen($new_pwd) < 8) {
        wp_send_json_error(array('message' => 'New password must be at least 8 characters long.'));
    }

    // Update password
    wp_set_password($new_pwd, $user->ID);

    wp_send_json_success(array('message' => 'Password changed successfully!'));
}
add_action('wp_ajax_sst_update_password_ajax', 'sst_update_password_ajax');


/** AJAX: Save Payroll Deduction */
function sst_save_payroll_deduction_ajax()
{
    $nonce = $_POST['nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'sst_auth_nonce')) {
        wp_send_json_error(array('message' => 'Security check failed.'));
    }

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please log in to submit deductions.'));
    }

    $amount = floatval($_POST['amount'] ?? 0);
    $country = sanitize_text_field($_POST['country'] ?? 'General');

    if ($amount <= 0) {
        wp_send_json_error(array('message' => 'Please enter a valid amount.'));
    }

    $user_id = get_current_user_id();

    // 4. Create Deduction Post (Visible in Admin as Pending)
    $user = wp_get_current_user();
    wp_insert_post(array(
        'post_type' => 'sst_deduction',
        'post_title' => 'Deduction Request: ' . $user->display_name . ' - $' . number_format($amount, 2),
        'post_content' => "User: {$user->display_name} ({$user->user_email})\nCountry: $country\nAmount: $" . number_format($amount, 2),
        'post_status' => 'pending',
        'meta_input' => array(
            '_sst_amount' => $amount,
            '_sst_country' => $country,
            '_sst_user_id' => $user_id,
            '_sst_date' => date('Y-m-d H:i:s'),
            '_sst_processed' => 'no' // Flag to prevent double counting
        )
    ));

    wp_send_json_success(array(
        'message' => 'Deduction submitted! It will appear on your dashboard after administrator confirmation.',
        'new_total' => number_format(floatval(get_user_meta($user_id, '_sst_total_deduction', true)), 2)
    ));
}
add_action('wp_ajax_sst_save_payroll_deduction_ajax', 'sst_save_payroll_deduction_ajax');

/**
 * Handle Meta Updates ONLY when Deduction is Published (Confirmed)
 */
function sst_handle_deduction_confirmation($new_status, $old_status, $post)
{
    if ($post->post_type !== 'sst_deduction' || $new_status !== 'publish' || $old_status === 'publish') {
        return;
    }

    $processed = get_post_meta($post->ID, '_sst_processed', true);
    if ($processed === 'yes') {
        return;
    }

    $amount = floatval(get_post_meta($post->ID, '_sst_amount', true));
    $user_id = intval(get_post_meta($post->ID, '_sst_user_id', true));
    $country = get_post_meta($post->ID, '_sst_country', true);

    if ($amount > 0 && $user_id > 0) {
        // 1. Total amount tracking
        $current_total = get_user_meta($user_id, '_sst_total_deduction', true);
        $new_total = floatval($current_total) + $amount;
        update_user_meta($user_id, '_sst_total_deduction', $new_total);

        // 2. Donation History Tracking
        $history = get_user_meta($user_id, '_sst_donation_history', true);
        if (!is_array($history))
            $history = array();
        $history[] = array(
            'country' => $country,
            'amount' => $amount,
            'date' => date('Y-m-d H:i')
        );
        update_user_meta($user_id, '_sst_donation_history', $history);

        // 3. Unique Countries Tracking
        $countries = get_user_meta($user_id, '_sst_donated_countries', true);
        if (!is_array($countries))
            $countries = array();
        if (!in_array($country, $countries) && $country !== 'General') {
            $countries[] = $country;
            update_user_meta($user_id, '_sst_donated_countries', $countries);
        }

        // Mark as processed
        update_post_meta($post->ID, '_sst_processed', 'yes');
    }
}
add_action('transition_post_status', 'sst_handle_deduction_confirmation', 10, 3);
/** Inject AJAX URL + nonce into page <head> */
function sst_auth_inline_data()
{
    ?>
    <script>
        var sstAuth = {
            ajaxUrl: "<?php echo esc_url(admin_url('admin-ajax.php')); ?>",
            nonce: "<?php echo wp_create_nonce('sst_auth_nonce'); ?>",
            homeUrl: "<?php echo esc_url(home_url('/')); ?>"
        };
    </script>
    <?php
}
add_action('wp_head', 'sst_auth_inline_data');


/* ------------------------------------------
 6. CONTACT ENQUIRIES CPT & HANDLER
 ------------------------------------------ */

/** Register CPT: Enquiry */
function sst_register_cpts()
{
    // Inquiries
    register_post_type('sst_enquiry', array(
        'labels' => array(
            'name' => 'Inquiries',
            'singular_name' => 'Inquiry',
            'add_new' => 'Add New Inquiry',
            'add_new_item' => 'Add New Inquiry',
            'edit_item' => 'View Inquiry',
            'all_items' => 'All Inquiries',
            'menu_name' => 'Inquiries',
        ),
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-email-alt',
        'has_archive' => false,
    ));

    // Deductions (Payments)
    register_post_type('sst_deduction', array(
        'labels' => array(
            'name' => 'Deductions',
            'singular_name' => 'Deduction',
            'add_new' => 'Add New Deduction',
            'add_new_item' => 'Add New Deduction',
            'edit_item' => 'View Deduction',
            'all_items' => 'All Deductions',
            'menu_name' => 'Payroll Deductions',
        ),
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-money-alt',
        'has_archive' => false,
    ));
}
add_action('init', 'sst_register_cpts');


/** AJAX Handler for Inquiries (Contact Forms + Donation Form) */
function sst_handle_submission_ajax()
{
    // Start output buffering
    ob_start();

    // Verify Nonce
    $nonce = $_POST['nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'sst_auth_nonce')) {
        if (ob_get_length())
            ob_clean();
        wp_send_json_error(array('message' => 'Security check failed. Please refresh.'));
    }

    $form_type = sanitize_text_field($_POST['form_type'] ?? 'General');
    $name = sanitize_text_field($_POST['name'] ?? 'Unknown');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = wp_kses_post($_POST['message'] ?? '');

    // Form-specific extra data
    $extra_data = array();
    foreach ($_POST as $key => $value) {
        if (!in_array($key, array('action', 'nonce', 'form_type', 'name', 'email', 'message'))) {
            $extra_data[$key] = sanitize_text_field($value);
        }
    }

    // Create the Inquiry Post
    $post_id = wp_insert_post(array(
        'post_type' => 'sst_enquiry',
        'post_title' => $form_type . ': ' . $name . ' (' . date('Y-m-d H:i') . ')',
        'post_content' => $message,
        'post_status' => 'publish',
    ));

    if (is_wp_error($post_id)) {
        if (ob_get_length())
            ob_clean();
        wp_send_json_error(array('message' => 'Error saving inquiry. Please try again.'));
    }

    // Save Meta
    update_post_meta($post_id, '_sst_form_type', $form_type);
    update_post_meta($post_id, '_sst_user_name', $name);
    update_post_meta($post_id, '_sst_user_email', $email);

    foreach ($extra_data as $key => $val) {
        update_post_meta($post_id, '_sst_' . $key, $val);
    }

    if (ob_get_length())
        ob_clean();
    wp_send_json_success(array('message' => 'Inquiry submitted successfully! We will be in touch soon.'));
}
add_action('wp_ajax_sst_handle_submission_ajax', 'sst_handle_submission_ajax');
add_action('wp_ajax_nopriv_sst_handle_submission_ajax', 'sst_handle_submission_ajax');
