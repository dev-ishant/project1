<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main error-404-page" style="background-color: #f8fbff; min-height: 70vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 100px 20px;">
    <div class="container">
        <section class="error-404 not-found">
            <div class="error-icon" style="margin-bottom: 30px;">
                <i class="bi bi-exclamation-octagon" style="font-size: 6rem; color: #003049;"></i>
            </div>
            
            <header class="page-header">
                <h1 class="page-title" style="font-size: 4rem; color: #003049; margin-bottom: 10px; font-weight: 700;">404</h1>
                <h2 style="font-size: 2rem; color: #333; margin-bottom: 30px; font-weight: 500;">Oops! That page can’t be found.</h2>
            </header>

            <div class="page-content" style="max-width: 600px; margin: 0 auto 50px;">
                <p style="font-size: 1.2rem; color: #666; line-height: 1.6;">It looks like nothing was found at this location. Maybe try one of the links below or return to the homepage.</p>
                
                <div class="quick-links" style="margin-top: 30px; display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( home_url( '/pay-your-bill/' ) ); ?>" style="color: #003049; text-decoration: underline; font-weight: 500;">Pay Your Bill</a>
                    <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" style="color: #003049; text-decoration: underline; font-weight: 500;">Our Services</a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color: #003049; text-decoration: underline; font-weight: 500;">Contact Support</a>
                </div>
            </div>

            <div class="error-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-filled-blue" style="background-color: #003049; color: #fff; padding: 16px 45px; border-radius: 50px; font-size: 1.1rem; text-decoration: none; display: inline-block; font-weight: 600; transition: background-color 0.3s;">
                    Back to Homepage
                </a>
            </div>
        </section>
    </div>
</main>

<style>
.error-404-page .btn-filled-blue:hover {
    background-color: #004a7c !important;
}
</style>

<?php
get_footer();
