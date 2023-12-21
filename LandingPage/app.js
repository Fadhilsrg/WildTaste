// JAVASCRIPT ANIMASI JQUERY
jQuery(function ($) {
  var doAnimations = function () {
    var offset = $(window).scrollTop() + $(window).height(),
      $animatables = $(".animatable");

    $animatables.each(function (i) {
      var $animatable = $(this);

      if ($animatable.offset().top + $animatable.height() - 50 < offset) {
        if (!$animatable.hasClass("animate-in")) {
          $animatable.css("top", $animatable.css("top")).addClass("animate-in");
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

links.forEach((link) =>
  link.addEventListener("click", () => {
    closeDropdownMenu();
    setAriaExpandedFalse();
    toggleHamburger();
  })
);

document.documentElement.addEventListener("click", () => {
  closeDropdownMenu();
  setAriaExpandedFalse();
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeDropdownMenu();
    setAriaExpandedFalse();
  }
});

hamburgerBtn.addEventListener("click", toggleHamburger);

// Cart dan Pop up container
document.getElementById("cartLink").addEventListener("click", function (event) {
  event.preventDefault();

  var cartIcon = document.getElementById("cartIcon");
  if (cartIcon.className === "bx bx-cart") {
    cartIcon.className = "bx bxs-cart";
    showPopup();
  } else {
    cartIcon.className = "bx bx-cart";
    hidePopup();
  }
});

document.getElementById("closePopup").addEventListener("click", function () {
  cartIcon.className = "bx bx-cart";
  hidePopup();
});

function showPopup() {
  var cartSection = document.getElementById("cartSection");
  cartSection.style.display = "flex";
}

function hidePopup() {
  var cartSection = document.getElementById("cartSection");
  cartSection.style.display = "none";
}

// Show container
document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("testimonialForm");
  var responseContainer = form.querySelector(".containerResponse");
  var input = form.querySelector("input");
  var textarea = form.querySelector("textarea");
  var showButton = document.getElementById("showBtn");
  var closeButton = document.getElementById("closeBtn");
  var containerSubmit = document.getElementById("containerSubmit");
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

/* Set rates + misc */
var taxRate = 0.05;
var shippingRate = 10000;
var fadeTime = 300;

/* Assign actions */
$(".product-quantity input").change(function () {
  updateQuantity(this);
});

$(".product-removal button").click(function () {
  removeItem(this);
});

/* Recalculate cart */
function recalculateCart() {
  var subtotal = 0;

  /* Sum up row totals */
  $(".product").each(function () {
    subtotal += parseFloat(
      $(this)
        .find(".product-line-price")
        .text()
        .replace("Rp. ", "")
        .replace(".", "")
    );
  });

  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = subtotal > 0 ? shippingRate : 0;
  var total = subtotal + tax + shipping;

  /* Update totals display */
  $(".totals-value").fadeOut(fadeTime, function () {
    $("#cart-subtotal").html(formatCurrency(subtotal));
    $("#cart-tax").html(formatCurrency(tax));
    $("#cart-shipping").html(formatCurrency(shipping));
    $("#cart-total").html(formatCurrency(total));
    if (total == 0) {
      $(".checkout").fadeOut(fadeTime);
    } else {
      $(".checkout").fadeIn(fadeTime);
    }
    $(".totals-value").fadeIn(fadeTime);
  });
}

/* Helper function to format currency */
function formatCurrency(amount) {
  return "Rp. " + amount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

/* Update quantity */
function updateQuantity(quantityInput) {
  var productRow = $(quantityInput).closest(".product");
  var price = parseFloat(
    productRow
      .find(".product-price")
      .text()
      .replace("Rp. ", "")
      .replace(".", "")
  );
  var quantity = parseInt($(quantityInput).val(), 10);
  var linePrice = price * quantity;

  productRow.find(".product-line-price").fadeOut(fadeTime, function () {
    $(this).text(formatCurrency(linePrice));
    recalculateCart();
    $(this).fadeIn(fadeTime);
  });
}

/* Remove item from cart */
function removeItem(removeButton) {
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent().parent();
  productRow.slideUp(fadeTime, function () {
    productRow.remove();
    recalculateCart();
  });
}

document.getElementById("logoutButton").addEventListener("click", function () {
  // Redirect to logout.php when the logout button is clicked
  window.location.href = "/WildTaste/login.html";
});
