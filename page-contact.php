<?php
/**
 * Template Name: Contact Us
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Contact Hero Section — Diagnostic Inline Styles added -->
    <section class="contact-hero-section" style="background-color: #003049; color: #ffffff; height: 340px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
        <div class="contact-hero-content container" style="display: flex; justify-content: space-between; align-items: center; width: 100%; height: 100%;">
            <div class="contact-hero-text-area" style="z-index: 10;">
                <h1 class="contact-hero-title" style="font-size: 2.8rem; font-weight: 500; color: #ffffff; margin: 0;">Contact Us</h1>
            </div>
            <div class="contact-hero-image-area" style="position: absolute; right: 0; top: 0; height: 100%; width: 45%; mask-image: linear-gradient(to right, transparent, black 30%); -webkit-mask-image: linear-gradient(to right, transparent, black 30%);">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact.PNG" alt="Contact Us" class="contact-hero-image" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </section>

    <!-- Contact Section: Questions & Form (BELOW THE HERO) -->
    <section class="contact-dual-section">
        <div class="container dual-grid">
            
            <!-- Left Side: Text Content -->
            <div class="contact-text-column">
                <h2 class="contact-main-title">Have questions or need assistance? We're here to help!</h2>
                <div class="contact-body-text">
                    <p>Thank you for your interest in Systems & Services Technologies, Inc.</p>
                    <p>Please complete the form and we'll be in touch soon.</p>
                </div>
            </div>

            <!-- Right Side: The Form -->
            <div class="contact-form-column">
                <div class="inquiry-toggle-wrap">
                    <button type="button" class="btn-toggle active" id="toggle-general">General Inquiries</button>
                    <button type="button" class="btn-toggle" id="toggle-sales">Sales Inquiries</button>
                </div>

                <!-- General Inquiry Form -->
                <div id="general-inquiry-form">
                    <form class="high-fidelity-form">
                        <div class="form-field">
                            <label>Your Name*</label>
                            <input type="text" placeholder="What's your name?">
                        </div>

                        <div class="form-field">
                            <label>Email Address*</label>
                            <input type="email" placeholder="e.g. sue@youremail.com">
                        </div>

                        <div class="form-field">
                            <label>Telephone Number*</label>
                            <input type="tel" placeholder="(xxx) xxx-xxxx">
                        </div>

                        <div class="form-field">
                            <label>Message*</label>
                            <textarea rows="4" placeholder="How can we help?"></textarea>
                        </div>

                        <div class="captcha-placeholder-row">
                            <p class="captcha-label">Please type the code below (case sensitive)</p>
                            <div class="captcha-box-mock">
                                 <div class="captcha-image-area">
                                     <span class="captcha-refresh"></span>
                                     <span class="captcha-text-code">j6RuxP</span>
                                     <span class="captcha-audio"></span>
                                 </div>
                                 <input type="text" class="captcha-input-field">
                            </div>
                        </div>

                        <p class="privacy-consent-text">
                            By clicking the link below, you consent to us contacting you directly, and to the collection, storage, and use of your personal information as more fully described in our <a href="#">privacy policy</a>.
                        </p>

                        <div class="form-submit-row">
                            <button type="submit" class="btn-send-pill">Send</button>
                        </div>
                    </form>
                </div>

                <!-- Sales Inquiry Form (Matches Screenshot) -->
                <div id="sales-inquiry-form" style="display: none;">
                    <form class="high-fidelity-form sales-specific-form">
                        <div class="form-row-multi">
                            <div class="form-field">
                                <label>First Name*</label>
                                <input type="text" placeholder="What's your first name?">
                            </div>
                            <div class="form-field">
                                <label>Last Name*</label>
                                <input type="text" placeholder="What's your last name?">
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Email*</label>
                            <input type="email" placeholder="e.g. sue@youremail.com">
                        </div>

                        <div class="form-field">
                            <label>Your Organization*</label>
                            <input type="text" placeholder="What organization are you with?">
                        </div>

                        <div class="form-field">
                            <label>What Piece Of Your Business Are You Considering Outsourcing For?*</label>
                            <select class="form-select-styled">
                                <option value="">Please Select:</option>
                                <option value="loans">Loan Servicing</option>
                                <option value="back-office">Back Office Support</option>
                                <option value="customer-care">Customer Care</option>
                                <option value="compliance">Compliance</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Message*</label>
                            <textarea rows="4" placeholder="Write your message here..."></textarea>
                        </div>

                        <!-- reCAPTCHA Badge Mock -->
                        <div class="recaptcha-badge-mock">
                            <div class="recaptcha-blue-side">
                                <span>protected by <strong>reCAPTCHA</strong></span>
                                <div class="legal-mini">Privacy - Terms</div>
                            </div>
                            <div class="recaptcha-logo-side">
                                <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA">
                            </div>
                        </div>

                        <div class="form-submit-row right-align">
                            <button type="submit" class="btn-submit-navy">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btnGeneral = document.getElementById('toggle-general');
                const btnSales = document.getElementById('toggle-sales');
                const formGeneral = document.getElementById('general-inquiry-form');
                const formSales = document.getElementById('sales-inquiry-form');

                if (btnGeneral && btnSales) {
                    btnGeneral.addEventListener('click', () => {
                        btnGeneral.classList.add('active');
                        btnSales.classList.remove('active');
                        formGeneral.style.display = 'block';
                        formSales.style.display = 'none';
                    });

                    btnSales.addEventListener('click', () => {
                        btnSales.classList.add('active');
                        btnGeneral.classList.remove('active');
                        formGeneral.style.display = 'none';
                        formSales.style.display = 'block';
                    });
                }
            });
            </script>

        </div>
    </section>

</main>

<?php get_footer(); ?>
