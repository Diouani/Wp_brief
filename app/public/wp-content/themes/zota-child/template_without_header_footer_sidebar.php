/**
 * Template Name: Template without Header / Footer / Sidebar
 * Template will display only the contents you had entered in the page editor
 */
?>
 
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>
<?php
    while ( have_posts() ) : the_post();   
        the_content();
    endwhile;
?>
<?php wp_footer(); ?>
</body>
</html>