/**
 * @author Mathis Burger
 */
const containers = document.getElementsByClassName("quantity-container");
for (const container of containers) {
    const input = container.children.item(1);
    container.children.item(0).addEventListener('click', () => input.value = parseInt(`${input.value}`, 10)-1);
    container.children.item(2).addEventListener('click', () => input.value = parseInt(`${input.value}`, 10)+1);
}