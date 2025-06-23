-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2025 at 11:21 PM
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
(28, 'A', 'Admin', 'Istrator', 'admin', 'admin@system.org', '$2y$10$/Vkc9FerppYi1Zt4rq2Kk.8AmjklPYE4CDqz93VKX4UzTl.DL4OwK', 0);

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
(1, 2);

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
(1, 4);

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
(1, 'Wearables', NULL),
(2, 'Sweater', 1),
(3, 'Shirts', 1),
(4, 'Bags', 5),
(5, 'Asessours', NULL);

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
('max@mustermail.de');

-- --------------------------------------------------------

--
-- Table structure for table `orderProduct`
--

CREATE TABLE `orderProduct` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `boughtAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `boughtPrice` float DEFAULT NULL,
  `shoppingCartNumber` int(11) DEFAULT NULL,
  `boughtDiscount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productImage`
--

CREATE TABLE `productImage` (
  `productTypeId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 2, 'Produkt 01', '100% Bio-Baumwolle', 199, 'Unser erster Sweater', 'Summer Retro 2025', 'Maschinenwäsche bei 30°C, auf links waschen, nicht in den Trockner geben.', 'Made in Germany', '{}', 0);

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
(28, 1, 0, NULL, 'vNRWT-T6r2r8Ys8KP7ABGFZhI8cNmZ_2LEGfLhnVl2YfOnitUetLktjl-lhNy9K8dsS_tIajBxtCoeNNsoF_Wm3X9NRMtmwvxH0CMoQlBJMk4EsnLFsRhaJgwzQ-v0_td69pfbFaZVBpMx4UPlsWx716Hqkny29H2PXjx-_y4ZP3tb9nXB4W7U5uGZrCrEnpoM48BHHmdKTkF4yUIXo-cQ3JS8n0XSbpcOVFgn7-E5mqX88dGJ0nwPJg6beWetT');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productType`
--
ALTER TABLE `productType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

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
