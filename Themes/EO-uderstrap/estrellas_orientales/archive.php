<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>
<main class="site-main" id="main">
<div class="breadcrumb">
    <div class="container">
        <?php get_breadcrumb(); ?>
    </div>
</div> 
<section class="section-category section-page-news" style="background:white;">
	<div class="container">
		<div class="row">
			<div class="col-md-9">	
                <div class="pre-content">
                    <?php 
                    $titleCat = single_cat_title( '', false );
                    echo '<h2 class="page-title">'.$titleCat.'</h2>';
                        Global $wp_query;
                        if(is_category($category = 'como-tuto-lo-ve') || is_category($category = 'al-verde-olivo') || is_category($category = 'linterna-verde')):
                            $author_opinion_image = get_field('author_opinion_image', 'category_'.get_queried_object_id().'');
                            $author_name = get_field('author_name', 'category_'.get_queried_object_id().'');
                            $content_opinion = get_field('content_opinion', 'category_'.get_queried_object_id().'');
                            if($author_opinion_image || $author_name || $content_opinion):
                        ?>
                            <div class="written-by">
                                <?php if($author_opinion_image): ?> 
                                    <img src="<?php echo $author_opinion_image ?>" alt="Author">
                                <?php else: ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/silueta.png" alt="Author">
                                <?php endif; ?>
                                    <div class="opinion-content">
                                        <h4>Escrito por <span class="author-name"><?php echo $author_name ?></span></h4>
                                        <p><?php echo $content_opinion ?></p>
                                    </div>
                            </div>
                            <?php endif; ?>
                        <?php else: ?>
                        <div class="post-slider">
                            <?php  
                                if($wp_query->have_posts() ) {
                                    while($wp_query->have_posts() ) {
                                    $wp_query->the_post();
                                    ?>
                                    <!-- <h2><?php the_title(); ?></h2> -->
                                    <div class="item"
                                            style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/slider-img.png);">
                                            <div class="item-content">
                                            <h2><?php echo get_the_title(); ?></h2>
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
                                $count=0;
                                if($wp_query->have_posts() ) {
                                    while($wp_query->have_posts() ) {
                                    $wp_query->the_post();
                                    $count++;
                                    if ($count==2) {
                                        ?> 
                                        <div class="col-md-3 item type2 p-0" style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                                            <div class="post-down">
                                                <h5><?php the_title(); ?></h5>
                                            </div>
                                        </div>
                                        
                                        <?php $count=0;
                                    }else{
                                        ?>
                                        <div class="col-9 item type1">
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
                        <?php endif;?>
                </div>
            <div class="line-separator position-relative separator-small">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/footerimg.png" alt="">
            </div>
            <section class="section-last-photos">
                <?php  
                    $post_query_category = array(
                        'post_type' => 'post',
                        'category_name' => $category,
                        'orderby' => 'publish_date',
                        'order' => 'DESC',
                        'posts_per_page' => -1,
                    );
                    $loop_post_c = new WP_Query($post_query_category);     
                ?>
                <div class="container">
                <div class="top-cta">
                    <!-- <h2>LINTERNA VERDE</h2>
                    <a class="btn black" href="#">Ver más</a> -->
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
			<div class="col-md-3">
				<?php if ( is_active_sidebar( 'sidebar_news' ) ) : ?>
				     <div id="sidebar-news" role="complementary">
				        <?php dynamic_sidebar( 'sidebar_news' ); ?>
				     </div>
			    <?php endif; ?>
			</div>
		</div>
	</div>
</section>

</main><!-- #main -->
<?php get_footer(); ?>
