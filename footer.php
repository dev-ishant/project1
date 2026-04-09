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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BBB-Seal.png" alt="BBB Accredited Business" width="80" style="display:block; margin: 0 auto;">
            </div>

            <hr class="footer-divider" style="margin-top: 30px; margin-bottom: 0;">
        </div>
    </div>
</footer>

<!-- BACK TO TOP -->
<button id="scroll-top" aria-label="Back to top" title="Back to top" style="opacity:0;pointer-events:none;">
    <i class="bi bi-chevron-up"></i>
</button>

<!-- GOOGLE TRANSLATE WIDGET -->
<div class="lang-widget-container">
    <div id="sst-lang-panel" class="lang-panel" style="display:none;">
        <p style="margin: 0 0 10px 0; font-size: 0.9rem; color: #003049; font-weight: 600;">Select Language</p>
        <div id="google_translate_element"></div>
    </div>
    <button class="lang-btn" aria-label="Translate" id="sst-lang-toggle">
        <i class="bi bi-translate"></i>
    </button>
</div>
<style>
.lang-widget-container {
    position: fixed;
    bottom: 100px;
    left: 15px; /* Moved bit to the left to align with accessibility button */
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
}
.lang-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #003049; /* SST Navy */
    color: #fff;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.lang-btn:hover {
    transform: scale(1.1);
    background-color: #2e7bbd;
}
.lang-panel {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    animation: slideUpLang 0.3s ease-out forwards;
    min-width: 180px;
}
@keyframes slideUpLang {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
/* Style the Google Translate inside the panel */
.goog-te-gadget-simple {
    background-color: #f8f9fa !important;
    border: 1px solid #ddd !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05) !important;
    display: flex !important;
    align-items: center;
    width: 100%;
}
.goog-te-gadget-icon { display: none; }
.goog-te-menu-value { display: flex; align-items: center; justify-content: space-between; width: 100%; }
.goog-te-menu-value span { color: #003049 !important; font-weight: 500 !important; }
body { top: 0 !important; }
.skiptranslate iframe { display: none !important; } /* Hide the top google bar */
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const langToggle = document.getElementById('sst-lang-toggle');
    const langPanel  = document.getElementById('sst-lang-panel');
    if (langToggle && langPanel) {
        langToggle.addEventListener('click', function() {
            langPanel.style.display = (langPanel.style.display === 'none' || langPanel.style.display === '') ? 'block' : 'none';
        });
    }
});
</script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- CHATBOT WIDGET -->
<div class="chatbot-widget-container">
    <button class="chat-btn" aria-label="Open chat" id="sst-chatbot-toggle">
        <i class="bi bi-chat-dots-fill"></i>
    </button>
</div>

<!-- Chatbot Modal/Panel -->
<div id="sst-chatbot-panel" class="chatbot-panel" style="display:none;">
    <div class="chatbot-header">
        <h4><i class="bi bi-robot"></i> SST Virtual Assistant</h4>
        <button id="sst-chatbot-close" class="chatbot-close">&times;</button>
    </div>
    <div class="chatbot-body" id="chatbot-body">
        <p class="bot-msg">Hello! How can I help you today?</p>
    </div>
    <div class="chatbot-footer">
        <input type="text" id="chat-input-field" placeholder="Type your message...">
        <button class="chat-send-btn" id="chat-send-btn"><i class="bi bi-send-fill"></i></button>
    </div>
</div>

<style>
/* Chatbot Styles */
.chatbot-widget-container {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 9999;
}
.chat-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #003049; /* SST Navy */
    color: #fff;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    align-items: center;
    justify-content: center;
}
.chat-btn:hover {
    transform: scale(1.1);
    background-color: #2e7bbd; /* SST Light Blue */
}
.chatbot-panel {
    position: fixed;
    bottom: 95px;
    right: 25px;
    width: 350px;
    height: 480px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    z-index: 9999;
    flex-direction: column;
    overflow: hidden;
    animation: slideUpChat 0.3s ease-out forwards;
}
@keyframes slideUpChat {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.chatbot-header {
    background: #003049;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.chatbot-header h4 { margin: 0; font-size: 1.05rem; display: flex; align-items: center; gap: 8px; }
.chatbot-close {
    background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; opacity: 0.8;
}
.chatbot-close:hover { opacity: 1; }
.chatbot-body {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #f8f9fa;
    display: flex;
    flex-direction: column;
}
.bot-msg {
    align-self: flex-start;
    background: #eef7ff;
    color: #003049;
    padding: 12px 16px;
    border-radius: 15px 15px 15px 0;
    max-width: 85%;
    font-size: 0.95rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    margin: 0 0 10px 0;
}
.bot-msg a {
    color: #003049;
    font-weight: bold;
    text-decoration: underline;
}
.user-msg {
    align-self: flex-end;
    background: #003049;
    color: #fff;
    padding: 12px 16px;
    border-radius: 15px 15px 0 15px;
    max-width: 85%;
    font-size: 0.95rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    margin: 0 0 10px 0;
}
.chatbot-footer {
    padding: 15px;
    background: white;
    border-top: 1px solid #ebebeb;
    display: flex;
    gap: 10px;
}
.chatbot-footer input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
    font-size: 0.9rem;
}
.chat-send-btn {
    background: #2e7bbd;
    color: white;
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatToggle = document.getElementById('sst-chatbot-toggle');
    const chatPanel  = document.getElementById('sst-chatbot-panel');
    const chatClose  = document.getElementById('sst-chatbot-close');
    const chatInput  = document.getElementById('chat-input-field');
    const chatSend   = document.getElementById('chat-send-btn');
    const chatBody   = document.getElementById('chatbot-body');

    // Toggle Chat Panel
    if (chatToggle && chatPanel) {
        chatToggle.addEventListener('click', function() {
            chatPanel.style.display = (chatPanel.style.display === 'none' || chatPanel.style.display === '') ? 'flex' : 'none';
        });
    }
    if (chatClose && chatPanel) {
        chatClose.addEventListener('click', () => {
             chatPanel.style.display = 'none';
        });
    }

    // Bot Logic Mapping
    const siteMap = {
        'services': 'Check out our <a href="<?php echo home_url('/services'); ?>">Services page</a> to see what we offer.',
        'donate': 'You can contribute via our <a href="<?php echo home_url('/donate'); ?>">Donation Portal</a>.',
        'donation': 'You can submit a request on our <a href="<?php echo home_url('/sst-request-for-donation'); ?>">Request for Donation</a> page.',
        'pay': 'Want to make a payment? Head to <a href="<?php echo home_url('/pay-your-bill'); ?>">Pay Your Bill</a>.',
        'bill': 'Want to make a payment? Head to <a href="<?php echo home_url('/pay-your-bill'); ?>">Pay Your Bill</a>.',
        'contact': 'Reach out to our team right here: <a href="<?php echo home_url('/contact'); ?>">Contact Us</a>.',
        'payroll': 'Submit your deduction form here: <a href="<?php echo home_url('/payroll-deduction'); ?>">Payroll Deduction</a>.',
        'profile': 'View your profile and security settings at your <a href="<?php echo home_url('/user-profile'); ?>">Dashboard</a>.'
    };

    function appendMessage(text, type) {
        const msg = document.createElement('p');
        msg.className = type === 'user' ? 'user-msg' : 'bot-msg';
        msg.innerHTML = text;
        chatBody.appendChild(msg);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function handleChatSend() {
        const rawVal = chatInput.value;
        const val = rawVal.trim().toLowerCase();
        if(!val) return;
        
        // 1. Add User Message
        appendMessage(rawVal, 'user');
        chatInput.value = '';

        // 2. Add Bot Response after delay
        setTimeout(() => {
            let found = false;
            for(let key in siteMap) {
                if(val.includes(key)) {
                    appendMessage(siteMap[key], 'bot');
                    found = true;
                    break;
                }
            }
            if(!found) {
                appendMessage('I am a simple website assistant. Try asking me about our <b>Services</b>, <b>Donate</b>, <b>Pay Bill</b>, or <b>Contact</b>.', 'bot');
            }
        }, 600);
    }

    if (chatSend && chatInput) {
        chatSend.addEventListener('click', handleChatSend);
        chatInput.addEventListener('keypress', (e) => {
            if(e.key === 'Enter') handleChatSend();
        });
    }
});
</script>

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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BBB-Seal.png" alt="SST Logo" style="height: 35px; width: auto; object-fit: contain;">
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