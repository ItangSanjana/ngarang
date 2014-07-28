(function ($) {

Drupal.behaviors.ngarang = {
  attach:function(context, settings) {
    $("input", context).once("ngarang", function() {
      if ($(this).attr("size") > 20) {
        $(this).attr("size", 20);
      }
    });
  }
}

})(jQuery);
