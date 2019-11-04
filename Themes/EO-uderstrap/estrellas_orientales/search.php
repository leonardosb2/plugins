<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>
<main class="site-main" id="main">
	<section class="section-search " style="background:white;">
		<div class="container">
			
			<div class="row">
				<div class="col-md-9">
					<h2 class="page-title">
					<?php
					printf(
						/* translators: %s: query term */
						esc_html__( 'Resultados para: %s', 'understrap' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
					</h2>
					<div class="serach-4040">
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
								<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
								<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
								<button type="submit" class="search-submit btn-primary"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<div class="row m-0">
						
						<?php if ( have_posts() ) {
							while ( have_posts() ) {
								the_post(); 
								
								?> 
								<div class="col-md-12 p-0 mb-5">
									<div class="post-news post-opinions">
										<div class="row m-0">
										<div class="col-md-5">
											<div class="img-result">
												<img src="<?php  echo get_the_post_thumbnail_url(); ?>" alt="">
											</div>
										</div>
										<div class="col-md-7 p-0">
											<div class="content-post">
												<h3><?php the_title();  ?></h3>
												<p>
													Reyes tiene 25 años de edad. Fue firmado en 2011. Fue selección "draft" de EO en 2017.                                 
												</p>
												<a class="btn black" href="<?php  echo get_permalink(); ?>">Leer más</a>
											</div>
										</div>
										</div>
									</div>
								</div>
								<?php
							} 
						} else{
							echo "no se encontraron resulttados";
						}
						?>
					</div>
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
			
		
	</section>
</main>



				






<?php get_footer(); ?>
