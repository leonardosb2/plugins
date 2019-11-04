<?php
/**
 * Partial template for content in page-directive.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$banner_top = get_field('banner_top','option');
$banner_adsense_middle = get_field('banner_adsense_middle','option');
$banner_adsense_middle = get_field('banner_adsense_middle','option');
$directive_information = get_field('directive_information');





?>
<div class="breadcrumb">
    <div class="container">
        <?php get_breadcrumb(); ?>
    </div>
</div> 
<section class="banner-content"  data-aos="fade-up" style="background-color:<?php the_sub_field('color'); ?>;">
   <div class="container">
       <?php   echo $banner_top; ?>
   </div>
</section>
<section class="section-players content-absolute">
   <div class="container">
         <?php 
         ?>
            <div class="my-posts row no-gutters">
                  <?php  

               foreach($directive_information as $directive):
                  ?>
                     <div class="item-player col-lg-3 col-md-4 col-sm-6 mb-5">
                      
                           <div class="content-figure" style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);">   
                              <div class="photo-player h-100 w-100">
                                 <img src="<?php echo $directive['directive_image']; ?>" alt="">
                              </div>
                             
                              <div class="description">
                                 <h2><?php echo $directive['name_directive']; ?></h2>
                                 <p><?php  echo $directive['management_position']; ?>  <?php  //echo get_field('position')['label']; ?> </p>
                              </div>
                           </div>
                       
                     </div>
                     
       <?php  endforeach; //endwhile; ?>
            </div>
         <?php// endif; ?>
      <!-- <div class="loadmore btn black">CARGAR MÁS JUGADORES</div> -->
   </div>
   
</section>
<div class="line-separator  position-relative separator-small">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footerimg.png" alt="">
</div>
<?php 
   $title_videos_slider = get_field('title_videos_slider','option');
   $link_more_videos = get_field('link_more_videos','option');
   $link_subscribe = get_field('link_subscribe','option');
?>
<section class="section-videos-yt videos-section" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bg-videos.png);">
      <div class="youtube-links">
          <h3 class="text-center"><?php echo $title_videos_slider ?></h3>
      </div>
      <?php //echo do_shortcode('[yotuwp type="playlist" id="PLF9I_81o3H9WcKHfVHS9RExiIfm0N_93I" column="4" template="list"]'); ?>
      <?php
      $youtube_channel = get_field('youtube_channel', 'option');
      
      echo do_shortcode('[yotuwp type="channel" id="'.$youtube_channel.'" pagination="off" column="4" template="list"]'); ?>
      <div class="btn-content">
      <?php
      if( $link_more_videos ): 
         $link_url = $link_more_videos['url'];
         $link_title = $link_more_videos['title'];
         $link_target = $link_more_videos['target'] ? $link_more_videos['target'] : '_self';
         ?>
         <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary" target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
      <?php endif; 
      if( $link_subscribe ): 
         $link_url = $link_subscribe['url'];
         $link_title = $link_subscribe['title'];
         $link_target = $link_subscribe['target'] ? $link_subscribe['target'] : '_self';
         ?>
         <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary red" target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
      <?php endif; ?>
      </div>
</section>







