<?php  
    function adding_new_scripts()
    {
    
        wp_enqueue_style('customCssASF', get_stylesheet_directory_uri() . '/css/customCssASF.css', array('su-content-shortcodes','su-box-shortcodes'), '0.1.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'adding_new_scripts', PHP_INT_MAX);

?>
