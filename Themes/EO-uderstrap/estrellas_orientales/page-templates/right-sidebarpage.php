<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
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
			<div class="container">
				<div class="row">
					<div class="col-md-9">
					<section class="section-stadium  pt-5 pb-5">
						<div class="container">
							<h2><?php  the_title() ?></h2>
							<div class="content-page">
								<?php  echo the_content(); ?>
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
			

			<?php endwhile;wp_reset_query(); // end of the loop. ?>
</main><!-- #main -->

<?php get_footer(); ?>
