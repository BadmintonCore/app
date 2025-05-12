// Funktion zum Umschalten der Sichtbarkeit der Breadcrumbs
document.getElementById('toggle-breadcrumbs').addEventListener('click', function() {
    const breadcrumbs = document.querySelector('.breadcrumbs');
    const isHidden = breadcrumbs.style.display === 'none';
    breadcrumbs.style.display = isHidden ? 'block' : 'none';
    document.getElementById('toggle-breadcrumbs').textContent = isHidden ? 'Breadcrumbs ausblenden' : 'Breadcrumbs anzeigen';

    // Zustand in localStorage speichern
    localStorage.setItem('breadcrumbsHidden', !isHidden);
});

// Sichtbarkeit der Breadcrumbs beim Laden der Seite setzen
document.addEventListener('DOMContentLoaded', function() {
    const breadcrumbs = document.querySelector('.breadcrumbs');
    const toggleButton = document.getElementById('toggle-breadcrumbs');
    const isHidden = localStorage.getItem('breadcrumbsHidden') === 'true';

    if (breadcrumbs) {
        breadcrumbs.style.display = isHidden ? 'none' : 'block';
    }
    if (toggleButton) {
        toggleButton.textContent = isHidden ? 'Breadcrumbs anzeigen' : 'Breadcrumbs ausblenden';
    }
});