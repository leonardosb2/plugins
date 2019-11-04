<?php
/**
 * Signs in Bulk
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
	wp_enqueue_style( 'fonts-poppins',  "https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i,800&display=swap" );
	wp_enqueue_style( 'fonts-Raleway',  "https://fonts.googleapis.com/css?family=Raleway:300,400,600,700&display=swap");

	wp_enqueue_style( 'slick-css',  get_stylesheet_directory_uri().'/js/slick/slick.css' );
	wp_enqueue_style( 'awesome3',  get_stylesheet_directory_uri().'/fonts/all.css' );
	wp_enqueue_style( 'custom',  get_stylesheet_directory_uri().'/css/custom.css' );


	wp_enqueue_script('slick-js',get_stylesheet_directory_uri().'/js/slick/slick.min.js');
	wp_enqueue_script('custom-js',get_stylesheet_directory_uri().'/js/custom.js');
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );
include_once( get_stylesheet_directory() . '/lib/shortcodes.php' );
include_once( get_stylesheet_directory() . '/lib/hooks.php' );
include_once( get_stylesheet_directory() . '/lib/custom-fields.php' );
include_once( get_stylesheet_directory() . '/lib/register.php' );

function woocommerce_quantity_input_select( $args = array(), $product = null, $echo = true ) {
  
   if ( is_null( $product ) ) {
      $product = $GLOBALS['product'];
   }
 
   $defaults = array(
      'input_id' => uniqid( 'quantity_' ),
      'input_name' => 'quantity',
      'input_value' => '1',
      'classes' => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
      'max_value' => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
      'min_value' => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
      'step' => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
      'pattern' => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
      'inputmode' => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
      'product_name' => $product ? $product->get_title() : '',
   );
 
   $args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );
  
   // Apply sanity to min/max args - min cannot be lower than 0.
   $args['min_value'] = max( $args['min_value'], 0 );
   // Note: change 20 to whatever you like
   $args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : 20;
 
   // Max cannot be lower than min if defined.
   if ( '' !== $args['max_value'] && $args['max_value'] < $args['min_value'] ) {
      $args['max_value'] = $args['min_value'];
   }
  
   $options = '';
    
   for ( $count = $args['min_value']; $count <= $args['max_value']; $count = $count + $args['step'] ) {
 
      // Cart item quantity defined?
      if ( '' !== $args['input_value'] && $args['input_value'] >= 1 && $count == $args['input_value'] ) {
        $selected = 'selected';      
      } else $selected = '';
 
      $options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
 
   }
     
   $string = '<div class="quantity"><span>Qty</span><select name="' . $args['input_name'] . '">' . $options . '</select></div>';
 
   if ( $echo ) {
      echo $string;
   } else {
      return $string;
   }
  
}