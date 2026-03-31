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
                                    <label for="org_name">Organization Name *</label>
                                    <input type="text" id="org_name" name="org_name" placeholder="Legal name of organization" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-field">
                                    <label for="contact_name">Contact Representative *</label>
                                    <input type="text" id="contact_name" name="contact_name" placeholder="Full name" required>
                                </div>
                                <div class="form-field">
                                    <label for="contact_email">Contact Email *</label>
                                    <input type="email" id="contact_email" name="contact_email" placeholder="e.g. rep@org.com" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-field">
                                    <label for="request_type">Request Type *</label>
                                    <select id="request_type" name="request_type" required>
                                        <option value="" disabled selected>Select an option</option>
                                        <option value="monetary">Monetary Donation</option>
                                        <option value="sponsorship">Event Sponsorship</option>
                                        <option value="volunteer">Volunteer Support</option>
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label for="amount">Requested Amount ($) *</label>
                                    <input type="number" id="amount" name="amount" placeholder="e.g. 500" required>
                                </div>
                            </div>

                            <div class="form-field">
                                <label for="purpose">Purpose of Donation *</label>
                                <textarea id="purpose" name="purpose" rows="4" placeholder="Briefly describe how the funds will be used..." required></textarea>
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

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dForm = document.getElementById('sst-request-donation-form');
    if (dForm) {
        dForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = dForm.querySelector('button[type="submit"]');
            const loader = btn.querySelector('.btn-loader');
            const btnText = btn.querySelector('.btn-text');
            
            // Feedback element
            let msgDiv = dForm.querySelector('.submission-msg');
            if (!msgDiv) {
                msgDiv = document.createElement('div');
                msgDiv.className = 'submission-msg';
                msgDiv.style.marginTop = '20px';
                msgDiv.style.padding = '15px';
                msgDiv.style.borderRadius = '8px';
                msgDiv.style.fontSize = '0.9rem';
                msgDiv.style.textAlign = 'center';
                dForm.appendChild(msgDiv);
            }

            // Reset UI
            msgDiv.style.display = 'none';
            btn.disabled = true;
            if (loader) loader.style.display = 'inline-block';
            if (btnText) btnText.style.opacity = '0.5';
            
            const formData = new FormData(dForm);
            formData.append('action', 'sst_handle_submission_ajax');
            formData.append('nonce', sstAuth.nonce);
            formData.append('form_type', 'Donation Request');
            
            // Map specialized fields
            formData.append('name', document.getElementById('contact_name').value);
            formData.append('email', document.getElementById('contact_email').value);
            formData.append('message', document.getElementById('purpose').value);

            fetch(sstAuth.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                if (loader) loader.style.display = 'none';
                if (btnText) btnText.style.opacity = '1';
                
                msgDiv.style.display = 'block';
                if (data.success) {
                    msgDiv.style.backgroundColor = 'rgba(0, 255, 127, 0.1)';
                    msgDiv.style.color = '#00ff7f';
                    msgDiv.style.border = '1px solid rgba(0, 255, 127, 0.2)';
                    msgDiv.textContent = data.data.message;
                    dForm.reset();
                } else {
                    msgDiv.style.backgroundColor = 'rgba(255, 77, 77, 0.1)';
                    msgDiv.style.color = '#ff4d4d';
                    msgDiv.style.border = '1px solid rgba(255, 77, 77, 0.2)';
                    msgDiv.textContent = data.data.message || 'Error processing request.';
                }
            })
            .catch(err => {
                btn.disabled = false;
                if (loader) loader.style.display = 'none';
                if (btnText) btnText.style.opacity = '1';
                msgDiv.style.display = 'block';
                msgDiv.style.backgroundColor = 'rgba(255, 77, 77, 0.1)';
                msgDiv.style.color = '#ff4d4d';
                msgDiv.textContent = 'Connection error. Please try again.';
            });
        });
    }
});
</script>
