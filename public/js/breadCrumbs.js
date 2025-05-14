const translation = {
    categories: 'Kategorie',
    clothes: 'Kleidung',
    bags: 'Taschen',
    accessories: 'Accessoires',
    "about-us": 'Über uns',
    "customer-service": 'Kundenservice',
    "your-purchases": 'Dein Einkauf',
    legal: 'Rechtliches',
    impress: 'Impressum',
    "user-area": 'Benutzerbereich',
}


document.addEventListener("DOMContentLoaded", function () {
    const breadcrumbsContainer = document.getElementById('breadcrumbs-container');
    if (!breadcrumbsContainer) return;



    const breadcrumbData = generateBreadcrumbList();

    breadcrumbsContainer.innerHTML = ''; // Container leeren


    // // Breadcrumbs hardcoded generieren / nur möglich, wenn Pfad in jeweiliger Seite angegeben
    breadcrumbData.forEach((item, index) => {
         if (item.url) {
             const link = document.createElement('a');
             link.href = item.url;
             link.textContent = item.name;
             breadcrumbsContainer.appendChild(link);
         } else {
             const span = document.createElement('span');
             span.textContent = item.name;
             breadcrumbsContainer.appendChild(span);
         }

         // Trennzeichen hinzufügen, außer beim letzten Element
         if (index < breadcrumbData.length - 1) {
             const separator = document.createElement('span');
             separator.textContent = ' / ';
             breadcrumbsContainer.appendChild(separator);
         }
     });
});

function generateBreadcrumbList() {
    let previousCategory = ""; // Variable für die vorherige Kategorie (Shirt, Sweater, usw.)
    let previousCategoryUrl = ""; // Variable für die URL der vorherigen Kategorie
    const h1Text = document.querySelector("h1")?.textContent; // Holt den Text des h1-Elements der aktuellen Seite
    const parts = location.pathname.split('/'); // Teilt Pfad in seine Komponenten
    let path = '/'; // Initialer Pfad
    const breadcrumbs = [{ name: "Startseite", url: "/" }]; // Map für die Breadcrumbs mit Startseite initial


    //wenn die URL "categoryId=bag" oder "categoryId=accessory" enthält
    if (
        window.location.href.includes("categoryId=bag") ||
        window.location.href.includes("categoryId=cap")
    ) {
        /* Breadcrumbs für die Kategorie "Accessoires" generieren und Link-Weiterleitung zu "/categories/accessoires.php"
        * z.B. "Accessoires / Cap" oder "Accessoires / Bag"
        * Für die aktuelle Seite wird der h1-Text verwendet
         */
        return [
            {name: "Startseite", url: "/"},
            {name: "Accessoires", url: "/categories/accessories"},
            {name: h1Text, url: null}
        ];

    }
    //wenn die URL "categoryId=shirt" oder "categoryId=sweater" enthält
    if (
        window.location.href.includes("categoryId=shirt") ||
        window.location.href.includes("categoryId=sweater")
    ) {
        return [
            {name: "Startseite", url: "/"},
            {name: "Kleidung", url: "/categories/clothes"},
            {name: h1Text || "Kategorie", url: null}
        ];
    }

    for (let i = 1; i < parts.length; i++) {
        const part = parts[i];
        const translated = translation[part] ?? decodeURIComponent(part); // decodeURIComponent für Sonderzeichen
        path += part + "/"; // Pfad aktualisieren
        if (i === parts.length - 1) {
            breadcrumbs.push({ name: h1Text, url: null }); // Seitenname von aktueller Seite ohne URL
        } else {
            breadcrumbs.push({ name: translated, url: path }); // Übersetzte Breadcrumbs mit URL
        }
    }

    return breadcrumbs; // Rückgabe der Breadcrumbs
}