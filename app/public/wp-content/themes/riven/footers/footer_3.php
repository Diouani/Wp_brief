<?php
$riven_settings = riven_check_theme_options();
?>
<div id="footer" class="footer-v3">
        <?php
        $cols = 0;
        for ($i = 1; $i <= 4; $i++) {
            if (is_active_sidebar('footer-column-' . $i))
                $cols++;
        }
        ?>
        <?php
        if ($cols) :
            $col_class = array();
            switch ($cols) {
                case 1:
                    $col_class[1] = 'col-sm-12 text-center';
                    break;
                case 2:
                    $col_class[1] = 'col-sm-6 col-md-6 col-xs-12';
                    $col_class[2] = 'col-sm-6 col-md-6 col-xs-12';
                    break;
                case 3:
                    $col_class[1] = 'col-xs-12 col-sm-4 col-md-4';
                    $col_class[2] = 'col-xs-12 col-sm-4 col-md-4';
                    $col_class[3] = 'col-xs-12 col-sm-4 col-md-4';
                    break;
                case 4:
                    $col_class[1] = 'col-xs-12 col-sm-6 col-md-3';
                    $col_class[2] = 'col-xs-12 col-sm-6 col-md-3';
                    $col_class[3] = 'col-xs-12 col-sm-6 col-md-3';
                    $col_class[4] = 'col-xs-12 col-sm-6 col-md-3';
                    break;
            }
            ?>
            <div class="footer-office">
                <div class="footer-office-content">
                    <div class="container">
                        <div class="row">
                            <?php
                            $cols = 1;
                            for ($i = 1; $i <= 4; $i++) {
                                if (is_active_sidebar('footer-column-' . $i)) {
                                    ?>
                                    <div class="<?php echo esc_attr($col_class[$cols++]) ?>">
                                        <?php dynamic_sidebar('footer-column-' . $i); ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>    							
            </div>
        <?php endif; ?>
        <?php if ($riven_settings['footer-copyright']) : ?>
        <div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 text-left">
						<div class="copyright">
							<address>             
								<?php 
                                    echo wp_kses($riven_settings['footer-copyright'],array(
                                        'a' => array(
                                            'href' => array(),
                                            'title' => array(),
                                            'target' => array()
                                        ),
                                        'div' => array(
                                            'class' => array(),
                                        ),
                                    ));
                                ?> 
							</address>
						</div>    
					</div>
				</div>    
			</div>    
        </div>    
        <?php endif; ?>
</div>		
