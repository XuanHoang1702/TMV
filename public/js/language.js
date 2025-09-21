// Language translation functionality
function translateLanguage(lang) {
    console.log('Attempting to translate to:', lang);

    // Try to use Google Translate widget first
    var selectField = document.querySelector(".goog-te-combo");
    if (selectField) {
        console.log('Google Translate widget found, using it');
        selectField.value = lang;
        selectField.dispatchEvent(new Event("change"));
        return;
    }

    // Fallback: use Laravel language routes
    console.log('Google Translate widget not found, using Laravel fallback');
    window.location.href = '/lang/' + lang;
}

// Initialize language functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add error handling for Google Translate
    window.addEventListener('error', function(e) {
        if (e.target && e.target.src && e.target.src.includes('translate_a/element.js')) {
            console.log('Google Translate failed to load, language switching will use fallback');
        }
    });

    // Ensure language selector works properly
    var languageLinks = document.querySelectorAll('a[href*="lang/"]');
    languageLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var href = this.getAttribute('href');
            var lang = href.split('/').pop();
            translateLanguage(lang);
        });
    });
});
