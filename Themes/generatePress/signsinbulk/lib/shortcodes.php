<?php  
add_shortcode( 'list_socials', 'socials_links' );
function socials_links() {
    $twitter_url= get_theme_mod('twitter_url') ? get_theme_mod('twitter_url') : '';
    $link_face= get_theme_mod('facebook_url') ? get_theme_mod('facebook_url') : '';
    $instagram_url= get_theme_mod('instagram_url') ? get_theme_mod('instagram_url') : '';
    ?> 

    <?php
    return '
    <ul class="socials">
        <li>
            <a href="'.$twitter_url.'" target="blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="'.$link_face.'"><i class="fa fa-facebook"></i></a>
        </li>
        <li>
            <a href="'.$instagram_url.'"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </li>
    </ul>
    
            ';
}
//shortcode testimonials
add_shortcode('slider_testimonials', 'function_slider' );
function function_slider(){
    $arg= array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1
    );
    $testimonials = new WP_Query($arg);
    ?> 
    
    <div class="slider-testimonials">
    <?php
    if ($testimonials->have_posts()) {
        while ( $testimonials->have_posts() ) {
            $testimonials->the_post(); 
            ?> 

                <div class="testimoner">
                    <div class="content-testimonial">
                        <?php  the_content(); ?>
                        <ul>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                    <h3><?php  the_title(); ?></h3>
                </div>
            <?php
        } wp_reset_query(); 
    }
    ?> 
     </div>
    <?php
}

