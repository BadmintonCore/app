# Vestis.

Dies ist unser Projekt für das WebTech Praktikum. TODO: Hier eine sinnvolle Einleitung


## Requirements

- PHP 8.4
- Apache2
- Firefox

## Setup

Docker setup: 

```shell
docker-compose up -d
docker-compose exec -it php-server /bin/bash
composer dump-autoload
```


## Ordner Struktur

- `.github/` Enthält Workflow-Konfigurationen, die zum automatischen Bauen und Bereitstellen des Docker Containers benötigt werden
- `components/` Alle relevanten UI Komponenten, die in der Anwendung mehrfach verwendet werden
- `conf/` Konfigurationsdateien für den Apache2 Server im Docker Container
- `public/` Öffentlich verfügbare Dateien (Bilder, CSS, Javascript)
- `pages/` Die Seiten, die aus dem Browser aus aufgerufen werden können
- `database/` Alles, was mit der Datenbank / der Zugriffsschicht direkt zu tun hat
- Bei dem Rest handelt es sich um Files, die nicht öffentlich zugänglich sein sollen (Business Logik / Persistence Abstraktionen / etc.)

## Wie benutze ich das Währungssystem?

Bei jedem HTML Element mit der Klasse `price-field` wird der Inhalt zu einem Float konveriert und anhand der aktuellen Forex-Kurse der jeweilige Preis in einer anderen Währung angezeigt.

Um die Preise im nachhinein zu aktualisieren kann man die Funktion `updatePrices()` nutzen. Diese aktualisiert alle Preise im aktuellen Dokument