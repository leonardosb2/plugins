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
$banner_top_page = get_field('banner_top_page'); 
$size = 'full'; // (thumbnail, medium, large, full or custom size)

?>


<div class="container">

    <div class="row">
        <div class="col-md-9 positions-eo">
        <section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?>">  
            <div class="banner-content">
                    <?php echo get_field('banner_top_page'); ?>
            </div>
        </section>
             <h2><?php  the_title(); ?> <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2>
             <section class="section-table" data-aos="fade-up">
                    <?php 
                            $table_teams = get_field('table_teams','option');
                            $order = array();
                           foreach( $table_teams as $i => $row ) {
                              $order[ $i ] = $row['dif_repiter'];
                           }
                           array_multisort( $order, SORT_ASC, $table_teams );
                    ?> 

                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 pt-lg-0 pt-5">
                                <div class="table-responsive">
                                <table class="table sortable">
                                    <thead>
                                        <tr>
                                            <th scope="col">POS</th>
                                            <th scope="col">EQUIPO</th>
                                            <th scope="col">J</th>
                                            <th scope="col">G</th>
                                            <th scope="col">P</th>
                                            <th scope="col">PCT</th>
                                            <th scope="col">DIF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $position=0;
                                        foreach ($table_teams as $elements) {
                                            $position++;
                                            $team_post= $elements['team'];
                                            $j_repiter = $elements['j_repiter'];
                                            $g_repiter = $elements['g_repiter'];
                                            $p_repiter= $elements['p_repiter'];
                                            $pct_repiter = $elements['pct_repiter'];
                                            $dif_repiter = $elements['dif_repiter'];
                                            $url_img=get_the_post_thumbnail_url($team_post->ID);
                                            ?>
                                            <tr>
                                            <th scope="row"><?php  echo $position; ?></th>
                                            <td>
                                                <p><img src="<?php echo $url_img; ?>" alt="stars"></p>
                                                <?php  echo $team_post->post_title; ?>
                                            </td>
                                            <td><?php  echo $j_repiter; ?></td>
                                            <td><?php  echo $g_repiter; ?></td>
                                            <td><?php  echo $p_repiter; ?></td>
                                            <td><?php  echo $pct_repiter; ?></td>
                                            <td><?php  echo $dif_repiter ; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>  
                                        
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <h2 class="title-share">¡COMPARTE EN LAS REDES!</h2>
                            <a class="share face" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                        class="sbtn facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook-f"></i></a>
                            <a class="share twiter"
                            href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title_attribute(); ?>"
                            class="sbtn twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                        
                    </div>
                </section>
        </div>
        <div class="col-md-3 hidden-widgets">
            <?php if ( is_active_sidebar( 'sidebar_news' ) ) : ?>
			     <div id="sidebar-news" role="complementary">
			        <?php dynamic_sidebar( 'sidebar_news' ); ?>
			     </div>
		    <?php endif; ?>

        </div>
        
    </div>
</div>

<!-- / Section video -->


<section class="section-last-news" data-aos="fade-up">
   <?php  
         $post_query_category = array(
            'post_type' => 'post',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'posts_per_page' => 4,
      );
      $loop_post_c = new WP_Query($post_query_category);     
   ?>
   <div class="container">
      <div  class="top-cta">
         <h2>ÚLTIMAS NOTICIAS</h2>
         <a class="btn black" href="<?php echo get_site_url() ?>/noticias">Ver más NOTICIAS</a>
      </div>
      <div class="row">
         <?php  
            while ( $loop_post_c->have_posts() ){
            $loop_post_c->the_post();
            $url_featured=get_the_post_thumbnail_url();
               ?>         
                  <div class="col-sm-6 mb-4">
                     <a href="<?php  echo get_the_permalink(); ?>" class="post-news post-opinions">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="img-post h-100">
                                <img src="<?php  echo $url_featured ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 p-0">
                                <div class="content-post">
                                <p><span><?php  echo get_the_date(); ?></span></p>
                                <p class="title-post-all"><?php  the_title(); ?></p>
                                <p >
                                    <?php   excerpt(10); ?>
                                </p>
                                </div>
                            </div>
                        </div>
                     </a>
                     
                  </div>
               <?php
            }wp_reset_query();
         ?>
         <!-- END COLUMN M6 -->
      </div>
   </div>
</section>

