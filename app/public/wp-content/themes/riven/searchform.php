<form role="search" method="get" id="searchform" class="searchform product-search" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" class="search-field" value="<?php echo esc_attr__('', 'riven' ); ?>" placeholder="<?php echo esc_attr__('Search...', 'riven' ); ?>" name="s" id="s" />
        <button type="submit" class="submit button search-btn"><i class="fa fa-search"></i></button>
    </div>
</form>