<?php
/**
 * Template Name: Donate
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Donate Hero Banner -->
    <section class="donate-hero-banner" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/d1.PNG' ); ?>');">
        <div class="donate-hero-overlay"></div>
        <div class="container donate-hero-content">
            <h1 class="donate-hero-title">DONATE</h1>
            <p class="donate-hero-subtitle">Small change can make a big difference.</p>
        </div>
    </section>

    <!-- Country Flag Grid -->
    <section class="country-grid-section">
        <div class="container">
            <div class="country-grid">
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Bulgaria' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Bulgaria-Flag..PNG' ); ?>" alt="Bulgaria" class="country-icon">
                    <span class="country-name">Bulgaria</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Canada' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Canada-Flag.webp.PNG' ); ?>" alt="Canada" class="country-icon">
                    <span class="country-name">Canada</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Guatemala' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/image7.webp.PNG' ); ?>" alt="Guatemala" class="country-icon">
                    <span class="country-name">Guatemala</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Honduras' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Honduras-Flag.webp.PNG' ); ?>" alt="Honduras" class="country-icon">
                    <span class="country-name">Honduras</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Mexico' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/mexico_color.webp.PNG' ); ?>" alt="Mexico" class="country-icon">
                    <span class="country-name">Mexico</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Panama' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/panama_color.webp.PNG' ); ?>" alt="Panama" class="country-icon">
                    <span class="country-name">Panama</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Philippines' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ph_color.webp.PNG' ); ?>" alt="Philippines" class="country-icon">
                    <span class="country-name">Philippines</span>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=United States' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/us_color.webp.PNG' ); ?>" alt="United States" class="country-icon">
                    <span class="country-name">United States</span>
                </a>

                <a href="<?php echo esc_url( home_url( '/payroll-deduction/?country=Other' ) ); ?>" class="country-item">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/P.PNG' ); ?>" alt="Other Countries" class="country-icon">
                    <span class="country-name">Other Countries</span>
                </a>

            </div>
            
            <hr class="donate-section-divider">
        </div>
    </section>

    <!-- Donation Cards -->
    <section class="donation-cards-section">
        <div class="container">
            <div class="donation-cards-grid single-card-center">
                
                <!-- Payroll Card -->
                <div class="donation-card">
                    <div class="card-icon-header">
                        <div class="icon-circle icon-blue"><i class="bi bi-currency-dollar"></i></div>
                        <h3 class="card-title text-blue">PAYROLL</h3>
                    </div>
                    <p class="card-subtext italic text-blue">Only Alorica employees can make payroll contributions.</p>
                    <p class="card-text">
                        If you would like to make a one-time or recurring Payroll Deduction, or cancel an existing one, click the button below.
                    </p>
                    <div class="card-footer">
                        <a href="<?php echo esc_url( home_url( '/payroll-deduction/' ) ); ?>" class="btn-donate btn-blue">DONATE</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
