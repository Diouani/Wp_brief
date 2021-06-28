
<?php 
$riven_settings = riven_check_theme_options();
$riven_layout = riven_get_layout();
$footer_type = riven_get_footer_type();
?> 
            <?php get_sidebar('right'); ?>    
        <?php if($riven_layout == 'fullwidth') :?>     
            </div>
        </div> 
        <?php endif;?>
        <?php if(is_single() || !is_page()) :?>
            <?php if (is_post_type_archive('portfolio') || is_singular('portfolio')) :?>
                <?php
                if(isset($riven_settings['portfolio-banner']) && $riven_settings['portfolio-banner'] !=''){
                $banner_block = $riven_settings['portfolio-banner'];
                echo apply_filters('the_content', get_post_field('post_content', $banner_block));
                }
                ?>
            <?php else :?>
                <?php
                if(isset($riven_settings['post-banner']) && $riven_settings['post-banner'] !=''){
                $banner_block = $riven_settings['post-banner'];
                echo apply_filters('the_content', get_post_field('post_content', $banner_block));
                }
                ?>
            <?php endif;?>    
        <?php endif;?>      
</div> <!--Main-->      
<?php if (riven_get_meta_value('show_footer', true)) : ?>    
<footer id="colophon" class="footer">
    <?php get_template_part('footers/footer_' . $footer_type); ?>
</footer><!-- #colophon -->
<?php endif;?>
</div><!--page-->
<?php if (isset($riven_settings['js-code'])): ?>
    <script type="text/javascript">
        <?php echo $riven_settings['js-code']; ?>
    </script>
<?php endif; ?>
<?php wp_footer(); ?>
<!-- Google Code for Remarketing Tag -->
<!--
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
-->
<script type="text/javascript">
var google_tag_params = {
dynx_itemid: 'REPLACE_WITH_VALUE',
dynx_itemid2: 'REPLACE_WITH_VALUE',
dynx_pagetype: 'REPLACE_WITH_VALUE',
dynx_totalvalue: 'REPLACE_WITH_VALUE',
};
</script>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1004719363;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
var google_conversion_format = 3;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1004719363/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>