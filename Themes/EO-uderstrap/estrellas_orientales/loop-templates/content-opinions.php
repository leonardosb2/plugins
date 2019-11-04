<?php
/**
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$banner_top = get_field('banner_top','option');
$banner_adsense_middle = get_field('banner_adsense_middle','option');

$size = 'full'; // (thumbnail, medium, large, full or custom size)

?>
<div class="breadcrumb">
    <div class="container">
        <?php get_breadcrumb(); ?>
    </div>
</div> 

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-9">
            <?php  $banner_top=get_field('banner_top','option'); 
            $banner_top_page = get_field('banner_top_page'); ?>
            <section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?>">  
                <div class="banner-content">
                        <?php echo get_field('banner_top_page'); ?>
                </div>
            </section>
            <?php  
                if (is_page('opiniones')) {
                    $args = array(
                        'post_type' => 'post',
                        'category__in' => 24,
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 6,
                    );
                }else{
                    $args = array(
                        'post_type' => 'post',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 6,
                    );
                }
                
                $post_query = new WP_Query($args);
                   
            ?>
            <div class="line-separator position-relative separator-small">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/footerimg.png" alt="">
            </div>
            <section class="section-last-photos page-plus">
                <?php  
                    $post_query_category = array(
                        'post_type' => 'post',
                        'category_name' => 'como-tuto-lo-ve',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 3,
                    );
                    $loop_post_c = new WP_Query($post_query_category);     
                ?>
                <div class="container">
                <div class="top-cta">
                    <h2>COMO TUTO LO VE</h2>
                    <a class="btn black" href="<?php echo get_site_url() ?>/category/como-tuto-lo-ve">Ver más</a>
                </div>
                <div class="row">
                <?php  
                    while ( $loop_post_c->have_posts() ){
                    $loop_post_c->the_post();
                    $url_featured=get_the_post_thumbnail_url();
                    ?> 
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="<?php echo  get_the_permalink() ?>" class="text-decoration-none">
                            <div class="post-news post-opinions">
                                <div class="img-post position-relative">
                                <img src="<?php echo $url_featured; ?>" alt="">
                                </div>
                                <div class="content-post text-center">
                                <p>
                                    <?php  the_title(); ?>
                                </p>
                                <p><span><?php  echo get_the_date(); ?></span></p>
                                </div>

                            </div>
                        </a>
                    </div>
                                <?php
                        }wp_reset_query();
                    ?>
                </div>
                </div>
            </section>

            <section class="section-last-photos page-plus">
                <?php  
                    $post_query_category = array(
                        'post_type' => 'post',
                        'category_name' => 'linterna-verde',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 3,
                    );
                    $loop_post_c = new WP_Query($post_query_category);     
                ?>
                <div class="container">
                
                <div  class="top-cta">
                    <h2>LINTERNA VERDE</h2>
                    <a class="btn black" href="<?php echo get_site_url() ?>/category/linterna-verde">Ver más</a>
                </div>
                <div class="row">
                <?php  
                    while ( $loop_post_c->have_posts() ){
                    $loop_post_c->the_post();
                    $url_featured=get_the_post_thumbnail_url();
                    ?> 
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="<?php echo  get_the_permalink() ?>" class="text-decoration-none">
                            <div class="post-news post-opinions">
                                <div class="img-post position-relative">
                                <img src="<?php echo $url_featured; ?>" alt="">
                                </div>
                                <div class="content-post text-center">
                                <p>
                                    <?php  the_title(); ?>
                                </p>
                                <p><span><?php  echo get_the_date(); ?></span></p>
                                </div>

                            </div>
                        </a>
                    </div>
                                <?php
                        }wp_reset_query();
                    ?>
                </div>
                </div>
            </section>
            <section class="section-last-photos page-plus">
                <?php  
                    $post_query_category = array(
                        'post_type' => 'post',
                        'category_name' => 'al-verde-olivo',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 3,
                    );
                    $loop_post_c = new WP_Query($post_query_category);     
                ?>
                <div class="container">
                <div  class="top-cta">
                    <h2>AL VERDE OLIVO</h2>
                    <a class="btn black" href="<?php echo get_site_url() ?>/category/al-verde-olivi">Ver más</a>
                </div>
                <div class="row">
                <?php  
                    while ( $loop_post_c->have_posts() ){
                    $loop_post_c->the_post();
                    $url_featured=get_the_post_thumbnail_url();
                    ?> 
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="<?php echo  get_the_permalink() ?>" class="text-decoration-none">
                            <div class="post-news post-opinions">
                                <div class="img-post position-relative">
                                <img src="<?php echo $url_featured; ?>" alt="">
                                </div>
                                <div class="content-post text-center">
                                <p>
                                    <?php  the_title(); ?>
                                </p>
                                <p><span><?php  echo get_the_date(); ?></span></p>
                                </div>

                            </div>
                        </a>
                        
                    </div>
                                <?php
                        }wp_reset_query();
                    ?>
                </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-3">

            <?php if ( is_active_sidebar( 'sidebar_news' ) ) : ?>
			     <div id="sidebar-news" role="complementary">
			        <?php dynamic_sidebar( 'sidebar_news' ); ?>
			     </div>
		    <?php endif; ?>
        </div>
    </div>
</div>

<!-- / Section video -->

