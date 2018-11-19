
/* TOGGLES
============================================================*/
(function( $ ) {
    "use strict";
     
    $(function() {
     
         $('.toggle-block .tab-head').each( function() {
            var toggle = $(this).parent();
            
            $(this).click(function() {

                var icon = toggle.find('.arrow i');

                toggle.find('.tab-body').slideToggle();

                icon.toggleClass(function() {
                    if (icon.is('.icon-plus')) {
                        return 'icon-minus';
                    } else {
                        return 'icon-plus';
                    }
                });

                $(this).toggleClass(function() {
                    if ($(this).is('.tab-head')) {
                        return 'active';
                    } else {
                        return '';
                    }
                });

                return false;

            });
            
        });

    });
 
}(jQuery));