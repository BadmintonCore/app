-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 24. Jun 2025 um 16:40
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `vestis`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isBlocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `account`
--

INSERT INTO `account` (`id`, `type`, `firstname`, `surname`, `username`, `email`, `password`, `isBlocked`) VALUES
(27, 'C', 'Max', 'Mustermann', 'maxmusti', 'max@mustermail.de', '$2y$10$wAKf/ODl9eWJIYMxksp7V.G6M.zbukIo0jKuoVEBr95LEUVuPIVnm', 0),
(28, 'A', 'Admin', 'Istrator', 'admin', 'admin@admin.com', '$2y$10$6zEtD5CTtfZjt1invakXleY5sBxy.G04TyvbKZ..9eQS5rR4uLcbO', 0),
(29, 'C', 'Susi', 'Sorglos', 'susisorg', 'sosi@sorglos.net', '$2y$10$ECOki2kBkk5zHO6QJAA5SecwdSk2wWDoFqYDyZuMCDqRSKbXd8VX6', 0),
(30, 'C', 'Hugo', 'Habicht', 'hugohab', 'hugohab@icht.de', '$2y$10$RtRGwvfieosvopZK7s6DluVfYKcZrFsVGJggrNQqDhqRNeJpX8kgK', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `houseNr` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `addition` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `allowedColor`
--

CREATE TABLE `allowedColor` (
  `productTypeId` int(11) NOT NULL,
  `colorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `allowedColor`
--

INSERT INTO `allowedColor` (`productTypeId`, `colorId`) VALUES
(1, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 2),
(5, 3),
(5, 6),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(9, 1),
(9, 3),
(9, 4),
(9, 5),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(16, 5),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(17, 6),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(18, 5),
(18, 6),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 5),
(19, 6),
(20, 2),
(20, 3),
(21, 2),
(21, 3),
(22, 7),
(23, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `allowedSize`
--

CREATE TABLE `allowedSize` (
  `productTypeId` int(11) NOT NULL,
  `sizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `allowedSize`
--

INSERT INTO `allowedSize` (`productTypeId`, `sizeId`) VALUES
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 2),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 4),
(6, 5),
(7, 3),
(7, 4),
(7, 5),
(8, 1),
(8, 3),
(8, 4),
(9, 2),
(9, 3),
(9, 4),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(15, 6),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(18, 7),
(19, 7),
(20, 7),
(21, 7),
(22, 7),
(23, 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentCategoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `parentCategoryId`) VALUES
(1, 'Kleidung', NULL),
(2, 'Sweater', 1),
(3, 'Shirts', 1),
(4, 'Bags', 5),
(5, 'Accessoires', NULL),
(6, 'Caps', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `hex` varchar(6) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `color`
--

INSERT INTO `color` (`id`, `hex`, `name`) VALUES
(1, 'db3333', 'Rot'),
(2, '000000', 'Schwarz'),
(3, 'ffffff', 'Weiß'),
(4, '1f73e0', 'Blau'),
(5, 'c96e6e', 'Beige'),
(6, '26990f', 'Grün'),
(7, 'aa7941', 'Braun');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `evaluation` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `globalConfig`
--

CREATE TABLE `globalConfig` (
  `attribute` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `globalConfig`
--

INSERT INTO `globalConfig` (`attribute`, `value`) VALUES
('ABOUT_US_CONTENT', 'Wir suchen motivierte, kreative und sympathische Menschen, die Lust haben, mit uns gemeinsam etwas zu bewegen.<br>\r\nBei Vestis bist du nicht nur eine Nummer, sondern ein wichtiger Teil unseres Teams.<br>\r\nHier zählt Teamspirit, Eigeninitiative und echtes Miteinander.<br><br>\r\n\r\nOb im Lager, im Büro oder im Kundenservice – wir bieten dir einen Arbeitsplatz, an dem du dich weiterentwickeln kannst und dich wohlfühlst.<br>\r\nFlexible Strukturen, moderne Arbeitsplätze, offene Kommunikation und ganz viel gute Laune inklusive!<br><br>\r\n\r\n<strong>Was dich bei uns erwartet:</strong><br>\r\n– Ein Team, das zusammenhält und sich gegenseitig unterstützt<br>\r\n– Abwechslungsreiche Aufgaben und Raum für eigene Ideen<br>\r\n– Faire Bezahlung und Entwicklungsmöglichkeiten<br>\r\n– Und nicht zuletzt: ein Arbeitsplatz, an dem Lachen erlaubt (und erwünscht!) ist <br><br>\r\n\r\n<strong>Lust, mit uns durchzustarten?</strong><br>\r\nDann bewirb dich jetzt – wir freuen uns auf dich!<br><br>'),
('FAQ_CONTENT', '<p class=\"large-text\">\r\n            <b>1. Wie lange dauert der Versand?</b> <br>\r\n            Die Lieferzeit beträgt in der Regel 2–5 Werktage innerhalb Deutschlands. <br>\r\n            Sollte es zu Verzögerungen kommen, informieren wir Sie umgehend per E-Mail.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>2. Welche Zahlungsmethoden werden akzeptiert?</b> <br>\r\n            Sie können bei uns per Vorkasse, PayPal, Kreditkarte oder Sofortüberweisung bezahlen.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>3. Wie kann ich meine Bestellung stornieren?</b> <br>\r\n            Bitte kontaktieren Sie unseren Kundenservice so schnell wie möglich per E-Mail oder Telefon. <br>\r\n            Sollte die Bestellung noch nicht versandt worden sein, können wir sie problemlos stornieren.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>4. Was mache ich, wenn meine Bestellung beschädigt ankommt?</b> <br>\r\n            Bitte dokumentieren Sie die Beschädigung mit Fotos und melden Sie sich umgehend bei unserem Kundenservice. <br>\r\n            Wir kümmern uns schnellstmöglich um Ersatz oder Rückerstattung.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>5. Kann ich Artikel umtauschen?</b> <br>\r\n            Ein direkter Umtausch ist leider nicht möglich. <br>\r\n            Bitte senden Sie den Artikel zurück und bestellen Sie den gewünschten Artikel neu.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>6. Wo finde ich meine Rechnung?</b> <br>\r\n            Ihre Rechnung erhalten Sie per E-Mail nach Abschluss der Bestellung. <br>\r\n            Alternativ können Sie sie in Ihrem Kundenkonto herunterladen, sofern Sie eines angelegt haben.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>7. Muss ich ein Kundenkonto anlegen, um zu bestellen?</b> <br>\r\n            Nein, Sie können auch als Gast bestellen. Ein Kundenkonto bietet jedoch Vorteile <br>\r\n            wie die Einsicht in frühere Bestellungen und schnelleren Bestellvorgang.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>8. Kann ich meine Lieferadresse nachträglich ändern?</b> <br>\r\n            Bitte kontaktieren Sie uns so schnell wie möglich. <br>\r\n            Solange die Bestellung noch nicht versendet wurde, können wir die Adresse ändern.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>9. Was passiert, wenn ich bei der Lieferung nicht zu Hause bin?</b> <br>\r\n            Der Versanddienstleister hinterlässt in der Regel eine Benachrichtigungskarte <br>\r\n            mit Informationen zur Abholung oder einem neuen Zustellversuch.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>10. Wie kann ich den Status meiner Bestellung verfolgen?</b> <br>\r\n            Nach dem Versand erhalten Sie von uns eine E-Mail mit einem Link zur Sendungsverfolgung. <br>\r\n            So wissen Sie jederzeit, wo sich Ihr Paket befindet.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>11. Was kostet der Versand?</b> <br>\r\n            Die genauen Versandkosten werden im Bestellvorgang deutlich angezeigt. <br>\r\n            Ab einem bestimmten Bestellwert kann der Versand kostenlos sein – die Bedingungen finden Sie auf unserer Website.\r\n        </p>'),
('FOOTER_FACEBOOK_LINK', 'https://facebook.com'),
('FOOTER_HEADING', 'Bleibe immer einen Stil voraus'),
('FOOTER_INSTAGRAM_LINK', 'https://instagram.com'),
('FOOTER_SUBTITLE', 'Melde dich für unseren Newsletter an und entdecke\nexklusive Kollektionen und Angebote vor allen anderen.'),
('FOOTER_TIKTOK_LINK', 'https://tiktok.com'),
('FOOTER_X_LINK', 'https://x.com'),
('GTC_CONTENT', '<p class = \"large-text\">\n            <b>1. Geltungsbereich</b> <br>\n\n            Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle Bestellungen, <br>\n            die über unseren Online-Shop durch Verbraucher und Unternehmer erfolgen.\n        </p>\n        <p class = \"large-text\">\n            <b>2. Vertragspartner, Vertragsschluss</b> <br>\n\n            Der Kaufvertrag kommt zustande mit MusterShop GmbH, Musterstraße 1, 12345 Musterstadt. <br>\n            Mit Einstellung der Produkte in den Online-Shop geben wir ein verbindliches Angebot zum <br>\n            Vertragsschluss über diese Artikel ab. Der Vertrag kommt zustande, indem Sie durch Anklicken des <br>\n            Bestellbuttons das Angebot über die im Warenkorb enthaltenen Waren annehmen.\n        </p>\n        <p class=\"large-text\">\n            <b>3. Preise und Versandkosten</b> <br>\n\n            Alle Preise sind Endpreise und enthalten die gesetzliche Mehrwertsteuer. Zuzüglich zum Warenpreis <br>\n            kommen gegebenenfalls Versandkosten hinzu, die im Bestellvorgang deutlich ausgewiesen werden.\n        </p>\n        <p class=\"large-text\">\n            <b>4. Lieferung</b> <br>\n\n            Die Lieferung erfolgt innerhalb Deutschlands mit DHL oder einem anderen Versanddienstleister. <br>\n            Die Lieferzeit beträgt in der Regel 2–5 Werktage, sofern beim Produkt keine andere Angabe erfolgt.\n        </p>\n        <p class=\"large-text\">\n            <b>5. Zahlung</b> <br>\n\n            In unserem Shop stehen Ihnen die folgenden Zahlungsarten zur Verfügung: <br>\n            <br>\n            Vorkasse<br>\n            PayPal<br>\n            Kreditkarte<br>\n            Sofortüberweisung\n        </p>\n        <p class=\"large-text\">\n            <b>6. Widerrufsrecht</b> <br>\n\n            Verbraucher haben ein gesetzliches Widerrufsrecht. Die Widerrufsbelehrung und ein <br>\n            Muster-Widerrufsformular finden Sie auf unserer Website unter dem Menüpunkt „Widerrufserklärung“.\n        </p>\n        <p class=\"large-text\">\n            <b>7. Eigentumsvorbehalt</b> <br>\n\n            Die Ware bleibt bis zur vollständigen Bezahlung unser Eigentum.\n        </p>\n        <p class=\"large-text\">\n            <b>8. Gewährleistung und Haftung</b> <br>\n\n            Es gelten die gesetzlichen Gewährleistungsrechte. Bei Mängeln der gelieferten Ware wenden Sie <br>\n            sich bitte an unseren Kundenservice. Für Schäden haften wir nur bei Vorsatz oder grober Fahrlässigkeit.\n        </p>\n        <p class=\"large-text\">\n            <b>9. Schlussbestimmungen</b> <br>\n\n            Sollte eine Bestimmung dieser AGB unwirksam sein, bleibt der Vertrag im Übrigen wirksam. <br>\n            Anstelle der unwirksamen Bestimmung gilt das einschlägige gesetzliche Recht.\n        </p>\n\n        <br>\n\n        <p class=\"large-text\" style=\"text-align: center\">\n            <b>MusterShop GmbH<br>\n            Musterstraße 1<br>\n            12345 Musterstadt<br>\n            E-Mail: info@mustershop.de<br>\n                Telefon: 01234 / 567890</b>\n        </p>'),
('IMPRESS_CONTENT', '<p class=\"large-text\">\n        <!--Author: Lennart Moog-->\n        <!--Author: Lasse Hoffmann-->\n        <b>Impressum</b><br>\n        Angaben gemäß § 5 TMG: <br>\n        <br>\n        [Vor- und Nachname oder Firmenname]<br>\n        [Anschrift: Straße, Hausnummer]<br>\n        [PLZ] [Ort]<br>\n        [Land]<br>\n        <br>\n        Vertreten durch:<br>\n        [Name der vertretungsberechtigten Person(en)]<br>\n        <br>\n        Kontakt:<br>\n        Telefon: [Telefonnummer]<br>\n        E-Mail: [E-Mail-Adresse]<br>\n        Website: [Domain-URL]<br>\n        <br>\n        Umsatzsteuer-ID:<br>\n        Umsatzsteuer-Identifikationsnummer <br>\n        gemäß §27 a Umsatzsteuergesetz: [USt-ID]<br>\n        <br>\n        Handelsregister:<br>\n        Eingetragen im Handelsregister.<br>\n        Registergericht: [z. B. Amtsgericht Musterstadt]<br>\n        Registernummer: [HRB 123456]<br>\n        <br>\n        Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:<br>\n        [Name]<br>\n        [Adresse wie oben oder abweichend]\n    </p>'),
('JOBS_CONTENT', 'Wir suchen motivierte, kreative und sympathische Menschen, die Lust haben, mit uns gemeinsam etwas zu bewegen.<br>\r\nBei Vestis bist du nicht nur eine Nummer, sondern ein wichtiger Teil unseres Teams.<br>\r\nHier zählt Teamspirit, Eigeninitiative und echtes Miteinander.<br><br>\r\n\r\nOb im Lager, im Büro oder im Kundenservice – wir bieten dir einen Arbeitsplatz, an dem du dich weiterentwickeln kannst und dich wohlfühlst.<br>\r\nFlexible Strukturen, moderne Arbeitsplätze, offene Kommunikation und ganz viel gute Laune inklusive!<br><br>\r\n\r\n<strong>Was dich bei uns erwartet:</strong><br>\r\n– Ein Team, das zusammenhält und sich gegenseitig unterstützt<br>\r\n– Abwechslungsreiche Aufgaben und Raum für eigene Ideen<br>\r\n– Faire Bezahlung und Entwicklungsmöglichkeiten<br>\r\n– Und nicht zuletzt: ein Arbeitsplatz, an dem Lachen erlaubt (und erwünscht!) ist <br><br>\r\n\r\n<strong>Lust, mit uns durchzustarten?</strong><br>\r\nDann bewirb dich jetzt – wir freuen uns auf dich!<br><br>'),
('ORDER_CONTENT', 'Du hast Fragen zu deiner Bestellung bei Vestis?<br>\r\nKein Problem – wir helfen dir gerne weiter!<br><br>\r\n\r\nOb es um Lieferzeiten, Zahlungsarten, Retouren oder den aktuellen Stand deiner Bestellung geht – unser Kundenservice steht dir zuverlässig zur Seite.<br><br>\r\n\r\n<strong>So erreichst du uns:</strong><br>\r\n– Per E-Mail unter: service@vestis.de</a><br>\r\n– Telefonisch zu unseren Geschäftszeiten<br>\r\n– Oder direkt über unser Kontaktformular<br><br>\r\n\r\nWir kümmern uns schnell und unkompliziert um dein Anliegen.<br>\r\nDeine Zufriedenheit steht bei uns an erster Stelle.\r\n'),
('PAYMENT_METHODS_CONTENT', 'Bei Vestis bieten wir dir eine einfache und bequeme Zahlungsmöglichkeit an:<br><br>\r\n\r\n<strong>Kauf auf Rechnung</strong><br>\r\nDu bestellst – wir liefern – du zahlst ganz bequem nach Erhalt der Ware.<br><br>\r\n\r\nDer Rechnungsbetrag ist innerhalb von 14 Tagen nach Erhalt der Lieferung fällig.<br>\r\nAlle Zahlungsinformationen findest du auf der Rechnung, die deiner Bestellung beiliegt.<br><br>\r\n\r\nBitte beachte: Der Kauf auf Rechnung ist nur für Lieferungen innerhalb Deutschlands möglich.'),
('PRESS_CONTENT', 'Hier findest du alle aktuellen Meldungen, Pressemitteilungen und News rund um Vestis.<br><br>\r\n\r\n<strong>Unsere Themen:</strong><br>\r\n– Neue Produkt- oder Serviceeinführungen<br>\r\n– Unternehmensentwicklungen und Meilensteine<br>\r\n– Kooperationen, Partnerschaften und Projekte<br>\r\n– Medienberichte und Interviews mit unserem Team<br><br>\r\n\r\nAlle Inhalte stehen zum Download bereit, darunter Pressemitteilungen, Bildmaterial und Ansprechpartner für Journalisten.<br><br>\r\n\r\n<strong>Interessiert an weiteren Informationen?</strong><br>\r\nDann kontaktiere unser Presseteam direkt oder nutze das Kontaktformular auf unserer Presse-Seite.\r\n'),
('PRIVACY_CONTENT', '<p class=\"large-text\">\n            <b>1. Verantwortlicher</b> <br>\n            MusterShop GmbH <br>\n            Musterstraße 1 <br>\n            12345 Musterstadt <br>\n            E-Mail: info@mustershop.de <br>\n            Telefon: 01234 / 567890\n        </p>\n        <p class=\"large-text\">\n            <b>2. Erhebung und Verarbeitung personenbezogener Daten</b> <br>\n            Wir erheben, speichern und verarbeiten Ihre personenbezogenen Daten zur Abwicklung Ihrer Bestellung, <br>\n            für die Lieferung sowie zur Pflege der Kundenbeziehung. <br>\n            Personenbezogene Daten erheben wir nur, wenn Sie uns diese im Rahmen Ihrer Bestellung <br>\n            oder bei der Eröffnung eines Kundenkontos freiwillig mitteilen.\n        </p>\n        <p class=\"large-text\">\n            <b>3. Weitergabe personenbezogener Daten</b> <br>\n            Eine Weitergabe Ihrer Daten erfolgt ausschließlich an das mit der Lieferung beauftragte Versandunternehmen <br>\n            und – soweit erforderlich – an das mit der Zahlungsabwicklung beauftragte Kreditinstitut oder Zahlungsdienstleister <br>\n            (z. B. PayPal, Kreditkartenanbieter, Sofortüberweisung).\n        </p>\n        <p class=\"large-text\">\n            <b>4. Verwendung von Cookies</b> <br>\n            Unser Online-Shop verwendet Cookies, um bestimmte Funktionen zu ermöglichen und die Nutzung unserer Website zu verbessern. <br>\n            Sie können das Speichern von Cookies in Ihrem Browser deaktivieren. <br>\n            Dies kann jedoch die Funktionalität der Website einschränken.\n        </p>\n        <p class=\"large-text\">\n            <b>5. Ihre Rechte</b> <br>\n            Sie haben das Recht auf Auskunft über Ihre gespeicherten personenbezogenen Daten <br>\n            sowie ggf. ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. <br>\n            Wenden Sie sich hierzu bitte an unseren Kundenservice unter info@mustershop.de.\n        </p>\n        <p class=\"large-text\">\n            <b>6. Datensicherheit</b> <br>\n            Ihre Daten werden im Bestellprozess mittels SSL-Verschlüsselung übertragen. <br>\n            Wir sichern unsere Website und Systeme durch technische und organisatorische Maßnahmen <br>\n            gegen Verlust, Zerstörung, Zugriff, Veränderung oder Verbreitung Ihrer Daten durch unbefugte Personen.\n        </p>'),
('RESPONSIBILITY_CONTENT', 'Bei Vestis übernehmen wir Verantwortung – für unsere Umwelt, unsere Mitarbeitenden und für die Gesellschaft.<br><br>\r\n\r\nNachhaltigkeit ist für uns kein Trend, sondern ein fester Bestandteil unseres Handelns.<br>\r\nWir setzen auf umweltfreundliche Prozesse, ressourcenschonende Materialien und faire Arbeitsbedingungen entlang unserer gesamten Lieferkette.<br><br>\r\n\r\n<strong>Unsere Schwerpunkte:</strong><br>\r\n– Umweltbewusste Verpackung und Versand<br>\r\n– Nachhaltige Produkte und Materialien<br>\r\n– Verantwortungsvoller Umgang mit Energie und Ressourcen<br>\r\n– Partnerschaften mit regionalen und sozialen Initiativen<br><br>\r\n\r\nVerantwortung bedeutet für uns: Heute schon an morgen denken – und aktiv gestalten, was wir besser machen können.\r\n'),
('RETURNS_CONTENT', '<p class=\"large-text\">\n            <b>Rücksendung</b> <br>\n            Sie können Artikel innerhalb von 14 Tagen nach Erhalt der Ware an uns zurücksenden. <br>\n            Bitte stellen Sie sicher, dass sich die Artikel in ungebrauchtem und einwandfreiem Zustand befinden <br>\n            und möglichst in der Originalverpackung zurückgesendet werden.\n        </p>\n        <p class=\"large-text\">\n            <b>Rücksendeadresse</b> <br>\n            MusterShop GmbH <br>\n            Retourenabteilung <br>\n            Musterstraße 1 <br>\n            12345 Musterstadt\n        </p>\n        <p class=\"large-text\">\n            <b>Rücksendeablauf</b> <br>\n            1. Bitte kontaktieren Sie unseren Kundenservice per E-Mail an info@mustershop.de <br>\n            und geben Sie Ihre Bestellnummer sowie den Rücksendegrund an. <br>\n            2. Sie erhalten anschließend von uns ein Rücksendeetikett per E-Mail. <br>\n            3. Verpacken Sie die Ware sicher und bringen Sie das Etikett gut sichtbar an. <br>\n            4. Geben Sie das Paket bei einer Annahmestelle des angegebenen Versanddienstleisters ab.\n        </p>\n        <p class=\"large-text\">\n            <b>Erstattung</b> <br>\n            Nach Eingang und Prüfung der Rücksendung erstatten wir Ihnen den Kaufbetrag <br>\n            innerhalb von 7 Werktagen auf das bei der Bestellung verwendete Zahlungsmittel.\n        </p>\n        <p class=\"large-text\">\n            <b>Rücksendekosten</b> <br>\n            Die Kosten der Rücksendung tragen Sie, es sei denn, die gelieferte Ware war fehlerhaft <br>\n            oder entsprach nicht der bestellten. In diesem Fall übernehmen wir die Rücksendekosten.\n        </p>'),
('REVOCATION_CONTENT', '<p class=\"large-text\" style=\"text-align: justify\">\n            <b>Widerrufsrecht für Verbraucher</b> <br>\n            <br>\n            Verbraucher haben ein vierzehntägiges Widerrufsrecht.<br>\n            <br>\n            <b>Widerrufsrecht</b> <br>\n            Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen.<br>\n            Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter,<br>\n            der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat, <br>\n            im Falle einer Teillieferung: an dem Sie oder ein Dritter die letzte Ware in Besitz genommen haben.<br>\n            Um Ihr Widerrufsrecht auszuüben, müssen Sie uns (MusterShop GmbH, Musterstraße 1, 12345 Musterstadt,<br>\n            E-Mail: info@mustershop.de, Telefon: 01234 / 567890) mittels einer eindeutigen Erklärung <br>\n            (per E-Mail oder Post) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren.\n        </p>'),
('SHIPMENT_CONTENT', 'Wir liefern deine Bestellung schnell, zuverlässig und sicher zu dir nach Hause.<br><br>\r\n\r\n<strong>Unsere Versanddetails:</strong><br>\r\n– Versand innerhalb Deutschlands<br>\r\n– Zuverlässige Lieferung mit unserem Logistikpartner<br>\r\n– Versandkostenfrei<br>\r\n– Lieferzeit in der Regel 2–4 Werktage<br><br>\r\n\r\nSobald deine Bestellung versendet wurde, erhältst du eine Versandbestätigung mit Sendungsverfolgung per E-Mail.<br><br>\r\n\r\nDu hast Fragen zu deiner Lieferung?<br>\r\nUnser Kundenservice hilft dir gerne weiter.'),
('VOUCHERS_CONTENT', 'Aktuell bieten wir noch keine Gutscheine an.<br>\r\nWir arbeiten aber bereits daran und freuen uns, dir diese Möglichkeit schon bald zur Verfügung stellen zu können.<br><br>\r\n\r\nBleib gespannt – wir informieren dich, sobald Gutscheine bei Vestis verfügbar sind!\r\n');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `image`
--

INSERT INTO `image` (`id`, `name`, `path`) VALUES
(24, 'Wave Form Cap', '/uploads/img_685a96f85ddc37.29089788.png'),
(25, 'VHS Tee Shirt', '/uploads/img_685a9721434960.36327885.png'),
(26, 'Sunset Radio Tee Shirt', '/uploads/img_685a975e7e3a21.20928616.png'),
(27, 'Sunset Fade Sweater', '/uploads/img_685a97814576b8.99270144.png'),
(28, 'Stereo Sunset Sweater', '/uploads/img_685a9796901051.36766193.png'),
(29, 'Static Memories Sweater', '/uploads/img_685a97a69b5de7.25386270.png'),
(30, 'Retro Sunburst Tee front', '/uploads/img_685a97b1620436.57107803.png'),
(31, 'Pixel Palm Tee', '/uploads/img_685a97bd8e78b5.46805394.png'),
(32, 'Neon Nights Tee', '/uploads/img_685a97cba7a3f4.59408319.png'),
(33, 'LoFi Sunset Sweater', '/uploads/img_685a97e32ecd93.92359722.png'),
(34, 'Lo-Fi Coastline', '/uploads/img_685a97ee51d345.09769513.png'),
(35, 'Casette Club Sweater', '/uploads/img_685a97fc6b6c23.32746695.png'),
(36, 'Casette Vibes Shirt', '/uploads/img_685a9818c24f99.15951037.png'),
(37, 'Analog Waves Sweater', '/uploads/img_685a98207945c8.60501964.png'),
(38, 'Analog Mood Shirt', '/uploads/img_685a9828252c76.93233863.png'),
(39, 'Lo-Fi Bag', '/uploads/img_685a98394f4b80.52964555.png'),
(40, 'LoFi Bauchtasche', '/uploads/img_685a9851eed819.57617166.png'),
(41, 'Vestis pouch', '/uploads/img_685a9879322883.57439026.png'),
(42, 'Rewind Sweater', '/uploads/img_685a9886c20988.20869100.png'),
(43, 'Gameboy Bag', '/uploads/img_685a9898db76a3.82037953.png'),
(44, 'LoFi Cord Cap', '/uploads/img_685a98b0cc02e5.12378902.png'),
(45, 'Gradient sweater', '/uploads/img_685a98bb845626.36874332.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `joinAddressAcc`
--

CREATE TABLE `joinAddressAcc` (
  `addressId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newsletter`
--

CREATE TABLE `newsletter` (
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `newsletter`
--

INSERT INTO `newsletter` (`email`) VALUES
(''),
('hugohab@icht.de'),
('max@mustermail.de'),
('sosi@sorglos.net');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orderProduct`
--

CREATE TABLE `orderProduct` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `orderProduct`
--

INSERT INTO `orderProduct` (`orderId`, `productId`) VALUES
(1, 1),
(2, 17),
(2, 1101),
(2, 1116),
(2, 1131),
(2, 1138),
(2, 1139);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `denialMessage` text DEFAULT NULL,
  `discount` float DEFAULT 0,
  `discountMessage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`id`, `accountId`, `timestamp`, `status`, `denialMessage`, `discount`, `discountMessage`) VALUES
(1, 27, '2025-06-24 15:17:59', 'Zahlung ausstehend', NULL, 0, 'Vielen Dank für Ihre Bestellung!'),
(2, 30, '2025-06-24 16:29:24', 'Zahlung ausstehend', NULL, 0, 'Vielen Dank für Ihre Bestellung!');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `productTypeId` int(11) NOT NULL,
  `sizeId` int(11) NOT NULL,
  `colorId` int(11) NOT NULL,
  `shoppingCartId` int(11) DEFAULT NULL,
  `accId` int(11) DEFAULT NULL,
  `boughtAt` timestamp NULL DEFAULT NULL,
  `boughtPrice` float DEFAULT NULL,
  `shoppingCartNumber` int(11) DEFAULT NULL,
  `boughtDiscount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `productTypeId`, `sizeId`, `colorId`, `shoppingCartId`, `accId`, `boughtAt`, `boughtPrice`, `shoppingCartNumber`, `boughtDiscount`) VALUES
(1, 2, 2, 3, NULL, 27, '2025-06-24 13:17:59', 34.99, 2, 0),
(2, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 2, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 3, 1, 1, 27, NULL, NULL, NULL, 1, NULL),
(17, 3, 1, 1, NULL, 30, '2025-06-24 14:29:24', 34.99, 1, 0),
(18, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 5, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 6, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 7, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 8, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 9, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 10, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 11, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 12, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(189, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(191, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 13, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(206, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 14, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(211, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(212, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(213, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(214, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(216, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(217, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(218, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(220, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(222, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(242, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(258, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 15, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(268, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(269, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(270, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(271, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(272, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(273, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(274, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(275, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(276, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(277, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(278, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(279, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(286, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(287, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(288, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(289, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(290, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(291, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(292, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(293, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(294, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(295, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(296, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(297, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(299, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(300, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(301, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(302, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(303, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(304, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(306, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(308, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(309, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 16, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(313, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(314, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(315, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(316, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(317, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(318, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(319, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(320, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(321, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(322, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(323, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(324, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(325, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(326, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(327, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(329, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(331, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(332, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(333, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(334, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(335, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(336, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(337, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(338, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(339, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(340, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(343, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(344, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(345, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(346, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(347, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(349, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(350, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(351, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(352, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(353, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(354, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(356, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(358, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(360, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(361, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(363, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(364, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(365, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(366, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(367, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(368, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(369, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(370, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(371, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(372, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(373, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(377, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(379, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(380, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(381, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(382, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(383, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(384, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(385, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(386, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(387, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(388, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(389, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(391, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(392, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(394, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(395, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(396, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(397, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(398, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(399, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(400, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(401, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(402, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(403, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(404, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(405, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(407, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(408, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(409, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(410, 17, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1101, 23, 7, 3, NULL, 30, '2025-06-24 14:29:24', 30, 1, 0),
(1102, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1103, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1104, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1105, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1106, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1107, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1108, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1109, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1110, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1111, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1112, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1113, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1114, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1115, 23, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1131, 18, 7, 1, NULL, 30, '2025-06-24 14:29:24', 42, 1, 0),
(1132, 18, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1133, 18, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1134, 18, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1135, 18, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1136, 18, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1137, 18, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1138, 19, 7, 1, NULL, 30, '2025-06-24 14:29:24', 79, 1, 0),
(1139, 19, 7, 1, NULL, 30, '2025-06-24 14:29:24', 79, 1, 0),
(1140, 19, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1141, 19, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1142, 19, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1143, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1144, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1145, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1146, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1147, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1148, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1149, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1150, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1151, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1152, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1153, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1154, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1155, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1156, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1157, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1158, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1159, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1160, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1161, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1162, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1163, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1164, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1165, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1166, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1167, 21, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(1168, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1169, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1170, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1171, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1172, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1173, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1174, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1175, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1176, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1177, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1178, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1179, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1180, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1181, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1182, 21, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1183, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1184, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1185, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1186, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1187, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1188, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1189, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1190, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1191, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1192, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1193, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1194, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1195, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1196, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1197, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1198, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1199, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1200, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1201, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1202, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1203, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1204, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(1205, 22, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productImage`
--

CREATE TABLE `productImage` (
  `productTypeId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `productImage`
--

INSERT INTO `productImage` (`productTypeId`, `imageId`) VALUES
(2, 38),
(3, 30),
(4, 36),
(5, 31),
(6, 25),
(7, 32),
(8, 26),
(9, 34),
(10, 27),
(11, 37),
(12, 33),
(13, 42),
(14, 29),
(15, 35),
(16, 45),
(17, 28),
(18, 40),
(19, 39),
(20, 43),
(21, 41),
(22, 44),
(23, 24);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productType`
--

CREATE TABLE `productType` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `collection` varchar(255) NOT NULL,
  `careInstructions` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `extraFields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extraFields`)),
  `discount` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `productType`
--

INSERT INTO `productType` (`id`, `categoryId`, `name`, `material`, `price`, `description`, `collection`, `careInstructions`, `origin`, `extraFields`, `discount`) VALUES
(2, 3, 'Analog Mood', '100% Bio-Baumwolle', 34.99, 'Schlicht und stilvoll – inspiriert vom Charme alter Polaroids.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, nicht im Trockner trocknen.', 'Made in Germany', '                {\r\n\"Stoffgewicht\": \"185 g/m²\",\r\n\"Fit\": \"Regular Fit\"\r\n}            ', 0.1),
(3, 3, 'Retro Sunburst Tee', '100% Bio-Baumwolle', 34.99, 'Weiches Retro-T-Shirt aus Bio-Baumwolle mit Sonnenmuster – perfekt für lässige Sommertage.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, auf links waschen, nicht in den Trockner geben.', 'Made in Germany', '{\"Stoffgewicht\": \"180 g/m²\", \"Fit\": \"Regular Fit\"}', 0),
(4, 3, 'Cassette Vibes', '100% Bio-Baumwolle', 32, 'Hochwertiges Baumwollshirt im kultigen Kassetten-Design – für echte 80s-Fans.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, Feinwaschgang empfohlen.', 'Made in Germany', '{\"Stoffgewicht\": \"190 g/m²\", \"Fit\": \"Loose Fit\"}', 0),
(5, 3, 'Pixel Palm Tee', '100% Bio-Baumwolle', 37.99, 'Luftiges Retro-T-Shirt mit 8-Bit-Palmenmotiv – Sommer, Sonne, Nostalgie.', 'Summer Retro 2025', 'Schonwaschgang bei 30°C, auf links waschen.', 'Made in Germany', '{\"Stoffgewicht\": \"175 g/m²\", \"Fit\": \"Regular Fit\"}', 0),
(6, 3, 'VHS Club Shirt', '100% Bio-Baumwolle', 34.99, 'Oversized Fit im VHS-Design – perfekt für entspannte Vintage-Looks.', 'Summer Retro 2025', 'Maschinenwäsche kalt, auf links bügeln.', 'Made in Germany', '{\"Stoffgewicht\": \"200 g/m²\", \"Fit\": \"Oversized Fit\"}', 0),
(7, 3, 'Neon Nights Tee', '100% Bio-Baumwolle', 37.99, 'Retro-Discofeeling in sanften Farben – dein Essential für laue Sommernächte.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, geringe Schleuderzahl empfohlen.', 'Made in Germany', '{\"Stoffgewicht\": \"175 g/m²\", \"Fit\": \"Relaxed Fit\"}', 0),
(8, 3, 'Sunset Radio', '100% Bio-Baumwolle', 39.99, 'Vintage-RadioDesign trifft weichen Baumwollstoff – perfekt zum Chillen.', 'Summer Retro 2025', 'Feinwäsche bei 30°C, sanft schleudern.', 'Made in Germany', '{\"Stoffgewicht\": \"190 g/m²\", \"Fit\": \"Regular Fit\"}', 0),
(9, 3, 'Lo-Fi Coastline', '100% Bio-Baumwolle', 34.99, 'Lässiges Shirt mit Lo-Fi Coastline Print – entspannt, stilvoll, retro.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, auf links drehen.', 'Made in Germany', '{\"Stoffgewicht\": \"170 g/m²\", \"Fit\": \"Relaxed Fit\"}', 0),
(10, 2, 'Sunset Fade Crew', '85% Bio-Baumwolle, 15% recyceltes Polyester', 65, 'Weicher Crewneck mit sanftem Farbverlauf – wie ein Sonnenuntergang in Stoffform.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, auf links waschen, nicht bügeln.', 'Made in Germany', '{\"Stoffgewicht\": \"300 g/m²\", \"Fit\": \"Relaxed Fit\"}', 0),
(11, 2, 'Analog Waves Sweater', '100% Bio-Baumwolle', 69.99, 'Wellenprint im Stil alter Audioanzeigen – stylisch und warm zugleich.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, Feinwaschgang empfohlen.', 'Made in Germany', '{\"Stoffgewicht\": \"290 g/m²\", \"Fit\": \"Oversized Fit\"}', 0),
(12, 2, 'Lo-Fi Sunset Pullover', '80% Baumwolle, 20% recyceltes Polyester', 67, 'Sweater mit Lo-Fi-Print – fühlt sich an wie ein Abend auf Kassette.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, auf links drehen.', 'Made in Germany', '{\"Stoffgewicht\": \"300 g/m²\", \"Fit\": \"Regular Fit\"}', 0),
(13, 2, 'Rewind Club', '100% Bio-Baumwolle', 72, 'Statement-Sweater mit REWIND-Print – für echte Vintage-Enthusiasten.', 'Retro Layers 2025', 'Maschinenwäsche kalt, nicht im Trockner trocknen.', 'Made in Germany', '{\"Stoffgewicht\": \"320 g/m²\", \"Fit\": \"Oversized Fit\"}', 0),
(14, 2, 'Static Memories', '85% Baumwolle, 15% recyceltes Polyester', 63.99, 'Leicht strukturierter Sweater im Stil eines alten TV-Rauschens.', 'Retro Layers 2025', 'Feinwäsche bei 30°C, auf links bügeln.', 'Made in Germany', '{\"Stoffgewicht\": \"280 g/m²\", \"Fit\": \"Regular Fit\"}', 0),
(15, 2, 'Cassette Club Crew', '100% Bio-Baumwolle', 69.99, 'Kassetten-Grafik auf kuscheligem Baumwollstoff – 90s in modernem Gewand.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, keine Bleichmittel verwenden.', 'Made in Germany', '{\"Stoffgewicht\": \"300 g/m²\", \"Fit\": \"Loose Fit\"}', 0),
(16, 2, 'Fade-In Pullover', '100% Bio-Baumwolle', 64.99, 'Minimalistischer Sweater mit subtilem Farbverlauf – clean und retro zugleich.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, kein Weichspüler.', 'Made in Germany', '{\"Stoffgewicht\": \"310 g/m²\", \"Fit\": \"Regular Fit\"}', 0),
(17, 2, 'Stereo Sunset', '80% Bio-Baumwolle, 20% recyceltes Polyester', 70, 'Oversized Sweater mit grafischem Sunset-Stick – retro und cozy.', 'Retro Layers 2025', 'Maschinenwäsche kalt, auf links bügeln.', 'Made in Germany', '{\"Stoffgewicht\": \"25 g/m²\", \"Fit\": \"Oversized Fit\"}', 0),
(18, 4, 'Tape Deck Sling', 'Recyceltes Nylon', 42, 'Kompakte Sling Bag mit Tape-Design – ideal für unterwegs.', 'Urban Heritage 2025', 'Feucht abwischen, nicht bügeln.', 'Made in Germany', '                {\"Volumen\": \"6 Liter\", \"Verschluss\": \"Reißverschluss\", \"Träger\": \"Crossbody verstellbar\", \"Fächer\": \"Hauptfach, Frontfach mit Reißverschluss\"}            ', 0),
(19, 4, 'Lo-Fi Backpack', 'Canvas & veganes Leder', 79, 'Retro-Rucksack mit Lo-Fi Patch – robust und stylisch für unterwegs.', 'Urban Heritage 2025', 'Nicht waschen, punktuell reinigen', 'Made in Germany', '                {\"Volumen\": \"18 Liter\", \"Verschluss\": \"Kordelzug & Magnetklappe\", \"Träger\": \"Verstellbare Canvas-Träger\", \"Fächer\": \"Großes Hauptfach, Innenfach mit Reißverschluss\"}            ', 0),
(20, 4, 'Polaroid Pocket Tote', '100% Baumwoll-Canvas', 39.99, 'Tote Bag mit Polaroid-Stickerei – leicht, geräumig, retro.', 'Urban Heritage 2025', 'Handwäsche empfohlen.', 'Made in Germany', '                {\"Volumen\": \"10 Liter\", \"Verschluss\": \"Offen mit Innendruckknopf\", \"Träger\": \"Tragehenkel\", \"Fächer\": \"1 Hauptfach, 2 Steckfächer innen\"}            ', 0),
(21, 4, 'Sunset Radio Pouch', 'Baumwoll-Canvas', 25, 'Kleine Pouch mit Radiodetail – perfekt für Essentials oder als Accessoire.', 'Urban Heritage 2025', 'Handwäsche, nicht schleudern.', 'Made in Germany', '                {\"Volumen\": \"2 Liter\", \"Verschluss\": \"Reißverschluss\", \"Träger\": \"Ohne – als Etui oder Clutch\", \"Fächer\": \"1 Innenfach\"}            ', 0),
(22, 6, 'Lo-Fi Script Cap', 'Cord', 34.99, 'Cord-Cap im 90s-Look mit edler Lo-Fi Stickerei.', 'Headlines 2025', 'Nicht waschen, punktuell reinigen', 'Made in Germany', '                {\"Schirm\": \"Flacher Schirm\", \"Verschluss\": \"Metallschnalle\", \"Design\": \"Lo-Fi-Stickerei mit Retro-Schriftzug\", \"Belüftung\": \"Gestickte Ösen\"}            ', 0),
(23, 6, 'Waveform Classic Cap', '100% Baumwoll-Twill', 30, 'Schlichte 90s-Cap mit hochwertiger Stickerei – understated und retro.', 'Headlines 2025', 'Nur Handwäsche, nicht bleichen.', 'Made in Germany', '                                {\"Schirm\": \"Gebogener Schirm\", \"Verschluss\": \"Metallschnalle hinten\", \"Design\": \"Ton-in-Ton Stickerei vorn\", \"Belüftung\": \"Bestickte Ösen\"}                        ', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `review`, `created_at`) VALUES
(4, 2, 29, 3, 'Ich wollte das Shirt für meine Tochter kaufen, aber ich finde den Preis etwas zu hoch. 12,99 € wäre ein deutlich besserer Preis, wenn man aktuelle Umstände wie die Inflation bedenkt.', '2025-06-24 11:59:43'),
(5, 2, 27, 5, 'Hab diese Schönheit gekauft, um mich nochmal richtig jung zu fühlen. Erfolgreicher Kauf 😎', '2025-06-24 13:18:57'),
(6, 19, 27, 5, 'Sehr schicker Rucksack für alle Anlässe!', '2025-06-24 14:20:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shoppingCart`
--

CREATE TABLE `shoppingCart` (
  `accId` int(11) NOT NULL,
  `cartNumber` int(11) NOT NULL DEFAULT 0,
  `isShared` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `inviteSecret` varchar(255) DEFAULT '123'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `shoppingCart`
--

INSERT INTO `shoppingCart` (`accId`, `cartNumber`, `isShared`, `name`, `inviteSecret`) VALUES
(27, 1, 0, NULL, 'ulQoZ64mzJddcojIJyYzaYdF-EwPYFNS7lgeqTkkTDs9-VZjxemGvx8QiGEDXyVl-nskDY8hmgEywkGKqCzlHVipbkllFwNzczFGQeGZa1zlvRNergIKMnQjUEa3sMO9tMligQzV6Yp_oplbIfq0j_hCG9gOD-v4YJiUhcHRWEDHKcoYgocDsyJNcO-3-I9MiX8Ll3vcdJAI3S7JR_YfVv7bl4c9Q6Kgr-cLJJauSyHUHuZKvunf-WjSv-fV2BF'),
(27, 2, 1, 'Weihnachtsgeschenke', 'bp6Xqz4ORqDY49M35cf6g1yLJ-GgBFPiITGOuIJt31E1hDbtbDCzpqdjjwgiWCHx0opJ8wLxBY8wdm6fHewYRp947vzEtu26285ibLYn9yt8z1S6xYoAT4YJpxzRKum9IrkJOI5dwuR0RJ8KIwgfXlJ9dDYI4HUxoour66Rzb3S4wKk9WHzQRoM0uQv4BqKpevuNiqeyrtGXrk41rntH2fRRqL-1m7gIupBt5HFZvPHY0LghhIOLciAH1MOdxvn'),
(28, 1, 0, NULL, 'vNRWT-T6r2r8Ys8KP7ABGFZhI8cNmZ_2LEGfLhnVl2YfOnitUetLktjl-lhNy9K8dsS_tIajBxtCoeNNsoF_Wm3X9NRMtmwvxH0CMoQlBJMk4EsnLFsRhaJgwzQ-v0_td69pfbFaZVBpMx4UPlsWx716Hqkny29H2PXjx-_y4ZP3tb9nXB4W7U5uGZrCrEnpoM48BHHmdKTkF4yUIXo-cQ3JS8n0XSbpcOVFgn7-E5mqX88dGJ0nwPJg6beWetT'),
(29, 1, 0, NULL, 'AV8GC5SPIrbn7zFF6ur9SlBP6TuUspJS8xj8Uo5LhV7gCALPzz7xhKU3AnNi0iUB49QdMScy1OTYbLvhpe5p0j3FIGPG7olPWLr_za2mNaqjzV13NUNLiHP0M-2A7kFpA5rUfwnNLPQ0_cL1KeU0xprIU5CxMmt6BfklWRbPewEK7PoOXfwKe5aJ4MHj0bXQXkD2Dh5xY0sELIC_bRHd6imk4Bnma6V9GtbLXQwgo-XS-eI4jgVH_MF3FscqR5n'),
(30, 1, 0, NULL, 'LJMzMvNdCvy5dFYy0jPY1zMd7iRUHkfxBV3jTxsFYF5mMSzJWU5cay8vc8sioxEwWTue0WSLhRXL37MI55tcTOqtfmmTm2LTqO66JLeNZKX7ikGyDF21W0A1vtDw6SzARnYyWohu3O_i7DGxmOrrSPtbsovWaUVZrB55ftEw-7W9rL1dKr7i5x8TxbFN-gzv7RixQosf6LsM-KInQTiBsm_rm4-91sF1nrZGGdsVIhoOY0k98owCWfbv_IVNFCT');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shoppingCartMember`
--

CREATE TABLE `shoppingCartMember` (
  `userId` int(11) NOT NULL,
  `accId` int(11) NOT NULL,
  `cartNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `size`
--

INSERT INTO `size` (`id`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, 'OS');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userConfig`
--

CREATE TABLE `userConfig` (
  `attribute` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `accId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wishlist`
--

CREATE TABLE `wishlist` (
  `accId` int(11) NOT NULL,
  `productTypeId` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `wishlist`
--

INSERT INTO `wishlist` (`accId`, `productTypeId`, `timestamp`) VALUES
(27, 2, '2025-06-24 15:19:27'),
(27, 19, '2025-06-24 16:20:10'),
(30, 23, '2025-06-24 16:29:12');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `allowedColor`
--
ALTER TABLE `allowedColor`
  ADD PRIMARY KEY (`productTypeId`,`colorId`);

--
-- Indizes für die Tabelle `allowedSize`
--
ALTER TABLE `allowedSize`
  ADD PRIMARY KEY (`productTypeId`,`sizeId`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `globalConfig`
--
ALTER TABLE `globalConfig`
  ADD PRIMARY KEY (`attribute`);

--
-- Indizes für die Tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `joinAddressAcc`
--
ALTER TABLE `joinAddressAcc`
  ADD PRIMARY KEY (`accountId`,`addressId`,`type`);

--
-- Indizes für die Tabelle `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`email`);

--
-- Indizes für die Tabelle `orderProduct`
--
ALTER TABLE `orderProduct`
  ADD PRIMARY KEY (`orderId`,`productId`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`,`productTypeId`),
  ADD KEY `fk_shoppingCart` (`accId`,`shoppingCartNumber`);

--
-- Indizes für die Tabelle `productImage`
--
ALTER TABLE `productImage`
  ADD PRIMARY KEY (`productTypeId`,`imageId`),
  ADD KEY `imageId` (`imageId`);

--
-- Indizes für die Tabelle `productType`
--
ALTER TABLE `productType`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `shoppingCart`
--
ALTER TABLE `shoppingCart`
  ADD PRIMARY KEY (`accId`,`cartNumber`);

--
-- Indizes für die Tabelle `shoppingCartMember`
--
ALTER TABLE `shoppingCartMember`
  ADD PRIMARY KEY (`userId`,`accId`,`cartNumber`),
  ADD KEY `accId` (`accId`,`cartNumber`);

--
-- Indizes für die Tabelle `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `userConfig`
--
ALTER TABLE `userConfig`
  ADD PRIMARY KEY (`attribute`,`accId`);

--
-- Indizes für die Tabelle `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`accId`,`productTypeId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1206;

--
-- AUTO_INCREMENT für Tabelle `productType`
--
ALTER TABLE `productType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `allowedSize`
--
ALTER TABLE `allowedSize`
  ADD CONSTRAINT `allowedsize_ibfk_1` FOREIGN KEY (`productTypeId`) REFERENCES `productType` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `allowedsize_ibfk_2` FOREIGN KEY (`productTypeId`) REFERENCES `productType` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_shoppingCart` FOREIGN KEY (`accId`,`shoppingCartNumber`) REFERENCES `shoppingCart` (`accId`, `cartNumber`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `productImage`
--
ALTER TABLE `productImage`
  ADD CONSTRAINT `productimage_ibfk_1` FOREIGN KEY (`imageId`) REFERENCES `image` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `product_reviews_productType_id_fk` FOREIGN KEY (`product_id`) REFERENCES `productType` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `shoppingCart`
--
ALTER TABLE `shoppingCart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`accId`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `shoppingCartMember`
--
ALTER TABLE `shoppingCartMember`
  ADD CONSTRAINT `shoppingcartmember_ibfk_1` FOREIGN KEY (`accId`,`cartNumber`) REFERENCES `shoppingCart` (`accId`, `cartNumber`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
