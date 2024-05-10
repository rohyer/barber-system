document.addEventListener("DOMContentLoaded", getStateMenu);

function getStateMenu() {
  const menuState = sessionStorage.getItem("menu");

  if (menuState && menuState === "open") {
    const nav = document.querySelector("nav.nav");

    nav.setAttribute("data-state", "open");
  }
}

const navMenu = document.getElementById("nav-menu");

navMenu.addEventListener("click", changeMenuState);

function changeMenuState() {
  const nav = document.querySelector("nav.nav");
  const navAttribute = nav.getAttribute("data-state");

  if (navAttribute === "open") {
    nav.setAttribute("data-state", "close");
    sessionStorage.setItem("menu", "close");
  } else if (navAttribute === "close") {
    nav.setAttribute("data-state", "open");
    sessionStorage.setItem("menu", "open");
  }
}

// Format Phone
const inputPhone = document.getElementById("input-phone");

function formatPhoneInput(value) {
  if (!value) return "";
  value = value.replace(/\D/g, "");
  value = value.replace(/(\d{2})(\d)/, "($1) $2");
  value = value.replace(/(\d)(\d{4})$/, "$1-$2");
  return value;
}

inputPhone.addEventListener("keyup", function (e) {
  const formattedInput = formatPhoneInput(e.target.value);
  e.target.value = formattedInput;
});

const inputBirth = document.getElementById("input-birth");

function formatBirthInput(value) {
  if (!value) return "";
  value = value.replace(/\D/g, "");
  value = value.replace(/(\d{2})(\d{2})(\d{4})/, "$1/$2/$3");
  return value;
}

inputBirth.addEventListener("keyup", function (e) {
  const formattedInput = formatBirthInput(e.target.value);
  e.target.value = formattedInput;
});
