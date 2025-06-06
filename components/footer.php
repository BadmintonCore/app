<!--Autor(en): Lasse Hoffmann*/-->
<?php

use Vestis\Database\Repositories\GCR;
use Vestis\Service\AuthService;

?>
<footer>

    <!--Container der Klasse "footer-newsletter"-->
    <div class="footer-newsletter">
        <h2>
            <?= GCR::getValue('FOOTER_HEADING') ?>
        </h2>
        <p>
            <?= GCR::getValue('FOOTER_SUBTITLE') ?>
        </p>

        <!--Formular der Klasse "form-row" und "form-newsletter"-->
        <form class="form-row form-newsletter" action="/newsletter/subscribe" method="post">
            <label>
                <input type="email" name="mail" placeholder="E-Mail Adresse">
            </label>
            <button type="submit" class="btn">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell"
                     viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                </svg>
            </button>
        </form>
    </div>

    <!--Container der Klasse "footer-categories"-->
    <div class="footer-categories">

        <!--Container der Klasse "footer-category"-->
        <div class="footer-category">
            <h4>Über uns</h4>
            <a href="/about-us/about">Das sind wir</a>
            <a href="/about-us/jobs">Jobs</a>
            <a href="/about-us/press">Presse</a>
            <a href="/about-us/responsibility">Verantwortung</a>
        </div>

        <!--Container der Klasse "footer-category"-->
        <div class="footer-category">
            <h4>Kundenservice</h4>
            <a href="/customer-service/faq">Fragen und Antworten</a>
            <a href="/customer-service/contact">Kontakt</a>
            <a href="/customer-service/returns">Rücksendungen</a>
            <?php if (AuthService::isCustomer()) : ?>
                <a href="/user-area/user">Benutzerbereich</a>
            <?php else: ?>
                <a href="/auth/login">Benutzerbereich</a>
            <?php endif; ?>
        </div>

        <!--Container der Klasse "footer-category"-->
        <div class="footer-category">
            <h4>Dein Einkauf</h4>
            <a href="/your-purchase/order">Fragen zur Bestellung</a>
            <a href="/your-purchase/paymentmethods">Zahlungsmethoden</a>
            <a href="/your-purchase/shipment">Versand und Lieferung</a>
            <a href="/your-purchase/vouchers">Online-Gutscheine</a>
        </div>

        <!--Container der Klasse "footer-category"-->
        <div class="footer-category">
            <h4>Rechtliches</h4>
            <a href="/legal/impress">Impressum</a>
            <a href="/legal/gtc">AGBs</a>
            <a href="/legal/privacypolicy">Datenschutz</a>
            <a href="/legal/revocation">Widerrufserklärung</a>
        </div>
    </div>

    <!--Container der Klasse "footer-accordion"-->
    <div class="footer-accordion">

        <!--Ein Akkordion-Element-->
        <button class="accordion-button">Über uns

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-down-fill open" viewBox="0 0 16 16" style="float: right">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-up-fill close" viewBox="0 0 16 16" style="float: right">
                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
            </svg>
        </button>
        <div class="accordion-content">
            <a href="/about-us/about">Das sind wir</a> <br>
            <a href="/about-us/jobs">Jobs</a> <br>
            <a href="/about-us/press">Presse</a> <br>
            <a href="/about-us/responsibility">Verantwortung</a>
        </div>

        <!--Ein Akkordion-Element-->
        <button class="accordion-button">Kundenservice

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-down-fill open" viewBox="0 0 16 16" style="float: right">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-up-fill close" viewBox="0 0 16 16" style="float: right">
                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
            </svg>
        </button>
        <div class="accordion-content">
            <a href="/customer-service/faq">Fragen und Antworten</a> <br>
            <a href="/customer-service/contact">Kontakt</a> <br>
            <a href="/customer-service/returns">Rücksendungen</a> <br>
            <?php
            if (AuthService::isCustomer()) : ?>
                <a href="/user-area/user">Benutzerbereich</a>
            <?php else: ?>
                <a href="/auth/login">Benutzerbereich</a>
            <?php endif; ?>
        </div>

        <!--Ein Akkordion-Element-->
        <button class="accordion-button">Dein Einkauf

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-down-fill open" viewBox="0 0 16 16" style="float: right">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-up-fill close" viewBox="0 0 16 16" style="float: right">
                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
            </svg>
        </button>
        <div class="accordion-content">
            <a href="/your-purchase/order">Fragen zur Bestellung</a> <br>
            <a href="/your-purchase/paymentmethods">Zahlungsmethoden</a> <br>
            <a href="/your-purchase/shipment">Versand und Lieferung</a> <br>
            <a href="/your-purchase/vouchers">Online-Gutscheine</a>
        </div>

        <!--Ein Akkordion-Element-->
        <button class="accordion-button">Rechtliches

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-down-fill open" viewBox="0 0 16 16" style="float: right">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-up-fill close" viewBox="0 0 16 16" style="float: right">
                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
            </svg>
        </button>
        <div class="accordion-content">
            <a href="/legal/impress">Impressum</a> <br>
            <a href="/legal/gtc">AGBs</a> <br>
            <a href="/legal/privacypolicy">Datenschutz</a> <br>
            <a href="/legal/revocation">Widerrufserklärung</a>
        </div>
    </div>

    <div class="footer-bottom">
        <!--Container der Klasse "footer-social"-->
        <div class="footer-social">

            <!--Instagram Link mit Vektor-Grafik-->
            <a href="<?= GCR::getValue('FOOTER_INSTAGRAM_LINK') ?>" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     class="bi bi-instagram"
                     viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                </svg>
            </a>

            <!--TikTok Link mit Vektor-Grafik-->
            <a href="<?= GCR::getValue('FOOTER_TIKTOK_LINK') ?>" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-tiktok"
                     viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                </svg>
            </a>

            <!--X Link mit Vektor-Grafik-->
            <a href="<?= GCR::getValue('FOOTER_X_LINK') ?>" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     class="bi bi-twitter-x"
                     viewBox="0 0 16 16">
                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                </svg>
            </a>

            <!--Facebook Link mit Vektor-Grafik-->
            <a href="<?= GCR::getValue('FOOTER_FACEBOOK_LINK') ?>" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     class="bi bi-facebook"
                     viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                </svg>
            </a>
            <a href="/katze.html">
                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gitlab" viewBox="0 0 16 16">
                    <path d="m15.734 6.1-.022-.058L13.534.358a.57.57 0 0 0-.563-.356.6.6 0 0 0-.328.122.6.6 0 0 0-.193.294l-1.47 4.499H5.025l-1.47-4.5A.572.572 0 0 0 2.47.358L.289 6.04l-.022.057A4.044 4.044 0 0 0 1.61 10.77l.007.006.02.014 3.318 2.485 1.64 1.242 1 .755a.67.67 0 0 0 .814 0l1-.755 1.64-1.242 3.338-2.5.009-.007a4.05 4.05 0 0 0 1.34-4.668Z"/>
                </svg>
            </a>
            <a href="/drucker.html">
                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                </svg>
            </a>
            <a href="/intern.html">
                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                </svg>
            </a>
        </div>
    </div>

    <!--Container der Klasse "footer-copyright"-->
    <div class="footer-copyright">
        <p>Copyright &#169; 2025 vestis.</p>
    </div>
</footer>
<!--Autor(en): Lasse Hoffmann-->