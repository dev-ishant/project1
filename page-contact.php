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
                            <input type="text" name="user_name" placeholder="What's your name?" required>
                        </div>

                        <div class="form-field">
                            <label>Email Address*</label>
                            <input type="email" name="user_email" placeholder="e.g. sue@youremail.com" required>
                        </div>

                        <div class="form-field">
                            <label>Telephone Number*</label>
                            <input type="tel" name="user_phone" placeholder="(xxx) xxx-xxxx" required>
                        </div>

                        <div class="form-field">
                            <label>Message*</label>
                            <textarea name="user_message" rows="4" placeholder="How can we help?" required></textarea>
                        </div>

                        <div class="captcha-placeholder-row">
                            <p class="captcha-label">Please type the code below (case sensitive)</p>
                            <div class="captcha-box-mock">
                                 <div class="captcha-image-area">
                                     <span class="captcha-refresh" title="Get new code"></span>
                                     <span class="captcha-text-code"></span>
                                     <span class="captcha-audio" title="Audio assistance"></span>
                                 </div>
                                 <input type="text" class="captcha-input-field" placeholder="Code" required>
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
                                <input type="text" name="first_name" placeholder="What's your first name?" required>
                            </div>
                            <div class="form-field">
                                <label>Last Name*</label>
                                <input type="text" name="last_name" placeholder="What's your last name?" required>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Email*</label>
                            <input type="email" name="user_email" placeholder="e.g. sue@youremail.com" required>
                        </div>

                        <div class="form-field">
                            <label>Telephone Number*</label>
                            <input type="tel" name="user_phone" placeholder="(xxx) xxx-xxxx" required>
                        </div>

                        <div class="form-field">
                            <label>Your Organization*</label>
                            <input type="text" name="organization" placeholder="What organization are you with?" required>
                        </div>

                        <div class="form-field">
                            <label>What Piece Of Your Business Are You Considering Outsourcing For?*</label>
                            <select name="outsourcing_type" class="form-select-styled" required>
                                <option value="">Please Select:</option>
                                <option value="loans">Loan Servicing</option>
                                <option value="back-office">Back Office Support</option>
                                <option value="customer-care">Customer Care</option>
                                <option value="compliance">Compliance</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Message*</label>
                            <textarea name="user_message" rows="4" placeholder="Write your message here..." required></textarea>
                        </div>

                        <div class="captcha-placeholder-row">
                            <p class="captcha-label">Please type the code below (case sensitive)</p>
                            <div class="captcha-box-mock">
                                 <div class="captcha-image-area">
                                     <span class="captcha-refresh" title="Get new code"></span>
                                     <span class="captcha-text-code"></span>
                                     <span class="captcha-audio" title="Audio assistance"></span>
                                 </div>
                                 <input type="text" class="captcha-input-field" placeholder="Code" required>
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

                // --- VALIDATION HELPERS ---
                const validateEmail = (email) => {
                    return String(email).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
                };

                const validatePhone = (phone) => {
                    const digits = phone.replace(/\D/g, '');
                    return digits.length === 10;
                };

                const validateName = (name) => {
                    return name.trim().split(/\s+/).length >= 2 && /^[a-zA-Z\s'-]+$/.test(name);
                };

                // Phone Auto-formatter
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

                // --- DYNAMIC CAPTCHA LOGIC ---
                const setupCaptcha = (form) => {
                    const display = form.querySelector('.captcha-text-code');
                    const refreshBtn = form.querySelector('.captcha-refresh');
                    const input = form.querySelector('.captcha-input-field');
                    
                    if (!display || !input) return null;

                    const generate = () => {
                        const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
                        let code = '';
                        for (let i = 0; i < 6; i++) {
                            code += chars.charAt(Math.floor(Math.random() * chars.length));
                        }
                        display.textContent = code;
                        form.dataset.captcha = code;
                    };

                    if (refreshBtn) {
                        refreshBtn.addEventListener('click', generate);
                    }
                    generate();
                    return generate;
                };

                const gForm = document.querySelector('#general-inquiry-form form');
                const sForm = document.querySelector('#sales-inquiry-form form');
                
                const refreshGCaptcha = gForm ? setupCaptcha(gForm) : null;
                const refreshSCaptcha = sForm ? setupCaptcha(sForm) : null;
                // --- END CAPTCHA LOGIC ---

                if (btnGeneral && btnSales) {
                    btnGeneral.addEventListener('click', () => {
                        btnGeneral.classList.add('active');
                        btnSales.classList.remove('active');
                        formGeneral.style.display = 'block';
                        formSales.style.display = 'none';
                        if (refreshGCaptcha) refreshGCaptcha();
                    });

                    btnSales.addEventListener('click', () => {
                        btnSales.classList.add('active');
                        btnGeneral.classList.remove('active');
                        formGeneral.style.display = 'none';
                        formSales.style.display = 'block';
                        if (refreshSCaptcha) refreshSCaptcha();
                    });
                }

                // AJAX Form Submission
                const handleSubmission = (form, type, refreshFn) => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        // Feedback
                        let msgDiv = form.querySelector('.submission-msg');
                        if (!msgDiv) {
                            msgDiv = document.createElement('div');
                            msgDiv.className = 'submission-msg';
                            msgDiv.style.marginTop = '20px';
                            msgDiv.style.padding = '15px';
                            msgDiv.style.borderRadius = '8px';
                            msgDiv.style.fontSize = '0.9rem';
                            msgDiv.style.textAlign = 'center';
                            form.appendChild(msgDiv);
                        }

                        // FORM VALIDATION
                        const showError = (text) => {
                            msgDiv.style.display = 'block';
                            msgDiv.style.backgroundColor = 'rgba(255, 77, 77, 0.1)';
                            msgDiv.style.color = '#ff4d4d';
                            msgDiv.style.border = '1px solid rgba(255, 77, 77, 0.2)';
                            msgDiv.textContent = text;
                        };

                        // 0. Name Validation
                        const nameInput = form.querySelector('input[name*="name"]');
                        if (nameInput && !validateName(nameInput.value)) {
                            showError('Please enter a valid full name (letters only, First and Last name).');
                            return;
                        }

                        // 1. Email Validation
                        const emailInput = form.querySelector('input[type="email"]');
                        if (emailInput && !validateEmail(emailInput.value)) {
                            showError('Please enter a valid email address.');
                            return;
                        }

                        // 2. Phone Validation
                        const phoneInput = form.querySelector('input[type="tel"]');
                        if (phoneInput && !validatePhone(phoneInput.value)) {
                            showError('Please enter a valid 10-digit phone number.');
                            return;
                        }

                        // 3. CAPTCHA VALIDATION
                        const captchaInput = form.querySelector('.captcha-input-field');
                        if (captchaInput) {
                            if (captchaInput.value.trim() !== form.dataset.captcha) {
                                showError('Invalid security code. Please try again.');
                                return;
                            }
                        }

                        const btn = form.querySelector('button[type="submit"]');
                        const originalBtnText = btn.textContent;
                        
                        // Reset UI
                        msgDiv.style.display = 'none';
                        btn.disabled = true;
                        btn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Processing...';
                        
                        const formData = new FormData(form);
                        formData.append('action', 'sst_handle_submission_ajax');
                        formData.append('nonce', sstAuth.nonce);
                        formData.append('form_type', type);
                        
                        // Extract basic fields for the CPT from the already filled FormData
                        if (type === 'General') {
                            formData.append('name', formData.get('user_name'));
                            formData.append('email', formData.get('user_email'));
                            formData.append('phone', formData.get('user_phone'));
                            formData.append('message', formData.get('user_message'));
                        } else {
                            formData.append('name', formData.get('first_name') + ' ' + formData.get('last_name'));
                            formData.append('email', formData.get('user_email'));
                            formData.append('phone', formData.get('user_phone'));
                            formData.append('message', formData.get('user_message'));
                        }

                        fetch(sstAuth.ajaxUrl, {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            btn.disabled = false;
                            btn.textContent = originalBtnText;
                            
                            msgDiv.style.display = 'block';
                            if (data.success) {
                                msgDiv.style.backgroundColor = 'rgba(0, 255, 127, 0.1)';
                                msgDiv.style.color = '#00ff7f';
                                msgDiv.style.border = '1px solid rgba(0, 255, 127, 0.2)';
                                msgDiv.textContent = data.data.message;
                                form.reset();
                                if (refreshFn) refreshFn();
                            } else {
                                msgDiv.style.backgroundColor = 'rgba(255, 77, 77, 0.1)';
                                msgDiv.style.color = '#ff4d4d';
                                msgDiv.style.border = '1px solid rgba(255, 77, 77, 0.2)';
                                msgDiv.textContent = data.data.message || 'An error occurred.';
                                if (refreshFn) refreshFn();
                            }
                        })
                        .catch(err => {
                            btn.disabled = false;
                            btn.textContent = originalBtnText;
                            msgDiv.style.display = 'block';
                            msgDiv.style.backgroundColor = 'rgba(255, 77, 77, 0.1)';
                            msgDiv.style.color = '#ff4d4d';
                            msgDiv.textContent = 'Connection error. Please try again.';
                        });
                    });
                };

                if (gForm) handleSubmission(gForm, 'General', refreshGCaptcha);
                if (sForm) handleSubmission(sForm, 'Sales', refreshSCaptcha);
            });
            </script>

        </div>
    </section>

</main>

<?php get_footer(); ?>
