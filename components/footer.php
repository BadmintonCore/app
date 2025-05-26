<!--Author: Lasse Hoffmann-->

<?php

use Vestis\Service\AuthService;

?>
<footer>

    <!--Container der Klasse "footer-newsletter"-->
    <div class="footer-newsletter">
        <h2>
            Bleibe immer einen Stil voraus
        </h2>
        <p>
            Melde dich für unseren Newsletter an und entdecke <br> exklusive Kollektionen und Angebote vor allen
            anderen.
        </p>

        <!--Formular der Klasse "form-row" und "form-newsletter"-->
        <form class="form-row form-newsletter">
            <label>
                <input type="email" name="email" placeholder="E-Mail Adresse">
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
            <a href="https://www.instagram.com/" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-instagram"
                     viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                </svg>
            </a>

            <!--TikTok Link mit Vektor-Grafik-->
            <a href="https://www.tiktok.com/explore" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok"
                     viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                </svg>
            </a>

            <!--X Link mit Vektor-Grafik-->
            <a href="https://x.com/" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-twitter-x"
                     viewBox="0 0 16 16">
                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                </svg>
            </a>

            <!--Facebook Link mit Vektor-Grafik-->
            <a href="https://www.facebook.com/" target="_blank">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-facebook"
                     viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                </svg>
            </a>
        </div>

        <div class="footer-payment">
            <svg viewBox="0 0 750 471" width="55" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="m278.198 334.228 33.36-195.763h53.358l-33.384 195.763z"/>
                    <path d="m524.307 142.687c-10.57-3.966-27.135-8.222-47.822-8.222-52.725 0-89.863 26.551-90.18 64.604-.297 28.129 26.514 43.821 46.754 53.185 20.77 9.597 27.752 15.716 27.652 24.283-.133 13.123-16.586 19.116-31.924 19.116-21.355 0-32.701-2.967-50.225-10.274l-6.877-3.112-7.488 43.823c12.463 5.466 35.508 10.199 59.438 10.445 56.09 0 92.502-26.248 92.916-66.884.199-22.27-14.016-39.216-44.801-53.188-18.65-9.056-30.072-15.099-29.951-24.269 0-8.137 9.668-16.838 30.559-16.838 17.447-.271 30.088 3.534 39.936 7.5l4.781 2.259z"/>
                    <path d="m661.615 138.464h-41.23c-12.773 0-22.332 3.486-27.941 16.234l-79.244 179.402h56.031s9.16-24.121 11.232-29.418c6.123 0 60.555.084 68.336.084 1.596 6.854 6.492 29.334 6.492 29.334h49.512zm-65.417 126.408c4.414-11.279 21.26-54.724 21.26-54.724-.314.521 4.381-11.334 7.074-18.684l3.607 16.878s10.217 46.729 12.352 56.527h-44.293z"/>
                    <path d="m45.878906 138.46484-.68164 4.07227c21.092962 5.106 39.932007 12.49619 56.425784 21.68945l47.3457 169.6875 56.45508-.0625 84.0039-195.38672h-56.52539l-52.23828 133.4961-5.56445-27.13086c-.26068-.83823-.54407-1.67793-.83399-2.51953l-18.16015-87.31836c-3.229-12.396-12.59655-16.09535-24.18555-16.52735z"/>
                </g>
            </svg>
        </div>
    </div>

    <!--Container der Klasse "footer-copyright"-->
    <div class="footer-copyright">
        <p>Copyright &#169; 2025 vestis.</p>
    </div>
</footer>
<!--Author: Lasse Hoffmann-->