document.addEventListener("DOMContentLoaded", function () {
    const breadcrumbsContainer = document.getElementById('breadcrumbs-container');
    if (!breadcrumbsContainer) return;



    const breadcrumbData = categoryListBreadcrumbGenerator();

    breadcrumbsContainer.innerHTML = ''; // Container leeren


    <!-- Breadcrumbs hardcoded generieren / nur möglich, wenn Pfad in jeweiliger Seite angegeben   -->
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

function categoryListBreadcrumbGenerator() {
    const h1Text = document.querySelector("h1")?.textContent;

    if (
        window.location.href.includes("categoryId=shirt") ||
        window.location.href.includes("categoryId=sweater")
    ) {
        return [
            { name: "Startseite", url: "/index.php" },
            { name: "Kleidung", url: "/categories/clothes.php" },
            { name: h1Text || "Kategorie", url: null }
        ];
    }

    return [
        { name: "Startseite", url: "/" },
        { name: "Kategorie", url: null }
    ];
}