/*Autor(en): Lennart Moog*/
const containers = document.getElementsByClassName("quantity-container");
for (const container of containers) {
    const input = container.children.item(1);


    container.children.item(0).addEventListener('click', function () {
        const currentValue = parseInt(`${input.value}`, 10);

        // Der Anzahl-Input muss immer > 0 sein, ansonsten wird er beim nächsten Klick auf "-" auf 1 gesetzt
        if (currentValue > 1) {
            input.value = parseInt(`${input.value}`, 10) - 1;
        } else {
            input.value = 1;
        }

    });

    container.children.item(2).addEventListener('click', function () {
        const currentValue = parseInt(`${input.value}`, 10);

        // Der Anzahl-Input darf nicht größer als 9 sein
        if (currentValue < input.max) {
            input.value = parseInt(`${input.value}`, 10) + 1;
        }
    });
}
/*Autor(en): Lennart Moog*/