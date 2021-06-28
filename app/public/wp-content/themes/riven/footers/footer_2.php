<?php
$riven_settings = riven_check_theme_options();
?>
<div id="footer" class="footer-v2">
    <?php if ($riven_settings['show-top-footer'] && is_active_sidebar('top-footer')) : ?>
        <div class="top-footer"> 
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">              
                            <?php dynamic_sidebar('top-footer'); ?> 
                    </div> 
                </div>
            </div>   
        </div>    
    <?php endif; ?>
    <?php if ($riven_settings['footer-copyright']) : ?>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
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
                </div>
            </div>
        </div>    
    <?php endif; ?>
</div>      
