<?php
/**
 * Template Name: Telelo Vargas Template
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
		<!-- Do the left sidebar check -->
		<main class="site-main" id="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'loop-templates/content', 'telelo' ); ?>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->

		<!-- Do the right sidebar check -->









<?php get_footer(); ?>
