<?php

// Register Custom Post Type
function custom_post_type_photos() {

    $labels = array(
        'name'                => _x( 'Photos', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'Photo', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'Photos', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Parent Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Items', 'estrellas_orientales' ),
        'view_item'           => __( 'View Item', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Item', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Item', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Item', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Item', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'Photo', 'estrellas_orientales' ),
        'description'         => __( 'Photos CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title','thumbnail' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-camera',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'foto', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_photos', 0 );

function custom_post_type_videos() {

    $labels = array(
        'name'                => _x( 'Videos', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'Video', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'Videos', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Parent Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Items', 'estrellas_orientales' ),
        'view_item'           => __( 'View Item', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Item', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Item', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Item', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Item', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'Video', 'estrellas_orientales' ),
        'description'         => __( 'Videos CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title','thumbnail' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-video-alt',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'video', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_videos', 0 );

function custom_post_type_players() {

    $labels = array(
        'name'                => _x( 'Players', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'Player', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'Players', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Parent Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Items', 'estrellas_orientales' ),
        'view_item'           => __( 'View Item', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Item', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Item', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Item', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Item', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'Player', 'estrellas_orientales' ),
        'description'         => __( 'Players CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title','thumbnail' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'jugador', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_players', 0);

function custom_post_type_teams() {

    $labels = array(
        'name'                => _x( 'Teams', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'Teams', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Parent Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Items', 'estrellas_orientales' ),
        'view_item'           => __( 'View Item', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Item', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Item', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Item', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Item', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'Team', 'estrellas_orientales' ),
        'description'         => __( 'Teams CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title','thumbnail' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-flag',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'equipo', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_teams', 0);

function custom_post_type_games() {

    $labels = array(
        'name'                => _x( 'Games', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'Game', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'Games', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Parent Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Items', 'estrellas_orientales' ),
        'view_item'           => __( 'View Item', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Item', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Item', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Item', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Item', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'Game', 'estrellas_orientales' ),
        'description'         => __( 'Games CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title','thumbnail' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-tickets',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'partido', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_games', 0);

function custom_post_type_tables() {

    $labels = array(
        'name'                => _x( 'League Tables', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'League Table', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'League Tables', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Parent Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Items', 'estrellas_orientales' ),
        'view_item'           => __( 'View Item', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Item', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Item', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Item', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Item', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'League Table', 'estrellas_orientales' ),
        'description'         => __( 'League Tables CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title','thumbnail' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-editor-ol',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'tabla-de-posiciones', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_tables', 0);


// Roaster

function custom_post_type_roster() {

    $labels = array(
        'name'                => _x( 'Roster', 'Post Type General Name', 'estrellas_orientales' ),
        'singular_name'       => _x( 'Roster', 'Post Type Singular Name', 'estrellas_orientales' ),
        'menu_name'           => __( 'Rosters', 'estrellas_orientales' ),
        'parent_item_colon'   => __( 'Roster Item:', 'estrellas_orientales' ),
        'all_items'           => __( 'All Rosters', 'estrellas_orientales' ),
        'view_item'           => __( 'View Roster', 'estrellas_orientales' ),
        'add_new_item'        => __( 'Add New Roster', 'estrellas_orientales' ),
        'add_new'             => __( 'Add New', 'estrellas_orientales' ),
        'edit_item'           => __( 'Edit Roster', 'estrellas_orientales' ),
        'update_item'         => __( 'Update Roster', 'estrellas_orientales' ),
        'search_items'        => __( 'Search Roster', 'estrellas_orientales' ),
        'not_found'           => __( 'Not found', 'estrellas_orientales' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'estrellas_orientales' ),
    );
    $args = array(
        'label'               => __( 'Roster', 'estrellas_orientales' ),
        'description'         => __( 'Rosters CPT', 'estrellas_orientales' ),
        'labels'              => $labels,
        'supports'            => array('title'),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-calendar-alt',
        'can_export'          => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'roster-semanal', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_roster', 0);



