<?php
/**
 *  Template Name: Players  Template
 *
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main class="site-main" id="main" role="main">
		<?php get_template_part( '/loop-templates/content', 'players' ); ?>
	</main>

<?php get_footer(); ?>
