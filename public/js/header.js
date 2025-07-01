/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
const sidebarToggler = document.getElementById("sidebarDrawerToggler");
const sidebarDrawer = document.getElementById("sidebarDrawer");
const sidebarOverlay = document.getElementById("sidebarOverlay");
const sidebarClose = document.getElementById("sidebarClose");

function openSidebar() {
    sidebarDrawer.classList.remove("closed");
    sidebarDrawer.classList.add("open");
    sidebarOverlay.classList.toggle("open");
}

function closeSidebar() {
    sidebarDrawer.classList.remove("open");
    sidebarDrawer.classList.add("closed");
    sidebarOverlay.classList.toggle("open");
}

sidebarToggler.addEventListener("click", () => openSidebar());

sidebarClose.addEventListener("click", () => {
    closeSidebar();
});

document.addEventListener("click", (e) => {

   if (
       sidebarDrawer.classList.contains("open")
       && !(sidebarDrawer.contains(e.target) || sidebarDrawer === e.target)
       && !(sidebarToggler.contains(e.target) || sidebarToggler === e.target)
   ) {
       closeSidebar();
   }
});