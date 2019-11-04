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
$url_page_image= get_the_post_thumbnail_url();
?>
<div class="breadcrumb">
    <div class="container">
        <?php get_breadcrumb(); ?>
    </div>
</div> 
<?php  $banner_top=get_field('banner_top','option');
$banner_top_page = get_field('banner_top_page');  ?>
<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<section class="section-stadium page-generic">
    <div class="container">
        <h2> <?php  the_title(); ?> </h2>
    </div>
    
    <div class="baner-stadium" style="background-image:url(<?php  echo $url_page_image ?>);">
        <img src="" alt="">
    </div>
    <div class="container">
        <p><?php  the_content(); ?></p>
        <h2>DIRECCIONES AL TELELO VARGAS</h2>
    </div>
    <br>
</section>


