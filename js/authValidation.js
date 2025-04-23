/*Author: Lasse Hoffmann*/

const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const passwordConfirmationInput = document.getElementById("passwordConfirmation");
const submitButton = document.getElementById("subBtn");
const registrationForm = document.getElementById("registrationForm");
const loginForm = document.getElementById("loginForm");
const userForm = document.getElementById("userForm");

/**
 * Funktion zur Validierung des Benutzernamens
 *
 * @param {string} username Benutzername des Kundens
 *
 * @returns {boolean} Korrekt formatierter Benutzername
 */
function validateUsername(username) {
    const usernameRegex = /^(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
    return usernameRegex.test(username);
}

/**
 * Funktion zur Validierung des Passworts
 *
 * @param {string} password Passwort des Kundens
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
function markField(inputElement, isValid) {
    if(!inputElement) return; //Wenn das inputElement nicht existiert, return
    if (isValid) {
        inputElement.classList.remove("form-input-error");
        inputElement.classList.add("form-input-success");
    } else {
        inputElement.classList.remove("form-input-success");
        inputElement.classList.add("form-input-error");
    }
}

/**
 * Validiert das Formular und markiert die Eingabefelder entsprechend
 */
function validateForm() {
    //Markierung der Input-Felder
    markField(usernameInput, validateUsername(usernameInput.value));
    markField(passwordInput, validatePassword(passwordInput.value));

    let passwordsOk = true;

    if (passwordConfirmationInput) {
        passwordsOk = passwordsMatch(passwordInput.value, passwordConfirmationInput.value);
        markField(passwordConfirmationInput, passwordsOk);
    }

    // Button nur aktivieren, wenn alles gültig ist
    submitButton.disabled = !(validateUsername(usernameInput.value) && validatePassword(passwordInput.value) && passwordsOk);
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

//Validierung bei Eingaben in Echtzeit (Aufruf der Validierungsfunktion)
if (usernameInput) usernameInput.addEventListener("input", validateForm);
if (passwordInput) passwordInput.addEventListener("input", validateForm);
if (passwordConfirmationInput) passwordConfirmationInput.addEventListener("input", validateForm);

/*Author: Lasse Hoffmann*/