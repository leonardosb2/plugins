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
?>
<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0px;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<?php 
   $title_page_video = get_field('title_page_video');
   $link_video_page_subscribe = get_field('link_video_page_subscribe');
?>
<section class="videos-section grid-video" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bg-videos.png);">
    <div class="container">
        <div class="youtube-links">
            <h3 class="text-center"><?php echo $title_page_video; ?></h3>
            <?php
            if( $link_video_page_subscribe ): 
               $link_url = $link_video_page_subscribe['url'];
               $link_title = $link_video_page_subscribe['title'];
               $link_target = $link_video_page_subscribe['target'] ? $link_video_page_subscribe['target'] : '_self';
            ?>
               <div class="cta-links">
                  <a href="<?php echo esc_url($link_url); ?>" class="youtube-link-icon" target="<?php echo esc_attr($link_target); ?>"><i class="fa fa-youtube"></i></a>
                  <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary red" target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
               </div>
            <?php endif; ?>
        </div>
        <?php 
        $youtube_channel = get_field('youtube_channel', 'option');
        echo do_shortcode('[yotuwp type="channel" id="'.$youtube_channel.'" ]'); ?>
    </div>
</section>
<section class="card-wrap">
   <div class="container">
      <div class="row">
         <div class="col-md-3">
            <?php echo $banner_adsense_middle['banner_1']; ?>
         </div>
         <div class="col-md-3">
            <?php echo $banner_adsense_middle['banner_2']; ?>
         </div>
         <div class="col-md-3">
            <?php echo $banner_adsense_middle['banner_3']; ?>
         </div>
         <div class="col-md-3">
            <?php echo $banner_adsense_middle['banner_4']; ?>
         </div>
      </div>
   </div>
   <div class="line-separator  position-relative separator-small"><img
         src="<?php echo get_stylesheet_directory_uri(); ?>/images/footerimg.png" alt=""></div>
</section>
<section class="section-last-photos">
   <div class="container">
      <div  class="top-cta">
         <h2>ÚLTIMAS FOTOS</h2>
         <a class="btn black" href="<?php echo get_site_url() ?>/multimedia">Ver más fortos</a>
      </div>
      <?php
   $args = array(  
       'post_type' => 'foto',
       'post_status' => 'publish',
       'posts_per_page' => 4,
       'orderby' => 'date',
       'order' => 'DESC',
   );
   $loop = new WP_Query( $args ); ?>
   <div class="row"> <?php
   while ( $loop->have_posts() ) : $loop->the_post(); 
   $featured_img_box = get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_site_url().'/wp-content/uploads/2019/08/hero-bg.jpg'; 
   $photos = get_field('photos');
   ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
             <div class="post-news post-opinions">
               <div class="img-post position-relative">
                  <button  class="go-to-popup" id="<?php echo get_the_ID(); ?>">
                     <img src="<?php echo $featured_img_box ?>" alt="">
                  </button>
                  <div class="content-popup <?php echo get_the_ID(); ?>" >
                     <button class="close">
									<span class="yotuicon-close"></span>
                     </button>
                     <?php
                           if( $photos ):
                              $counterPhotos = 0; ?>
                              <div class="popup-gallery slide-photos" >
                                 <?php foreach( $photos as $image ):
                                    $counterPhotos++; ?>
                                    <div class="photo-item" style="background-image:url(<?php echo $image['url']; ?>);">
                                    </div>
                                 <?php endforeach; ?>
                              </div>
                        <?php endif; 
                        ?> 
                  </div>
                  <p><?php echo $counterPhotos;?> <i class="fa fa-camera"></i></p>

               </div>
               <div class="content-post text-center">
                  <p><?php echo get_the_title() ?></p>
                  <p><span><?php echo calculate_time_ago(); /* post date in time ago format */ ?></span></p>
               </div>
             </div>
         </div>
        <?php
   endwhile; ?>
   </div>
   <?php
wp_reset_postdata();
?>
   </div>
</section>

