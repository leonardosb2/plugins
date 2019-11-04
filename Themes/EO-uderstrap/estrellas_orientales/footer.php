<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
$bg=get_field('background_footer','option');
?>
<section class="logos-pre-footer" style="background:#f5f5f5;">
<?php 
	$sponsors_footer = get_field('sponsors_footer','option');
?>
   <div class="container">
      <ul class="list-logos">
		<?php  
			foreach ($sponsors_footer as $sponsors) {
				$logo_sponsor= $sponsors['logo_sponsor'];
			?>
			<li>
				<img src="<?php echo $logo_sponsor;  ?>" alt="">
			</li>
			<?php
			}  
		?>
      </ul>
   </div>
</section>
<div id="site_footer" style="background-image:url(<?php  echo $bg;	?>);">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-6 text-sm-left">
						<?php if ( is_active_sidebar( 'footer1l' ) ) : ?>
						     <div id="footer_buttom" class="footer_buttom" role="complementary">
						     	<?php dynamic_sidebar( 'footer1l' ); ?>
						     </div>
					    <?php endif; ?>
					</div>
					<div class="col-6 text-sm-left">
						<?php if ( is_active_sidebar( 'footer2l' ) ) : ?>
						     <div id="footer_buttom" class="footer_buttom" role="complementary">
						     	<?php dynamic_sidebar( 'footer2l' ); ?>
						     </div>
					    <?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			<?php  
			$date_pr_wp = new DateTime("now", new DateTimeZone('America/Santo_Domingo') );
			$in_text= date( "Y-m-d H:i:s" );
			$date_pr_wp->format("Y-m-d H:i:s");
			$loop_order = new WP_Query( array(
				'post_type' => 'partido',
            	'meta_key'          => 'match_day',
				'meta_value'        => $date_pr_wp->format("Y-m-d H:i:s"), 
				'meta_compare'      => '>',
				'orderby'           => 'meta_value',
				'order'             => 'ASC'
			)
			);
			while ( $loop_order->have_posts() ){
				$loop_order->the_post();
				$date = get_field('match_day');
				$date2 = DateTime::createFromFormat('d/m/Y g:i a', $date);
				$fecha_actual = strtotime(date('d-m-Y g:i a'));
				$fecha_entrada = strtotime($date2->format('d-m-Y g:i a'));
				$game_team = get_field('game_team');
				$game_team2 = get_field('game_team2');
				$team=$game_team['first_team'];
				$team2=$game_team2['team'];
				setlocale(LC_ALL,"es_ES");
				if (true) {
				   ?> 
				   	<div class="next-mach">
						<div class="header_mach">
							<?php  
                              if ($date2->format('D')=="Sat") {
                                ?> <span><?php  echo strftime("Sábado",$date2->getTimestamp());?></span><?php
                              }else{
								if ($date2->format('D')=="Wed"){
									?> <span><?php  echo strftime("Míercoles",$date2->getTimestamp());?></span>  <?php
								}else{
									?> <span><?php  echo strftime("%A",$date2->getTimestamp());?></span>  <?php
								}
                              }
                           	?>  
							<h3 class="date"><strong><?php  echo strftime("%d ",$date2->getTimestamp()); ?></strong> <?php  echo strftime("%B",$date2->getTimestamp()); ?></h3>
						</div>
						<p class="serie"><?php echo get_field('season_game'); ?></p>
						<div class="vs_teams">
							<div class="row">
								<div class="col-5 text-center pr-0 ">
									<img class="img-team1" src="<?php echo get_the_post_thumbnail_url($team); ?>" alt="">	
								</div>
								<div class="col-1 text-center">
									<div class="d-flex h-100">
										<span class="text-vs m-auto " >VS</span>
									</div>
								</div>
								<div class="col-5 text-center pr-0">
									<img  class="img-team2" src="<?php echo get_the_post_thumbnail_url($team2); ?>" alt="">
								</div>
							</div>
						</div>
						<div class="date_place">
							<h4><?php  echo $date2->format('g:i'); ?> <span><?php  echo $date2->format('A'); ?></span></h4>
							<p><?php  echo get_field('stadium'); ?></p>
						</div>
					</div>
				   <?php
				   break;
				}
			}
			?>

				
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-6 text-sm-left ">
						<?php if ( is_active_sidebar( 'footer1r' ) ) : ?>
						     <div id="footer_buttom" class="footer_buttom" role="complementary">
						     	<?php dynamic_sidebar( 'footer1r' ); ?>
						     </div>
					    <?php endif; ?>
					</div>
					<div class="col-6 text-sm-left">
						<?php if ( is_active_sidebar( 'footer2r' ) ) : ?>
						     <div id="footer_buttom" class="footer_buttom" role="complementary">
						     	<?php dynamic_sidebar( 'footer2r' ); ?>
						     </div>
					    <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line-separator position-relative"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/footerimg.png" alt=""></div>
	<section class="copy-right">
			<?php  
			$header = get_field('header','option');
			$socials = $header['socials']; ?>
			<div class="container">
				<div class="social-cr">
					<ul class="list-links">
							<?php foreach ($socials as $social) {
							?>
							<li><a href="<?php echo $social['url']?>" target="_blank"><i class="fa fa-<?php echo $social['social_icon']?>"></i></a></li>
							<?php
							}
							?>
					</ul>
				</div>
				<div class="text-cr">
					<?php  echo get_field('content_footer','option') ?>
				</div>
			</div>
	</section>
</div>


<?php wp_footer(); ?>

</body>

</html>

