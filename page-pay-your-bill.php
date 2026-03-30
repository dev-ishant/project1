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

            <!-- Column 3: Action Box -->
            <div class="bill-column bill-action-column">
                <div class="action-box">
                    <p class="action-description">Already a customer of System & Services Technologies, Inc.?</p>
                    <p class="action-subtext">Click here to access your accountinfo.com loan portal and manage loans.</p>
                    <a href="#" class="btn btn-pill-white">Make a Loan Payment <span class="arrow">&gt;</span></a>
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


<?php get_footer(); ?>
