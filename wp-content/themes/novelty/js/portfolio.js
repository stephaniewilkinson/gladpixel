
/* PORTFOLIO
============================================================*/
(function($) {
    "use strict";

    $(function() {
     
        var $container = $('#portfolio');

        if ($container.length) {

            var $itemsFilter = $('#filtrable'),
                mouseOver;

            $('article', $container).each(function(i){
                var $this = $(this);
                $this.addClass($this.attr('data-categories'));
            });

            $(window).on('load', function(){
                $container.isotope({
                    itemSelector : 'article',
                    layoutMode   : 'fitRows'
                });
            });

            // Filter projects
            $itemsFilter.on('click', 'a', function(e) {
                var $this         = $(this),
                    currentOption = $this.attr('data-categories');

                $itemsFilter.find('a').removeClass('active');
                $this.addClass('active');

                if (currentOption) {
                    if (currentOption !== '*') currentOption = currentOption.replace(currentOption, '.' + currentOption)
                    $container.isotope({filter : currentOption});
                }

                e.preventDefault();
            });

            $itemsFilter.find('a').first().addClass('active');
        }

    });
 
}(jQuery));