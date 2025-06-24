-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2025 at 03:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vestis`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
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
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `type`, `firstname`, `surname`, `username`, `email`, `password`, `isBlocked`) VALUES
(27, 'C', 'Max', 'Mustermann', 'maxmusti', 'max@mustermail.de', '$2y$10$DOzQ5.kRAR9PntLF7wURaekepQZbWkwW1hVprbx9I8ZbxM92czW/C', 0),
(28, 'A', 'Admin', 'Istrator', 'admin', 'admin@system.org', '$2y$10$/Vkc9FerppYi1Zt4rq2Kk.8AmjklPYE4CDqz93VKX4UzTl.DL4OwK', 0),
(29, 'C', 'Susi', 'Sorglos', 'susisorg', 'sosi@sorglos.net', '$2y$10$ECOki2kBkk5zHO6QJAA5SecwdSk2wWDoFqYDyZuMCDqRSKbXd8VX6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `address`
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
-- Table structure for table `allowedColor`
--

CREATE TABLE `allowedColor` (
  `productTypeId` int(11) NOT NULL,
  `colorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowedColor`
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
(22, 3),
(23, 3);

-- --------------------------------------------------------

--
-- Table structure for table `allowedSize`
--

CREATE TABLE `allowedSize` (
  `productTypeId` int(11) NOT NULL,
  `sizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowedSize`
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
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 5),
(20, 3),
(21, 3),
(22, 3),
(23, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentCategoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
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
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `hex` varchar(6) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `hex`, `name`) VALUES
(1, 'db3333', 'Rot'),
(2, '000000', 'Schwarz'),
(3, 'ffffff', 'Weiß'),
(4, '1f73e0', 'Blau'),
(5, 'c96e6e', 'Beige'),
(6, '26990f', 'Grün');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
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
-- Table structure for table `globalConfig`
--

CREATE TABLE `globalConfig` (
  `attribute` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `globalConfig`
--

INSERT INTO `globalConfig` (`attribute`, `value`) VALUES
('ABOUT_US_CONTENT', '<p class = \"large-text\">\n            Wir sind eine junge, trendbewusste Mode-Marke, die es sich zur Aufgabe gemacht hat, Mode für alle zu <br>\n            kreieren, die ihren eigenen Stil leben und sich selbstbewusst ausdrücken möchten. Unsere Kollektionen <br>\n            kombinieren Qualität, Komfort und aktuelle Trends, um dir die perfekte Mischung aus Alltagsbekleidung <br>\n            und Statement-Pieces zu bieten. <br>\n            Bei vestis. findest du Outfits, die nicht nur gut aussehen, sondern sich auch gut anfühlen. Wir setzen auf\n            <br>\n            nachhaltige Materialien und faire Produktion, um dir nicht nur modische, sondern auch verantwortungsbewusste\n            <br>\n            Kleidung zu bieten.\n        </p>\n        <p class = \"large-text\">\n            Entdecke deine neue Lieblingsmode bei uns und lass dich von unseren Designs inspirieren – für jeden Moment,\n            <br>\n            für deinen Style, für dich!\n        </p>'),
('FAQ_CONTENT', '<p class=\"large-text\">\r\n            <b>1. Wie lange dauert der Versand?</b> <br>\r\n            Die Lieferzeit beträgt in der Regel 2–5 Werktage innerhalb Deutschlands. <br>\r\n            Sollte es zu Verzögerungen kommen, informieren wir Sie umgehend per E-Mail.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>2. Welche Zahlungsmethoden werden akzeptiert?</b> <br>\r\n            Sie können bei uns per Vorkasse, PayPal, Kreditkarte oder Sofortüberweisung bezahlen.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>3. Wie kann ich meine Bestellung stornieren?</b> <br>\r\n            Bitte kontaktieren Sie unseren Kundenservice so schnell wie möglich per E-Mail oder Telefon. <br>\r\n            Sollte die Bestellung noch nicht versandt worden sein, können wir sie problemlos stornieren.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>4. Was mache ich, wenn meine Bestellung beschädigt ankommt?</b> <br>\r\n            Bitte dokumentieren Sie die Beschädigung mit Fotos und melden Sie sich umgehend bei unserem Kundenservice. <br>\r\n            Wir kümmern uns schnellstmöglich um Ersatz oder Rückerstattung.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>5. Kann ich Artikel umtauschen?</b> <br>\r\n            Ein direkter Umtausch ist leider nicht möglich. <br>\r\n            Bitte senden Sie den Artikel zurück und bestellen Sie den gewünschten Artikel neu.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>6. Wo finde ich meine Rechnung?</b> <br>\r\n            Ihre Rechnung erhalten Sie per E-Mail nach Abschluss der Bestellung. <br>\r\n            Alternativ können Sie sie in Ihrem Kundenkonto herunterladen, sofern Sie eines angelegt haben.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>7. Muss ich ein Kundenkonto anlegen, um zu bestellen?</b> <br>\r\n            Nein, Sie können auch als Gast bestellen. Ein Kundenkonto bietet jedoch Vorteile <br>\r\n            wie die Einsicht in frühere Bestellungen und schnelleren Bestellvorgang.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>8. Kann ich meine Lieferadresse nachträglich ändern?</b> <br>\r\n            Bitte kontaktieren Sie uns so schnell wie möglich. <br>\r\n            Solange die Bestellung noch nicht versendet wurde, können wir die Adresse ändern.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>9. Was passiert, wenn ich bei der Lieferung nicht zu Hause bin?</b> <br>\r\n            Der Versanddienstleister hinterlässt in der Regel eine Benachrichtigungskarte <br>\r\n            mit Informationen zur Abholung oder einem neuen Zustellversuch.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>10. Wie kann ich den Status meiner Bestellung verfolgen?</b> <br>\r\n            Nach dem Versand erhalten Sie von uns eine E-Mail mit einem Link zur Sendungsverfolgung. <br>\r\n            So wissen Sie jederzeit, wo sich Ihr Paket befindet.\r\n        </p>\r\n\r\n        <p class=\"large-text\">\r\n            <b>11. Was kostet der Versand?</b> <br>\r\n            Die genauen Versandkosten werden im Bestellvorgang deutlich angezeigt. <br>\r\n            Ab einem bestimmten Bestellwert kann der Versand kostenlos sein – die Bedingungen finden Sie auf unserer Website.\r\n        </p>'),
('FOOTER_FACEBOOK_LINK', 'https://facebook.com'),
('FOOTER_HEADING', 'Bleibe immer einen Stil voraus'),
('FOOTER_INSTAGRAM_LINK', 'https://instagram.com'),
('FOOTER_SUBTITLE', 'Melde dich für unseren Newsletter an und entdecke\nexklusive Kollektionen und Angebote vor allen anderen.'),
('FOOTER_TIKTOK_LINK', 'https://tiktok.com'),
('FOOTER_X_LINK', 'https://x.com'),
('GTC_CONTENT', '<p class = \"large-text\">\n            <b>1. Geltungsbereich</b> <br>\n\n            Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle Bestellungen, <br>\n            die über unseren Online-Shop durch Verbraucher und Unternehmer erfolgen.\n        </p>\n        <p class = \"large-text\">\n            <b>2. Vertragspartner, Vertragsschluss</b> <br>\n\n            Der Kaufvertrag kommt zustande mit MusterShop GmbH, Musterstraße 1, 12345 Musterstadt. <br>\n            Mit Einstellung der Produkte in den Online-Shop geben wir ein verbindliches Angebot zum <br>\n            Vertragsschluss über diese Artikel ab. Der Vertrag kommt zustande, indem Sie durch Anklicken des <br>\n            Bestellbuttons das Angebot über die im Warenkorb enthaltenen Waren annehmen.\n        </p>\n        <p class=\"large-text\">\n            <b>3. Preise und Versandkosten</b> <br>\n\n            Alle Preise sind Endpreise und enthalten die gesetzliche Mehrwertsteuer. Zuzüglich zum Warenpreis <br>\n            kommen gegebenenfalls Versandkosten hinzu, die im Bestellvorgang deutlich ausgewiesen werden.\n        </p>\n        <p class=\"large-text\">\n            <b>4. Lieferung</b> <br>\n\n            Die Lieferung erfolgt innerhalb Deutschlands mit DHL oder einem anderen Versanddienstleister. <br>\n            Die Lieferzeit beträgt in der Regel 2–5 Werktage, sofern beim Produkt keine andere Angabe erfolgt.\n        </p>\n        <p class=\"large-text\">\n            <b>5. Zahlung</b> <br>\n\n            In unserem Shop stehen Ihnen die folgenden Zahlungsarten zur Verfügung: <br>\n            <br>\n            Vorkasse<br>\n            PayPal<br>\n            Kreditkarte<br>\n            Sofortüberweisung\n        </p>\n        <p class=\"large-text\">\n            <b>6. Widerrufsrecht</b> <br>\n\n            Verbraucher haben ein gesetzliches Widerrufsrecht. Die Widerrufsbelehrung und ein <br>\n            Muster-Widerrufsformular finden Sie auf unserer Website unter dem Menüpunkt „Widerrufserklärung“.\n        </p>\n        <p class=\"large-text\">\n            <b>7. Eigentumsvorbehalt</b> <br>\n\n            Die Ware bleibt bis zur vollständigen Bezahlung unser Eigentum.\n        </p>\n        <p class=\"large-text\">\n            <b>8. Gewährleistung und Haftung</b> <br>\n\n            Es gelten die gesetzlichen Gewährleistungsrechte. Bei Mängeln der gelieferten Ware wenden Sie <br>\n            sich bitte an unseren Kundenservice. Für Schäden haften wir nur bei Vorsatz oder grober Fahrlässigkeit.\n        </p>\n        <p class=\"large-text\">\n            <b>9. Schlussbestimmungen</b> <br>\n\n            Sollte eine Bestimmung dieser AGB unwirksam sein, bleibt der Vertrag im Übrigen wirksam. <br>\n            Anstelle der unwirksamen Bestimmung gilt das einschlägige gesetzliche Recht.\n        </p>\n\n        <br>\n\n        <p class=\"large-text\" style=\"text-align: center\">\n            <b>MusterShop GmbH<br>\n            Musterstraße 1<br>\n            12345 Musterstadt<br>\n            E-Mail: info@mustershop.de<br>\n                Telefon: 01234 / 567890</b>\n        </p>'),
('IMPRESS_CONTENT', '<p class=\"large-text\">\n        <!--Author: Lennart Moog-->\n        <!--Author: Lasse Hoffmann-->\n        <b>Impressum</b><br>\n        Angaben gemäß § 5 TMG: <br>\n        <br>\n        [Vor- und Nachname oder Firmenname]<br>\n        [Anschrift: Straße, Hausnummer]<br>\n        [PLZ] [Ort]<br>\n        [Land]<br>\n        <br>\n        Vertreten durch:<br>\n        [Name der vertretungsberechtigten Person(en)]<br>\n        <br>\n        Kontakt:<br>\n        Telefon: [Telefonnummer]<br>\n        E-Mail: [E-Mail-Adresse]<br>\n        Website: [Domain-URL]<br>\n        <br>\n        Umsatzsteuer-ID:<br>\n        Umsatzsteuer-Identifikationsnummer <br>\n        gemäß §27 a Umsatzsteuergesetz: [USt-ID]<br>\n        <br>\n        Handelsregister:<br>\n        Eingetragen im Handelsregister.<br>\n        Registergericht: [z. B. Amtsgericht Musterstadt]<br>\n        Registernummer: [HRB 123456]<br>\n        <br>\n        Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:<br>\n        [Name]<br>\n        [Adresse wie oben oder abweichend]\n    </p>'),
('JOBS_CONTENT', 'Karriere bei uns macht mega Spaß!'),
('ORDER_CONTENT', 'Fragen zur Bestellung hier rein'),
('PAYMENT_METHODS_CONTENT', 'Wir bieten nur Zahlung auf Rechnung an'),
('PRESS_CONTENT', 'Hier finden Sie unsere neusten Presseinhalte'),
('PRIVACY_CONTENT', '<p class=\"large-text\">\n            <b>1. Verantwortlicher</b> <br>\n            MusterShop GmbH <br>\n            Musterstraße 1 <br>\n            12345 Musterstadt <br>\n            E-Mail: info@mustershop.de <br>\n            Telefon: 01234 / 567890\n        </p>\n        <p class=\"large-text\">\n            <b>2. Erhebung und Verarbeitung personenbezogener Daten</b> <br>\n            Wir erheben, speichern und verarbeiten Ihre personenbezogenen Daten zur Abwicklung Ihrer Bestellung, <br>\n            für die Lieferung sowie zur Pflege der Kundenbeziehung. <br>\n            Personenbezogene Daten erheben wir nur, wenn Sie uns diese im Rahmen Ihrer Bestellung <br>\n            oder bei der Eröffnung eines Kundenkontos freiwillig mitteilen.\n        </p>\n        <p class=\"large-text\">\n            <b>3. Weitergabe personenbezogener Daten</b> <br>\n            Eine Weitergabe Ihrer Daten erfolgt ausschließlich an das mit der Lieferung beauftragte Versandunternehmen <br>\n            und – soweit erforderlich – an das mit der Zahlungsabwicklung beauftragte Kreditinstitut oder Zahlungsdienstleister <br>\n            (z. B. PayPal, Kreditkartenanbieter, Sofortüberweisung).\n        </p>\n        <p class=\"large-text\">\n            <b>4. Verwendung von Cookies</b> <br>\n            Unser Online-Shop verwendet Cookies, um bestimmte Funktionen zu ermöglichen und die Nutzung unserer Website zu verbessern. <br>\n            Sie können das Speichern von Cookies in Ihrem Browser deaktivieren. <br>\n            Dies kann jedoch die Funktionalität der Website einschränken.\n        </p>\n        <p class=\"large-text\">\n            <b>5. Ihre Rechte</b> <br>\n            Sie haben das Recht auf Auskunft über Ihre gespeicherten personenbezogenen Daten <br>\n            sowie ggf. ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. <br>\n            Wenden Sie sich hierzu bitte an unseren Kundenservice unter info@mustershop.de.\n        </p>\n        <p class=\"large-text\">\n            <b>6. Datensicherheit</b> <br>\n            Ihre Daten werden im Bestellprozess mittels SSL-Verschlüsselung übertragen. <br>\n            Wir sichern unsere Website und Systeme durch technische und organisatorische Maßnahmen <br>\n            gegen Verlust, Zerstörung, Zugriff, Veränderung oder Verbreitung Ihrer Daten durch unbefugte Personen.\n        </p>'),
('RESPONSIBILITY_CONTENT', 'Hier finden sie ganz viel Verantwortung'),
('RETURNS_CONTENT', '<p class=\"large-text\">\n            <b>Rücksendung</b> <br>\n            Sie können Artikel innerhalb von 14 Tagen nach Erhalt der Ware an uns zurücksenden. <br>\n            Bitte stellen Sie sicher, dass sich die Artikel in ungebrauchtem und einwandfreiem Zustand befinden <br>\n            und möglichst in der Originalverpackung zurückgesendet werden.\n        </p>\n        <p class=\"large-text\">\n            <b>Rücksendeadresse</b> <br>\n            MusterShop GmbH <br>\n            Retourenabteilung <br>\n            Musterstraße 1 <br>\n            12345 Musterstadt\n        </p>\n        <p class=\"large-text\">\n            <b>Rücksendeablauf</b> <br>\n            1. Bitte kontaktieren Sie unseren Kundenservice per E-Mail an info@mustershop.de <br>\n            und geben Sie Ihre Bestellnummer sowie den Rücksendegrund an. <br>\n            2. Sie erhalten anschließend von uns ein Rücksendeetikett per E-Mail. <br>\n            3. Verpacken Sie die Ware sicher und bringen Sie das Etikett gut sichtbar an. <br>\n            4. Geben Sie das Paket bei einer Annahmestelle des angegebenen Versanddienstleisters ab.\n        </p>\n        <p class=\"large-text\">\n            <b>Erstattung</b> <br>\n            Nach Eingang und Prüfung der Rücksendung erstatten wir Ihnen den Kaufbetrag <br>\n            innerhalb von 7 Werktagen auf das bei der Bestellung verwendete Zahlungsmittel.\n        </p>\n        <p class=\"large-text\">\n            <b>Rücksendekosten</b> <br>\n            Die Kosten der Rücksendung tragen Sie, es sei denn, die gelieferte Ware war fehlerhaft <br>\n            oder entsprach nicht der bestellten. In diesem Fall übernehmen wir die Rücksendekosten.\n        </p>'),
('REVOCATION_CONTENT', '<p class=\"large-text\" style=\"text-align: justify\">\n            <b>Widerrufsrecht für Verbraucher</b> <br>\n            <br>\n            Verbraucher haben ein vierzehntägiges Widerrufsrecht.<br>\n            <br>\n            <b>Widerrufsrecht</b> <br>\n            Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen.<br>\n            Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter,<br>\n            der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat, <br>\n            im Falle einer Teillieferung: an dem Sie oder ein Dritter die letzte Ware in Besitz genommen haben.<br>\n            Um Ihr Widerrufsrecht auszuüben, müssen Sie uns (MusterShop GmbH, Musterstraße 1, 12345 Musterstadt,<br>\n            E-Mail: info@mustershop.de, Telefon: 01234 / 567890) mittels einer eindeutigen Erklärung <br>\n            (per E-Mail oder Post) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren.\n        </p>'),
('SHIPMENT_CONTENT', 'Wir versenden so, wie wir wollen'),
('VOUCHERS_CONTENT', 'Wir nutzen viele tolle Gutscheine');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
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
-- Table structure for table `joinAddressAcc`
--

CREATE TABLE `joinAddressAcc` (
  `addressId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`email`) VALUES
(''),
('max@mustermail.de'),
('sosi@sorglos.net');

-- --------------------------------------------------------

--
-- Table structure for table `orderProduct`
--

CREATE TABLE `orderProduct` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderProduct`
--

INSERT INTO `orderProduct` (`orderId`, `productId`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
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
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `accountId`, `timestamp`, `status`, `denialMessage`, `discount`, `discountMessage`) VALUES
(1, 27, '2025-06-24 15:17:59', 'Zahlung ausstehend', NULL, 0, 'Vielen Dank für Ihre Bestellung!');

-- --------------------------------------------------------

--
-- Table structure for table `product`
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
-- Dumping data for table `product`
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
(17, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
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
(411, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(412, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(413, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(414, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(415, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(416, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(417, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(418, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(419, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(420, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(421, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(422, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(423, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(424, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(425, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(426, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(427, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(428, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(429, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(430, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(431, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(432, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(433, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(434, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(435, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(436, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(437, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(438, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(439, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(440, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(441, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(442, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(443, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(444, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(445, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(446, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(447, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(448, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(449, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(450, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(451, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(452, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(453, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(454, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(455, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(456, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(457, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(458, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(459, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(460, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(461, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(462, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(463, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(464, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(465, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(466, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(467, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(468, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(469, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(470, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(471, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(472, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(473, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(474, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(475, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(476, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(477, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(478, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(479, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(480, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(481, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(482, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(483, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(484, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(485, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(486, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(487, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(488, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(489, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(490, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(491, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(492, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(493, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(494, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(495, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(496, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(497, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(498, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(499, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(500, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(501, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(502, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(503, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(504, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(505, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(506, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(507, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(508, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(509, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(510, 18, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(511, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(512, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(513, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(514, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(515, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(516, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(517, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(518, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(519, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(520, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(521, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(522, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(523, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(524, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(525, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(526, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(527, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(528, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(529, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(530, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(531, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(532, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(533, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(534, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(535, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(536, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(537, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(538, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(539, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(540, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(541, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(542, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(543, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(544, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(545, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(546, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(547, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(548, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(549, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(550, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(551, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(552, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(553, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(554, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(555, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(556, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(557, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(558, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(559, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(560, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(561, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(562, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(563, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(564, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(565, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(566, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(567, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(568, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(569, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(570, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(571, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(572, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(573, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(574, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(575, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(576, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(577, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(578, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(579, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(580, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(581, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(582, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(583, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(584, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(585, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(586, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(587, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(588, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(589, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(590, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(591, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(592, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(593, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(594, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(595, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(596, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(597, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(598, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(599, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(600, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(601, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(602, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(603, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(604, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(605, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(606, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(607, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(608, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(609, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(610, 19, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(611, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(612, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(613, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(614, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(615, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(616, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(617, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(618, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(619, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(620, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(621, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(622, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(623, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(624, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(625, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(626, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(627, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(628, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(629, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(630, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(631, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(632, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(633, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(634, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(635, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(636, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(637, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(638, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(639, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(640, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(641, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(642, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(643, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(644, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(645, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(646, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(647, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(648, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(649, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(650, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(651, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(652, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(653, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(654, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(655, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(656, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(657, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(658, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(659, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(660, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(661, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(662, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(663, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(664, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(665, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(666, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(667, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(668, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(669, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(670, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(671, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(672, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(673, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(674, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(675, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(676, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(677, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(678, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(679, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(680, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(681, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(682, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(683, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(684, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(685, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(686, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(687, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(688, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(689, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(690, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(691, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(692, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(693, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(694, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(695, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(696, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(697, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(698, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(699, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(700, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(701, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(702, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(703, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(704, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(705, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(706, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(707, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(708, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(709, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(710, 20, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(711, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(712, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(713, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(714, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(715, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(716, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(717, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(718, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(719, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(720, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(721, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(722, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(723, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(724, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(725, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(726, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(727, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(728, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(729, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(730, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(731, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(732, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(733, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(734, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(735, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(736, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(737, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(738, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(739, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(740, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(741, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(742, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(743, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(744, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(745, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(746, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(747, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(748, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(749, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(750, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(751, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(752, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(753, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(754, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(755, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(756, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(757, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(758, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(759, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(760, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(761, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(762, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(763, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(764, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(765, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(766, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(767, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(768, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(769, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(770, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(771, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(772, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(773, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(774, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(775, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(776, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(777, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(778, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(779, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(780, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(781, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(782, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(783, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(784, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(785, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(786, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(787, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(788, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(789, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(790, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(791, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(792, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(793, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(794, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(795, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(796, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(797, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(798, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(799, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(800, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(801, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(802, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(803, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(804, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(805, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(806, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(807, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(808, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(809, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(810, 21, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(811, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(812, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(813, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(814, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(815, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(816, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(817, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(818, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(819, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(820, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(821, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(822, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(823, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(824, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(825, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(826, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(827, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(828, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(829, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(830, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(831, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(832, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(833, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(834, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(835, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(836, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(837, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(838, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(839, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(840, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(841, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(842, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(843, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(844, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(845, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(846, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(847, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(848, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(849, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(850, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(851, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(852, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(853, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(854, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(855, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(856, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(857, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(858, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(859, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(860, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(861, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(862, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(863, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(864, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(865, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(866, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(867, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(868, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(869, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(870, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(871, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(872, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(873, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(874, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(875, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(876, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(877, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(878, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(879, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(880, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(881, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(882, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(883, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(884, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(885, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(886, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(887, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(888, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(889, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(890, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(891, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(892, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(893, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(894, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(895, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(896, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(897, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(898, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(899, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(900, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(901, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(902, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(903, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(904, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(905, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(906, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(907, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(908, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(909, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(910, 22, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(911, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(912, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(913, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(914, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(915, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(916, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(917, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(918, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(919, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(920, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(921, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(922, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(923, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(924, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(925, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(926, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(927, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(928, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(929, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(930, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(931, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(932, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(933, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(934, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(935, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(936, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(937, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(938, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(939, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(940, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(941, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(942, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(943, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(944, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(945, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(946, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(947, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(948, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(949, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(950, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(951, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(952, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(953, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(954, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(955, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(956, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(957, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(958, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(959, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(960, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(961, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(962, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(963, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(964, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(965, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(966, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(967, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(968, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(969, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(970, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(971, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(972, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(973, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(974, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(975, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(976, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(977, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(978, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(979, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(980, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(981, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `product` (`id`, `productTypeId`, `sizeId`, `colorId`, `shoppingCartId`, `accId`, `boughtAt`, `boughtPrice`, `shoppingCartNumber`, `boughtDiscount`) VALUES
(982, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(983, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(984, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(985, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(986, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(987, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(988, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(989, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(990, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(991, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(992, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(993, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(994, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(995, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(996, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(997, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(998, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(999, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1000, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1001, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1002, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1003, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1004, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1005, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1006, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1007, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1008, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1009, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(1010, 23, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productImage`
--

CREATE TABLE `productImage` (
  `productTypeId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productImage`
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
-- Table structure for table `productType`
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
-- Dumping data for table `productType`
--

INSERT INTO `productType` (`id`, `categoryId`, `name`, `material`, `price`, `description`, `collection`, `careInstructions`, `origin`, `extraFields`, `discount`) VALUES
(2, 3, 'Analog Mood', '100% Bio-Baumwolle', 34.99, 'Schlicht und stilvoll – inspiriert vom Charme alter Polaroids.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, nicht im Trockner trocknen.', 'Made in Germany', '                {\r\n\"fabric_weight\": \"185 g/m²\",\r\n\"fit\": \"Regular Fit\"\r\n}            ', 0),
(3, 3, 'Retro Sunburst Tee', '100% Bio-Baumwolle', 34.99, 'Weiches Retro-T-Shirt aus Bio-Baumwolle mit Sonnenmuster – perfekt für lässige Sommertage.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, auf links waschen, nicht in den Trockner geben.', 'Made in Germany', '{\"fabric_weight\": \"180 g/m²\", \"fit\": \"Regular Fit\"}', 0),
(4, 3, 'Cassette Vibes', '100% Bio-Baumwolle', 32, 'Hochwertiges Baumwollshirt im kultigen Kassetten-Design – für echte 80s-Fans.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, Feinwaschgang empfohlen.', 'Made in Germany', '{\"fabric_weight\": \"190 g/m²\", \"fit\": \"Loose Fit\"}', 0),
(5, 3, 'Pixel Palm Tee', '100% Bio-Baumwolle', 37.99, 'Luftiges Retro-T-Shirt mit 8-Bit-Palmenmotiv – Sommer, Sonne, Nostalgie.', 'Summer Retro 2025', 'Schonwaschgang bei 30°C, auf links waschen.', 'Made in Germany', '{\"fabric_weight\": \"175 g/m²\", \"fit\": \"Regular Fit\"}', 0),
(6, 3, 'VHS Club Shirt', '100% Bio-Baumwolle', 34.99, 'Oversized Fit im VHS-Design – perfekt für entspannte Vintage-Looks.', 'Summer Retro 2025', 'Maschinenwäsche kalt, auf links bügeln.', 'Made in Germany', '{\"fabric_weight\": \"200 g/m²\", \"fit\": \"Oversized Fit\"}', 0),
(7, 3, 'Neon Nights Tee', '100% Bio-Baumwolle', 37.99, 'Retro-Discofeeling in sanften Farben – dein Essential für laue Sommernächte.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, geringe Schleuderzahl empfohlen.', 'Made in Germany', '{\"fabric_weight\": \"175 g/m²\", \"fit\": \"Relaxed Fit\"}', 0),
(8, 3, 'Sunset Radio', '100% Bio-Baumwolle', 39.99, 'Vintage-Radiodesign trifft weichen Baumwollstoff – perfekt zum Chillen.', 'Summer Retro 2025', 'Feinwäsche bei 30°C, sanft schleudern.', 'Made in Germany', '{\"fabric_weight\": \"190 g/m²\", \"fit\": \"Regular Fit\"}', 0),
(9, 3, 'Lo-Fi Coastline', '100% Bio-Baumwolle', 34.99, 'Lässiges Shirt mit Lo-Fi Coastline Print – entspannt, stilvoll, retro.', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, auf links drehen.', 'Made in Germany', '{\"fabric_weight\": \"170 g/m²\", \"fit\": \"Relaxed Fit\"}', 0),
(10, 2, 'Sunset Fade Crew', '85% Bio-Baumwolle, 15% recyceltes Polyester', 65, 'Weicher Crewneck mit sanftem Farbverlauf – wie ein Sonnenuntergang in Stoffform.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, auf links waschen, nicht bügeln.', 'Made in Germany', '{\"fabric_weight\": \"300 g/m²\", \"fit\": \"Relaxed Fit\"}', 0),
(11, 2, 'Analog Waves Sweater', '100% Bio-Baumwolle', 69.99, 'Wellenprint im Stil alter Audioanzeigen – stylisch und warm zugleich.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, Feinwaschgang empfohlen.', 'Made in Germany', '{\"fabric_weight\": \"290 g/m²\", \"fit\": \"Oversized Fit\"}', 0),
(12, 2, 'Lo-Fi Sunset Pullover', '80% Baumwolle, 20% recyceltes Polyester', 67, 'Sweater mit Lo-Fi-Print – fühlt sich an wie ein Abend auf Kassette.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, auf links drehen.', 'Made in Germany', '{\"fabric_weight\": \"r g/m²\", \"fit\": \"Regular Fit\"}', 0),
(13, 2, 'Rewind Club', '100% Bio-Baumwolle', 72, 'Statement-Sweater mit REWIND-Print – für echte Vintage-Enthusiasten.', 'Retro Layers 2025', 'Maschinenwäsche kalt, nicht im Trockner trocknen.', 'Made in Germany', '{\"fabric_weight\": \"320 g/m²\", \"fit\": \"Oversized Fit\"}', 0),
(14, 2, 'Static Memories', '85% Baumwolle, 15% recyceltes Polyester', 63.99, 'Leicht strukturierter Sweater im Stil eines alten TV-Rauschens.', 'Retro Layers 2025', 'Feinwäsche bei 30°C, auf links bügeln.', 'Made in Germany', '{\"fabric_weight\": \"280 g/m²\", \"fit\": \"Regular Fit\"}', 0),
(15, 2, 'Cassette Club Crew', '100% Bio-Baumwolle', 69.99, 'Kassetten-Grafik auf kuscheligem Baumwollstoff – 90s in modernem Gewand.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, keine Bleichmittel verwenden.', 'Made in Germany', '{\"fabric_weight\": \"300 g/m²\", \"fit\": \"Loose Fit\"}', 0),
(16, 2, 'Fade-In Pullover', '100% Bio-Baumwolle', 64.99, 'Minimalistischer Sweater mit subtilem Farbverlauf – clean und retro zugleich.', 'Retro Layers 2025', 'Maschinenwäsche bei 30°C, kein Weichspüler.', 'Made in Germany', '{\"fabric_weight\": \"310 g/m²\", \"fit\": \"Regular Fit\"}', 0),
(17, 2, 'Stereo Sunset', '80% Bio-Baumwolle, 20% recyceltes Polyester', 70, 'Oversized Sweater mit grafischem Sunset-Stick – retro und cozy.', 'Retro Layers 2025', 'Maschinenwäsche kalt, auf links bügeln.', 'Made in Germany', '{\"fabric_weight\": \"25 g/m²\", \"fit\": \"Oversized Fit\"}', 0),
(18, 4, 'Tape Deck Sling', 'Recyceltes Nylon', 42, 'Kompakte Sling Bag mit Tape-Design – ideal für unterwegs.', 'Urban Heritage 2025', 'Feucht abwischen, nicht bügeln.', 'Made in Germany', '{\"volume\": \"6 Liter\", \"closure\": \"Reißverschluss\", \"straps\": \"Crossbody verstellbar\", \"compartments\": \"Hauptfach, Frontfach mit Reißverschluss\"}', 0),
(19, 4, 'Lo-Fi Backpack', 'Canvas & veganes Leder', 79, 'Retro-Rucksack mit Lo-Fi Patch – robust und stylisch für unterwegs.', 'Urban Heritage 2025', 'Nicht waschen, punktuell reinigen', 'Made in Germany', '                {\"volume\": \"18 Liter\", \"closure\": \"Kordelzug & Magnetklappe\", \"straps\": \"Verstellbare Canvas-Träger\", \"compartments\": \"Großes Hauptfach, Innenfach mit Reißverschluss\"}            ', 0),
(20, 4, 'Polaroid Pocket Tote', '100% Baumwoll-Canvas', 39.99, 'Tote Bag mit Polaroid-Stickerei – leicht, geräumig, retro.', 'Urban Heritage 2025', 'Handwäsche empfohlen.', 'Made in Germany', '{\"volume\": \"10 Liter\", \"closure\": \"Offen mit Innendruckknopf\", \"straps\": \"Tragehenkel\", \"compartments\": \"1 Hauptfach, 2 Steckfächer innen\"}', 0),
(21, 4, 'Sunset Radio Pouch', 'Baumwoll-Canvas', 25, 'Kleine Pouch mit Radiodetail – perfekt für Essentials oder als Accessoire.', 'Urban Heritage 2025', 'Handwäsche, nicht schleudern.', 'Made in Germany', '                {\"volume\": \"2 Liter\", \"closure\": \"Reißverschluss\", \"straps\": \"Ohne – als Etui oder Clutch\", \"compartments\": \"1 Innenfach\"}            ', 0),
(22, 6, 'Lo-Fi Script Cap', 'Cord', 34.99, 'Cord-Cap im 90s-Look mit edler Lo-Fi Stickerei.', 'Headlines 2025', 'Nicht waschen, punktuell reinigen', 'Made in Germany', '{\"visor\": \"Flacher Schirm\", \"closure\": \"Metallschnalle\", \"design\": \"Lo-Fi-Stickerei mit Retro-Schriftzug\", \"ventilation\": \"Gestickte Ösen\"}', 0),
(23, 6, 'Waveform Classic Cap', '100% Baumwoll-Twill', 30, 'Schlichte 90s-Cap mit hochwertiger Stickerei – understated und retro.', 'Headlines 2025', 'Nur Handwäsche, nicht bleichen.', 'Made in Germany', '{\"visor\": \"Gebogener Schirm\", \"closure\": \"Metallschnalle hinten\", \"design\": \"Ton-in-Ton Stickerei vorn\", \"ventilation\": \"Bestickte Ösen\"}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
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
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `review`, `created_at`) VALUES
(4, 2, 29, 3, 'Ich wollte das Shirt für meine Tochter kaufen, aber ich finde den Preis etwas zu hoch. 12,99 € wäre ein deutlich besserer Preis, wenn man aktuelle Umstände wie die Inflation bedenkt.', '2025-06-24 11:59:43'),
(5, 2, 27, 5, 'Hab diese Schönheit gekauft, um mich nochmal richtig jung zu fühlen. Erfolgreicher Kauf 😎', '2025-06-24 13:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingCart`
--

CREATE TABLE `shoppingCart` (
  `accId` int(11) NOT NULL,
  `cartNumber` int(11) NOT NULL DEFAULT 0,
  `isShared` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `inviteSecret` varchar(255) DEFAULT '123'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoppingCart`
--

INSERT INTO `shoppingCart` (`accId`, `cartNumber`, `isShared`, `name`, `inviteSecret`) VALUES
(27, 1, 0, NULL, 'ulQoZ64mzJddcojIJyYzaYdF-EwPYFNS7lgeqTkkTDs9-VZjxemGvx8QiGEDXyVl-nskDY8hmgEywkGKqCzlHVipbkllFwNzczFGQeGZa1zlvRNergIKMnQjUEa3sMO9tMligQzV6Yp_oplbIfq0j_hCG9gOD-v4YJiUhcHRWEDHKcoYgocDsyJNcO-3-I9MiX8Ll3vcdJAI3S7JR_YfVv7bl4c9Q6Kgr-cLJJauSyHUHuZKvunf-WjSv-fV2BF'),
(27, 2, 1, 'Weihnachtsgeschenke', 'bp6Xqz4ORqDY49M35cf6g1yLJ-GgBFPiITGOuIJt31E1hDbtbDCzpqdjjwgiWCHx0opJ8wLxBY8wdm6fHewYRp947vzEtu26285ibLYn9yt8z1S6xYoAT4YJpxzRKum9IrkJOI5dwuR0RJ8KIwgfXlJ9dDYI4HUxoour66Rzb3S4wKk9WHzQRoM0uQv4BqKpevuNiqeyrtGXrk41rntH2fRRqL-1m7gIupBt5HFZvPHY0LghhIOLciAH1MOdxvn'),
(28, 1, 0, NULL, 'vNRWT-T6r2r8Ys8KP7ABGFZhI8cNmZ_2LEGfLhnVl2YfOnitUetLktjl-lhNy9K8dsS_tIajBxtCoeNNsoF_Wm3X9NRMtmwvxH0CMoQlBJMk4EsnLFsRhaJgwzQ-v0_td69pfbFaZVBpMx4UPlsWx716Hqkny29H2PXjx-_y4ZP3tb9nXB4W7U5uGZrCrEnpoM48BHHmdKTkF4yUIXo-cQ3JS8n0XSbpcOVFgn7-E5mqX88dGJ0nwPJg6beWetT'),
(29, 1, 0, NULL, 'AV8GC5SPIrbn7zFF6ur9SlBP6TuUspJS8xj8Uo5LhV7gCALPzz7xhKU3AnNi0iUB49QdMScy1OTYbLvhpe5p0j3FIGPG7olPWLr_za2mNaqjzV13NUNLiHP0M-2A7kFpA5rUfwnNLPQ0_cL1KeU0xprIU5CxMmt6BfklWRbPewEK7PoOXfwKe5aJ4MHj0bXQXkD2Dh5xY0sELIC_bRHd6imk4Bnma6V9GtbLXQwgo-XS-eI4jgVH_MF3FscqR5n');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingCartMember`
--

CREATE TABLE `shoppingCartMember` (
  `userId` int(11) NOT NULL,
  `accId` int(11) NOT NULL,
  `cartNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `userConfig`
--

CREATE TABLE `userConfig` (
  `attribute` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `accId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `accId` int(11) NOT NULL,
  `productTypeId` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`accId`, `productTypeId`, `timestamp`) VALUES
(27, 2, '2025-06-24 15:19:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowedColor`
--
ALTER TABLE `allowedColor`
  ADD PRIMARY KEY (`productTypeId`,`colorId`);

--
-- Indexes for table `allowedSize`
--
ALTER TABLE `allowedSize`
  ADD PRIMARY KEY (`productTypeId`,`sizeId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `globalConfig`
--
ALTER TABLE `globalConfig`
  ADD PRIMARY KEY (`attribute`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joinAddressAcc`
--
ALTER TABLE `joinAddressAcc`
  ADD PRIMARY KEY (`accountId`,`addressId`,`type`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `orderProduct`
--
ALTER TABLE `orderProduct`
  ADD PRIMARY KEY (`orderId`,`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`,`productTypeId`),
  ADD KEY `fk_shoppingCart` (`accId`,`shoppingCartNumber`);

--
-- Indexes for table `productImage`
--
ALTER TABLE `productImage`
  ADD PRIMARY KEY (`productTypeId`,`imageId`),
  ADD KEY `imageId` (`imageId`);

--
-- Indexes for table `productType`
--
ALTER TABLE `productType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shoppingCart`
--
ALTER TABLE `shoppingCart`
  ADD PRIMARY KEY (`accId`,`cartNumber`);

--
-- Indexes for table `shoppingCartMember`
--
ALTER TABLE `shoppingCartMember`
  ADD PRIMARY KEY (`userId`,`accId`,`cartNumber`),
  ADD KEY `accId` (`accId`,`cartNumber`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userConfig`
--
ALTER TABLE `userConfig`
  ADD PRIMARY KEY (`attribute`,`accId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`accId`,`productTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `productType`
--
ALTER TABLE `productType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allowedSize`
--
ALTER TABLE `allowedSize`
  ADD CONSTRAINT `allowedsize_ibfk_1` FOREIGN KEY (`productTypeId`) REFERENCES `productType` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `allowedsize_ibfk_2` FOREIGN KEY (`productTypeId`) REFERENCES `productType` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_shoppingCart` FOREIGN KEY (`accId`,`shoppingCartNumber`) REFERENCES `shoppingCart` (`accId`, `cartNumber`) ON DELETE SET NULL;

--
-- Constraints for table `productImage`
--
ALTER TABLE `productImage`
  ADD CONSTRAINT `productimage_ibfk_1` FOREIGN KEY (`imageId`) REFERENCES `image` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `product_reviews_productType_id_fk` FOREIGN KEY (`product_id`) REFERENCES `productType` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shoppingCart`
--
ALTER TABLE `shoppingCart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`accId`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shoppingCartMember`
--
ALTER TABLE `shoppingCartMember`
  ADD CONSTRAINT `shoppingcartmember_ibfk_1` FOREIGN KEY (`accId`,`cartNumber`) REFERENCES `shoppingCart` (`accId`, `cartNumber`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
