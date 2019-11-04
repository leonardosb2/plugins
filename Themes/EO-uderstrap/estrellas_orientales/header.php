<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">
	<?php
		$header = get_field('header','option');
		$socials = $header['socials'];
		$calendar_link = get_field('calendar_link','option');
		// $logo=get_field('logo_header','option');
		$bg=get_field('background_header','option');
	?>
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<nav class="navbar navbar-expand-md navbar-dark bg-primary header-main" style="background-image:url(<?php  echo $bg; ?>);">
			<div class="container-header">
				<div class="row hidden-fix ">
					<div class="col-md-6">
					</div>
					<div class="col-md-12 text-right">
						<ul class="social-top">
							<li class="text-li"><p><?php echo __("WEB OFICIAL DE LAS ESTRELLAS ORIENTALES")?></p></li>
							<?php foreach ($socials as $social) {
							?>
							<li><a href="<?php echo $social['url']?>" target="_blank"><i class="fa fa-<?php echo $social['social_icon']?>"></i></a></li>
							<?php
							}
							?>
							<li><a class="sepatator" href="<?php echo $calendar_link?>"><i class="fa fa-calendar"></i></a></li>
							<li><a class="cta-search"href="#"><i class="fa fa-search"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="row ">
					<div class="section-search">
							<div class="content-popup cta-search-pop-up">
								<button class="close">
									<span class="yotuicon-close"></span>
								</button>
								<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
										<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
										<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
										<button type="submit" class="search-submit btn-primary"><i class="fa fa-search"></i></button>
								</form>
							</div>
					</div>
					<div class="col-6 col-lg-2 desktop-logo">
							<div class="logo_header">
								<a href="<?php  echo get_home_url() ?>"><img src="<?php  echo $header['logo']; ?>" alt=""></a>
							</div>
					</div>
					<div class="col-6 col-lg-10 desktop-menu text-left mobile-logo-menu">
						<a href="<?php  echo get_home_url() ?>"><img src="<?php  echo $header['logo']; ?>" alt=""></a>
					</div>
					<div class="col-6 col-lg-10 desktop-menu">
						<div class="d-flex h-100 justify-content-end">
								<div class="responsive-button">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</div>
						</div>
					</div>
					<div class="col-lg-10 p-0 large-menu">
						<div class="responsive-custom-menu">
							<div class="row hide-d">
								<div class="col-6">
									<div class="responsive-close-button">
										<span></span>
										<span></span>
										<span></span>
										<span></span>
									</div>
								</div>
								<div class="col-6 text-right mobile-logo-menu">
									<a href="<?php  echo get_home_url() ?>"><img src="<?php  echo $header['logo']; ?>" alt=""></a>
								</div>
							</div>
							<div class="col-12 desktop-menu">
								<button class="btn back">Volver</button>
		                        <form role="search" method="get" class="search-form s-menu" action="<?php echo esc_url( home_url( '/' ) ) ?>">
		                            <span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
		                            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
		                            <button type="submit" class="search-submit btn-primary"><i class="fa fa-search"></i></button>
		                        </form>  
							</div>					
							<!-- The WordPress Menu goes here -->
							<?php 
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarNavDropdown',
									'menu_class'      => 'navbar-nav ml-auto',
									'fallback_cb'     => '',
									'menu_id'         => 'main-menu',
									'depth'           => 2,
									'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
								)
							); 
							?>
						</div>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('.responsive-button').on('click', function(e){
								e.preventDefault();
								jQuery('.responsive-custom-menu').addClass('active');
							});
							jQuery('.responsive-close-button').on('click', function(e){
								e.preventDefault();
								jQuery('.responsive-custom-menu').removeClass('active');
								jQuery('button.back').click();
							});
						});
					</script>
				</div>


			</div><!-- .container -->
		</nav><!-- .site-navigation -->

    </div><!-- #wrapper-navbar end -->
    <div class="loader">
        <div class="content-gif"></div>
    </div>
