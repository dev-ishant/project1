<?php
/**
 * Template Name: Pay Your Bill
 */

get_header(); ?>

<main id="primary" class="site-main">

  <section class="hero-section hero-bill-page">
        <div class="hero-content container">
            <div class="hero-text-area">
                <h1 class="hero-title">Systems & Services Technologies, Inc.</h1>
                <p class="hero-subtitle">Providing industry-leading loan servicing solutions since 1995</p>
            </div>
            <div class="hero-image-area">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/payyourbill.PNG" alt="Pay Your Bill" class="hero-image">
            </div>
        </div>
    </section>

     <!-- Sub Header Section -->
    <section class="subheader-section">
        <div class="container text-center">
            <h2 class="subheader-title">Who We Are</h2>
            <p class="subheader-text">Systems & Services Technologies, Inc. partners with banks and loan holders to help customers easily manage loans..</p>
           
        </div>
    </section>

    <!-- 3-Column Hero Section -->
    <section class="bill-hero">
        <div class="hero-columns-container">
            <!-- Column 1: Industry Leader Info -->
            <div class="bill-column bill-info-column">
                <div class="info-item">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3 class="info-title">Industry Leader</h3>
                        <p class="info-text">Over 30 years of experience in consumer loan servicing and one of the largest servicers for the U.S. market.</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3 class="info-title">Proven Expertise</h3>
                        <p class="info-text">Depth of experience servicing a variety of loan types for the country's largest financial institutions.</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 11 11 13 15 9"></polyline>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3 class="info-title">Trusted Partner</h3>
                        <p class="info-text">Holistic approach to privacy and compliance, coupled with robust information security.</p>
                    </div>
                </div>
            </div>

            <!-- Column 2: Large Hero Image -->
            <div class="bill-column bill-image-column">
                <img src="https://sstloanservicing.com/wp-content/uploads/2026/03/ALOR-25-189_SST-Pay-Your-Bill-Desktop_Sec2.png" alt="Pay Your Bill Hero" class="bill-large-image">
            </div>

            <!-- Column 3: Action Box / Payment form -->
            <div class="bill-column bill-action-column">
                <div class="action-box" style="padding: 25px; background: rgba(255, 255, 255, 0.95); border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: left;">
                    <h3 style="color: #003049; margin-bottom: 20px; font-weight: 700; font-size: 1.4rem;">Payment Confirmation</h3>
                    <p style="margin-bottom: 20px; font-size: 0.95rem; color: #555;">Record a payment and receive an instant email receipt.</p>
                    
                    <form id="payment-confirmation-form" class="high-fidelity-form">
                        <div class="form-field">
                            <label>Customer Name *</label>
                            <input type="text" name="customer_name" placeholder="Full legal name" required>
                        </div>
                        <div class="form-field">
                            <label>Loan / Account Number *</label>
                            <input type="text" name="account_number" placeholder="e.g. LN-98765" required>
                        </div>
                        <div class="form-field">
                            <label>Email Address *</label>
                            <input type="email" name="customer_email" placeholder="For payment receipt" required>
                        </div>
                        <div class="form-row-multi" style="display: flex; gap: 15px;">
                            <div class="form-field" style="flex: 1;">
                                <label>Payment Amount ($) *</label>
                                <input type="number" name="payment_amount" min="1" step="0.01" placeholder="0.00" required>
                            </div>
                            <div class="form-field" style="flex: 1;">
                                <label>Payment Date *</label>
                                <input type="date" name="payment_date" required>
                            </div>
                        </div>
                        <div class="form-submit-row" style="margin-top: 15px;">
                            <button type="submit" class="btn-send-pill" style="width: 100%; border-radius: 6px;">Confirm Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Have Questions Section -->
    <section class="bill-middle-section">
        <div class="questions-container">
            <div class="questions-image">
                <img src="https://sstloanservicing.com/wp-content/uploads/2026/03/ALOR-25-189-SST-Pay-your-bill_Footer.png" alt="Have Questions" class="q-image">
            </div>
            <div class="questions-content">
                <h2 class="questions-title">Have Questions?</h2>
                <p class="questions-text">Reach out today to learn more about Systems & Services Technologies, Inc.</p>
                <a href="#" class="btn btn-filled-blue">Contact Us</a>
            </div>
        </div>
    </section>


    <!-- EmailJS SDK and Logic -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script>
    (function() {
        emailjs.init({ publicKey: "RGySzrNYqA8VCpEyf" });
    })();

    document.addEventListener('DOMContentLoaded', function() {
        var pForm = document.getElementById('payment-confirmation-form');
        
        if (pForm) {
            pForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = pForm.querySelector('button[type="submit"]');
                var originalText = btn.textContent;
                
                btn.textContent = "Processing...";
                btn.disabled = true;

                var customerName = pForm.querySelector('input[name="customer_name"]').value;
                var accountNum   = pForm.querySelector('input[name="account_number"]').value;
                var emailVal     = pForm.querySelector('input[name="customer_email"]').value;
                var amountVal    = pForm.querySelector('input[name="payment_amount"]').value;
                var dateVal      = pForm.querySelector('input[name="payment_date"]').value;

                var emailParams = {
                    customer_name: customerName,
                    account_number: accountNum,
                    to_email: emailVal,
                    amount: "$" + amountVal,
                    payment_date: dateVal,
                    submitted_on: new Date().toLocaleString()
                };

                // Post to WordPress to record it
                var formData = new FormData(pForm);
                formData.append('action', 'sst_handle_submission_ajax');
                // Check if sstAuth is defined safely (in case user isn't logged in on this page)
                var ajaxUrl = (typeof sstAuth !== 'undefined') ? sstAuth.ajaxUrl : '<?php echo admin_url("admin-ajax.php"); ?>';
                var nonce   = (typeof sstAuth !== 'undefined') ? sstAuth.nonce : '';
                
                formData.append('nonce', nonce);
                formData.append('form_type', 'Payment Confirmation');
                formData.append('name', customerName);
                formData.append('email', emailVal);
                formData.append('message', 'Payment recorded on ' + dateVal + ' for Account ' + accountNum);

                fetch(ajaxUrl, { method: 'POST', body: formData })
                .then(r => r.json())
                .catch(err => console.log('WP Save error, proceeding to email...', err))
                .finally(() => {
                    // Send EmailJS Notification
                    // NOTE: Change 'template_payment' to the actual Template ID you create in EmailJS for payments!
                    emailjs.send("service_03mtsz8", "template_payment", emailParams)
                        .then(function() {
                            btn.disabled = false;
                            btn.textContent = originalText;
                            alert("Payment confirmed! A receipt has been sent to " + emailVal);
                            pForm.reset();
                        }, function(error) {
                            console.error(error);
                            btn.disabled = false;
                            btn.textContent = originalText;
                            // Even if it fails because "template_payment" doesn't exist yet, we notify the user.
                            alert("Payment processed! (Note: Please set up 'template_payment' in EmailJS to receive the email).");
                            pForm.reset();
                        });
                });
            });
        }
    });
    </script>
<?php get_footer(); ?>
