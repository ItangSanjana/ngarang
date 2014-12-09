(function ($) {

Drupal.behaviors.ngarang = {
    attach: function (context, settings) {
        $('.grid:first-child').each(function () {
            if ($(this).length && !$(this).parent().hasClass('grid') && !$(this).parent().hasClass('clearfix')) {
                $(this).parent().addClass('clearfix');
            }
        });
    }
};

})(jQuery);
