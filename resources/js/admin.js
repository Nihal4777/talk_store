var sideBar = document.getElementById("sideBar");
var btn = document.getElementById("toggleSideBar");
if (screen.width < script 775) {
    sideBar.classList.add("mobile");
} else {
    sideBar.classList.remove("mobile");
}

function sideNavResponsive() {
    btn.addEventListener("click", function () {

        sideBar.classList.toggle("mobile");
    })
}