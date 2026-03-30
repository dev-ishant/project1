</main><!-- /#primary / #main-content -->

<!-- FOOTER -->
<footer id="sst-footer">
    <div class="container">
        <div class="footer-top-row">
            <div class="footer-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php
else: ?>
                        <svg width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="white"/>
                            <path d="M25 60 C35 75, 65 75, 75 60 L65 50 C55 60, 45 60, 35 50 Z" fill="#003366"/>
                            <path d="M25 40 C35 25, 65 25, 75 40 L65 50 C55 40, 45 40, 35 50 Z" fill="#003366"/>
                        </svg>
                        <div class="logo-text-wrap">
                            Systems &amp; Services<br>Technologies, Inc.
                        </div>
                    <?php
endif; ?>
                </a>
            </div>

            <nav class="footer-primary-links" aria-label="Footer Navigation">
                <?php
if (has_nav_menu('footer-menu')) {
    wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'menu_class' => '',
        'container' => false,
        'depth' => 1,
    ));
}
else {
    // Fallback static links
?>
                    <a href="<?php echo esc_url(home_url('/pay-your-bill/')); ?>">Pay Your Bill</a>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
                    <?php
}
?>
            </nav>
        </div>

        <hr class="footer-divider">

        <div class="footer-legal">
            <div class="footer-links-row">
                <span>&copy; <?php echo date('Y'); ?> Systems &amp; Services Technologies, Inc.</span>
                <span class="sep">|</span>
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
                <span class="sep">|</span>
                <a href="<?php echo esc_url(home_url('/terms/')); ?>">Terms of Use</a>
                <span class="sep">|</span>
                <a href="<?php echo esc_url(home_url('/legal/')); ?>">Legal Disclosures</a>
                <span class="sep">|</span>
                <a href="#" class="cookie-settings" id="footer-cookie-settings">Cookie Settings</a>
            </div>

            <p class="alorica-text">
                Alorica Inc. ("Alorica") is the holding company of various direct and indirect subsidiaries, including Systems &amp; Services Technologies, Inc., NMLS 950746. Many of Alorica Inc.'s subsidiaries operate under the brand, Alorica, but all remain separate legal entities.
            </p>

            <div class="footer-bbb">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bbb-logo.png" alt="BBB Accredited Business" width="80" style="display:block; margin: 0 auto;">
            </div>

            <hr class="footer-divider" style="margin-top: 30px; margin-bottom: 0;">
        </div>
    </div>
</footer>

<!-- BACK TO TOP -->
<button id="scroll-top" aria-label="Back to top" title="Back to top" style="opacity:0;pointer-events:none;">
    <i class="bi bi-chevron-up"></i>
</button>

<!-- FLOATING WIDGETS -->
<div class="translate-widget">
    <button class="translate-btn" aria-label="Translate"><i class="bi bi-translate"></i></button>
</div>
<div class="a11y-widget">
    <button class="a11y-btn" aria-label="Accessibility settings"><i class="bi bi-person-fill"></i></button>
</div>
<div class="chat-widget">
    <button class="chat-btn" aria-label="Open chat"><i class="bi bi-chat-dots-fill"></i></button>
</div>

<?php wp_footer(); ?>
    <!-- Cookie Consent Banner -->
    <div id="cookie-banner" class="cookie-banner-wrapper">
        <div class="cookie-banner-content">
            <div class="cookie-banner-text">
                <h3>Our Cookie Policy</h3>
                <p>We use cookies to improve your experience, analyze site traffic, and serve targeted advertisements. By clicking "Allow All", you consent to our use of cookies. <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" style="color: #003049; text-decoration: underline;">Read our Privacy Policy</a>.</p>
            </div>
            <div class="cookie-banner-actions">
                <button type="button" class="btn-cookie-outline" id="btn-cookie-settings">Cookie Settings</button>
                <button type="button" class="btn-cookie-solid" id="btn-cookie-allow-all">Allow All</button>
            </div>
        </div>
    </div>

    <!-- Cookie Preference Modal -->
    <div id="cookie-modal-overlay" class="cookie-modal-overlay">
        <div class="cookie-modal">
            <div class="cookie-modal-header">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bbb-logo.png" alt="SST Logo" style="height: 35px; width: auto; object-fit: contain;">
                <span class="cookie-close" id="cookie-modal-close">&times;</span>
            </div>
            
            <div class="cookie-modal-body">
                <h4>Manage Consent Preferences</h4>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 25px;">When you visit any website, it may store or retrieve information on your browser, mostly in the form of cookies. This information might be about you, your preferences or your device and is mostly used to make the site work as you expect it to.</p>
                
                <!-- Strictly Necessary -->
                <div class="cookie-pref-item">
                    <div class="pref-info">
                        <h5>Strictly Necessary Cookies</h5>
                        <p>These cookies are necessary for the website to function and cannot be switched off in our systems.</p>
                    </div>
                    <div class="always-active-text">Always Active</div>
                </div>

                <!-- Functional Cookies -->
                <div class="cookie-pref-item">
                    <div class="pref-info">
                        <h5>Functional Cookies</h5>
                        <p>These cookies enable the website to provide enhanced functionality and personalization.</p>
                    </div>
                    <label class="cookie-switch">
                        <input type="checkbox" id="pref-functional" checked>
                        <span class="cookie-slider"></span>
                    </label>
                </div>

                <!-- Targeting Cookies -->
                <div class="cookie-pref-item">
                    <div class="pref-info">
                        <h5>Targeting Cookies</h5>
                        <p>These cookies may be set through our site by our advertising partners to build a profile of your interests.</p>
                    </div>
                    <label class="cookie-switch">
                        <input type="checkbox" id="pref-targeting" checked>
                        <span class="cookie-slider"></span>
                    </label>
                </div>
            </div>

            <div class="cookie-modal-footer">
                <button type="button" class="btn-cookie-outline" id="btn-cookie-reject-all">Reject All</button>
                <button type="button" class="btn-cookie-solid" id="btn-cookie-confirm">Confirm My Choices</button>
            </div>
        </div>
    </div>

</body>
</html>