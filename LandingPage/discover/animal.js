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
  