<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="main-header">
    <div class="container header-container">

        <!-- Logo / Branding -->
        <div class="site-branding">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
                <!-- SVG Logo -->
                <svg class="site-logo-icon" width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="50" fill="white"/>
                    <path d="M25 60 C35 75, 65 75, 75 60 L65 50 C55 60, 45 60, 35 50 Z" fill="#003366"/>
                    <path d="M25 40 C35 25, 65 25, 75 40 L65 50 C55 40, 45 40, 35 50 Z" fill="#003366"/>
                </svg>
                <div class="logo-text-wrap">
                    Systems &amp; Services<br>Technologies, Inc.
                </div>
            </a>
        </div>

        <!-- Hamburger toggle (mobile only) -->
        <button id="nav-toggle" class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="site-navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Primary Navigation -->
        <nav id="site-navigation" class="main-navigation" aria-label="Primary Navigation">
            <?php
            if ( has_nav_menu( 'primary-menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'menu_class'     => '',
                    'container'      => false,
                ) );
            } else {
                ?>
                <ul>
                    <li class="<?php echo is_front_page() ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                    </li>
                    <li class="<?php echo is_page('pay-your-bill') ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url( home_url( '/pay-your-bill/' ) ); ?>">Pay Your Bill</a>
                    </li>
                    <li class="<?php echo is_page('services') ? 'current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a>
                    </li>
                </ul>
                <?php
            }
            ?>
        </nav>

        <!-- CTA Buttons: Donate + Login / User Avatar -->
        <div class="header-cta-group">

            <!-- Donate Button (always visible) -->
            <a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>" class="btn-header-donate">
                <i class="bi bi-heart-fill"></i> Donate
            </a>

            <!-- Login / User avatar -->
            <?php if ( is_user_logged_in() ) :
                $current_user = wp_get_current_user();
                $avatar_url   = get_avatar_url( $current_user->ID, array( 'size' => 36 ) );
            ?>
                <div class="user-avatar-wrap" id="user-avatar-wrap">
                    <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $current_user->display_name ); ?>" class="user-avatar-img">
                    <span class="user-display-name"><?php echo esc_html( $current_user->display_name ); ?></span>
                    <i class="bi bi-chevron-down user-caret"></i>

                    <div class="user-dropdown">
                        <a href="<?php echo esc_url( home_url( '/payroll-deduction/' ) ); ?>" class="user-dropdown-item">
                            <i class="bi bi-file-earmark-text"></i> Payroll Deduction Form
                        </a>
                        <a href="<?php echo esc_url( home_url( '/donation-request/' ) ); ?>" class="user-dropdown-item">
                            <i class="bi bi-gift"></i> Request for Donation
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="user-dropdown-item user-dropdown-logout" id="btn-logout">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn-header-login">
                    <i class="bi bi-person-circle"></i> Login
                </a>
            <?php endif; ?>

        </div><!-- /.header-cta-group -->

    </div>
</header>
