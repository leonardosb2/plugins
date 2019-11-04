<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$banner_top=get_field('banner_top','option'); 
$banner_top_page = get_field('banner_top_page'); 
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="breadcrumb">
		<div class="container">
			<?php get_breadcrumb(); ?>
		</div>
	</div> 
	<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:15px;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
	<div class="container">
		<h2 class="text-uppercase"><?php  the_title(); ?></h2>
	</div>
	<section class="section-single-players single-jugador">
		<div class="container">
				<div class="slider-current-players">
						<?php  
						$info_player=get_field('player_information');
						$url_image=get_the_post_thumbnail_url();
						$isretired=$info_player['player_state'];
						
					?> 
					<div class="item-slider-p">
							<div class="content-s-player">
								<div class="row">
									<div class="col-sm-6 text-sm-right text-center info">
										<h3><span><?php  echo $info_player['name_player']; ?></span> <?php  echo $info_player['last_name_player']; ?></h3>
										<h6>Nacionalidad</h6>
											<h4><?php  echo $info_player['country_player']; ?></h4>
										<h6>Posición</h6>
											<h4><?php  echo get_field('position')['label']; ?></h4>
										<h6>Cumpleaños</h6>
											<h4><?php  echo $info_player['birthday_player']; ?></h4>
										<?php if (!$info_player['player_state']) { ?>
										<h6>Edad</h6>
											<h4><?php  echo CalculaEdad($info_player['birthday_player']); ?> AÑOS</h4>
										<?php } ?>
										<p><?php echo $info_player['player_biography']; ?></p>
									</div>
									<div class="col-sm-6 offset-4 offset-sm-0 col-5">
										<div class="img-center-player" style="background-image:url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);"> 
											<img src="<?php  echo $url_image; ?>" alt="">
											<?php  if (!$isretired) {
												?> 
													<div class="number-player">
														<h5><?php  echo $info_player['number_player']; ?></h5>
													</div>
												<?php
											} ?>
											
										</div>
									</div>
									<div class="col-md-1 col-sm-0"></div>
								</div>
								
								
						</div>
					</div><!-- end item-slider-p -->
				</div>
		</div>
	</section>


	<section class="section-players content-absolute">
		<?php $info_player=get_field('player_information'); ?>
   <div class="container">
		<div class="d-flex justify-content-between align-items-center">
		 
		<?php if(!$info_player['player_state']):?>
				<h2>OTROS JUGADORES</h2>
			 	<a class="btn black	" href="<?php echo get_site_url() ?>/jugadores">Ver más jugadores</a>
		<?php else:?>
				<h2 style="margin: 30px 0;">OTROS JUGADORES RETIRADOS</h2>
		<?php endif;?>
      </div>
		 <?php 
		 
         if(!$info_player['player_state']):
			$args = array(
				'post_type' => 'jugador',
				'post_status' => 'publish',
				'posts_per_page' => '8',
				'paged' => 1,  
				'post__not_in'           => array(get_the_ID()),
				'meta_key'		=> 'player_information_player_state',
				'meta_value'	=> 0,
			);
			$my_posts = new WP_Query( $args );
			if ( $my_posts->have_posts() ) : 
			?>
				<div class="my-posts row">
					<?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
							$info_player=get_field('player_information');
							$url_image=get_the_post_thumbnail_url();
					?>
						<div class="col-lg-3 col-md-4 col-sm-6">
							
							<a href="<?php  echo get_the_permalink(); ?>">
							<div class="content-figure" style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);">   
								<div class="photo-player">
									<img src="<?php  echo $url_image ?>" alt="">
								</div>
								<div class="number-player">
									<h5><?php  echo $info_player['number_player']; ?></h5>
								</div>
								<div class="description">
									<h2><?php the_title(); ?></h2>
									<p><?php  echo CalculaEdad($info_player['birthday_player']); ?> años / <?php  echo get_field('position')['label']; ?> </p>
								</div>
							</div>
							</a>
						</div>
						
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php else: ?>
			<?php 
         
         $args = array(
            'post_type' => 'jugador',
            'post_status' => 'publish',
            'posts_per_page' => '8',
			'paged' => 1,  
			'post__not_in'           => array(get_the_ID()),
            'meta_key'		=> 'player_information_player_state',
            'meta_value'	=> 1,
         );
         $my_posts = new WP_Query( $args );
         if ( $my_posts->have_posts() ) : 
         ?>
            <div class="my-posts row">
                  <?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
                        $info_player=get_field('player_information');
						$url_image=get_the_post_thumbnail_url();
						if ($info_player['player_state']) {
                  ?>
                     <div class="item-player col-lg-3 col-md-4 col-sm-6">
                        <a href="<?php the_permalink(); ?>">
                           <div class="content-figure c-retired" style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);">   
                              <div class="retired-p">
                                 <img src="<?php  echo $url_image ?>" alt="">
                              </div>
                              <div class="description">
                                 <h2><?php the_title(); ?></h2>
                                 <p> <?php  echo get_field('position')['label']; ?> </p>
                              </div>
                           </div>
                        </a>
                     </div>
                     <?php  } ?>
                   <?php endwhile; ?>
            </div>
         <?php endif; ?>
		 <?php endif; ?>
   </div>
</section>
	
</article><!-- #post-## -->
