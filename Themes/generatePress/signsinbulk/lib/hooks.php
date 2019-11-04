<?php  


add_action( 'generate_before_header','example_function_name' );  
function example_function_name() { ?> 
<section class="header-top">
    <div class="wrap">
        <div class="flex no-wrap">
            <a href="tel:1.866.60.SIGNS">Call Us: 1.866.60.SIGNS</a>
            <a href="">Free Standard Shipping $50+</a>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="my-acount"> My Acount</a>
        </div>
    </div>
</section>
        

<?php 
}
    // disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);



//Footer
add_action( 'generate_footer', 'custom_footer' );
function custom_footer() {
    ?> 
    
    <section class="footer-cr">
        <div class="wrap">
            <div class="flex">
                <span>Created by UpSale Group</span>
                <a class="go-top">Back Top</a>
            </div>
        </div>
    </section>
    
    <?php   
}
add_action( 'after_setup_theme','tu_remove_footer' );
function tu_remove_footer() {
    remove_action( 'generate_footer','generate_construct_footer' );
}
//WOOCOMMERCE
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//remove 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//reposition  
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 13 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 60 );

add_action( 'woocommerce_single_product_summary', 'open_tag', 4 );
add_action( 'woocommerce_single_product_summary', 'close_tag', 10);

function open_tag(){
?>   <div class="headeer-product"><?php
}
function close_tag(){
    ?> </div>  <?php
}
add_action( 'woocommerce_single_product_summary', 'custom_atributes', 20 );
function custom_atributes(){
    ?> 
        <div class="list-atributes">
            <ul>
                <li>Next-day Production</li>
                <li>Overnight Shipping</li>
                <li>High Resolution</li>
                <li>Full Color</li>
                <li>16pt. Card Stock </li>
                <li>Semi-gloss or Ultra-gloss</li>
                <li>One-sided or Two-sided</li>
            </ul>
        </div>
    <?php
}
add_action( 'woocommerce_single_product_summary', 'quantity_discounts', 21);
function quantity_discounts(){
    ?> 
        <div class="contet-table-discount">
            <h3>Quantity Discounts</h3>
            <table>
                <tr>
                    <th style="width: 100px;">Qty</th>
                    <th>1+</th>
                    <th>5+</th>
                    <th>10+</th>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>1+ $15.99</td>
                    <td>$11.99</td>
                    <td>$10.23</td>
                </tr>
                <tr>
                    <td>Turnaround</td>
                    <td>1 day</td>
                    <td>1 day</td>
                    <td>1 day</td>
                </tr>
            </table>
        </div>
    <?php
}

add_action( 'woocommerce_after_shop_loop_item', 'new_btn_add_to_cart', 10 );
function new_btn_add_to_cart(){
    ?> 
        <div class="btn wc-cta-c">
            <?php   woocommerce_template_loop_add_to_cart(); ?>
        </div> 
    <?php
   
}



add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'show_excerpt', 20 );
function show_excerpt(){
    $excerpt = explode(' ', get_the_excerpt(), 8);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).".";
    ?> 
        <p class="custom-des-product">
            <?php   echo $excerpt; ?>
        </p>
    <?php
   
}
add_action( 'generate_after_header','woocomerce_breadcrumb_custom' );  
function woocomerce_breadcrumb_custom() {
    ?> 
        <section class="section-breadcrumb">
           <div class="grid-container">
               <div class="site-content">
               <?php
                woocommerce_breadcrumb();             
                ?>
               </div>
            </div>
        </section>
    <?php
}
add_action('woocommerce_after_single_product_summary','shortcode_form_entry',11);
add_action('generate_before_footer','shortcode_form');
function shortcode_form(){    
    if (is_shop()) {
        ?> 
        <section class="section-form">
            <div class="wrap">
                    <h2 style="text-align: center;">Do you want to get updates &amp; discounts?</h2>
                    <p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <?php  
                        echo do_shortcode('[contact-form-7 id="121" title="Contact form 1"]' );
                    ?>
            </div>
        </section>
        <?php
    }

}
function shortcode_form_entry(){
        ?> 
        <section class="section-form">
            <div class="wrap">
                    <h2 style="text-align: center;">Do you want to get updates &amp; discounts?</h2>
                    <p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <?php  
                        echo do_shortcode('[contact-form-7 id="121" title="Contact form 1"]' );
                    ?>
            </div>
        </section>
        <?php
}






