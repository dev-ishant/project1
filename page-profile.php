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
?>

<main id="primary" class="site-main">
    <div class="profile-glass-wrapper">
        <div class="profile-glass-container">
            <!-- Glass Sidebar -->
            <aside class="profile-glass-sidebar">
                <div class="profile-user-info">
                    <div class="user-avatar-placeholder">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h3 class="user-welcome-name"><?php echo esc_html( $current_user->display_name ); ?></h3>
                    <p class="user-role-tag"><?php echo ucfirst( $current_user->roles[0] ?? 'Member' ); ?></p>
                </div>

                <nav class="profile-glass-nav">
                    <button class="glass-nav-item active" data-tab="panel-dashboard">
                        <i class="bi bi-grid-1x2"></i> <span>Dashboard</span>
                    </button>
                    <button class="glass-nav-item" data-tab="panel-security">
                        <i class="bi bi-shield-lock"></i> <span>Security Settings</span>
                    </button>
                    <hr class="glass-nav-divider">
                    <a href="<?php echo wp_logout_url( home_url() ); ?>" class="glass-nav-item logout-item">
                        <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
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
                            <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
                            <div class="stat-data">
                                <span class="stat-label">Member Since</span>
                                <span class="stat-value"><?php echo date( 'M Y', strtotime( $current_user->user_registered ) ); ?></span>
                            </div>
                        </div>
                        <div class="glass-stat-card">
                            <div class="stat-icon icon-alt"><i class="bi bi-activity"></i></div>
                            <div class="stat-data">
                                <span class="stat-label">Account Health</span>
                                <span class="stat-value">Active</span>
                            </div>
                        </div>
                    </div>

                    <div class="glass-info-section">
                        <div class="section-card-header">
                            <i class="bi bi-bar-chart-fill"></i> Profile Completion
                        </div>
                        <div class="glass-progress-bar">
                            <div class="progress-fill" style="width: 85%;"></div>
                            <span class="progress-pct">85%</span>
                        </div>
                        
                        <div class="glass-detail-list">
                            <div class="detail-row">
                                <span class="row-label">Full Name</span>
                                <span class="row-value"><?php echo esc_html( $current_user->display_name ); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="row-label">System Username</span>
                                <span class="row-value"><?php echo esc_html( $current_user->user_login ); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="row-label">Email Node</span>
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
                            <label class="glass-label">Current Access Key (Password)</label>
                            <input type="password" name="current_password" class="glass-input" required placeholder="Verify current key">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="glass-label">New Access Key</label>
                                <input type="password" name="new_password" id="new_password" class="glass-input" required placeholder="New secure key">
                            </div>
                            <div class="form-group">
                                <label class="glass-label">Confirm New Key</label>
                                <input type="password" name="confirm_password" class="glass-input" required placeholder="Re-enter key">
                            </div>
                        </div>
                        <div id="password-match-msg" class="profile-msg" style="display:none;"></div>
                        <button type="submit" class="glass-submit-btn">
                            <i class="bi bi-cloud-upload"></i> Synchronize Settings
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
                    msg.textContent = 'Data synchronized successfully.';
                    form.reset();
                } else {
                    msg.classList.add('error');
                    msg.textContent = data.data || 'Synchronization error.';
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
