<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<main class="site-main" id="main">
			<?php while ( have_posts() ) : the_post(); ?>
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
			<section class="section-stadium  pt-5 pb-5">
				<div class="container">
					<h2 class="title-post-c"><?php  the_title() ?></h2>
					<div class="content-page">
						<?php  echo the_content(); ?>
					</div>
				</div>
			</section>

			<?php endwhile; // end of the loop. ?>
</main><!-- #main -->

<?php get_footer(); ?>
