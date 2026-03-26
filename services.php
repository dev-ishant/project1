<?php
/**
 * Template Name: Services
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="services-hero-section">
        <div class="services-hero-content container">
            <div class="services-hero-text-area">
                <h1 class="services-hero-title">Systems &amp; Services Technologies, Inc. Loan<br>Servicing Solutions</h1>
                <p class="services-hero-subtitle">Unlock financial service efficiency backed by 30+ years of<br>trusted expertise in consumer loan servicing</p>
                <div class="services-hero-action">
                    <a href="#" class="btn-pill-white">
                        Learn More at Alorica.com 
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
            <div class="services-hero-image-area">
                <!-- Using service1.png as requested for the hero -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/services1.png" alt="Hero Banner" class="services-hero-image">
            </div>
        </div>
    </section>

    <!-- Sub Header & Track Record Section -->
    <section class="services-subheader-section">
        <div class="container text-center">
            <h2 class="services-subheader-title">Primary and Backup Loan Servicing Solutions</h2>
            <p class="services-subheader-text">System & Services Technologies, Inc., powered by Alorica, is committed to building strong partnerships that align to our clients’ strategies and leverage our proven capabilities to deliver unmatched customer experience, compliance, and operational efficiency.</p>
            
            <div class="services-track-record-wrap">
                <h2 class="services-subheader-title">Track Record of Excellence</h2>
            </div>

            <!-- Grid for 4 points -->
            <div class="services-excellence-grid">
                <div class="excellence-item">
                    <div class="excellence-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img1.png" alt="Depth of Experience">
                    </div>
                    <div class="excellence-content">
                        <h3>Depth of Experience</h3>
                        <p>30+ years of end-to-end consumer loan servicing experience and expertise for the world's largest financial institutions.</p>
                    </div>
                </div>

                <div class="excellence-item">
                    <div class="excellence-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img2.png" alt="Culture of Compliance">
                    </div>
                    <div class="excellence-content">
                        <h3>Culture of Compliance</h3>
                        <p>Tenured leadership team and dedicated compliance resources that deliver an unmatched compliance management program.</p>
                    </div>
                </div>

                <div class="excellence-item">
                    <div class="excellence-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img3.png" alt="Geo-Diversification">
                    </div>
                    <div class="excellence-content">
                        <h3>Geo-Diversification</h3>
                        <p>Unique market delivery options that drive efficiency, scalability, and cost-savings.</p>
                    </div>
                </div>

                <div class="excellence-item">
                    <div class="excellence-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img4.png" alt="Outcome Focused">
                    </div>
                    <div class="excellence-content">
                        <h3>Outcome Focused</h3>
                        <p>Proven success designing and deploying customer experiences that drive satisfaction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section: Ready to Get Started? -->
    <section class="services-contact-cta">
        <div class="contact-cta-left">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-contact.png" alt="Ready to Get Started">
        </div>
        <div class="contact-cta-right">
            <h2>Ready to Get Started?</h2>
            <p>Learn more about Systems & Services Technologies, Inc., powered by Alorica, and reach out today to get started.</p>
            <a href="#" class="btn-visit">Visit Alorica.com</a>
        </div>
    </section>


<?php get_footer(); ?>
