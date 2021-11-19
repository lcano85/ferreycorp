// Imports
//=require swiper/swiper-bundle.js

var ferreycorpBanner = new Swiper(".ferreycorp__banner", {
  loop: true,
  autoplay: {
    delay: 10000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
  },
});

var swiper = new Swiper(".ferreycorp__noticias .noticias__content", {
  slidesPerView: 1,
  spaceBetween: 30,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 29,
    },
  },
});

// Accordion
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

jQuery(function ($) {
  //Buscador
  $("html").on("click", function () {
    $(".ferreycorp__search").removeClass("active");
  });
  $(".ferreycorp__search").on("click", function (e) {
    e.stopPropagation();
    $(this).addClass("active");
    $(this).find(".form-control").focus();
  });

  // hamburger__list
  $(".hamburger__list").click(function () {
    $(this).toggleClass("active");

    $(".menu-principal").toggleClass("left-open");
    $("body").toggleClass("overflow-hidden");
  });

  $(".ferreycorp__header .menu-principal .menu-item-has-children > a").on(
    "click",
    function (e) {
      var width = $(window).width();
      console.log("holaaa");
      if (width < 992) {
        e.preventDefault();
        var $this = $(this);
        if ($this.next().hasClass("show")) {
          $this.removeClass("active");
          $this.next().removeClass("show");
          $this.next().slideUp(350);
        } else {
          $this.parent().parent().find("li a").removeClass("active");
          $this.parent().parent().find("li .sub-menu").removeClass("show");
          $this.parent().parent().find("li .sub-menu").slideUp(350);
          $this.toggleClass("active");
          $this.next().toggleClass("show");
          $this.next().slideToggle(350);
        }
        return false;
      }
    }
  );
});
