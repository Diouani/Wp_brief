<?php
$riven_settings = riven_check_theme_options();
$header_type = riven_get_header_type();
$breadcrumbs = riven_get_meta_value('breadcrumbs', true);
$page_title = riven_get_meta_value('page_title', true);

if (( is_front_page() && is_home()) || is_front_page() ) {
    $breadcrumbs = false;
    $page_title = false;
}
?>
<?php if ($breadcrumbs || $page_title) : ?>
<div class="<?php if($header_type != 5){echo 'bg-gradient';} ?> side-breadcrumb text-center <?php if($header_type == 3){echo 'breadcrumb_3';} ?> <?php if($header_type == 5){echo 'breadcrumb_5';}?>">
    <div class="<?php if($header_type != 5){echo 'container-fluid';}else{echo 'container';} ?>">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">  
                <?php if($page_title) :?>
                    <div class="page-title"><h1><?php riven_page_title(); ?></h1></div>
                <?php endif;?>
                <?php if ($breadcrumbs) : ?>
                    <?php riven_breadcrumbs(); ?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>