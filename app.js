// JAVASCRIPT ANIMASI JQUERY
jQuery(function ($) {
  var doAnimations = function () {
    var offset = $(window).scrollTop() + $(window).height(),
      $animatables = $(".animatable");

    $animatables.each(function (i) {
      var $animatable = $(this);

      if ($animatable.offset().top + $animatable.height() - 50 < offset) {
        if (!$animatable.hasClass("animate-in")) {
          $animatable
            .css("top", $animatable.css("top"))
            .addClass("animate-in");
        }
      } 
    });
  };

  $(window).on("scroll", doAnimations);
  $(window).trigger("scroll");
});

// NAVBAR
const dropdownBtn = document.querySelectorAll(".dropdown-btn");
const dropdown = document.querySelectorAll(".dropdown");
const hamburgerBtn = document.getElementById("hamburger");
const navMenu = document.querySelector(".menu");
const links = document.querySelectorAll(".dropdown a");

function setAriaExpandedFalse() {
  dropdownBtn.forEach((btn) => btn.setAttribute("aria-expanded", "false"));
}

function closeDropdownMenu() {
  dropdown.forEach((drop) => {
    drop.classList.remove("active");
    drop.addEventListener("click", (e) => e.stopPropagation());
  });
}

function toggleHamburger() {
  navMenu.classList.toggle("show");
}

dropdownBtn.forEach((btn) => {
  btn.addEventListener("click", function (e) {
    const dropdownIndex = e.currentTarget.dataset.dropdown;
    const dropdownElement = document.getElementById(dropdownIndex);

    dropdownElement.classList.toggle("active");
    dropdown.forEach((drop) => {
      if (drop.id !== btn.dataset["dropdown"]) {
        drop.classList.remove("active");
      }
    });
    e.stopPropagation();
    btn.setAttribute(
      "aria-expanded",
      btn.getAttribute("aria-expanded") === "false" ? "true" : "false"
    );
  });
});

// close dropdown menu when the dropdown links are clicked
links.forEach((link) =>
  link.addEventListener("click", () => {
    closeDropdownMenu();
    setAriaExpandedFalse();
    toggleHamburger();
  })
);

// close dropdown menu when you click on the document body
document.documentElement.addEventListener("click", () => {
  closeDropdownMenu();
  setAriaExpandedFalse();
});

// close dropdown when the escape key is pressed
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeDropdownMenu();
    setAriaExpandedFalse();
  }
});

hamburgerBtn.addEventListener("click", toggleHamburger);

// Show container
document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("testimonialForm");
  var responseContainer = form.querySelector(".containerResponse");
  var input = form.querySelector("input");
  var textarea = form.querySelector("textarea");
  var submitButton = document.getElementById("submitBtn");
  var showButton = document.getElementById("showBtn");
  var closeButton = document.getElementById("closeBtn");
  var containerSubmit = document.getElementById("containerSubmit")
  var containerShow = document.getElementById("containerShow");
  var containerClose = document.getElementById("containerClose");

  showButton.addEventListener("click", function () {
      responseContainer.style.display = "flex";
      input.style.display = "none";
      textarea.style.display = "none";
      containerSubmit.style.display = "none";
      containerShow.style.display = "none";
      containerClose.style.display = "flex";
  });

  closeButton.addEventListener("click", function () {
    responseContainer.style.display = "none";
    input.style.display = "block";
    textarea.style.display = "block";
    containerSubmit.style.display = "flex";
    containerShow.style.display = "flex";
    containerClose.style.display = "none";
  });
});

// menghitung panjang slider agar animasi smooth 
document.addEventListener("DOMContentLoaded", function () {
  // Menghitung jumlah slide asli
  var slideCount = document.querySelectorAll(".slide").length;

  // Mengatur properti transform dan width sesuai dengan jumlah slide asli
  var containerResponse = document.querySelector(".containerResponse");
  var slideTrack = document.querySelector(".slide-track");

  // Mengatur properti width pada .slide-track
  slideTrack.style.width = "calc(250px * " + slideCount + ")";

  // Mengatur properti transform pada .slide-track
  containerResponse.style.setProperty("--slide-count", slideCount);
});

