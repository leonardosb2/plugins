<?php
/**
 *  Template Name: Opinions Page Template
 *
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main class="site-main" id="main" role="main">
		<?php get_template_part( '/loop-templates/content', 'opinions' ); ?>
	</main>

<?php get_footer(); ?>

