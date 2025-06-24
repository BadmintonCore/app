/*Autor(en): Mathis Burger*/

const translation = {
    categories: 'Kategorien',
    clothes: 'Kleidung',
    bags: 'Taschen',
    admin: 'Admin Bereich',
    accessories: 'Accessoires',
    "about-us": 'Über uns',
    "customer-service": 'Kundenservice',
    "your-purchases": 'Dein Einkauf',
    legal: 'Rechtliches',
    impress: 'Impressum',
    "user-area": 'Nutzer',
    auth: "Anmeldung",
    "your-purchase": 'Dein Einkauf',
    colors: "Farben",
    sizes: "Größen",
    productTypes: "Produkt Typen",
    images: "Bilder",
    instances: "Instanzen",
    orders: "Aufträge",
    shoppingCarts: "Warenkörbe",
    globalConfigs: "Konfigurationen"
};

const disabled = {
    instances: true
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
    const h1Text = document.querySelector("h1")?.textContent; // Holt den Text des h1-Elements der aktuellen Seite
    const parts = location.pathname.split('/'); // Teilt Pfad in seine Komponenten
    let path = '/'; // Initialer Pfad
    const breadcrumbs = [{ name: "Startseite", url: "/" }]; // Map für die Breadcrumbs mit Startseite initial


    const searchParams = new URLSearchParams(window.location.search);

    if (
        searchParams.has("breadcrumpsContent")
    ) {
        const urlEncoded = searchParams.get("breadcrumpsContent");
        const base64 = urlEncoded.replaceAll('-', '+').replaceAll('_', '/');
        const jsonString = atob(base64);
        return JSON.parse(jsonString);
    }

    for (let i = 1; i < parts.length; i++) {
        const part = parts[i];
        const translated = translation[part]; // decodeURIComponent für Sonderzeichen

        if (i === 1) {
            path += part; // Pfad aktualisieren
        } else {
            path += "/" + part; // Pfad aktualisieren
        }

        if (i === parts.length - 1) {
            breadcrumbs.push({ name: h1Text, url: null }); // Seitenname von aktueller Seite ohne URL
        } else {
            breadcrumbs.push({ name: translated, url: disabled[part] ? null :  path }); // Übersetzte Breadcrumbs mit URL
        }
    }

    return breadcrumbs; // Rückgabe der Breadcrumbs
}

/*Autor(en): Mathis Burger*/