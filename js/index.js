(function ($) {

Drupal.behaviors.ngarang = {
    attach: function (context, settings) {
        $('.grid:first-child').each(function () {
            if ($(this).length) {
                if (!$(this).parent().hasClass('clearfix') || !$(this).parent().hasClass('grid')) {
                    $(this).parent().addClass('clearfix');
                }
            }
        });
    }
};

})(jQuery);
