// Format Phone
const inputPhone = document.getElementById("input-phone");

function formatPhoneInput(value) {
  if (!value) return "";
  value = value.replace(/\D/g, "");
  value = value.replace(/(\d{2})(\d)/, "($1) $2");
  value = value.replace(/(\d)(\d{4})$/, "$1-$2");
  return value;
}

if (inputPhone) {
  inputPhone.addEventListener("keyup", function (e) {
    const formattedInput = formatPhoneInput(e.target.value);
    e.target.value = formattedInput;
  });
}

// const inputBirth = document.getElementById("input-birth");

// function formatBirthInput(value) {
//   if (!value) return "";
//   value = value.replace(/\D/g, "");
//   value = value.replace(/(\d{2})(\d{2})(\d{4})/, "$1/$2/$3");
//   return value;
// }

// inputBirth.addEventListener("keyup", function (e) {
//   const formattedInput = formatBirthInput(e.target.value);
//   e.target.value = formattedInput;
// });

// Save Form

function clearForm() {
  document.getElementById("name").value = "";
  document.getElementById("sex").value = "M";
  document.getElementById("address").value = "";
  document.getElementById("input-birth").value = "";
  document.getElementById("input-phone").value = "";

  alert("Cliente cadastrado com sucesso!");
}

async function postData(formattedFormData) {
  const response = await fetch("cadastro", {
    method: "POST",
    body: formattedFormData
  });

  const data = response.ok;

  if (data) clearForm();
}

function validateInputs(data) {
  const errorTags = document.querySelectorAll(".form__error");

  let error = false;

  if (
    !/^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s][a-zA-Z.,áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s ]+$/.test(
      data.get("name")
    )
  ) {
    errorTags[0].textContent = "Prencha o campo corretamente";
    error = true;
  } else {
    errorTags[0].textContent = "";
  }
  if (
    data.get("sex") !== "M" &&
    data.get("sex") !== "F" &&
    data.get("sex") !== "Outro"
  ) {
    errorTags[1].textContent = "Prencha o campo corretamente";
    error = true;
  } else {
    errorTags[1].textContent = "";
  }
  if (
    !/^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s][a-zA-Z0-9.,áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s ]+$/.test(
      data.get("address")
    )
  ) {
    errorTags[2].textContent = "Prencha o campo corretamente";
    error = true;
  } else {
    errorTags[2].textContent = "";
  }
  if (!/\d{4}-\d{2}-\d{2}/.test(data.get("birth"))) {
    errorTags[3].textContent = "Prencha o campo corretamente";
    error = true;
  } else {
    errorTags[3].textContent = "";
  }
  if (!/^[0-9()]/.test(data.get("phone"))) {
    errorTags[4].textContent = "Prencha o campo corretamente";
    error = true;
  } else {
    errorTags[4].textContent = "";
  }

  return error;
}

const form = document.getElementById("client-form");

if (form) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formattedFormData = new FormData(form);

    const result = validateInputs(formattedFormData);

    if (!result) postData(formattedFormData);
  });
}
