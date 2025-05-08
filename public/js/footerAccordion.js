/*Author: Lasse Hoffmann, Quelle: https://www.w3schools.com/howto/howto_js_accordion.asp*/
const accordionElements = document.getElementsByClassName("accordion-button");

/*Für alle accordion-buttons*/
for (let i = 0; i < accordionElements.length; i++) {
    accordionElements[i].addEventListener("click", function () {

        /* Umschalten der Styles*/

        /*Das zugehörige accordion-content-Element (Container) als Variable speichern*/
        let accordionContent = this.nextElementSibling;

        if (accordionContent.classList.contains("open")) {

            /*Accordion-Content vertecken*/
            accordionContent.classList.remove("open");
            accordionContent.classList.add("closed");

            /*Umschalten zwischen den geöffnet/geschlossen-Icon des Akkordeons*/
            accordionElements[i].querySelector(".close").style.display = "none";
            accordionElements[i].querySelector(".open").style.display = "block";
        } else {

            /*Accordion-Content zeigen*/
            accordionContent.classList.remove("closed");
            accordionContent.classList.add("open");


            /*Umschalten zwischen den geöffnet/geschlossen-Icon des Akkordeons*/
            accordionElements[i].querySelector(".close").style.display = "block";
            accordionElements[i].querySelector(".open").style.display = "none";
        }
    });
}
/*Author: Lasse Hoffmann, Quelle: https://www.w3schools.com/howto/howto_js_accordion.asp*/