<?php
/**
 * Template Name: Request for Donation
 */

// Protected page: Redirct if not logged in
if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login/' ) );
    exit;
}

get_header(); ?>

<main id="primary" class="site-main">

     <!-- Hero Section -->
    <section class="login-hero-section">
        <div class="container">
            <h1 class="login-hero-title">Request for Donation Form</h1>
            <p class="login-hero-subtitle">Submit a formal request for corporate giving or sponsorship</p>
        </div>
    </section>

    <section class="protected-form-section">
        <div class="container protected-form-container">
            <div class="form-wrapper-box">
                <h2 class="form-title">Sponsorship & Donation Request</h2>
                <p class="form-instructions">Please provide detailed information regarding your request. Our committee reviews applications on the 15th of every month.</p>

                <form id="donation-request-form" action="#" method="POST" class="high-fidelity-form">
                    
                    <div class="form-field">
                        <label>Organization Name *</label>
                        <input type="text" name="org_name" placeholder="Full legal name of organization" required>
                    </div>

                    <div class="form-row-multi">
                        <div class="form-field">
                            <label>Contact Person *</label>
                            <input type="text" name="contact_name" placeholder="First and Last Name" required>
                        </div>
                        <div class="form-field">
                            <label>Contact Email *</label>
                            <input type="email" name="contact_email" placeholder="email@organization.org" required>
                        </div>
                    </div>

                    <div class="form-field">
                        <label>Tax ID / 501(c)(3) Number</label>
                        <input type="text" name="tax_id" placeholder="XX-XXXXXXX" required>
                    </div>

                    <div class="form-row-multi">
                        <div class="form-field">
                            <label>Amount Requested ($) *</label>
                            <input type="number" name="amount" min="10" placeholder="0.00" required>
                        </div>
                        <div class="form-field">
                            <label>Date Needed By *</label>
                            <input type="date" name="date_needed" required>
                        </div>
                    </div>

                    <div class="form-field">
                        <label>Purpose of Donation *</label>
                        <textarea rows="4" name="purpose" placeholder="Please describe how these funds will be used and who they will benefit..." required></textarea>
                    </div>

                    <hr class="form-divider">

                    <p class="privacy-consent-text">
                        <label>
                            <input type="checkbox" name="truth_certification" required>
                            * I certify that the information provided in this request is true and accurate. I understand that submitting a request does not guarantee funding.
                        </label>
                    </p>

                    <div class="form-submit-row right-align">
                        <button type="submit" class="btn-send-pill">Submit Request</button>
                    </div>
                </form>

                <script>
                document.getElementById('donation-request-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    var btn = this.querySelector('button[type="submit"]');
                    btn.textContent = "Submitting...";
                    btn.disabled = true;
                    // Simulate submission for now
                    setTimeout(() => {
                        alert("Your donation request has been submitted successfully! Our team will review it shortly.");
                        this.reset();
                        btn.textContent = "Submit Request";
                        btn.disabled = false;
                    }, 1500);
                });
                </script>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
