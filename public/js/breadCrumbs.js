// @Author: Lennart Moog

const translation = {
    categories: 'Kategorien',
    clothes: 'Kleidung',
    bags: 'Taschen',
    accessories: 'Accessoires',
    "about-us": 'Über uns',
    "customer-service": 'Kundenservice',
    "your-purchases": 'Dein Einkauf',
    legal: 'Rechtliches',
    impress: 'Impressum',
    "user-area": 'Nutzer',
    auth: "Anmeldung",
    "your-purchase": 'Dein Einkauf',
}


document.addEventListener("DOMContentLoaded", function () {
    const breadcrumbsContainer = document.getElementById('breadcrumbs-container');
    if (!breadcrumbsContainer) return;



    const breadcrumbData = generateBreadcrumbList();

    breadcrumbsContainer.innerHTML = ''; // Container leeren


    // Breadcrumbs generieren
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

        if(window.location.href.includes("itemId=3") ||
            window.location.href.includes("itemId=4")){
            if (window.location.href.includes("itemId=3")){
                previousCategory = "Taschen"; // Setze die vorherige Kategorie auf "accessories"
                previousCategoryUrl = "/categories?categoryId=bag"; // Setze die URL der vorherigen Kategorie

            }
            if (window.location.href.includes("itemId=4")){
                previousCategory = "Caps"; // Setze die vorherige Kategorie auf "bags"
                previousCategoryUrl = "/categories?categoryId=cap"; // Setze die URL der vorherigen Kategorie
            }
            return [
                {name: "Startseite", url: "/"},
                {name: "Accessoires", url: "/categories/accessories"},
                {name: previousCategory, url: previousCategoryUrl},
                {name: h1Text, url: null}
            ];
        }


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
        if(window.location.href.includes("itemId=1") ||
            window.location.href.includes("itemId=2")){
            if (window.location.href.includes("itemId=1")){
                previousCategory = "Shirts"; // Setze die vorherige Kategorie auf "accessories"
                previousCategoryUrl = "/categories?categoryId=shirt"; // Setze die URL der vorherigen Kategorie

            }
            if (window.location.href.includes("itemId=2")){
                previousCategory = "Sweater"; // Setze die vorherige Kategorie auf "bags"
                previousCategoryUrl = "/categories?categoryId=sweater"; // Setze die URL der vorherigen Kategorie
            }
            return [
                {name: "Startseite", url: "/"},
                {name: "Kleidung", url: "/categories/clothes"},
                {name: previousCategory, url: previousCategoryUrl},
                {name: h1Text, url: null}
            ];
        }
        return [
            {name: "Startseite", url: "/"},
            {name: "Kleidung", url: "/categories/clothes"},
            {name: h1Text || "Kategorie", url: null}
        ];
    }

    for (let i = 1; i < parts.length; i++) {
        const part = parts[i];
        const translated = translation[part]; // decodeURIComponent für Sonderzeichen
        path += part + "/"; // Pfad aktualisieren
        if (i === parts.length - 1) {
            breadcrumbs.push({ name: h1Text, url: null }); // Seitenname von aktueller Seite ohne URL
        } else {
            breadcrumbs.push({ name: translated, url: path }); // Übersetzte Breadcrumbs mit URL
        }
    }

    return breadcrumbs; // Rückgabe der Breadcrumbs
}

// @Author: Lennart Moog