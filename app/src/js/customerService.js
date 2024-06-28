const listStatus = document.querySelectorAll(".list__categories");
const openList = document.querySelector(".list__open");
const closedList = document.querySelector(".list__closed");

listStatus[0].addEventListener("click", () => {
  if (listStatus[0].getAttribute("data-state") === "false") {
    listStatus[0].setAttribute("data-state", "true");
    listStatus[1].setAttribute("data-state", "false");
    openList.setAttribute("data-state", "true");
    closedList.setAttribute("data-state", "false");
  }
});

listStatus[1].addEventListener("click", () => {
  if (listStatus[1].getAttribute("data-state") === "false") {
    listStatus[1].setAttribute("data-state", "true");
    listStatus[0].setAttribute("data-state", "false");
    closedList.setAttribute("data-state", "true");
    openList.setAttribute("data-state", "false");
  }
});