<?php
/**
 * Partial template for content in page-retirados.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$banner_top = get_field('banner_top','option');
$banner_adsense_middle = get_field('banner_adsense_middle','option');
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
<section class="section-players">
   <div class="container">
         <?php 
         
         $args = array(
            'post_type' => 'jugador',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'paged' => 1,  
            'meta_key'		=> 'player_information_player_state',
            'meta_value'	=> 1,
         );
         $my_posts = new WP_Query( $args );
         if ( $my_posts->have_posts() ) : 
         ?>
            <div class="my-posts row no-gutters">
                  <?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
                        $info_player=get_field('player_information');
                        $url_image=get_the_post_thumbnail_url();
                  ?>
                     
                     <div class="item-player col-lg-3 col-md-4 col-sm-6">
                        <a href="<?php the_permalink(); ?>">
                           <div class="content-figure c-retired" style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);">   
                              <div class="retired-p">
                                 <img src="<?php  echo $url_image ?>" alt="">
                              </div>
                              <div class="description">
                                 <h2><?php the_title(); ?></h2>
                                 <p> <?php  echo get_field('position')['label']; ?> </p>
                              </div>
                           </div>
                        </a>
                     </div>
                     
                  <?php endwhile; ?>
            </div>
         <?php endif; ?>
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


<script type="text/javascript">
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
jQuery(function($) {
    jQuery('body').on('click', '.loadmore', function() {
         jQuery(".loadmore").addClass("loading");
        var data = {
            'action': 'load_py_by_ajax',
            'page': page,
            'post_type': 'jugador',
            'posts_per_page':'8',
            'security': '<?php echo wp_create_nonce("load_more_retireds"); ?>'
        };
        $.post(ajaxurl, data, function(response) {
            if(response != '') {
                jQuery('.my-posts').append(response);
                page++;
                jQuery(".loadmore").removeClass("loading");
            } else {
                jQuery('.loadmore').hide();
                jQuery(".loadmore").removeClass("loading");
            }
        });
    });
});
</script> 




