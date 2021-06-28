<?php
$riven_settings = riven_check_theme_options();
?>
<div id="footer" class="footer-v5">
        <?php
        $cols = 0;
        for ($i = 1; $i <= 4; $i++) {
            if (is_active_sidebar('footer-bussiness-' . $i))
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
                    $col_class[1] = 'col-xs-12 col-sm-6 col-md-2 footer-col';
                    $col_class[2] = 'col-xs-12 col-sm-6 col-md-4 footer-col';
                    $col_class[3] = 'col-xs-12 col-sm-6 col-md-3 footer-col';
                    $col_class[4] = 'col-xs-12 col-sm-6 col-md-3 footer-col';
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
                                if (is_active_sidebar('footer-bussiness-' . $i)) {
                                    ?>
                                    <div class="<?php echo esc_attr($col_class[$cols++]) ?>">
                                        <?php dynamic_sidebar('footer-bussiness-' . $i); ?>
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
					<div class="col-md-6 col-sm-6 col-xs-12 text-left">
						<div class="copyright">
							<address>             
								<?php 
                                    echo wp_kses($riven_settings['footer-copyright'],array(
                                        'a' => array(
                                            'href' => array(),
                                            'title' => array(),
                                            'target' => array()
                                        )
                                    ));
                                ?> 
							</address>
						</div>    
					</div>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right hidden-xs">
                        <div class="footer-social">
                            <ul>
                                <?php if (!empty($riven_settings['social-facebook'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-facebook']) ?>" data-toggle="tooltip" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($riven_settings['social-google'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-google']) ?>" data-toggle="tooltip" title="google"><i class="fa fa-google-plus"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($riven_settings['social-twitter'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-twitter']) ?>" data-toggle="tooltip" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($riven_settings['social-youtube'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-youtube']) ?>" data-toggle="tooltip" title="youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($riven_settings['social-linkedin'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-linkedin']) ?>" data-toggle="tooltip" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($riven_settings['social-pinterest'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-pinterest']) ?>" data-toggle="tooltip" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($riven_settings['social-instagram'])): ?>
                                    <li><a href="<?php echo esc_url($riven_settings['social-instagram']) ?>" data-toggle="tooltip" title="instagram"><i class="fa fa-instagram"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
				</div>    
			</div>    
        </div>    
        <?php endif; ?>
</div>		
