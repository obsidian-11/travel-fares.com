let nameInput = null;
let emailInput = null;
let countryCodeSelect = null;
let phoneInput = null;
let nationalitySelect = null;
let countryOfResidenceSelect = null;
let travelDateInput = null;
let travellersInput = null;
let packageEl = null;
let submitBtn = null;

const submitForm = () => {
  const formData = {
    name: nameInput.value,
    email: emailInput.value,
    countryCode: countryCodeSelect.value,
    phone: phoneInput.value,
    nationality: nationalitySelect.value,
    countryOfResidence: countryOfResidenceSelect.value,
    travellers: travellersInput.value,
    travelDate: travelDateInput.value,
    tourPackage: packageEl.textContent,
    form: "TOUR_BOOKING",
  };

  if (formData) {
    const url = "/post";
    var form_data = new FormData();

    for (var key in formData) {
      form_data.append(key, formData[key]);
    }

    fetch(url, {
      method: "POST",
      body: form_data,
    })
      .then((res) => {
        console.log("res ===", res);
        // removeLoader();
        // removeForm();
        // showMessage(200);
      })
      .catch((error) => {
        // Handle any errors that occur during the request
        console.error("Error:", error);
        // removeLoader();
        // window.location.href = "#enquire";
        // showMessage(500);
      });
  } else {
    removeLoader();
  }
};

window.addEventListener("load", function () {
  nameInput = document.getElementById("tourBooking-name");
  emailInput = document.getElementById("tourBooking-name");
  phoneInput = document.getElementById("tourBooking-phone");
  nationalitySelect = document.getElementById("tourBooking-nationality-select");
  countryOfResidenceSelect = document.getElementById(
    "tourBooking-countryOfResidence-select"
  );
  countryCodeSelect = document.getElementById("tourBooking-countryCode-select");
  travellersInput = document.getElementById("tourBooking-travellers");
  travelDateInput = document.querySelector(".travelBooking-travelDate");
  packageEl = document.getElementById("tour-booking-heading");
  submitBtn = document.getElementById("tour-booking-form-submit-btn");

  submitBtn.addEventListener("click", (e) => {
    console.log("submitting");
    e.preventDefault();
    submitForm();
  });

  // .on("click", function (event) {
  //   console.log("submitting");
  //   event.preventDefault(); // Prevent form submission
  //   submitForm();
  // });
});

// const removeForm = () => {
//   document.querySelector(".booking-form").fadeOut(0);
// };

// const showMessage = (res) => {
//   if (res == 200) {
//     document.querySelector(".completion-msg-container").removeClass("hide");
//     document
//       .querySelector(".completion-msg-container > label")
//       .text(
//         "Thank you for reaching out to us. We have received your inquiry and will be in contact with you shortly."
//       )
//       .removeClass("error");

//     window.location.href = "#enquire";
//   } else {
//     document.querySelector(".completion-msg-container").removeClass("hide");
//     document
//       .querySelector(".completion-msg-container > label")
//       .text("Something went wrong. Please try again.")
//       .addClass("error");
//   }
// };
