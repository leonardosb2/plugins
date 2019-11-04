<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>


<section class="error-404 not-found">
	<div class="container">
		<header class="page-header text-center">
			<img src="<?php  echo get_stylesheet_directory_uri() ?>/images/orredes.png" alt="">
			<div class="title-404">404 :(</div>
			<h2>Esta página no existe </h2>
		</header><!-- .page-header -->
		
		<div class="serach-4040">
			
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<span class="screen-reader-text"><?php _x( 'Buscar..', 'label' )?></span>
					<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
					<button type="submit" class="search-submit btn-primary"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<a	href="javascript:window.history.back();">&laquo; Volver atrás</a>
	</div>
</section><!-- .error-404 -->


<?php get_footer(); ?>
