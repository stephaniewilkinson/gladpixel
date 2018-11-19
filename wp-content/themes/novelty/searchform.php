<form role="search" method="get" id="search" action="<?php echo home_url( '/' ); ?>">
    <fieldset>
        <input type="text" name="s" placeholder="<?php echo __('Search...', 'bmd') ?>" value="<?php the_search_query(); ?>" />
    </fieldset>
</form>
