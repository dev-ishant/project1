document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('cookie-banner');
    const modal = document.getElementById('cookie-modal-overlay');
    const btnSettings = document.getElementById('btn-cookie-settings');
    const footerLink = document.getElementById('footer-cookie-settings');
    const btnAllowAll = document.getElementById('btn-cookie-allow-all');
    const btnRejectAll = document.getElementById('btn-cookie-reject-all');
    const btnConfirm = document.getElementById('btn-cookie-confirm');
    const btnClose = document.getElementById('cookie-modal-close');
    
    // Show banner if no consent stored
    if (!localStorage.getItem('cookie_consent_given')) {
        setTimeout(() => {
            if (banner) {
                banner.style.display = 'block';
            }
        }, 1000);
    }

    // Open Settings Modal (Banner button)
    if (btnSettings) {
        btnSettings.addEventListener('click', () => {
            if (modal) modal.style.display = 'flex';
        });
    }

    // Open Settings Modal (Footer link)
    if (footerLink) {
        footerLink.addEventListener('click', (e) => {
            e.preventDefault();
            if (modal) modal.style.display = 'flex';
        });
    }

    // Close Modal
    if (btnClose) {
        btnClose.addEventListener('click', () => {
            if (modal) modal.style.display = 'none';
        });
    }

    // Allow All
    if (btnAllowAll) {
        btnAllowAll.addEventListener('click', () => {
            saveConsent({ necessary: true, functional: true, targeting: true });
        });
    }

    // Reject All
    if (btnRejectAll) {
        btnRejectAll.addEventListener('click', () => {
            saveConsent({ necessary: true, functional: false, targeting: false });
        });
    }

    // Confirm Choices
    if (btnConfirm) {
        btnConfirm.addEventListener('click', () => {
            const functionalInput = document.getElementById('pref-functional');
            const targetingInput = document.getElementById('pref-targeting');
            const functional = functionalInput ? functionalInput.checked : false;
            const targeting = targetingInput ? targetingInput.checked : false;
            saveConsent({ necessary: true, functional, targeting });
        });
    }

    function saveConsent(choices) {
        localStorage.setItem('cookie_consent_given', 'true');
        localStorage.setItem('cookie_preferences', JSON.stringify(choices));
        if (banner) banner.style.display = 'none';
        if (modal) modal.style.display = 'none';
        console.log('Consent Saved:', choices);
    }
});
