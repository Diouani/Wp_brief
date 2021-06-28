<div class="blog-search clearfix">
  <form role="search" method="get" id="searchform" class="search-form searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
     <input type="text" class="form-control input-box" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo __( 'Search...', 'bookpress' ); ?>">
     <input class="search-submit btn standard-button" value="Search" type="submit">
  </form>
</div>