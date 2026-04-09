<?php
/**
 * Template Name: Payroll Deduction Form
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Donate Hero Banner (From Donate Page) -->
    <section class="donate-hero-banner"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/d1.PNG'); ?>');">
        <div class="donate-hero-overlay"></div>
        <div class="container donate-hero-content">
            <h1 class="donate-hero-title">DONATE</h1>
            <p class="donate-hero-subtitle">Small change can make a big difference.</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="protected-form-section">
        <div class="container protected-form-container">
            <div class="form-wrapper-box">
                <h2 class="form-title text-blue" style="font-size: 2.2rem; margin-bottom: 20px;">Payroll Deduction Form
                </h2>
                <p class="form-instructions"
                    style="color: #333; font-weight: 600; font-size: 1.15rem; margin-bottom: 30px;">Which kind of
                    deduction would you like to do?</p>

                <!-- Deduction Type Buttons -->
                <div class="deduction-type-buttons">
                    <button type="button" class="deduction-btn active">NEW DEDUCTION</button>
                    <button type="button" class="deduction-btn">CHANGE DEDUCTION</button>
                    <button type="button" class="deduction-btn">ONE-TIME DEDUCTION</button>
                    <button type="button" class="deduction-btn">TERM DEDUCTION</button>
                </div>

                <hr class="donate-section-divider" style="margin: 40px 0;">

                <!-- Conditional Authentication Logic -->
                <?php if (!is_user_logged_in()): ?>

                    <div class="login-prompt-message" style="text-align: center; padding: 20px 0;">
                        <p style="font-size: 1.1rem; color: #555;">
                            Please <a href="<?php echo esc_url(home_url('/login/')); ?>"
                                style="color: #2e7bbd; text-decoration: underline;">login using your Alorica SSO
                                credentials</a> to fill out this form.
                        </p>
                    </div>

                <?php else: ?>

                    <!-- Form for Logged In Users -->
                    <div id="selected-country-info"
                        style="display: none; background: #eef7ff; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #2e7bbd;">
                        <p style="margin: 0; font-weight: 600; color: #003049;">
                            <i class="bi bi-geo-alt-fill"></i> Donating to: <span id="display-country"></span>
                        </p>
                    </div>

                    <form id="payroll-deduction-form" action="#" method="POST" class="high-fidelity-form">
                        <input type="hidden" name="donation_country" id="donation_country" value="General">

                        <div class="form-row-multi">
                            <div class="form-field">
                                <label>Employee Code *</label>
                                <input type="text" name="employee_code" placeholder="e.g. EMP-12345" required>
                            </div>
                            <div class="form-field">
                                <label>Employee Name *</label>
                                <input type="text" name="employee_name" placeholder="Full legal name" required>
                            </div>
                        </div>

                        <div class="form-row-multi">
                            <div class="form-field">
                                <label>Telephone Number *</label>
                                <input type="tel" name="employee_phone" placeholder="(xxx) xxx-xxxx" required>
                            </div>
                        </div>

                        <div class="form-row-multi">
                            <div class="form-field">
                                <label>Donation Amount ($) *</label>
                                <input type="number" name="amount" min="1" step="0.01" placeholder="0.00" required>
                            </div>
                            <div class="form-field">
                                <label>No of Installments *</label>
                                <input type="number" name="installments" min="1" placeholder="e.g. 1" required>
                            </div>
                        </div>

                        <hr class="form-divider">

                        <p class="privacy-consent-text">
                            <label>
                                <input type="checkbox" name="authorization" required>
                                * By checking this box, I authorize my employer to deduct the amount specified above from my
                                regular paycheck. I understand this authorization stays in effect until revoked in writing.
                            </label>
                        </p>

                        <div class="form-submit-row right-align">
                            <button type="submit" class="btn-send-pill">Submit Authorization</button>
                        </div>
                    </form>

                    <!-- EmailJS SDK -->
                    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

                    <script>
                        (function () {
                            emailjs.init({ publicKey: "RGySzrNYqA8VCpEyf" });
                        })();

                        document.addEventListener('DOMContentLoaded', function () {
                            const urlParams = new URLSearchParams(window.location.search);
                            const country = urlParams.get('country');
                            if (country) {
                                const display = document.getElementById('selected-country-info');
                                const text = document.getElementById('display-country');
                                const hiddenInput = document.getElementById('donation_country');
                                if (display && text && hiddenInput) {
                                    display.style.display = 'block';
                                    text.textContent = country;
                                    hiddenInput.value = country;
                                }
                            }

                            // Phone Auto-formatter helper
                            document.querySelectorAll('input[type="tel"]').forEach(input => {
                                input.addEventListener('input', (e) => {
                                    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                                    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
                                });
                            });

                            // Name character filter (prevent numbers)
                            document.querySelectorAll('input[name*="name"]').forEach(input => {
                                input.addEventListener('input', (e) => {
                                    e.target.value = e.target.value.replace(/[0-9]/g, '');
                                });
                            });
                        });

                        document.getElementById('payroll-deduction-form').addEventListener('submit', function (e) {
                            e.preventDefault();
                            var form = this;
                            var btn = form.querySelector('button[type="submit"]');
                            var amountField = form.querySelector('input[name="amount"]');
                            var installmentsField = form.querySelector('input[name="installments"]');
                            var empNameField = form.querySelector('input[name="employee_name"]');
                            var empCodeField = form.querySelector('input[name="employee_code"]');
                            var empPhoneField = form.querySelector('input[name="employee_phone"]');
                            var countryField = document.getElementById('donation_country');

                            // --- VALIDATION ---
                            const validateName = (n) => n.trim().split(/\s+/).length >= 2 && /^[a-zA-Z\s'-]+$/.test(n);
                            const validatePhone = (p) => p.replace(/\D/g, '').length === 10;

                            if (!validateName(empNameField.value)) {
                                alert("❌ Please enter a valid full name (letters only, First and Last name).");
                                return;
                            }
                            if (!validatePhone(empPhoneField.value)) {
                                alert("❌ Please enter a valid 10-digit phone number.");
                                return;
                            }

                            btn.textContent = "Processing...";
                            btn.disabled = true;

                            var body = new URLSearchParams({
                                action: 'sst_save_payroll_deduction_ajax',
                                nonce: sstAuth.nonce,
                                amount: amountField.value,
                                phone: empPhoneField ? empPhoneField.value : '',
                                country: countryField ? countryField.value : 'General'
                            });

                            fetch(sstAuth.ajaxUrl, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                body: body
                            })
                                .then(r => r.json())
                                .then(data => {
                                    if (data.success) {
                                        // SEND EMAIL VIA EMAILJS
                                        var emailParams = {
                                            to_name: empNameField ? empNameField.value : "<?php echo esc_js($current_user->display_name); ?>",
                                            to_email: "<?php echo esc_js($current_user->user_email); ?>",
                                            employee_name: empNameField ? empNameField.value : "",
                                            employee_code: empCodeField ? empCodeField.value : "",
                                            employee_phone: empPhoneField ? empPhoneField.value : "",
                                            amount: "$" + amountField.value,
                                            installments: installmentsField ? installmentsField.value : "",
                                            country: countryField ? countryField.value : 'General',
                                            date: new Date().toLocaleString()
                                        };

                                        // Updated Template ID: template_5x9z57x
                                        return emailjs.send("service_03mtsz8", "template_5x9z57x", emailParams)
                                            .then(function () {
                                                btn.disabled = false;
                                                btn.textContent = "Submit Authorization";
                                                alert("Deduction submitted! It will be added to your profile once confirmed by an administrator.");
                                                form.reset();
                                            }, function (error) {
                                                btn.disabled = false;
                                                btn.textContent = "Submit Authorization";
                                                alert("Deduction saved, but email notification failed: " + JSON.stringify(error));
                                                form.reset();
                                            });
                                    } else {
                                        btn.disabled = false;
                                        btn.textContent = "Submit Authorization";
                                        alert(data.data.message || 'Error occurred.');
                                    }
                                })
                                .catch(err => {
                                    btn.disabled = false;
                                    btn.textContent = "Submit Authorization";
                                    console.error('Deduction Error:', err);
                                    alert('Network error. Please try again.');
                                });
                        });

                        // simple interaction for deduction buttons
                        document.querySelectorAll('.deduction-btn').forEach(btn => {
                            btn.addEventListener('click', function () {
                                document.querySelectorAll('.deduction-btn').forEach(b => b.classList.remove('active'));
                                this.classList.add('active');
                            });
                        });
                    </script>

                <?php endif; ?>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>