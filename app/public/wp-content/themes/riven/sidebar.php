<?php
    $riven_sidebar_left = riven_get_sidebar_left();
    $riven_sidebar_right = riven_get_sidebar_right();

    ?>
<?php if ($riven_sidebar_left) : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 left-sidebar "><!-- main sidebar -->
        <?php dynamic_sidebar($riven_sidebar_left); ?>
    </div>
<?php endif; ?>
<?php if ($riven_sidebar_right) : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 right-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($riven_sidebar_right); ?>
    </div>
<?php endif; ?>





