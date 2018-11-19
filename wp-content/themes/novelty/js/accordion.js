
/* ACCORDION
============================================================*/
(function($) {
    "use strict";
 
    $(function() {
 
        $('.accordion-wrapper .tab-head + .arrow i').addClass('icon-plus');
        $('.accordion-wrapper .tab-head.active + .arrow i').removeClass('icon-plus').addClass('icon-minus');
        
        $(document).on('click', '.accordion-wrapper .tab-head', function() {
            var $clicked = $(this);

            $clicked.parents('.accordion-wrapper').find('.tab-head').removeClass('active')
            $clicked.addClass('clicked active');

            $('.accordion-wrapper .tab-head:not(clicked) + .arrow i').removeClass('icon-minus').addClass('icon-plus');
            $('.accordion-wrapper .tab-head.clicked + .arrow i').removeClass('icon-plus').addClass('icon-minus');

            $clicked.parents('.accordion-wrapper').find('.tab-body').each(function(i, el) {
                if($(el).is(':visible') && ( $(el).prev().hasClass('clicked') || $(el).prev().prev().hasClass('clicked') ) == false ) {
                    $(el).slideUp();
                    
                }
            });
            
            $clicked.parent().children('.tab-body').slideToggle();
            
            $clicked.removeClass('clicked');
            
            return false;
        });
        
 
    });
 
}(jQuery));