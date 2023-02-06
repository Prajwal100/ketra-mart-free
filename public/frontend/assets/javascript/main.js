$(document).ready(function () {
  // Custom Active Class
  $("ul li").on("click", function () {
    $(this).parent().find("li").removeClass("active");
    console.log("clicked");
    $(this).addClass("active");
  });

  $("#ShowReviewItem").on("click", function () {
    $(".others-item").css({
      opacity: "1",
      visibility: "visible",
      height: "auto",
    });
  });

});
