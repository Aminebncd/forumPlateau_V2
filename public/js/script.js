document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.getElementById("navbar-toggler");
    const sidebar = document.getElementById("sidebar");
    const sidebarMask = document.getElementById("sidebar-mask");

    navbarToggler.addEventListener("click", function () {
        sidebar.classList.toggle("show");
        sidebarMask.classList.toggle("show");
    });

    sidebarMask.addEventListener("click", function () {
        sidebar.classList.remove("show");
        sidebarMask.classList.remove("show");
    });
});
