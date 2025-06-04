ALTER TABLE globalConfig MODIFY COLUMN value TEXT;
INSERT INTO globalConfig (attribute, value) VALUES
                                                ('FOOTER_INSTAGRAM_LINK', 'https://instagram.com'),
                                                ('FOOTER_TIKTOK_LINK', 'https://tiktok.com'),
                                                ('FOOTER_X_LINK', 'https://x.com'),
                                                ('FOOTER_FACEBOOK_LINK', 'https://facebook.com');
INSERT INTO globalConfig (attribute, value) VALUES ('ABOUT_US_CONTENT', '<p class = "large-text">
            Wir sind eine junge, trendbewusste Mode-Marke, die es sich zur Aufgabe gemacht hat, Mode für alle zu <br>
            kreieren, die ihren eigenen Stil leben und sich selbstbewusst ausdrücken möchten. Unsere Kollektionen <br>
            kombinieren Qualität, Komfort und aktuelle Trends, um dir die perfekte Mischung aus Alltagsbekleidung <br>
            und Statement-Pieces zu bieten. <br>
            Bei vestis. findest du Outfits, die nicht nur gut aussehen, sondern sich auch gut anfühlen. Wir setzen auf
            <br>
            nachhaltige Materialien und faire Produktion, um dir nicht nur modische, sondern auch verantwortungsbewusste
            <br>
            Kleidung zu bieten.
        </p>
        <p class = "large-text">
            Entdecke deine neue Lieblingsmode bei uns und lass dich von unseren Designs inspirieren – für jeden Moment,
            <br>
            für deinen Style, für dich!
        </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('JOBS_CONTENT', 'Karriere bei uns macht mega Spaß!');
INSERT INTO globalConfig (attribute, value) VALUES ('PRESS_CONTENT', 'Hier finden Sie unsere neusten Presseinhalte');
INSERT INTO globalConfig (attribute, value) VALUES ('RESPONSIBILITY_CONTENT', 'Hier finden sie ganz viel Verantwortung');
INSERT INTO globalConfig (attribute, value) VALUES ('FAQ_CONTENT', '<p class="large-text">
            <b>1. Wie lange dauert der Versand?</b> <br>
            Die Lieferzeit beträgt in der Regel 2–5 Werktage innerhalb Deutschlands. <br>
            Sollte es zu Verzögerungen kommen, informieren wir Sie umgehend per E-Mail.
        </p>

        <p class="large-text">
            <b>2. Welche Zahlungsmethoden werden akzeptiert?</b> <br>
            Sie können bei uns per Vorkasse, PayPal, Kreditkarte oder Sofortüberweisung bezahlen.
        </p>

        <p class="large-text">
            <b>3. Wie kann ich meine Bestellung stornieren?</b> <br>
            Bitte kontaktieren Sie unseren Kundenservice so schnell wie möglich per E-Mail oder Telefon. <br>
            Sollte die Bestellung noch nicht versandt worden sein, können wir sie problemlos stornieren.
        </p>

        <p class="large-text">
            <b>4. Was mache ich, wenn meine Bestellung beschädigt ankommt?</b> <br>
            Bitte dokumentieren Sie die Beschädigung mit Fotos und melden Sie sich umgehend bei unserem Kundenservice. <br>
            Wir kümmern uns schnellstmöglich um Ersatz oder Rückerstattung.
        </p>

        <p class="large-text">
            <b>5. Kann ich Artikel umtauschen?</b> <br>
            Ein direkter Umtausch ist leider nicht möglich. <br>
            Bitte senden Sie den Artikel zurück und bestellen Sie den gewünschten Artikel neu.
        </p>

        <p class="large-text">
            <b>6. Wo finde ich meine Rechnung?</b> <br>
            Ihre Rechnung erhalten Sie per E-Mail nach Abschluss der Bestellung. <br>
            Alternativ können Sie sie in Ihrem Kundenkonto herunterladen, sofern Sie eines angelegt haben.
        </p>

        <p class="large-text">
            <b>7. Muss ich ein Kundenkonto anlegen, um zu bestellen?</b> <br>
            Nein, Sie können auch als Gast bestellen. Ein Kundenkonto bietet jedoch Vorteile <br>
            wie die Einsicht in frühere Bestellungen und schnelleren Bestellvorgang.
        </p>

        <p class="large-text">
            <b>8. Kann ich meine Lieferadresse nachträglich ändern?</b> <br>
            Bitte kontaktieren Sie uns so schnell wie möglich. <br>
            Solange die Bestellung noch nicht versendet wurde, können wir die Adresse ändern.
        </p>

        <p class="large-text">
            <b>9. Was passiert, wenn ich bei der Lieferung nicht zu Hause bin?</b> <br>
            Der Versanddienstleister hinterlässt in der Regel eine Benachrichtigungskarte <br>
            mit Informationen zur Abholung oder einem neuen Zustellversuch.
        </p>

        <p class="large-text">
            <b>10. Wie kann ich den Status meiner Bestellung verfolgen?</b> <br>
            Nach dem Versand erhalten Sie von uns eine E-Mail mit einem Link zur Sendungsverfolgung. <br>
            So wissen Sie jederzeit, wo sich Ihr Paket befindet.
        </p>

        <p class="large-text">
            <b>11. Was kostet der Versand?</b> <br>
            Die genauen Versandkosten werden im Bestellvorgang deutlich angezeigt. <br>
            Ab einem bestimmten Bestellwert kann der Versand kostenlos sein – die Bedingungen finden Sie auf unserer Website.
        </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('RETURNS_CONTENT', '<p class="large-text">
            <b>Rücksendung</b> <br>
            Sie können Artikel innerhalb von 14 Tagen nach Erhalt der Ware an uns zurücksenden. <br>
            Bitte stellen Sie sicher, dass sich die Artikel in ungebrauchtem und einwandfreiem Zustand befinden <br>
            und möglichst in der Originalverpackung zurückgesendet werden.
        </p>
        <p class="large-text">
            <b>Rücksendeadresse</b> <br>
            MusterShop GmbH <br>
            Retourenabteilung <br>
            Musterstraße 1 <br>
            12345 Musterstadt
        </p>
        <p class="large-text">
            <b>Rücksendeablauf</b> <br>
            1. Bitte kontaktieren Sie unseren Kundenservice per E-Mail an info@mustershop.de <br>
            und geben Sie Ihre Bestellnummer sowie den Rücksendegrund an. <br>
            2. Sie erhalten anschließend von uns ein Rücksendeetikett per E-Mail. <br>
            3. Verpacken Sie die Ware sicher und bringen Sie das Etikett gut sichtbar an. <br>
            4. Geben Sie das Paket bei einer Annahmestelle des angegebenen Versanddienstleisters ab.
        </p>
        <p class="large-text">
            <b>Erstattung</b> <br>
            Nach Eingang und Prüfung der Rücksendung erstatten wir Ihnen den Kaufbetrag <br>
            innerhalb von 7 Werktagen auf das bei der Bestellung verwendete Zahlungsmittel.
        </p>
        <p class="large-text">
            <b>Rücksendekosten</b> <br>
            Die Kosten der Rücksendung tragen Sie, es sei denn, die gelieferte Ware war fehlerhaft <br>
            oder entsprach nicht der bestellten. In diesem Fall übernehmen wir die Rücksendekosten.
        </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('GTC_CONTENT', '<p class = "large-text">
            <b>1. Geltungsbereich</b> <br>

            Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle Bestellungen, <br>
            die über unseren Online-Shop durch Verbraucher und Unternehmer erfolgen.
        </p>
        <p class = "large-text">
            <b>2. Vertragspartner, Vertragsschluss</b> <br>

            Der Kaufvertrag kommt zustande mit MusterShop GmbH, Musterstraße 1, 12345 Musterstadt. <br>
            Mit Einstellung der Produkte in den Online-Shop geben wir ein verbindliches Angebot zum <br>
            Vertragsschluss über diese Artikel ab. Der Vertrag kommt zustande, indem Sie durch Anklicken des <br>
            Bestellbuttons das Angebot über die im Warenkorb enthaltenen Waren annehmen.
        </p>
        <p class="large-text">
            <b>3. Preise und Versandkosten</b> <br>

            Alle Preise sind Endpreise und enthalten die gesetzliche Mehrwertsteuer. Zuzüglich zum Warenpreis <br>
            kommen gegebenenfalls Versandkosten hinzu, die im Bestellvorgang deutlich ausgewiesen werden.
        </p>
        <p class="large-text">
            <b>4. Lieferung</b> <br>

            Die Lieferung erfolgt innerhalb Deutschlands mit DHL oder einem anderen Versanddienstleister. <br>
            Die Lieferzeit beträgt in der Regel 2–5 Werktage, sofern beim Produkt keine andere Angabe erfolgt.
        </p>
        <p class="large-text">
            <b>5. Zahlung</b> <br>

            In unserem Shop stehen Ihnen die folgenden Zahlungsarten zur Verfügung: <br>
            <br>
            Vorkasse<br>
            PayPal<br>
            Kreditkarte<br>
            Sofortüberweisung
        </p>
        <p class="large-text">
            <b>6. Widerrufsrecht</b> <br>

            Verbraucher haben ein gesetzliches Widerrufsrecht. Die Widerrufsbelehrung und ein <br>
            Muster-Widerrufsformular finden Sie auf unserer Website unter dem Menüpunkt „Widerrufserklärung“.
        </p>
        <p class="large-text">
            <b>7. Eigentumsvorbehalt</b> <br>

            Die Ware bleibt bis zur vollständigen Bezahlung unser Eigentum.
        </p>
        <p class="large-text">
            <b>8. Gewährleistung und Haftung</b> <br>

            Es gelten die gesetzlichen Gewährleistungsrechte. Bei Mängeln der gelieferten Ware wenden Sie <br>
            sich bitte an unseren Kundenservice. Für Schäden haften wir nur bei Vorsatz oder grober Fahrlässigkeit.
        </p>
        <p class="large-text">
            <b>9. Schlussbestimmungen</b> <br>

            Sollte eine Bestimmung dieser AGB unwirksam sein, bleibt der Vertrag im Übrigen wirksam. <br>
            Anstelle der unwirksamen Bestimmung gilt das einschlägige gesetzliche Recht.
        </p>

        <br>

        <p class="large-text" style="text-align: center">
            <b>MusterShop GmbH<br>
            Musterstraße 1<br>
            12345 Musterstadt<br>
            E-Mail: info@mustershop.de<br>
                Telefon: 01234 / 567890</b>
        </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('IMPRESS_CONTENT', '<p class="large-text">
        <!--Author: Lennart Moog-->
        <!--Author: Lasse Hoffmann-->
        <b>Impressum</b><br>
        Angaben gemäß § 5 TMG: <br>
        <br>
        [Vor- und Nachname oder Firmenname]<br>
        [Anschrift: Straße, Hausnummer]<br>
        [PLZ] [Ort]<br>
        [Land]<br>
        <br>
        Vertreten durch:<br>
        [Name der vertretungsberechtigten Person(en)]<br>
        <br>
        Kontakt:<br>
        Telefon: [Telefonnummer]<br>
        E-Mail: [E-Mail-Adresse]<br>
        Website: [Domain-URL]<br>
        <br>
        Umsatzsteuer-ID:<br>
        Umsatzsteuer-Identifikationsnummer <br>
        gemäß §27 a Umsatzsteuergesetz: [USt-ID]<br>
        <br>
        Handelsregister:<br>
        Eingetragen im Handelsregister.<br>
        Registergericht: [z. B. Amtsgericht Musterstadt]<br>
        Registernummer: [HRB 123456]<br>
        <br>
        Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:<br>
        [Name]<br>
        [Adresse wie oben oder abweichend]
    </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('PRIVACY_CONTENT', '<p class="large-text">
            <b>1. Verantwortlicher</b> <br>
            MusterShop GmbH <br>
            Musterstraße 1 <br>
            12345 Musterstadt <br>
            E-Mail: info@mustershop.de <br>
            Telefon: 01234 / 567890
        </p>
        <p class="large-text">
            <b>2. Erhebung und Verarbeitung personenbezogener Daten</b> <br>
            Wir erheben, speichern und verarbeiten Ihre personenbezogenen Daten zur Abwicklung Ihrer Bestellung, <br>
            für die Lieferung sowie zur Pflege der Kundenbeziehung. <br>
            Personenbezogene Daten erheben wir nur, wenn Sie uns diese im Rahmen Ihrer Bestellung <br>
            oder bei der Eröffnung eines Kundenkontos freiwillig mitteilen.
        </p>
        <p class="large-text">
            <b>3. Weitergabe personenbezogener Daten</b> <br>
            Eine Weitergabe Ihrer Daten erfolgt ausschließlich an das mit der Lieferung beauftragte Versandunternehmen <br>
            und – soweit erforderlich – an das mit der Zahlungsabwicklung beauftragte Kreditinstitut oder Zahlungsdienstleister <br>
            (z. B. PayPal, Kreditkartenanbieter, Sofortüberweisung).
        </p>
        <p class="large-text">
            <b>4. Verwendung von Cookies</b> <br>
            Unser Online-Shop verwendet Cookies, um bestimmte Funktionen zu ermöglichen und die Nutzung unserer Website zu verbessern. <br>
            Sie können das Speichern von Cookies in Ihrem Browser deaktivieren. <br>
            Dies kann jedoch die Funktionalität der Website einschränken.
        </p>
        <p class="large-text">
            <b>5. Ihre Rechte</b> <br>
            Sie haben das Recht auf Auskunft über Ihre gespeicherten personenbezogenen Daten <br>
            sowie ggf. ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. <br>
            Wenden Sie sich hierzu bitte an unseren Kundenservice unter info@mustershop.de.
        </p>
        <p class="large-text">
            <b>6. Datensicherheit</b> <br>
            Ihre Daten werden im Bestellprozess mittels SSL-Verschlüsselung übertragen. <br>
            Wir sichern unsere Website und Systeme durch technische und organisatorische Maßnahmen <br>
            gegen Verlust, Zerstörung, Zugriff, Veränderung oder Verbreitung Ihrer Daten durch unbefugte Personen.
        </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('REVOCATION_CONTENT', '<p class="large-text" style="text-align: justify">
            <b>Widerrufsrecht für Verbraucher</b> <br>
            <br>
            Verbraucher haben ein vierzehntägiges Widerrufsrecht.<br>
            <br>
            <b>Widerrufsrecht</b> <br>
            Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen.<br>
            Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter,<br>
            der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat, <br>
            im Falle einer Teillieferung: an dem Sie oder ein Dritter die letzte Ware in Besitz genommen haben.<br>
            Um Ihr Widerrufsrecht auszuüben, müssen Sie uns (MusterShop GmbH, Musterstraße 1, 12345 Musterstadt,<br>
            E-Mail: info@mustershop.de, Telefon: 01234 / 567890) mittels einer eindeutigen Erklärung <br>
            (per E-Mail oder Post) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren.
        </p>');
INSERT INTO globalConfig (attribute, value) VALUES ('ORDER_CONTENT', 'Fragen zur Bestellung hier rein');
INSERT INTO globalConfig (attribute, value) VALUES ('PAYMENT_METHODS_CONTENT', 'Wir bieten nur Zahlung auf Rechnung an');
INSERT INTO globalConfig (attribute, value) VALUES ('SHIPMENT_CONTENT', 'Wir versenden so, wie wir wollen');
INSERT INTO globalConfig (attribute, value) VALUES ('VOUCHERS_CONTENT', 'Wir nutzen viele tolle Gutscheine');
INSERT INTO globalConfig (attribute, value) VALUES ('FOOTER_HEADING', 'Bleibe immer einen Stil voraus');
INSERT INTO globalConfig (attribute, value) VALUES ('FOOTER_SUBTITLE', 'Melde dich für unseren Newsletter an und entdecke
exklusive Kollektionen und Angebote vor allen anderen.');