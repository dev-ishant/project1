<?php
/**
 * The front page template file
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content container">
            <div class="hero-text-area">
                <h1 class="hero-title">Systems & Services Technologies, Inc.</h1>
                <p class="hero-subtitle">Providing industry-leading loan servicing solutions since 1995</p>
            </div>
            <div class="hero-image-area">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/SST-Homepage-Desktop.png' ); ?>" alt="Hero Banner" class="hero-image">
            </div>
        </div>
    </section>

    <!-- Sub Header Section -->
    <section class="subheader-section">
        <div class="container text-center">
            <h2 class="subheader-title">Comprehensive Consumer Loan Servicing, Unmatched Customer Service</h2>
            <p class="subheader-text">We provide end-to-end loan servicing for secured, unsecured consumer loans and receivables that is supported by industry-leading customer service expertise.</p>
            <p class="nmls-text">NMLS ID: 950746</p>
        </div>
    </section>

    <!-- Two Columns Features Section -->
    <section class="features-section">
        <div class="feature-column feature-banks">
            <!-- Background Image Placeholder for Woman on Laptop -->
            <div class="feature-bg-image feature-bg-1"></div>
            <div class="feature-content-box">
                <h2 class="feature-title">Banks and Financial Institutions</h2>
                <p class="feature-text">Learn more about our scalable, secure, and compliant loan servicing solutions and how we help financial institutions deliver results.</p>
                <a href="#" class="btn btn-outline-white">Visit Alorica.com <span class="arrow">&gt;</span></a>
            </div>
        </div>
        <div class="feature-column feature-customers">
            <!-- Background Image Placeholder for Man on Phone -->
            <div class="feature-bg-image feature-bg-2"></div>
            <div class="feature-content-box dark-box">
                <h2 class="feature-title">Current Customers</h2>
                <p class="feature-text">Already a customer of System & Services Technologies, Inc.? Click here to access your accountinfo.com loan portal and make a loan payment.</p>
                <a href="#" class="btn btn-filled-white">Access Your Account <span class="arrow">&gt;</span></a>
            </div>
        </div>
    </section>

    <!-- CTA Section — Full Width Banner -->
    <section class="cta-section">
        <div class="cta-container-box">
            <div class="cta-image-area">
                <!-- Replace this src with your uploaded image URL -->
                <img src="https://sstloanservicing.com/wp-content/uploads/2025/08/iStock-912491876@2x.png" alt="Get in Touch" class="cta-main-image">
            </div>
            <div class="cta-content-area">
                <h2 class="cta-title">Want to Know More?</h2>
                <p class="cta-text">Reach out today to learn more about Systems &amp; Services Technologies, Inc.</p>
                <a href="#" class="btn btn-filled-dark">Get in Touch</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
