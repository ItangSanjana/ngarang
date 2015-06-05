(function ($) {

Drupal.behaviors.ngarang = {
    attach: function ( context, settings ) {

        $( '.grid:first-child', context ).each(function() {
            if ( $( this ).length ) {
                if ( !$( this ).parent().hasClass( 'clearfix' ) ) {
                    if ( !$(this).parent().hasClass( 'grid' ) ) {
                        $( this ).parent().addClass( 'clearfix' );
                    }
                }
            }
        });

    }
};

})(jQuery);
