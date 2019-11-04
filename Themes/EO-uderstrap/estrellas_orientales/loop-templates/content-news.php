<?php
/**
 * Partial template for content in page-photos.php
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
            $banner_top_page = get_field('banner_top_page'); 
            ?>
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
                        'posts_per_page' => 12,
                    );
                }else{
                    $args = array(
                        'post_type' => 'post',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 12,
                    );
                }
                
                $post_query = new WP_Query($args);
                   
            ?>
            <section class="section-page-news hideline">
                <?php  
                    if (is_page('opiniones')) {
                        
                    }else{
                        ?> <h2>ÚLTIMAS NOTICIAS</h2> <?php
                    }
                ?>

                <div class="post-slider">
                    <?php  
                        if($post_query->have_posts() ) {
                            while($post_query->have_posts() ) {
                              $post_query->the_post();
                              ?>
                    <!-- <h2><?php the_title(); ?></h2> -->
                    <div class="item" style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                        <div class="item-content">
                            <h2><?php the_title(); ?></h2>
                            <p>
                                <?php  echo get_the_excerpt(); ?>
                            </p>
                            <a class="link-post" href="<?php echo get_the_permalink(); ?>">leer la noticia completa</a>
                            <i class=""></i>
                        </div>
                    </div>
                    <?php
                            }
                        }wp_reset_query(); 
                    ?>
                </div>

                <div class="row no-gutters slider-nav">
                    <?php  
                    if (is_page('opiniones')){
                        $argsNav = array(
                            'post_type' => 'no-post',
                            'offset' => 1,
                            'posts_per_page' => 12,
                         );
                    }else{
                        $argsNav = array(
                            'post_type' => 'post',
                            'offset' => 1,
                            'posts_per_page' => 12,
                         );
                    }
                     
                    $post_queryNav = new WP_Query($argsNav); 
                        $count=0;
                        if($post_queryNav->have_posts() ) {
                            while($post_queryNav->have_posts() ) {
                              $post_queryNav->the_post();
                              $count++;
                              if ($count==2) {
                                 ?>
                    <div class=" item type2 p-0"
                        style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                        <div class="post-down">
                            <h5><?php the_title(); ?></h5>
                        </div>
                    </div>

                    <?php $count=0;
                              }else{
                                 ?>
                    <div class=" item type1">
                        <div class="post-down mr-2"
                            style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                            <h4><?php the_title(); ?></h4>
                        </div>
                    </div>
                    <?php
                              }
                              
                            }
                        }wp_reset_query(); 
                    ?>
                </div>
            </section>
            <section class="section-last-photos">
                <!-- untimas noticias -->
                <?php  
                    $post_query_category = array(
                        'post_type' => 'post',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 3,
                    );
                    $loop_post_c = new WP_Query($post_query_category);     
                ?>
                <div class="container">

                    <div class="top-cta">
                        <h2>ÚLTIMAS NOTICIAS</h2>
                    </div>
                    <div class="row">
                        <?php  
                    while ( $loop_post_c->have_posts() ){
                    $loop_post_c->the_post();
                    $url_featured=get_the_post_thumbnail_url();
                    ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <a class="post-news post-opinions" href="<?php echo get_the_permalink() ?>">
                                <div class="img-post">
                                    <img src="<?php echo $url_featured; ?>" alt="feature">
                                </div>
                                <div class="content-post">
                                    <p class="title-post-all"><?php  the_title(); ?></p>
                                    <p class="text-left">
                                        <?php  excerpt(8); ?>
                                    </p>
                                    <p class="text-left"><span><?php  echo get_the_date(); ?></span></p>
                                </div>
                            </a>
                        </div>
                        <?php
                        }wp_reset_query();
                    ?>
                    </div>
                </div>
            </section>
            <section class="section-last-photos">
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

                    <div class="top-cta">
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
                                    <div class="content-post">
                                        <p class="title-post-all"><?php  the_title(); ?></p>
                                        <p class="text-left">
                                            <?php  excerpt(8); ?>
                                        </p>
                                        <p class="text-left"><span><?php  echo get_the_date(); ?></span></p>
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
            <section class="section-last-photos">
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
                    <div class="top-cta">
                        <h2>AL VERDE OLIVO</h2>
                        <a class="btn black" href="<?php echo get_site_url() ?>/category/al-verde-olivo">Ver más</a>
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
                                    <div class="content-post">
                                        <p class="title-post-all"><?php  the_title(); ?></p>
                                        <p class="text-left">
                                            <?php  excerpt(9) ?>
                                        </p>
                                        <p class="text-left"><span><?php  echo get_the_date(); ?></span></p>
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
            <section class="section-last-photos">
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
                        <a class="btn black" href="<?php echo get_site_url() ?>/category/como-tuto-lo-ve/">Ver más</a>
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
                                    <div class="content-post">
                                        <p class="title-post-all_title"></p>
                            <p class=" title-post-all"><?php  the_title(); ?></p>
                                        <p class="text-left">
                                            <?php  excerpt(8); ?>
                                        </p>
                                        <p class="text-left"><span><?php  echo get_the_date(); ?></span></p>
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
            <section class="section-last-photos">
                <?php  
                    $post_query_category = array(
                        'post_type' => 'post',
                        'category_name' => 'lidom',
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => 3,
                    );
                    $loop_post_c = new WP_Query($post_query_category);     
                ?>
                <div class="container">
                    <div class="top-cta">
                        <h2>LIDOM</h2>
                        <a class="btn black" href="<?php echo get_site_url() ?>/category/lidom/">Ver más</a>
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
                                    <div class="content-post">
                                        <p class="title-post-all"><?php  the_title(); ?></p>
                                        <p class="text-left">
                                            <?php  excerpt(8); ?>
                                        </p>
                                        <p class="text-left"><span><?php  echo get_the_date(); ?></span></p>
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