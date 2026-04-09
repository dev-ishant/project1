<?php
/**
 * Template Name: SST Request for Donation
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="request-hero-section">
        <div class="container">
            <h1 class="request-hero-title">Request for Donation</h1>
            <p class="request-hero-subtitle">Partnering with organizations to make a difference in our communities.</p>
        </div>
    </section>

    <!-- Content & Form Section -->
    <section class="request-form-section">
        <div class="container">
            <div class="request-grid">
                <!-- Info Column -->
                <div class="request-info-column">
                    <h2 class="section-title">Support for Your Mission</h2>
                    <p class="section-text">Systems & Services Technologies, Inc. is committed to helping our communities thrive. If your organization is seeking support, please fill out the request form below.</p>
                    
                    <div class="guidelines-box">
                        <h3>General Guidelines</h3>
                        <ul>
                            <li>Requests should be submitted at least 6 weeks in advance.</li>
                            <li>Organizations must be non-profit 501(c)(3) entities.</li>
                            <li>We prioritize local community initiatives and youth programs.</li>
                        </ul>
                    </div>

                    <div class="contact-card">
                        <i class="bi bi-info-circle-fill"></i>
                        <p>For large-scale sponsorships or multi-year partnership inquiries, please contact our community relations team directly.</p>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="request-form-column">
                    <div class="glass-form-card">
                        <form id="sst-request-donation-form" class="high-fidelity-form">
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="employee_code">Employee Code *</label>
                                    <input type="text" id="employee_code" name="employee_code" placeholder="e.g. EMP-12345" required>
                                </div>
                                <div class="form-field">
                                    <label for="employee_name">Employee Name *</label>
                                    <input type="text" id="employee_name" name="employee_name" placeholder="Full name" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-field">
                                    <label for="contact_email">Employee Email *</label>
                                    <input type="email" id="contact_email" name="contact_email" placeholder="For email confirmation" required>
                                </div>
                                <div class="form-field">
                                    <label for="contact_phone">Telephone Number *</label>
                                    <input type="tel" id="contact_phone" name="contact_phone" placeholder="(xxx) xxx-xxxx" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="amount">Requested Amount ($) *</label>
                                    <input type="number" id="amount" name="amount" placeholder="e.g. 500" required>
                                </div>
                            </div>

                            <div class="form-field">
                                <label for="purpose">Reason for Request *</label>
                                <textarea id="purpose" name="purpose" rows="4" placeholder="Briefly describe your request..." required></textarea>
                            </div>

                            <button type="submit" class="btn-send-pill btn-full">
                                <span class="btn-text">Submit Request</span>
                                <span class="btn-loader" style="display:none;"><i class="bi bi-arrow-repeat spin"></i></span>
                            </button>
                            
                            <p class="form-privacy-note">By submitting this form, you agree to our processing of the provided information for the purpose of evaluation.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- EmailJS SDK -->
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

<script>
const EMAILJS_PUBLIC_KEY  = 'RGySzrNYqA8VCpEyf';
const EMAILJS_SERVICE_ID  = 'service_03mtsz8';
const EMAILJS_TEMPLATE_ID = 'template_jyawfhn';

emailjs.init({ publicKey: EMAILJS_PUBLIC_KEY });

document.addEventListener('DOMContentLoaded', function () {
    var dForm = document.getElementById('sst-request-donation-form');
    if (!dForm) { console.error('[SST] Form not found!'); return; }

    dForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var btn     = dForm.querySelector('button[type="submit"]');
        var loader  = btn ? btn.querySelector('.btn-loader') : null;
        var btnText = btn ? btn.querySelector('.btn-text')   : null;

        var msgDiv = dForm.querySelector('.submission-msg');
        if (!msgDiv) {
            msgDiv = document.createElement('div');
            msgDiv.className = 'submission-msg';
            msgDiv.style.cssText = 'margin-top:20px;padding:15px;border-radius:8px;font-size:0.9rem;text-align:center;display:none;';
            dForm.appendChild(msgDiv);
        }

        function showMsg(text, ok) {
            msgDiv.textContent           = text;
            msgDiv.style.display         = 'block';
            msgDiv.style.backgroundColor = ok ? 'rgba(0,180,100,0.1)' : 'rgba(255,77,77,0.1)';
            msgDiv.style.color           = ok ? '#006633' : '#cc0000';
            msgDiv.style.border          = ok ? '1px solid rgba(0,180,100,0.3)' : '1px solid rgba(255,77,77,0.3)';
        }

        function setLoading(on) {
            if (btn)     btn.disabled         = on;
            if (loader)  loader.style.display  = on ? 'inline-block' : 'none';
            if (btnText) btnText.style.opacity = on ? '0.5' : '1';
        }

        var employeeCode = (document.getElementById('employee_code') ? document.getElementById('employee_code').value : '').trim();
        var employeeName = (document.getElementById('employee_name') ? document.getElementById('employee_name').value : '').trim();
        var contactEmail = (document.getElementById('contact_email') ? document.getElementById('contact_email').value : '').trim();
        var contactPhone = (document.getElementById('contact_phone') ? document.getElementById('contact_phone').value : '').trim();
        var amount       = (document.getElementById('amount') ? document.getElementById('amount').value : '').trim();
        var purpose      = (document.getElementById('purpose') ? document.getElementById('purpose').value : '').trim();
        var submittedOn  = new Date().toLocaleString('en-US', { dateStyle: 'long', timeStyle: 'short' });

        // --- VALIDATION ---
        const validateEmail = (e) => e.toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        const validatePhone = (p) => p.replace(/\D/g, '').length === 10;
        const validateName  = (n) => n.trim().split(/\s+/).length >= 2 && /^[a-zA-Z\s'-]+$/.test(n);

        if (!validateName(employeeName)) {
            showMsg('❌ Please enter a valid full name (letters only, First and Last name).', false);
            return;
        }
        if (!validateEmail(contactEmail)) {
            showMsg('❌ Please enter a valid email address.', false);
            return;
        }
        if (!validatePhone(contactPhone)) {
            showMsg('❌ Please enter a valid 10-digit phone number.', false);
            return;
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

        setLoading(true);
        msgDiv.style.display = 'none';

        var formData = new FormData(dForm);
        formData.append('action',    'sst_handle_submission_ajax');
        formData.append('nonce',     sstAuth.nonce);
        formData.append('form_type', 'Donation Request');
        formData.append('name',      employeeName);
        formData.append('email',     contactEmail);
        formData.append('phone',     contactPhone);
        formData.append('employee_code', employeeCode);
        formData.append('message',   purpose);

        console.log('[SST] Submitting to WP:', sstAuth.ajaxUrl);

        fetch(sstAuth.ajaxUrl, { method: 'POST', body: formData })
        .then(function(res) {
            console.log('[SST] HTTP status:', res.status);
            return res.text();
        })
        .then(function(rawText) {
            console.log('[SST] WP raw response:', rawText);
            var data;
            try { data = JSON.parse(rawText); }
            catch(e) { throw new Error('WP returned non-JSON: ' + rawText.substring(0, 300)); }

            if (!data.success) {
                throw new Error('WP error: ' + (data.data && data.data.message ? data.data.message : JSON.stringify(data)));
            }

            var params = {
                to_name      : employeeName,
                to_email     : contactEmail,
                employee_name: employeeName,
                employee_code: employeeCode,
                amount       : '$' + amount,
                reason       : purpose,
                submitted_on : submittedOn,
                reply_to     : contactEmail
            };
            console.log('[SST] Calling EmailJS with:', params);
            return emailjs.send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, params);
        })
        .then(function() {
            setLoading(false);
            showMsg('✅ Your request has been submitted! A confirmation was sent to ' + contactEmail + '.', true);
            dForm.reset();
        })
        .catch(function(err) {
            setLoading(false);
            var msg = (err && err.text) ? err.text : (err && err.message ? err.message : JSON.stringify(err));
            console.error('[SST] Error:', msg, err);
            showMsg('❌ ' + (msg || 'Something went wrong. Please try again.'), false);
        });
    });
});
</script>

<?php get_footer(); ?>
