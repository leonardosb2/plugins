<?php  
function wpse_register_post_types() {
$args = array(
    'public' => true,
    'label'  => 'Testimonials',
    'menu_icon'           => 'dashicons-testimonial',
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
);
register_post_type( 'testimonial', $args );
}
    
add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
function woo_custom_product_tabs( $tabs ) {

    // 2 Adding new tabs and set the right order

    //Attribute Description tab
    $tabs['attrib_artwork'] = array(
        'title'     => __( 'artwork', 'woocommerce' ),
        'priority'  => 10,
        'callback'  => 'artwork_tab_content'
    );
    // Adds the qty pricing  tab
    $tabs['turnaround_tab'] = array(
        'title'     => __( 'turnaround', 'woocommerce' ),
        'priority'  => 20,
        'callback'  => 'turnaround_tab_content'
    );
    return $tabs;

}

function artwork_tab_content( $slug, $tab ) {
    ?>
    <p>test 1=<?php  echo get_post_meta(get_the_ID(), 'artwork_field', true); ?></p>
    <?php
}
function turnaround_tab_content( $slug, $tab ) {
    ?>
    <p>test 2 =<?php  echo get_post_meta(get_the_ID(), 'artwork_field', true); ?></p>
    <?php
}

// The code for displaying WooCommerce Product Custom Fields
add_action( 'woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields' ); 
// Following code Saves  WooCommerce Product Custom Fields
add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save' );

function woocommerce_product_custom_fields () {
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => 'artwork_field',
            'placeholder' => 'Artwork',
            'label' => __('Artwork', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    //Custom Product Number Field
    woocommerce_wp_text_input(
        array(
            'id' => 'turnaround_field',
            'placeholder' => 'Turnaround',
            'label' => __('Turnaround ', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_textarea',
            'placeholder' => 'Custom Product Textarea',
            'label' => __('Custom Product Textarea', 'woocommerce')
        )
    );
    echo '</div>';
}


function woocommerce_product_custom_fields_save($post_id)
{
    // Custom Product Text Field
    $woocommerce_custom_product_text_field = $_POST['artwork_field'];
    if (!empty($woocommerce_custom_product_text_field))
        update_post_meta($post_id, 'artwork_field', esc_attr($woocommerce_custom_product_text_field));
// Custom Product Number Field
    $woocommerce_custom_product_number_field = $_POST['turnaround_field'];
    if (!empty($woocommerce_custom_product_number_field))
        update_post_meta($post_id, 'turnaround_field', esc_attr($woocommerce_custom_product_number_field));
// Custom Product Textarea Field
    $woocommerce_custom_procut_textarea = $_POST['_custom_product_textarea'];
    if (!empty($woocommerce_custom_procut_textarea))
        update_post_meta($post_id, '_custom_product_textarea', esc_html($woocommerce_custom_procut_textarea));
}
