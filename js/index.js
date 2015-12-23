(function ($) {
Drupal.behaviors.ngarang = {
  attach: function (context, settings) {
    if ($('input[type="text"]').length) {
      $('input[type="text"]', context).each(function() {
        if ($(this).closest('form').width() <= $(this).outerWidth()) {
          $(this).css({
            width: '100%'
          })
        }
      });
    }
  }
};
})(jQuery);
