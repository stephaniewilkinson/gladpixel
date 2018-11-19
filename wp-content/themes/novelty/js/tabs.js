
/* TABS
============================================================*/
(function( $ ) {
    "use strict";

    $(function() {

        if(jQuery().tabs) {
            $(".tab-block").tabs({ 
                show: true 
            });
        }


        $('.tab-widget .tab-header').each(function() {
            $(this).find('li').each(function(i) {
              $(this).click(function(){
                $(this).addClass('active').siblings().removeClass('active')
                  .parents('.tab-widget').find('.tab-context').slideUp(500).delay(500).end()
                  .find('.tab-context:eq('+i+')').slideDown(1000);
              });
            });
        });

    });

}(jQuery));