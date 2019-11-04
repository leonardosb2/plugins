<?php
/**
 * Template Name: Statistics Template
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main class="site-main" id="main" role="main">
		<?php get_template_part( '/loop-templates/content', 'statistics' ); ?>
	</main>


<?php get_footer(); ?>
