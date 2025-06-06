/*Autor(en): Lennart Moog*/
// Sichtbarkeit der Breadcrumbs beim Laden der Seite setzen
document.addEventListener('DOMContentLoaded', function () {
    const breadcrumbs = document.querySelector('.breadcrumbs');
    const toggleButton = document.getElementById('toggle-breadcrumbs');
    const isHidden = localStorage.getItem('breadcrumbsHidden') === 'true';

    if (breadcrumbs && !isHidden) {
        breadcrumbs.classList.add("open");
    }
    if (toggleButton) {
        toggleButton.textContent = isHidden ? 'Breadcrumbs anzeigen' : 'Breadcrumbs ausblenden';
    }

    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            const breadcrumbs = document.getElementById('breadcrumbs-container');
            const isHidden = !breadcrumbs.classList.contains("open");
            breadcrumbs.classList.toggle("open");

            document.getElementById('toggle-breadcrumbs').textContent = isHidden ? 'Breadcrumbs ausblenden' : 'Breadcrumbs anzeigen';

            // Zustand in localStorage speichern
            localStorage.setItem('breadcrumbsHidden', `${!isHidden}`);
        });
    }
});
/*Autor(en): Lennart Moog*/