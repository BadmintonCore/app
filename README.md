# Vestis.

Dies ist unser Projekt für das WebTech Praktikum. TODO: Hier eine sinnvolle Einleitung


## Requirements

TODO: Am Projektende definieren
- PHP 8.2? 
- Apache / Nginx? 
- Browser?

## Setup

TODO: Setup instructions hinzufügen


## Ordner Struktur

- `.github/` Enthält Workflow-Konfigurationen, die zum automatischen Bauen und Bereitstellen des Docker Containers benötigt werden
- `components/` Alle relevanten UI Komponenten, die in der Anwendung mehrfach verwendet werden
- `conf/` Konfigurationsdateien für den Apache2 Server im Docker Container
- `public/` Öffentlich verfügbare Dateien (Alle Seiten, Bilder, CSS, Javascript)
- Bei dem Rest handelt es sich um Files, die nicht öffentlich zugänglich sein sollen (Business Logik / Persistence Abstraktionen / etc.)