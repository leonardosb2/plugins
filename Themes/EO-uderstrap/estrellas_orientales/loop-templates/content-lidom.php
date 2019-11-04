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
<section class="section-emed">
   <div class="container">
       <?php  
        echo get_field('iframe_Lidom');
       ?>
   </div>
</section>


