<?php
/**
 * Template Name: Payroll Deduction Form
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Donate Hero Banner (From Donate Page) -->
    <section class="donate-hero-banner" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/d1.PNG' ); ?>');">
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
                <h2 class="form-title text-blue" style="font-size: 2.2rem; margin-bottom: 20px;">Payroll Deduction Form</h2>
                <p class="form-instructions" style="color: #333; font-weight: 600; font-size: 1.15rem; margin-bottom: 30px;">Which kind of deduction would you like to do?</p>

                <!-- Deduction Type Buttons -->
                <div class="deduction-type-buttons">
                    <button type="button" class="deduction-btn active">NEW DEDUCTION</button>
                    <button type="button" class="deduction-btn">CHANGE DEDUCTION</button>
                    <button type="button" class="deduction-btn">ONE-TIME DEDUCTION</button>
                    <button type="button" class="deduction-btn">TERM DEDUCTION</button>
                </div>

                <hr class="donate-section-divider" style="margin: 40px 0;">

                <!-- Conditional Authentication Logic -->
                <?php if ( ! is_user_logged_in() ) : ?>
                    
                    <div class="login-prompt-message" style="text-align: center; padding: 20px 0;">
                        <p style="font-size: 1.1rem; color: #555;">
                            Please <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" style="color: #2e7bbd; text-decoration: underline;">login using your Alorica SSO credentials</a> to fill out this form.
                        </p>
                    </div>

                <?php else : ?>

                    <!-- Form for Logged In Users -->
                    <form id="payroll-deduction-form" action="#" method="POST" class="high-fidelity-form">
                        
                        <div class="form-row-multi">
                            <div class="form-field">
                                <label>Employee Name *</label>
                                <input type="text" name="employee_name" placeholder="Full legal name" required>
                            </div>
                            <div class="form-field">
                                <label>Employee ID *</label>
                                <input type="text" name="employee_id" placeholder="e.g. EMP-12345" required>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Department *</label>
                            <select name="department" class="form-select-styled" required>
                                <option value="">Select your department</option>
                                <option value="sales">Sales & Marketing</option>
                                <option value="engineering">Engineering</option>
                                <option value="operations">Operations</option>
                                <option value="hr">Human Resources</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-row-multi">
                            <div class="form-field">
                                <label>Deduction Amount ($) *</label>
                                <input type="number" name="amount" min="1" step="0.01" placeholder="0.00" required>
                            </div>
                            <div class="form-field">
                                <label>Frequency *</label>
                                <select name="frequency" class="form-select-styled" required>
                                    <option value="">Select frequency</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="biweekly">Bi-weekly</option>
                                    <option value="onetime">One-time</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Additional Notes</label>
                            <textarea rows="3" name="notes" placeholder="Any special instructions..."></textarea>
                        </div>

                        <hr class="form-divider">

                        <p class="privacy-consent-text">
                            <label>
                                <input type="checkbox" name="authorization" required>
                                * By checking this box, I authorize my employer to deduct the amount specified above from my regular paycheck. I understand this authorization stays in effect until revoked in writing.
                            </label>
                        </p>

                        <div class="form-submit-row right-align">
                            <button type="submit" class="btn-send-pill">Submit Authorization</button>
                        </div>
                    </form>

                    <script>
                    document.getElementById('payroll-deduction-form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        var btn = this.querySelector('button[type="submit"]');
                        var amountField = this.querySelector('input[name="amount"]');
                        
                        btn.textContent = "Processing...";
                        btn.disabled = true;

                        var body = new URLSearchParams({
                            action: 'sst_save_payroll_deduction_ajax',
                            nonce:  sstAuth.nonce,
                            amount: amountField.value
                        });

                        fetch(sstAuth.ajaxUrl, { 
                            method: 'POST', 
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: body 
                        })
                        .then(r => r.json())
                        .then(data => {
                            btn.disabled = false;
                            btn.textContent = "Submit Authorization";
                            if (data.success) {
                                alert(data.data.message);
                                this.reset();
                            } else {
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
                        btn.addEventListener('click', function() {
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
