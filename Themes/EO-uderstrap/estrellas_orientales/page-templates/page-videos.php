<?php
/**
 *  Template Name: Videos Page Template
 *
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main class="site-main" id="main" role="main">
		<?php get_template_part( '/loop-templates/content', 'videos' ); ?>
	</main>

<?php get_footer(); ?>
