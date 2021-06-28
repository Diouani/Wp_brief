<?php

add_action('redux/options/riven_settings/saved', 'riven_save_theme_settings', 10, 2);
add_action('redux/options/riven_settings/import', 'riven_save_theme_settings', 10, 2);
add_action('redux/options/riven_settings/reset', 'riven_save_theme_settings');
add_action('redux/options/riven_settings/section/reset', 'riven_save_theme_settings');

function riven_config_value($value) {
    return isset($value) ? $value : 0;
}

//complie scss
function riven_save_theme_settings() {
    global $riven_settings;
    update_option('riven_init_theme', '1');
    if (!$riven_settings['compile-css'])
    return;
    global $rivenReduxSettings;

    $reduxFramework = $rivenReduxSettings->ReduxFramework;
    $template_dir = get_template_directory();

    // Compile SCSS Files
    if (!class_exists('scssc')) {
        require_once( riven_admin . '/sassphp/scss.inc.php' );
    }

    // config skin file
    ob_start();
    include riven_admin . '/sassphp/config_skin_scss.php';
    $_config_css = ob_get_clean();

    $filename = $template_dir . '/scss/config/_config_skin.scss';
    if(file_exists($template_dir.'/scss')) {
        @chmod($template_dir.'/scss', 0755);
    } else {
        mkdir($template_dir.'/scss', 0755);
    }
    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

    // skin color css
    ob_start();

    $scss = new scssc();
    $scss->setImportPaths($template_dir . '/scss');
    $scss->setFormatter('scss_formatter');
    echo $scss->compile('@import "skin.scss"');

    if (isset($riven_settings['custom-css-code']))
        echo $riven_settings['custom-css-code'];

    $_config_css = ob_get_clean();

    $filename = $template_dir . '/css/config/skin.css';

    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

    // skin theme css
    ob_start();

    $scss = new scssc();
    $scss->setImportPaths($template_dir . '/scss');
    $scss->setFormatter('scss_formatter');
    echo $scss->compile('@import "skin-theme.scss"');

    if (isset($riven_settings['custom-css-code']))
        echo $riven_settings['custom-css-code'];

    $_config_css = ob_get_clean();

    $filename = $template_dir . '/css/config/skin-theme.css';

    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
    
    // config theme file
    ob_start();
    include riven_admin . '/sassphp/config_theme_scss.php';
    $_config_css = ob_get_clean();

    $filename = $template_dir . '/scss/_config_theme.scss';

    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

    // theme css
    ob_start();

    $scss = new scssc();
    $scss->setImportPaths($template_dir . '/scss');
    $scss->setFormatter('scss_formatter');
    echo $scss->compile('@import "theme.scss"');

    $_config_css = ob_get_clean();

    $filename = $template_dir . '/css/theme.css';

    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
    
    // plugin css
    ob_start();

    $scss = new scssc();
    $scss->setImportPaths($template_dir . '/scss');
    $scss->setFormatter('scss_formatter');
    echo $scss->compile('@import "plugins.scss"');

    $_config_css = ob_get_clean();

    $filename = $template_dir . '/css/plugins.css';

    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
    // Reponsive css
    ob_start();

    $scss = new scssc();
    $scss->setImportPaths($template_dir . '/scss');
    $scss->setFormatter('scss_formatter');
    echo $scss->compile('@import "responsive.scss"');

    $_config_css = ob_get_clean();

    $filename = $template_dir . '/css/responsive.css';

    if (is_writable($filename) == false) {
        @chmod($filename, 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
}
