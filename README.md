# WebTech - Projekt vestis.

## Requirements

- PHP 8.2
- MariaDB 10.4.28 (10.5 preferred)
- Apache2
- Firefox v. 137.0

## Setup

1. Inhalt auf root-Ebene in den htdocs-Ordner laden
2. SQL Dump laden in das Schema `vestis`
3. `mkdir cache && mkdir public/uploads`
4. `chown -R daemon:daemon ./cache`
5. `chown -R daemon:daemon ./public/uploads`

Admin Nutzer:
Nutzername: `admin`, Passwort: `abc1234567`

Beispiel Customer-Nutzer:
Nutzername: `maxmusti`, Passwort: `abc1234567`
