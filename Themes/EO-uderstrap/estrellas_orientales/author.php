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
<main class="site-main" id="main" role="main">
    <!-- <div class="breadcrumb">
        <div class="container">
            <?php get_breadcrumb(); ?>
        </div>
    </div>  -->
    <section class="section-category section-page-news" style="background:white;">
        <div class="container">
            <div class="row">
                <div class="col-md-9">	
                    <div class="pre-content">
                        <?php
                        $titleCat = single_cat_title( '', false );
                        echo '<h2 class="page-title">'.$titleCat.'</h2>';
                            Global $wp_query;
                            $user_description = get_the_author_meta( 'user_description', $post->post_author );
                            ?>
                            <div class="written-by">
                                <!-- <img src="<?php echo $author_opinion_image ?>" alt="Author"> -->
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
                                <div class="opinion-content">
                                    <h4>Escrito por <span class="author-name"><?php the_author(); ?></span></h4>
                                    <?php if($user_description): ?>
                                        <p><?php echo $user_description ?></p>
                                    <?php endif; ?>
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="btn black">Ver todas sus publicaciones</a>
                                </div>
                            </div>
                    </div>
                <div class="line-separator position-relative separator-small">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/footerimg.png" alt="">
                </div>
                <!-- The Loop -->
        <section class="section-last-photos" >
            <div class="container">
                <div class="row">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!-- <li>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                <?php the_title(); ?></a>,
                <?php the_time('d M Y'); ?> in <?php the_category('&');?>
            </li> -->
                        <div class="col-md-4 col-sm-6">
                            <a href="<?php echo get_the_permalink() ?>">
                                <div class="post-news post-opinions">
                                    <div class="img-post position-relative">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                    </div>
                                    <div class="content-post text-center">
                                    <p>
                                        <?php the_title(); ?>
                                    </p>
                                    <!-- <p><span><?php echo get_the_title(); ?></span></p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
        <?php endwhile; else: ?>
            <p><?php _e('No posts by this author.'); ?></p>

        <?php endif; ?> 
                </div>
            </div>
        </section>
    <!-- End Loop -->     
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
</main>

<?php get_footer(); ?>
