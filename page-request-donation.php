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
