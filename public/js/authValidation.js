/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const passwordConfirmationInput = document.getElementById("passwordConfirmation");
const submitButton = document.getElementById("subBtn");
const registrationForm = document.getElementById("registrationForm");
const loginForm = document.getElementById("loginForm");
const userForm = document.getElementById("userForm");
const usernameInputSpan = document.getElementById("usernameInputSpan");
const passwordInputSpan = document.getElementById("passwordInputSpan")

const errorMessages = {
    usernameError: "Der Benutzername muss aus mindestens 5 Buchstaben bestehen.",
    passwordError: "Das Passwort muss aus mindestens 10 Zeichen bestehen."
}

let activeField = null;

/**
 * Funktion zur Validierung des Benutzernamens
 *
 * @param {string} username Benutzername des Kunden
 *
 * @returns {boolean} Korrekt formatierter Benutzername
 */
function validateUsername(username) {
    const usernameRegex = /^(?=.*[a-z]).{5,}$/;
    return usernameRegex.test(username);
}

/**
 * Funktion zur Validierung des Passworts
 *
 * @param {string} password Passwort des Kunden
 *
 * @returns {boolean} Korrekt formatiertes Passwort
 * */
function validatePassword(password) {
    return password.length >= 10;
}

/**
 * Funktion zur Validierung der wiederholten Passworteingabe
 *
 * @param {string} password Das erste eingegebene Passwort
 * @param {string} passwordConfirmation Das zweite eingegebene Passwort
 *
 * @returns {boolean} Richtige Wiederholung des Passworts
 */
function passwordsMatch(password, passwordConfirmation) {
    return password === passwordConfirmation && validatePassword(password);
}

/**
 * Markiert die Eingabefelder farblich
 *
 * @param {Element} inputElement Eingabefeld
 * @param {boolean} isValid Valides Eingabefeld
 */
function handleField(inputElement, isValid) {
    if (!inputElement) return;

    // Prüft, ob das gerade fokussierte Element auch das inputElement ist
    const isActive = activeField === inputElement;

    if (isValid) {
        inputElement.classList.remove("form-input-error");
        inputElement.classList.add("form-input-success");
        if (isActive) {
            if (inputElement === usernameInput) usernameInputSpan.innerHTML = "";
            if (inputElement === passwordInput) passwordInputSpan.innerHTML = "";
        }
        inputElement.classList.remove("form-input-error-after-submit");
    } else {
        inputElement.classList.remove("form-input-success");
        inputElement.classList.add("form-input-error");
        if (isActive) {
            if (inputElement === usernameInput) {
                usernameInputSpan.innerHTML = errorMessages["usernameError"];
            }
            if (inputElement === passwordInput) {
                passwordInputSpan.innerHTML = errorMessages["passwordError"];
            }
        }
    }
}

/**
 * Validiert das Formular und markiert die Eingabefelder entsprechend
 */
function validateForm() {
    //Markierung der Input-Felder
    handleField(usernameInput, validateUsername(usernameInput.value));
    handleField(passwordInput, validatePassword(passwordInput.value));

    let passwordsOk = true;

    if (passwordConfirmationInput) {
        passwordsOk = passwordsMatch(passwordInput.value, passwordConfirmationInput.value);
        handleField(passwordConfirmationInput, passwordsOk);
    }

    if (userForm || registrationForm) {
        // Button nur aktivieren, wenn alles gültig ist
        submitButton.disabled = !(validateUsername(usernameInput.value) && validatePassword(passwordInput.value) && passwordsOk);
    }
}

if (registrationForm) {
    registrationForm.addEventListener("submit", function (event) {
        validateForm();
        if (submitButton.disabled) {
            event.preventDefault(); //blockiere das Absenden
        }
    });
} else if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
        validateForm();
        if (submitButton.disabled) {
            event.preventDefault(); //blockiere das Absenden
        }
    });
} else if (userForm) {
    userForm.addEventListener("submit", function (event) {
        validateForm();
        if (submitButton.disabled) {
            event.preventDefault(); //blockiere das Absenden
        }
    });
}

// Validierung bei Eingaben in Echtzeit (Aufruf der Validierungsfunktion)
if (usernameInput) usernameInput.addEventListener("input", validateForm);
if (passwordInput) passwordInput.addEventListener("input", validateForm);
if (passwordConfirmationInput) passwordConfirmationInput.addEventListener("input", validateForm);

// Reagiert auf focus-Events und setzt somit das gerade fokussierte Input-Feld
if (usernameInput) usernameInput.addEventListener("focus", () => { activeField = usernameInput; });
if (passwordInput) passwordInput.addEventListener("focus", () => { activeField = passwordInput; });
