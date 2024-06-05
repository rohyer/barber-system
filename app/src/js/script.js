// document.addEventListener("DOMContentLoaded", getStateMenu);

// function getStateMenu() {
//   const menuState = sessionStorage.getItem("menu");

//   if (menuState && menuState === "open") {
//     const nav = document.querySelector("nav.nav");

//     nav.setAttribute("data-state", "open");
//   }
// }

// const navMenu = document.getElementById("nav-menu");

// navMenu.addEventListener("click", changeMenuState);

// function changeMenuState() {
//   const nav = document.querySelector("nav.nav");
//   const navAttribute = nav.getAttribute("data-state");

//   if (navAttribute === "open") {
//     nav.setAttribute("data-state", "close");
//     sessionStorage.setItem("menu", "close");
//   } else if (navAttribute === "close") {
//     nav.setAttribute("data-state", "open");
//     sessionStorage.setItem("menu", "open");
//   }
// }
