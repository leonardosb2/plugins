<?php
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
//End register page option
function arphabet_widgets_init() {
    register_sidebar( array(
        'name'=>'Footer 1 Left',
        'id'=>'footer1l',
        'before_title'=>'<h3 class="widget-title">',
        'after_title'=>'</h3>',
    ) );
    register_sidebar( array(
        'name'=>'Footer 2 Left',
        'id'=>'footer2l',
        'before_title'=>'<h3 class="widget-title">',
        'after_title'=>'</h3>',
    ) );
    register_sidebar( array(
        'name'=>'Footer 1 Right',
        'id'=>'footer1r',
        'before_title'=>'<h3 class="widget-title">',
        'after_title'=>'</h3>',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	    'after_widget'  => '</li>',
    ) );
    register_sidebar( array(
        'name'=>'Footer 2 Right',
        'id'=>'footer2r',
        'before_title'=>'<h3 class="widget-title">',
        'after_title'=>'</h3>',
    ) );
    register_sidebar( array(
        'name'=>'Sidebar',
        'id'=>'sidebar_news',
        'before_title'=>'<h3 class="widget-title">',
        'after_title'=>'</h3>',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
//unregister
function remove_some_widgets(){
	// Unregister some of the TwentyTen sidebars
	unregister_sidebar( 'left-sidebar' );
	unregister_sidebar( 'right-sidebar' );
	unregister_sidebar( 'statichero' );
	unregister_sidebar( 'herocanvas' );
	unregister_sidebar( 'hero' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );