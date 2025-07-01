/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
// Sichtbarkeit der Breadcrumbs beim Laden der Seite setzen
document.addEventListener('DOMContentLoaded', function () {
    const breadcrumbs = document.querySelector('.breadcrumbs');
    const toggleButton = document.getElementById('toggle-breadcrumbs');
    let isHidden = localStorage.getItem('breadcrumbsHidden') === 'true';

    if (breadcrumbs && !isHidden) {
        breadcrumbs.classList.add("open");
    }
    if (toggleButton) {
        toggleButton.textContent = isHidden ? 'Breadcrumbs anzeigen' : 'Breadcrumbs ausblenden';
    }

    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            const breadcrumbs = document.getElementById('breadcrumbs-container');
            //const isHidden = !breadcrumbs.classList.contains("open");
            //breadcrumbs.classList.toggle("open");
            isHidden = localStorage.getItem('breadcrumbsHidden') === 'true';

            document.getElementById('toggle-breadcrumbs').textContent = isHidden ? 'Breadcrumbs ausblenden' : 'Breadcrumbs anzeigen';

            // Zustand in localStorage speichern
            localStorage.setItem('breadcrumbsHidden', `${!isHidden}`);
        });
    }
});