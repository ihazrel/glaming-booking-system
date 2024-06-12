function drop() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  } 

document.addEventListener("DOMContentLoaded", function() {
    // Select the form
    const form = document.querySelector("form");

    // Add event listener for form submission
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get input values
        const dateInputs = document.querySelectorAll(".date");
        const peopleInput = document.querySelector(".people");
        const promoInput = document.querySelector("input[type='text']");

        // Prepare date string
        const dates = `${dateInputs[0].value} to ${dateInputs[1].value}`;
        const people = peopleInput.value;
        const promoCode = promoInput.value;

        // Display in summary
        document.querySelector(".sm-info-date").textContent = `${dates}`;
        document.querySelector(".sm-info-pax").textContent = `${people}`;
        // Assuming there's a place for promo code in summary
        // If not, you can omit this part or add a corresponding div in your HTML
        const promoDisplay = document.querySelector(".sm-info-promo");
        if (promoDisplay) {
            promoDisplay.textContent = `Promo Code: ${promoCode}`;
        }
    });
});