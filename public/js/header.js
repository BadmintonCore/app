const sidebarToggler = document.getElementById("sidebarDrawerToggler");
const sidebarDrawer = document.getElementById("sidebarDrawer");
const sidebarOverlay = document.getElementById("sidebarOverlay");
const sidebarClose = document.getElementById("sidebarClose")

sidebarToggler.addEventListener("click", () => {
    sidebarDrawer.classList.toggle("open");
    sidebarOverlay.classList.toggle("open");
});

sidebarClose.addEventListener("click", () => {
    sidebarDrawer.classList.toggle("open");
    sidebarOverlay.classList.toggle("open");
});

document.addEventListener("click", (e) => {

   if (
       sidebarDrawer.classList.contains("open")
       && !(sidebarDrawer.contains(e.target) || sidebarDrawer === e.target)
       && !(sidebarToggler.contains(e.target) || sidebarToggler === e.target)
   ) {
       sidebarDrawer.classList.remove("open");
       sidebarOverlay.classList.remove("open");
   }
});