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
<section class="gallery-hero-wrapper photos-hero-slider">
    <?php
   $args = array(  
       'post_type' => 'foto',
       'post_status' => 'publish',
       'posts_per_page' => 3,
       'orderby' => 'date',
       'order' => 'DESC',
   );
   $loop = new WP_Query( $args );
   
   while ( $loop->have_posts() ) : $loop->the_post(); 
   $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_site_url().'/wp-content/uploads/2019/08/hero-bg.jpg'; 
   $photos = get_field('photos');
   ?>

    <div class="gallery-hero-content text-center" style="background-image:url(<?php echo $featured_img_url;?>);
   background-size:cover; background-position: center;">
        <div class="container">
            <div class="gallery-meta__counter">
                <?php
                   if( $photos ):
                     $counterPhotos = 0; ?>
                <?php foreach( $photos as $image ):
                           $counterPhotos++;
                           ?>

                <?php endforeach; ?>
                <?php endif; ?>
                <span class="gallery-meta__counter-num"><?php echo $counterPhotos; ?></span>
                <svg class="icon" viewBox="0 0 88 72.63">
                    <path
                        d="M75.5 25.42a4.35 4.35 0 1 1 4.34-4.35 4.34 4.34 0 0 1-4.34 4.35zM44 63.47a21 21 0 1 1 21-21 21 21 0 0 1-21 21zM75.37 9.89H64.32A12.62 12.62 0 0 0 52 0H36a12.63 12.63 0 0 0-12.33 9.89h-11A12.64 12.64 0 0 0 0 22.53V60a12.63 12.63 0 0 0 12.63 12.63h62.74A12.63 12.63 0 0 0 88 60V22.53A12.64 12.64 0 0 0 75.36 9.89zM44 28.28a14.19 14.19 0 1 0 14.19 14.19A14.19 14.19 0 0 0 44 28.28z"
                        fill-rule="evenodd"></path>
                </svg>
            </div>
            <a class="go-to-popup" href="#" id="<?php  echo get_the_ID();?>"><span
                    class="gallery-meta__title"><?php echo get_the_title(); ?></span></a>
        </div>
    </div>
    <?php
   endwhile;
   ?>
</section>
<?php
wp_reset_postdata();
?>

<section class="section-publici"
    style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?><?php  if (get_field('banner_top_page')=="") {echo 'padding:0;';} ?> ">
    <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
    </div>
</section>
<section class="section-last-photos">
    <div class="container">
        <div>
            <h2>FOTOS</h2>
        </div>
        <?php
   $args = array(  
       'post_type' => 'foto',
       'post_status' => 'publish',
       'posts_per_page' => 16,
       'orderby' => 'date',
       'order' => 'DESC',
   );
   $loop = new WP_Query( $args ); 
   ?>

        <div class="row"> <?php
   while ( $loop->have_posts() ) : $loop->the_post(); 
   $featured_img_box = get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_site_url().'/wp-content/uploads/2019/08/hero-bg.jpg'; 
   $photos = get_field('photos');
   ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="post-news post-opinions">
                    <div class="img-post position-relative">
                        <button class="go-to-popup" id="<?php echo get_the_ID(); ?>">
                            <img src="<?php echo $featured_img_box ?>" alt="">
                        </button>
                        <div class="content-popup <?php echo get_the_ID(); ?>">
                            <button class="close">
                                <span class="yotuicon-close"></span>
                            </button>
                            <?php
                           if( $photos ):
                              $counterPhotos = 0; ?>
                            <div class="popup-gallery slide-photos">
                                <?php foreach( $photos as $image ):
                                    $counterPhotos++; ?>
                                <div class="photo-item  " style="background-image:url(<?php echo $image['url']; ?>);">
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; 
                        ?>
                        </div>
                        <p><?php echo $counterPhotos;?> <i class="fa fa-camera"></i></p>

                    </div>
                    <div class="content-post">
                        <p><?php echo get_the_title() ?></p>
                        <p><span><?php echo calculate_time_ago(); /* post date in time ago format */ ?></span></p>
                    </div>
                </div>
            </div>
            <?php
   endwhile; ?>
        </div>
        <?php
// wp_reset_postdata();
?>
        <div class="text-center">
            <div class="loadmore btn black">VER MÁS FOTOS</div>
        </div>
    </div>
</section>
<section class="card-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <?php echo $banner_adsense_middle['banner_1']; ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <?php echo $banner_adsense_middle['banner_2']; ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <?php echo $banner_adsense_middle['banner_3']; ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <?php echo $banner_adsense_middle['banner_4']; ?>
            </div>
        </div>
    </div>
    <div class="line-separator  position-relative separator-small"><img
            src="<?php echo get_stylesheet_directory_uri(); ?>/images/footerimg.png" alt=""></div>
</section>
<!-- Section video -->
<?php 
   $title_videos_slider = get_field('title_videos_slider','option');
   $link_more_videos = get_field('link_more_videos','option');
   $link_subscribe = get_field('link_subscribe','option');
   $youtube_channel = get_field('youtube_channel', 'option');
?>
<section class="section-videos-yt videos-section"
    style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bg-videos.png);">
    <div class="youtube-links">
        <h3 class="text-center"><?php echo $title_videos_slider ?></h3>
    </div>
    <?php //echo do_shortcode('[yotuwp type="playlist" id="PLF9I_81o3H9WcKHfVHS9RExiIfm0N_93I" column="4" template="list"]'); ?>
    <?php   
      echo do_shortcode('[yotuwp type="channel" id="'.$youtube_channel.'" pagination="off" column="4" template="list"]'); ?>
    <div class="btn-content">
        <?php
      if( $link_more_videos ): 
         $link_url = $link_more_videos['url'];
         $link_title = $link_more_videos['title'];
         $link_target = $link_more_videos['target'] ? $link_more_videos['target'] : '_self';
         ?>
        <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary"
            target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
        <?php endif; 
      if( $link_subscribe ): 
         $link_url = $link_subscribe['url'];
         $link_title = $link_subscribe['title'];
         $link_target = $link_subscribe['target'] ? $link_subscribe['target'] : '_self';
         ?>
        <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary red"
            target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
        <?php endif; ?>
    </div>
</section>
<script>
sortables_init();
</script>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
jQuery(function($) {
    jQuery('body').on('click', '.loadmore', function() {
        jQuery(".loadmore").addClass("loading");
        var data = {
            'action': 'load_photos_by_ajax',
            'page': page,
            'post_type': 'foto',
            'posts_per_page': '4',
            'security': '<?php echo wp_create_nonce("load_more_photos"); ?>'
        };
        $.post(ajaxurl, data, function(response) {
            if (response != '') {
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
<!-- / Section video -->