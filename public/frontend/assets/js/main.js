(function ($) {
  "use strict";
  jQuery(document).on("ready", function () {
    $(".others-option .search-btn").on("click", function () {
      $(".search-overlay").toggleClass("search-overlay-active");
    });
    $(".search-toggle").on("click", function () {
      console.log("123");
      $(".search-container").toggleClass("div-show");
    });

    $(".search-overlay-close").on("click", function () {
      $(".search-overlay").removeClass("search-overlay-active");
    });
    $(".header-top-others-option .search-btn").on("click", function () {
      $(".search-overlay").toggleClass("search-overlay-active");
    });

    $(".mean-menu").meanmenu({ meanScreenWidth: "991" });

    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 130) {
        $(".header-sticky").addClass("is-sticky");
      } else {
        $(".header-sticky").removeClass("is-sticky");
      }
    });

    var c,
      currentScrollTop = 0,
      navbar = $(".header-sticky");
    $(window).scroll(function () {
      var a = $(window).scrollTop();
      var b = navbar.height();
      currentScrollTop = a;
      if (c < currentScrollTop && a > b + b) {
        navbar.addClass("scrollUp");
      } else if (c > currentScrollTop && !(a <= b)) {
        navbar.removeClass("scrollUp");
      }
      c = currentScrollTop;
    });

    $(".home-slides").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplayHoverPause: false,
      autoplay: true,
      autoplayTimeout: 3000,
      smartSpeed: 500,
      autoHeight: true,
      items: 1,
      // navContainer: "#heroNav",
      // navText: [
      //   "<i class='flaticon-left d-none'></i>",
      //   "<i class='bx bx-right-arrow-alt'></i>",
      // ],
    });
    $(".home-slides").on("translate.owl.carousel", function () {
      $(".main-banner-content .sub-title")
        .removeClass("animated fadeInUp")
        .css("opacity", "0");
      $(".main-banner-content h1")
        .removeClass("animated fadeInUp")
        .css("opacity", "0");
      $(".main-banner-content p")
        .removeClass("animated fadeInUp")
        .css("opacity", "0");
      $(".main-banner-content .btn-box")
        .removeClass("animated fadeInUp")
        .css("opacity", "0");
    });
    $(".home-slides").on("translated.owl.carousel", function () {
      $(".main-banner-content .sub-title")
        .addClass("animated fadeInUp")
        .css("opacity", "1");
      $(".main-banner-content h1")
        .addClass("animated fadeInUp")
        .css("opacity", "1");
      $(".main-banner-content p")
        .addClass("animated fadeInUp")
        .css("opacity", "1");
      $(".main-banner-content .btn-box")
        .addClass("animated fadeInUp")
        .css("opacity", "1");
    });
      $(".categories-slides").owlCarousel({
          loop: true,
          // margin: 10,
          nav: true,
          dots: false,
          items: 6,
          navContainer: "#customNav",
          navText: [
              "<i class='bx bx-left-arrow-alt'></i>",
              "<i class='bx bx-right-arrow-alt'></i>",
          ],
          responsive: {
              0: { items: 2 },
              576: { items: 2 },
              768: { items: 5 },
              1200: { items: 6 },
              1400: { items: 8},
          },
      });
    $(".product-slides").owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      items: 1,
      navContainer: "#customNav",
      navText: [
        "<i class='bx bx-left-arrow-alt'></i>",
        "<i class='bx bx-right-arrow-alt'></i>",
      ],
    });

    $(".banner-image-slides").owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      dots: false,
      items: 1,
      autoplay: true,
      autoplaySpeed: 3000
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
    $(".facility-slides").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      margin: 30,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 1 },
        576: { items: 2 },
        768: { items: 3 },
        1200: { items: 4 },
      },
    });
    $(".products-slides").owlCarousel({
      loop: false,
      nav: false,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
        items: 6,

        margin: 15,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 2 },
        576: { items: 2 },
        768: { items: 3 },
        1200: { items: 4 },
        1400: { items: 6 },
      },
    });

    // Product Slider-Home Page

    $(".products-slider").owlCarousel({
      loop: false,
      nav: false,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      margin: 15,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 2 },
        576: { items: 2 },
        768: { items: 3 },
        1200: { items: 4 },
      },
    });

    $(".instagram-slides").owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 1 },
        576: { items: 2 },
        768: { items: 3 },
        1200: { items: 6 },
      },
    });
    $(".partner-slides").owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 2 },
        576: { items: 4 },
        768: { items: 4 },
        1200: { items: 7 },
      },
    });
    $(".offer-products-slides").owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      autoplayHoverPause: true,
      autoplay: false,
      animateOut: "fadeOut",
      mouseDrag: false,
      items: 1,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
    });
    $(".brand-slides").owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 2 },
        576: { items: 3 },
        768: { items: 4 },
        1200: { items: 7 },
      },
    });


    $(".js-range-of-price").ionRangeSlider({
      skin: "big",
      type: "double",
      grid: true,
      min: 1000,
      max: 1000000,
      from: 100000,
      step: 1000,
      prettify_enabled: true,
      prettify_separator: "-"
    });
    $(".testimonials-slides").owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      autoplayHoverPause: true,
      autoplay: false,
      center: true,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 1 },
        576: { items: 2 },
        768: { items: 2 },
        1200: { items: 3 },
      },
    });
    (function ($) {
      $(".tab ul.tabs")
        .addClass("active")
        .find("> li:eq(0)")
        .addClass("current");
      $(".tab ul.tabs li a").on("click", function (g) {
        var tab = $(this).closest(".tab"),
          index = $(this).closest("li").index();
        tab.find("ul.tabs > li").removeClass("current");
        $(this).closest("li").addClass("current");
        tab
          .find(".tab-content")
          .find("div.tabs-item")
          .not("div.tabs-item:eq(" + index + ")")
          .slideUp();
        tab
          .find(".tab-content")
          .find("div.tabs-item:eq(" + index + ")")
          .slideDown();
        g.preventDefault();
      });
    })(jQuery);
    $(function () {
      $(".accordion")
        .find(".accordion-title")
        .on("click", function () {
          $(this).toggleClass("active");
          $(this).next().slideToggle("fast");
          $(".accordion-content").not($(this).next()).slideUp("fast");
          $(".accordion-title").not($(this)).removeClass("active");
        });
    });
    $(function () {
      $(".icon-view-one").on("click", function (e) {
        e.preventDefault();
        document
          .getElementById("products-collections-filter")
          .classList.add("products-col-one");
        document
          .getElementById("products-collections-filter")
          .classList.remove(
            "products-col-two",
            "products-col-three",
            "products-col-four",
            "products-row-view"
          );
      });
      $(".icon-view-two").on("click", function (e) {
        e.preventDefault();
        document
          .getElementById("products-collections-filter")
          .classList.add("products-col-two");
        document
          .getElementById("products-collections-filter")
          .classList.remove(
            "products-col-one",
            "products-col-three",
            "products-col-four",
            "products-row-view"
          );
      });
      $(".icon-view-three").on("click", function (e) {
        e.preventDefault();
        document
          .getElementById("products-collections-filter")
          .classList.add("products-col-three");
        document
          .getElementById("products-collections-filter")
          .classList.remove(
            "products-col-one",
            "products-col-two",
            "products-col-four",
            "products-row-view"
          );
      });
      $(".view-grid-switch").on("click", function (e) {
        e.preventDefault();
        document
          .getElementById("products-collections-filter")
          .classList.add("products-row-view");
        document
          .getElementById("products-collections-filter")
          .classList.remove(
            "products-col-one",
            "products-col-two",
            "products-col-three",
            "products-col-four"
          );
      });
      $(".icon-view-six").on("click", function (e) {
        e.preventDefault();
        document
          .getElementById("products-collections-filter")
          .classList.add("products-col-six");
        document
          .getElementById("products-collections-filter")
          .classList.remove(
            "products-col-one",
            "products-col-two",
            "products-col-three",
            "products-col-four",
            "products-row-view"
          );
      });
    });
    $(".products-filter-options .view-column a").on("click", function () {
      $(".view-column a").removeClass("active");
      $(this).addClass("active");
    });
    $("select").niceSelect();
    $(".blog-slides").owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      autoplayHoverPause: true,
      autoplay: false,
      margin: 30,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: { 0: { items: 1 }, 768: { items: 2 }, 1200: { items: 3 } },
    });
    // $(".newsletter-form")
    //   .validator()
    //   .on("submit", function (event) {
    //     if (event.isDefaultPrevented()) {
    //       formErrorSub();
    //       submitMSGSub(false, "Please enter your email correctly.");
    //     } else {
    //       event.preventDefault();
    //     }
    //   });
    // function callbackFunction(resp) {
    //   if (resp.result === "success") {
    //     formSuccessSub();
    //   } else {
    //     formErrorSub();
    //   }
    // }
    // function formSuccessSub() {
    //   $(".newsletter-form")[0].reset();
    //   submitMSGSub(true, "Thank you for subscribing!");
    //   setTimeout(function () {
    //     $("#validator-newsletter").addClass("hide");
    //   }, 4000);
    // }
    // function formErrorSub() {
    //   $(".newsletter-form").addClass("animated shake");
    //   setTimeout(function () {
    //     $(".newsletter-form").removeClass("animated shake");
    //   }, 1000);
    // }
    // function submitMSGSub(valid, msg) {
    //   if (valid) {
    //     var msgClasses = "validation-success";
    //   } else {
    //     var msgClasses = "validation-danger";
    //   }
    //   $("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
    // }
    // $(".newsletter-form").ajaxChimp({
    //   url: "",
    //   callback: callbackFunction,
    // });
    $(".popup-btn").magnificPopup({
      type: "image",
      removalDelay: 300,
      gallery: { enabled: true },
      callbacks: {
        beforeOpen: function () {
          this.st.image.markup = this.st.image.markup.replace(
            "mfp-figure",
            "mfp-figure animated " + this.st.el.attr("data-effect")
          );
        },
      },
    });
    var $grid = $(".gallery-items, .blog-items, .lookbook-items").isotope({
      itemSelector: ".grid-item",
      percentPosition: true,
      masonry: { columnWidth: ".grid-item" },
    });
    $(".article-image-slides").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      animateOut: "fadeOut",
      items: 1,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
    });
    $(".products-details-desc-sticky").stickySidebar({
      topSpacing: 110,
      bottomSpacing: 110,
    });

    $(".products-details-image-slides").slick({
      dots: true,
      speed: 500,
      vertical: true,
      fade: false,
      slide: "li",
      slidesToShow: 1,
      autoplay: false,
      autoplaySpeed: 4000,
      prevArrow: false,
      nextArrow: false,
      responsive: [
        {
          breakpoint: 800,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            variableWidth: false,
            slidesToShow: 1,
            dots: true,
          },
          breakpoint: 1200,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            variableWidth: false,
            slidesToShow: 1,
            dots: true,
          },
        },
      ],
      customPaging: function (slider, i) {
        return (
          '<button class="tab">' +
          $(".slick-thumbs li:nth-child(" + (i + 1) + ")").html() +
          "</button>"
        );
      },
    });
    $(".products-details-image-slider").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplayHoverPause: true,
      autoplay: false,
      margin: 30,
      navText: [
        "<i class='flaticon-left'></i>",
        "<i class='flaticon-right-arrow'></i>",
      ],
      responsive: {
        0: { items: 1 },
        576: { items: 2 },
        768: { items: 2 },
        1200: { items: 3 },
      },
    });
    function makeTimer() {
      var endTime = new Date("September 20, 2020 17:00:00 PDT");
      var endTime = Date.parse(endTime) / 1000;
      var now = new Date();
      var now = Date.parse(now) / 1000;
      var timeLeft = endTime - now;
      var days = Math.floor(timeLeft / 86400);
      var hours = Math.floor((timeLeft - days * 86400) / 3600);
      var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
      var seconds = Math.floor(
        timeLeft - days * 86400 - hours * 3600 - minutes * 60
      );
      if (hours < "10") {
        hours = "0" + hours;
      }
      if (minutes < "10") {
        minutes = "0" + minutes;
      }
      if (seconds < "10") {
        seconds = "0" + seconds;
      }
      $("#days").html(days + "<span>Days</span>");
      $("#hours").html(hours + "<span>Hours</span>");
      $("#minutes").html(minutes + "<span>Minutes</span>");
      $("#seconds").html(seconds + "<span>Seconds</span>");
    }
    setInterval(function () {
      makeTimer();
    }, 0);
    $(function () {
      $(window).on("scroll", function () {
        var scrolled = $(window).scrollTop();
        if (scrolled > 300) $(".go-top").addClass("active");
        if (scrolled < 300) $(".go-top").removeClass("active");
      });
      $(".go-top").on("click", function () {
        $("html, body").animate({ scrollTop: "0" }, 500);
        console.log('top');
      });
    });
  });
  $(window).on("load", function () {
    if ($(".wow").length) {
      var wow = new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 20,
        mobile: true,
        live: true,
      });
      wow.init();
    }
  });


})(jQuery);


!(function (n, i, e, a) {
  (n.navigation = function (t, s) {
    var o = {
      responsive: !0,
      mobileBreakpoint: 1199,
      showDuration: 200,
      hideDuration: 200,
      showDelayDuration: 0,
      hideDelayDuration: 0,
      submenuTrigger: "hover",
      effect: "fade",
      submenuIndicator: !0,
      submenuIndicatorTrigger: !1,
      hideSubWhenGoOut: !0,
      visibleSubmenusOnMobile: !1,
      fixed: !1,
      overlay: !0,
      overlayColor: "rgba(0, 0, 0, 0.5)",
      hidden: !1,
      hiddenOnMobile: !1,
      offCanvasSide: "left",
      offCanvasCloseButton: !0,
      animationOnShow: "",
      animationOnHide: "",
      onInit: function () { },
      onLandscape: function () { },
      onPortrait: function () { },
      onShowOffCanvas: function () { },
      onHideOffCanvas: function () { }
    },
      r = this,
      u = Number.MAX_VALUE,
      d = 1,
      l = "click.nav touchstart.nav",
      f = "mouseenter focusin",
      c = "mouseleave focusout";
    r.settings = {};
    var t = (n(t), t);
    n(t).find(".nav-search").length > 0 &&
      n(t)
        .find(".nav-search")
        .find("form")
        .prepend(
          "<span class='nav-search-close-button' tabindex='0'>&#10005;</span>"
        ),
      (r.init = function () {
        (r.settings = n.extend({}, o, s)),
          r.settings.offCanvasCloseButton &&
          n(t)
            .find(".nav-menus-wrapper")
            .prepend(
              "<span class='nav-menus-wrapper-close-button'>&#10005;</span>"
            ),
          "right" == r.settings.offCanvasSide &&
          n(t)
            .find(".nav-menus-wrapper")
            .addClass("nav-menus-wrapper-right"),
          r.settings.hidden &&
          (n(t).addClass("navigation-hidden"),
            (r.settings.mobileBreakpoint = 99999)),
          v(),
          r.settings.fixed && n(t).addClass("navigation-fixed"),
          n(t)
            .find(".nav-toggle")
            .on("click touchstart", function (n) {
              n.stopPropagation(),
                n.preventDefault(),
                r.showOffcanvas(),
                s !== a && r.callback("onShowOffCanvas");
            }),
          n(t)
            .find(".nav-menus-wrapper-close-button")
            .on("click touchstart", function () {
              r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas");
            }),
          n(t)
            .find(".nav-search-button, .nav-search-close-button")
            .on("click touchstart keydown", function (i) {
              i.stopPropagation(), i.preventDefault();
              var e = i.keyCode || i.which;
              "click" === i.type ||
                "touchstart" === i.type ||
                ("keydown" === i.type && 13 == e)
                ? r.toggleSearch()
                : 9 == e && n(i.target).blur();
            }),
          n(t).find(".megamenu-tabs").length > 0 && y(),
          n(i).resize(function () {
            r.initNavigationMode(C()), O(), r.settings.hiddenOnMobile && m();
          }),
          r.initNavigationMode(C()),
          r.settings.hiddenOnMobile && m(),
          s !== a && r.callback("onInit");
      });
    var h = function () {
      n(t)
        .find(".nav-submenu")
        .hide(0),
        n(t)
          .find("li")
          .removeClass("focus");
    },
      v = function () {
        n(t)
          .find("li")
          .each(function () {
            n(this).children(".nav-dropdown,.megamenu-panel").length > 0 &&
              (n(this)
                .children(".nav-dropdown,.megamenu-panel")
                .addClass("nav-submenu"),
                r.settings.submenuIndicator &&
                n(this)
                  .children("a")
                  .append(
                    "<span class='submenu-indicator'><span class='submenu-indicator-chevron'></span></span>"
                  ));
          });
      },
      m = function () {
        n(t).hasClass("navigation-portrait")
          ? n(t).addClass("navigation-hidden")
          : n(t).removeClass("navigation-hidden");
      };
    (r.showSubmenu = function (i, e) {
      C() > r.settings.mobileBreakpoint &&
        n(t)
          .find(".nav-search")
          .find("form")
          .fadeOut(),
        "fade" == e
          ? n(i)
            .children(".nav-submenu")
            .stop(!0, !0)
            .delay(r.settings.showDelayDuration)
            .fadeIn(r.settings.showDuration)
            .removeClass(r.settings.animationOnHide)
            .addClass(r.settings.animationOnShow)
          : n(i)
            .children(".nav-submenu")
            .stop(!0, !0)
            .delay(r.settings.showDelayDuration)
            .slideDown(r.settings.showDuration)
            .removeClass(r.settings.animationOnHide)
            .addClass(r.settings.animationOnShow),
        n(i).addClass("focus");
    }),
      (r.hideSubmenu = function (i, e) {
        "fade" == e
          ? n(i)
            .find(".nav-submenu")
            .stop(!0, !0)
            .delay(r.settings.hideDelayDuration)
            .fadeOut(r.settings.hideDuration)
            .removeClass(r.settings.animationOnShow)
            .addClass(r.settings.animationOnHide)
          : n(i)
            .find(".nav-submenu")
            .stop(!0, !0)
            .delay(r.settings.hideDelayDuration)
            .slideUp(r.settings.hideDuration)
            .removeClass(r.settings.animationOnShow)
            .addClass(r.settings.animationOnHide),
          n(i)
            .removeClass("focus")
            .find(".focus")
            .removeClass("focus");
      });
    var p = function () {
      n("body").addClass("no-scroll"),
        r.settings.overlay &&
        (n(t).append("<div class='nav-overlay-panel'></div>"),
          n(t)
            .find(".nav-overlay-panel")
            .css("background-color", r.settings.overlayColor)
            .fadeIn(300)
            .on("click touchstart", function (n) {
              r.hideOffcanvas();
            }));
    },
      g = function () {
        n("body").removeClass("no-scroll"),
          r.settings.overlay &&
          n(t)
            .find(".nav-overlay-panel")
            .fadeOut(400, function () {
              n(this).remove();
            });
      };
    (r.showOffcanvas = function () {
      p(),
        "left" == r.settings.offCanvasSide
          ? n(t)
            .find(".nav-menus-wrapper")
            .css("transition-property", "left")
            .addClass("nav-menus-wrapper-open")
          : n(t)
            .find(".nav-menus-wrapper")
            .css("transition-property", "right")
            .addClass("nav-menus-wrapper-open");
    }),
      (r.hideOffcanvas = function () {
        n(t)
          .find(".nav-menus-wrapper")
          .removeClass("nav-menus-wrapper-open")
          .on(
            "webkitTransitionEnd moztransitionend transitionend oTransitionEnd",
            function () {
              n(t)
                .find(".nav-menus-wrapper")
                .css("transition-property", "none")
                .off();
            }
          ),
          g();
      }),
      (r.toggleOffcanvas = function () {
        C() <= r.settings.mobileBreakpoint &&
          (n(t)
            .find(".nav-menus-wrapper")
            .hasClass("nav-menus-wrapper-open")
            ? (r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas"))
            : (r.showOffcanvas(), s !== a && r.callback("onShowOffCanvas")));
      }),
      (r.toggleSearch = function () {
        "none" ==
          n(t)
            .find(".nav-search")
            .find("form")
            .css("display")
          ? (n(t)
            .find(".nav-search")
            .find("form")
            .fadeIn(200),
            n(t)
              .find(".nav-search")
              .find("input")
              .focus())
          : (n(t)
            .find(".nav-search")
            .find("form")
            .fadeOut(200),
            n(t)
              .find(".nav-search")
              .find("input")
              .blur());
      }),
      (r.initNavigationMode = function (i) {
        r.settings.responsive
          ? (i <= r.settings.mobileBreakpoint &&
            u > r.settings.mobileBreakpoint &&
            (n(t)
              .addClass("navigation-portrait")
              .removeClass("navigation-landscape"),
              S(),
              s !== a && r.callback("onPortrait")),
            i > r.settings.mobileBreakpoint &&
            d <= r.settings.mobileBreakpoint &&
            (n(t)
              .addClass("navigation-landscape")
              .removeClass("navigation-portrait"),
              k(),
              g(),
              r.hideOffcanvas(),
              s !== a && r.callback("onLandscape")),
            (u = i),
            (d = i))
          : (n(t).addClass("navigation-landscape"),
            k(),
            s !== a && r.callback("onLandscape"));
      });
    var b = function () {
      n("html").on("click.body touchstart.body", function (i) {
        0 === n(i.target).closest(".navigation").length &&
          (n(t)
            .find(".nav-submenu")
            .fadeOut(),
            n(t)
              .find(".focus")
              .removeClass("focus"),
            n(t)
              .find(".nav-search")
              .find("form")
              .fadeOut());
      });
    },
      C = function () {
        return (
          i.innerWidth || e.documentElement.clientWidth || e.body.clientWidth
        );
      },
      w = function () {
        n(t)
          .find(".nav-menu")
          .find("li, a")
          .off(l)
          .off(f)
          .off(c);
      },
      O = function () {
        if (C() > r.settings.mobileBreakpoint) {
          var i = n(t).outerWidth(!0);
          n(t)
            .find(".nav-menu")
            .children("li")
            .children(".nav-submenu")
            .each(function () {
              n(this)
                .parent()
                .position().left +
                n(this).outerWidth() >
                i
                ? n(this).css("right", 0)
                : n(this).css("right", "auto");
            });
        }
      },
      y = function () {
        function i(i) {
          var e = n(i)
            .children(".megamenu-tabs-nav")
            .children("li"),
            a = n(i).children(".megamenu-tabs-pane");
          n(e).on("click.tabs touchstart.tabs", function (i) {
            i.stopPropagation(),
              i.preventDefault(),
              n(e).removeClass("active"),
              n(this).addClass("active"),
              n(a)
                .hide(0)
                .removeClass("active"),
              n(a[n(this).index()])
                .show(0)
                .addClass("active");
          });
        }
        if (n(t).find(".megamenu-tabs").length > 0)
          for (var e = n(t).find(".megamenu-tabs"), a = 0; a < e.length; a++)
            i(e[a]);
      },
      k = function () {
        w(),
          h(),
          navigator.userAgent.match(/Mobi/i) ||
            navigator.maxTouchPoints > 0 ||
            "click" == r.settings.submenuTrigger
            ? n(t)
              .find(".nav-menu, .nav-dropdown")
              .children("li")
              .children("a")
              .on(l, function (e) {
                if (
                  (r.hideSubmenu(
                    n(this)
                      .parent("li")
                      .siblings("li"),
                    r.settings.effect
                  ),
                    n(this)
                      .closest(".nav-menu")
                      .siblings(".nav-menu")
                      .find(".nav-submenu")
                      .fadeOut(r.settings.hideDuration),
                    n(this).siblings(".nav-submenu").length > 0)
                ) {
                  if (
                    (e.stopPropagation(),
                      e.preventDefault(),
                      "none" ==
                      n(this)
                        .siblings(".nav-submenu")
                        .css("display"))
                  )
                    return (
                      r.showSubmenu(n(this).parent("li"), r.settings.effect),
                      O(),
                      !1
                    );
                  if (
                    (r.hideSubmenu(n(this).parent("li"), r.settings.effect),
                      "_blank" === n(this).attr("target") ||
                      "blank" === n(this).attr("target"))
                  )
                    i.open(n(this).attr("href"));
                  else {
                    if (
                      "#" === n(this).attr("href") ||
                      "" === n(this).attr("href") ||
                      "javascript:void(0)" === n(this).attr("href")
                    )
                      return !1;
                    i.location.href = n(this).attr("href");
                  }
                }
              })
            : n(t)
              .find(".nav-menu")
              .find("li")
              .on(f, function () {
                r.showSubmenu(this, r.settings.effect), O();
              })
              .on(c, function () {
                r.hideSubmenu(this, r.settings.effect);
              }),
          r.settings.hideSubWhenGoOut && b();
      },
      S = function () {
        w(),
          h(),
          r.settings.visibleSubmenusOnMobile
            ? n(t)
              .find(".nav-submenu")
              .show(0)
            : (n(t)
              .find(".submenu-indicator")
              .removeClass("submenu-indicator-up"),
              r.settings.submenuIndicator && r.settings.submenuIndicatorTrigger
                ? n(t)
                  .find(".submenu-indicator")
                  .on(l, function (i) {
                    return (
                      i.stopPropagation(),
                      i.preventDefault(),
                      r.hideSubmenu(
                        n(this)
                          .parent("a")
                          .parent("li")
                          .siblings("li"),
                        "slide"
                      ),
                      r.hideSubmenu(
                        n(this)
                          .closest(".nav-menu")
                          .siblings(".nav-menu")
                          .children("li"),
                        "slide"
                      ),
                      "none" ==
                        n(this)
                          .parent("a")
                          .siblings(".nav-submenu")
                          .css("display")
                        ? (n(this).addClass("submenu-indicator-up"),
                          n(this)
                            .parent("a")
                            .parent("li")
                            .siblings("li")
                            .find(".submenu-indicator")
                            .removeClass("submenu-indicator-up"),
                          n(this)
                            .closest(".nav-menu")
                            .siblings(".nav-menu")
                            .find(".submenu-indicator")
                            .removeClass("submenu-indicator-up"),
                          r.showSubmenu(
                            n(this)
                              .parent("a")
                              .parent("li"),
                            "slide"
                          ),
                          !1)
                        : (n(this)
                          .parent("a")
                          .parent("li")
                          .find(".submenu-indicator")
                          .removeClass("submenu-indicator-up"),
                          void r.hideSubmenu(
                            n(this)
                              .parent("a")
                              .parent("li"),
                            "slide"
                          ))
                    );
                  })
                : n(t)
                  .find(".nav-menu, .nav-dropdown")
                  .children("li")
                  .children("a")
                  .on(l, function (e) {
                    if (
                      (e.stopPropagation(),
                        e.preventDefault(),
                        r.hideSubmenu(
                          n(this)
                            .parent("li")
                            .siblings("li"),
                          r.settings.effect
                        ),
                        r.hideSubmenu(
                          n(this)
                            .closest(".nav-menu")
                            .siblings(".nav-menu")
                            .children("li"),
                          "slide"
                        ),
                        "none" ==
                        n(this)
                          .siblings(".nav-submenu")
                          .css("display"))
                    )
                      return (
                        n(this)
                          .children(".submenu-indicator")
                          .addClass("submenu-indicator-up"),
                        n(this)
                          .parent("li")
                          .siblings("li")
                          .find(".submenu-indicator")
                          .removeClass("submenu-indicator-up"),
                        n(this)
                          .closest(".nav-menu")
                          .siblings(".nav-menu")
                          .find(".submenu-indicator")
                          .removeClass("submenu-indicator-up"),
                        r.showSubmenu(n(this).parent("li"), "slide"),
                        !1
                      );
                    if (
                      (n(this)
                        .parent("li")
                        .find(".submenu-indicator")
                        .removeClass("submenu-indicator-up"),
                        r.hideSubmenu(n(this).parent("li"), "slide"),
                        "_blank" === n(this).attr("target") ||
                        "blank" === n(this).attr("target"))
                    )
                      i.open(n(this).attr("href"));
                    else {
                      if (
                        "#" === n(this).attr("href") ||
                        "" === n(this).attr("href") ||
                        "javascript:void(0)" === n(this).attr("href")
                      )
                        return !1;
                      i.location.href = n(this).attr("href");
                    }
                  }));
      };
    (r.callback = function (n) {
      s[n] !== a && s[n].call(t);
    }),
      r.init();
  }),
    (n.fn.navigation = function (i) {
      return this.each(function () {
        if (a === n(this).data("navigation")) {
          var e = new n.navigation(this, i);
          n(this).data("navigation", e);
        }
      });
    });
})(jQuery, window, document);



(function ($) {
  'use strict';

  var $window = $(window);

  if ($.fn.navigation) {
    $("#navigation1").navigation();
    $("#always-hidden-nav").navigation({
      hidden: true
    });
  }

  $window.on('load', function () {
    $('#preloader').fadeOut('slow', function () {
      $(this).remove();
    });
  });

  $("showAllColors").on('click', function () {
    $("AllColors").addClass("d-block")
  });


})(jQuery);


//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function () {
  if (animating) return false;
  animating = true;

  current_fs = $(this).parent();
  next_fs = $(this).parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({ opacity: 0 }, {
    step: function (now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50) + "%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale(' + scale + ')',
        'position': 'absolute'
      });
      next_fs.css({ 'left': left, 'opacity': opacity });
    },
    duration: 800,
    complete: function () {
      current_fs.hide();
      animating = false;
    },
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });

});

$(".previous").click(function () {
  if (animating) return false;
  animating = true;

  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();

  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

  //show the previous fieldset
  previous_fs.show();
  //hide the current fieldset with style
  current_fs.animate({ opacity: 0 }, {
    step: function (now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1 - now) * 50) + "%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({ 'left': left });
      previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
    },
    duration: 800,
    complete: function () {
      current_fs.hide();
      animating = false;
    },
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".submit").click(function () {
  return false;
})

// the selector will match all input controls of type :checkbox
// and attach a click event handler
// $("input:checkbox").on('click', function () {
//   // in the handler, 'this' refers to the box clicked on
//   var $box = $(this);
//   if ($box.is(":checked")) {
//     // the name of the box is retrieved using the .attr() method
//     // as it is assumed and expected to be immutable
//     var group = "input:checkbox[name='" + $box.attr("name") + "']";
//     // the checked state of the group/box on the other hand will change
//     // and the current value is retrieved using .prop() method
//     $(group).prop("checked", false);
//     $box.prop("checked", true);
//   } else {
//     $box.prop("checked", false);
//   }
// });


