(function ($) {

Drupal.behaviors.ngarang = {
    attach: function ( context, settings ) {

        $( '.grid:first-child', context ).each( function() {
            if ( $( this ).length ) {
                if ( !$( this ).parent().hasClass( 'clearfix' ) ) {
                    if ( !$(this).parent().hasClass( 'grid' ) ) {
                        $( this ).parent().addClass( 'clearfix' );
                    }
                }
            }
        });

        if ( $( 'input[type="text"]' ).length ) {
            $( 'input[type="text"]', context ).each( function() {
                if ( $( this ).closest( 'form' ).width() <= $( this ).outerWidth() ) {
                    $( this ).css({
                        width: '100%'
                    })
                }
            });
        }

    }
};

})(jQuery);
