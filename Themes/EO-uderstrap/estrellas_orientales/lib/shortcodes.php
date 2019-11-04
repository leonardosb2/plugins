<?php  
function net_match_sc(){
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
					<div class="top-text">
						<p>PRÓXIMO PARTIDO</p>
					</div>
				   <div class="next-mach">
							<div class="header_mach">
								<?php  
								if ($date2->format('D')=="Sat") {
									?> <span><?php  echo strftime("Sábado",$date2->getTimestamp());?></span><?php
								}else{
									?> <span><?php  echo strftime("%A",$date2->getTimestamp());?></span>  <?php
								}
								?>  
								<h3 class="date"><strong><?php  echo strftime("%d ",$date2->getTimestamp()); ?></strong> <?php  echo strftime("%B",$date2->getTimestamp()); ?></h3>
							</div>
							<p class="serie"><?php  echo get_field('season_game'); ?></p>
							<div class="vs_teams">
								<div class="row">
									<div class="col-5 text-center pr-0 ">
										<img class="img-team1" src="<?php echo get_the_post_thumbnail_url($team); ?>" alt="">
									</div>
									<div class="col-1 text-center ">
										<div class="d-flex h-100">
											<span class="text-vs m-auto">VS</span>
										</div>
									</div>
									<div class="col-5 text-center pr-0">
										<img class="img-team2" src="<?php echo get_the_post_thumbnail_url($team2); ?>" alt="">
									</div>
								</div>
							</div>
							<div class="date_place">
								<h4><?php  echo $date2->format('g:i'); ?>  <span><?php  echo $date2->format('A'); ?></span></h4>
								<p><?php  echo get_field('stadium'); ?></p>
							</div>
					</div>
					<?php  
				   break;
				}
			}
			?>
        <?php
    }
add_shortcode( 'match', 'net_match_sc' );
function subcribe_videos(){
	?> 
		<div class="widget-form">
		</div>
	<?php
}
add_shortcode( 'subscription_form', 'subcribe_videos' );
?>