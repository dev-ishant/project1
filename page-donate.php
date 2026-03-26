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
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Bulgaria-Flag..PNG' ); ?>" alt="Bulgaria" class="country-icon">
                    <span class="country-name">Bulgaria</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Canada-Flag.webp.PNG' ); ?>" alt="Canada" class="country-icon">
                    <span class="country-name">Canada</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/image7.webp.PNG' ); ?>" alt="Guatemala" class="country-icon">
                    <span class="country-name">Guatemala</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Honduras-Flag.webp.PNG' ); ?>" alt="Honduras" class="country-icon">
                    <span class="country-name">Honduras</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/mexico_color.webp.PNG' ); ?>" alt="Mexico" class="country-icon">
                    <span class="country-name">Mexico</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/panama_color.webp.PNG' ); ?>" alt="Panama" class="country-icon">
                    <span class="country-name">Panama</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ph_color.webp.PNG' ); ?>" alt="Philippines" class="country-icon">
                    <span class="country-name">Philippines</span>
                </div>
                
                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/us_color.webp.PNG' ); ?>" alt="United States" class="country-icon">
                    <span class="country-name">United States</span>
                </div>

                <div class="country-item grayscale">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/P.PNG' ); ?>" alt="Other Countries" class="country-icon">
                    <span class="country-name">Other Countries</span>
                </div>

            </div>
            
            <hr class="donate-section-divider">
        </div>
    </section>

    <!-- Donation Cards -->
    <section class="donation-cards-section">
        <div class="container">
            <div class="donation-cards-grid">
                
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

                <!-- Check Card -->
                <div class="donation-card">
                    <div class="card-icon-header">
                        <div class="icon-circle icon-orange"><i class="bi bi-ticket-perforated"></i></div>
                        <h3 class="card-title text-orange">CHECK</h3>
                    </div>
                    <p class="card-subtext italic text-orange">Km2 Carretera a Armenta, Altia Smart City Torre 3 piso 2,3 y 4</p>
                    <p class="card-text">
                        You can send checks to:<br>Alorica/ MLBA c/o MLBA Program Administrator.
                    </p>
                    <div class="card-footer">
                        <!-- Placeholder link as this is just informational in the screenshot, or links to a general contact/form -->
                        <a href="#" class="btn-donate btn-orange">DONATE</a>
                    </div>
                </div>

                <!-- PayPal Card -->
                <div class="donation-card">
                    <div class="card-icon-header">
                        <div class="icon-circle icon-blue paypal-icon"><i class="bi bi-paypal"></i></div>
                        <h3 class="card-title text-blue italic">PayPal</h3>
                    </div>
                    <p class="card-subtext italic text-blue">Preferred Option to Donate</p>
                    <p class="card-text">
                        PayPal offers reduced processing fees to Registered Charities, so more of your valuable donation gets to MLBA and the people who need it most.
                    </p>
                    <div class="card-footer">
                        <a href="#" class="btn-donate btn-blue">DONATE</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
