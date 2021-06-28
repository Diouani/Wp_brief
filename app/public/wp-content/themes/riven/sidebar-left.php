<?php
    $riven_sidebar_left = riven_get_sidebar_left();
?>
<?php if ($riven_sidebar_left && $riven_sidebar_left != "none") : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 left-sidebar active-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($riven_sidebar_left); ?>
    </div>
<?php endif; ?>


