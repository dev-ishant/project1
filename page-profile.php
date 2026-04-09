<?php
/**
 * Template Name: Profile
 */

// Protected page: Redirect to login if not logged in
if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login/' ) );
    exit;
}

get_header(); 
$current_user = wp_get_current_user();

// Fetch Pending Status for Dashboard
$pending_check = new WP_Query(array(
    'post_type' => 'sst_deduction',
    'post_status' => 'pending',
    'meta_query' => array(
        array(
            'key' => '_sst_user_id',
            'value' => $current_user->ID,
            'compare' => '='
        )
    ),
    'posts_per_page' => 1
));
$has_pending = $pending_check->have_posts();
?>

<main id="primary" class="site-main">
    <div class="profile-glass-wrapper">
        <div class="profile-glass-container">
            <!-- Glass Sidebar -->
            <aside class="profile-glass-sidebar">
                <div class="profile-user-info">
                    <div class="user-avatar-placeholder">
                        <i class="bi bi-person-bounding-box"></i>
                    </div>
                    <h3 class="user-welcome-name"><?php echo esc_html( $current_user->display_name ); ?></h3>
                    <p class="user-role-tag"><?php echo ucfirst( $current_user->roles[0] ?? 'Member' ); ?></p>
                </div>

                <nav class="profile-glass-nav">
                    <button class="glass-nav-item active" data-tab="panel-dashboard">
                        <i class="bi bi-cpu"></i> <span>Operational Center</span>
                    </button>
                    <button class="glass-nav-item" data-tab="panel-security">
                        <i class="bi bi-fingerprint"></i> <span>Security Protocol</span>
                    </button>
                    <hr class="glass-nav-divider">
                    <a href="<?php echo wp_logout_url( home_url() ); ?>" class="glass-nav-item logout-item">
                        <i class="bi bi-power"></i> <span>Terminate Session</span>
                    </a>
                </nav>
            </aside>

            <!-- Glass Main Content -->
            <div class="profile-glass-content">
                <!-- DASHBOARD PANEL -->
                <div id="panel-dashboard" class="profile-panel active">
                    <div class="panel-header">
                        <h1 class="panel-title">Operational Dashboard</h1>
                        <p class="panel-tagline">Real-time account status and performance metrics.</p>
                    </div>

                    <div class="glass-stats-grid">
                        <div class="glass-stat-card">
                            <div class="stat-icon"><i class="bi bi-calendar3-event"></i></div>
                            <div class="stat-data">
                                <span class="stat-label">Member Since</span>
                                <span class="stat-value"><?php echo date( 'M Y', strtotime( $current_user->user_registered ) ); ?></span>
                            </div>
                        </div>
                        <div class="glass-stat-card">
                            <div class="stat-icon icon-alt"><i class="bi bi-shield-check"></i></div>
                            <div class="stat-data">
                                <span class="stat-label">Security Health</span>
                                <span class="stat-value">Nominal</span>
                            </div>
                        </div>
                        <div class="glass-stat-card">
                            <div class="stat-icon icon-special"><i class="bi bi-graph-up-arrow"></i></div>
                            <div class="stat-data">
                                <span class="stat-label">Total Deduction</span>
                                <span class="stat-value">$<?php 
                                    $total = get_user_meta( $current_user->ID, '_sst_total_deduction', true );
                                    echo number_format( floatval($total), 2 ); 
                                ?></span>
                                <?php if ($has_pending) : ?>
                                    <span class="stat-status-active"><i class="bi bi-clock-history"></i> Payment Active</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="glass-stat-card">
                            <div class="stat-icon icon-special-2" style="background: rgba(255, 140, 0, 0.1); color: #ff8c00;"><i class="bi bi-globe-americas"></i></div>
                            <div class="stat-data">
                                <span class="stat-label">Countries Impacted</span>
                                <span class="stat-value"><?php 
                                    $countries = get_user_meta( $current_user->ID, '_sst_donated_countries', true );
                                    echo is_array($countries) ? count($countries) : 0; 
                                ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="glass-info-section">
                        <div class="section-card-header">
                            <i class="bi bi-cash-stack"></i> Recent Donation Log
                        </div>
                        <div class="glass-history-table-wrapper">
                            <table class="glass-history-table">
                                <thead>
                                    <tr>
                                        <th>Destination</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $history_query = new WP_Query(array(
                                        'post_type' => 'sst_deduction',
                                        'post_status' => array('publish', 'pending'),
                                        'posts_per_page' => 5,
                                        'meta_query' => array(
                                            array(
                                                'key' => '_sst_user_id',
                                                'value' => $current_user->ID,
                                                'compare' => '='
                                            )
                                        )
                                    ));

                                    if ( $history_query->have_posts() ) :
                                        while ( $history_query->have_posts() ) : $history_query->the_post();
                                            $amount  = get_post_meta(get_the_ID(), '_sst_amount', true);
                                            $country = get_post_meta(get_the_ID(), '_sst_country', true);
                                            $date    = get_post_meta(get_the_ID(), '_sst_date', true);
                                            $status  = get_post_status();
                                            ?>
                                            <tr>
                                                <td><span class="badge-country"><?php echo esc_html($country ?: 'General'); ?></span></td>
                                                <td>$<?php echo number_format(floatval($amount), 2); ?></td>
                                                <td><?php echo date('M d, Y', strtotime($date)); ?></td>
                                                <td>
                                                    <?php if ($status === 'publish') : ?>
                                                        <span class="status-badge status-confirmed">Confirmed</span>
                                                    <?php else : ?>
                                                        <span class="status-badge status-pending">Processing</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile;
                                        wp_reset_postdata();
                                    else : ?>
                                        <tr>
                                            <td colspan="4" style="text-align:center; padding: 20px; opacity: 0.6;">No donation records found in the node.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="glass-info-section">
                        <div class="section-card-header">
                            <i class="bi bi-reception-4"></i> Profile Synchronization
                        </div>
                        <div class="glass-progress-bar">
                            <div class="progress-fill" style="width: 85%;"></div>
                            <span class="progress-pct">85% COMPLETE</span>
                        </div>
                        
                        <div class="glass-detail-list">
                            <div class="detail-row">
                                <span class="row-label">Operational Identity</span>
                                <span class="row-value"><?php echo esc_html( $current_user->display_name ); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="row-label">System Login Node</span>
                                <span class="row-value"><?php echo esc_html( $current_user->user_login ); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="row-label">Communication Node</span>
                                <span class="row-value"><?php echo esc_html( $current_user->user_email ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECURITY PANEL -->
                <div id="panel-security" class="profile-panel">
                    <div class="panel-header">
                        <h1 class="panel-title">Security & Access</h1>
                        <p class="panel-tagline">Manage your credentials and authentication nodes.</p>
                    </div>

                    <form id="sst-profile-update-form" class="glass-form">
                        <div class="form-group">
                            <label class="glass-label">Existing Access Key</label>
                            <input type="password" name="current_password" class="glass-input" required placeholder="Verify current security key">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="glass-label">New Access Key</label>
                                <input type="password" name="new_password" id="new_password" class="glass-input" required placeholder="Generate new secure key">
                            </div>
                            <div class="form-group">
                                <label class="glass-label">Confirm Key</label>
                                <input type="password" name="confirm_password" class="glass-input" required placeholder="Verify new key">
                            </div>
                        </div>
                        <div id="password-match-msg" class="profile-msg" style="display:none;"></div>
                        <button type="submit" class="glass-submit-btn">
                            <i class="bi bi-arrow-repeat"></i> Synchronize Protocols
                        </button>
                        <div id="profile-msg" class="profile-msg"></div>
                    </form>
                </div>
            </div><!-- /.profile-glass-content -->
        </div><!-- /.profile-glass-container -->
    </div><!-- /.profile-glass-wrapper -->
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.glass-nav-item[data-tab]');
    const panels = document.querySelectorAll('.profile-panel');

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Update nav
            navItems.forEach(ni => ni.classList.remove('active'));
            this.classList.add('active');

            // Update panels
            panels.forEach(p => {
                p.classList.remove('active');
                if (p.id === targetTab) p.classList.add('active');
            });
        });
    });

    // AJAX Password Change
    const form = document.querySelector('#sst-profile-update-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = document.querySelector('#profile-msg');
            const btn = form.querySelector('button');
            
            const formData = new FormData(form);
            formData.append('action', 'sst_update_password_ajax');
            formData.append('_nonce', '<?php echo wp_create_nonce("sst_auth_nonce"); ?>');

            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Synchronizing...';
            msg.className = 'profile-msg';
            msg.textContent = '';

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-cloud-upload"></i> Synchronize Settings';
                
                if (data.success) {
                    msg.classList.add('success');
                    msg.textContent = data.data.message || 'Data synchronized successfully.';
                    form.reset();
                } else {
                    msg.classList.add('error');
                    // Handle case where data.data is an object with a message or just a string
                    const errorMsg = (data.data && data.data.message) ? data.data.message : (typeof data.data === 'string' ? data.data : 'Synchronization error.');
                    msg.textContent = errorMsg;
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-cloud-upload"></i> Synchronize Settings';
                msg.classList.add('error');
                msg.textContent = 'Network connectivity error.';
            });
        });
    }
});
</script>

<?php get_footer(); ?>
