<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$banner_top_page = get_field('banner_top_page'); 
$banner_top = get_field('banner_top','option');
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<div class="breadcrumb">
		<div class="container">
			<?php get_breadcrumb(); ?>
		</div>
	</div> 
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:15px;';}?>">  
					<div class="banner-content">
							<?php echo get_field('banner_top_page'); ?>
					</div>
				</section>
				<section class="section-single">
					<h2 class="text-uppercase"><?php  $category = get_the_category();echo $category[0]->cat_name; ?></h2>
					<div class="img-post">
						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
					</div>
					<div class="info-post">
						<div class="row">
							<div class="col-md-8">
								<p class="by-author text-uppercase">ESCRITO POR<span class="author"> <?php echo  get_author_name(); ?></span> <?php  echo get_the_date(); ?> </p>
							</div>
							<div class="col-md-4 text-right text-uppercase">
								<?php
								  the_category(); 
								?>	
							</div>
						</div>
					</div>
					<h3><?php  the_title(); ?></h3>
					<div class="content-post">
						<?php  the_content(); ?>
					</div>
				</section>
				<?php
					$author_opinion_image = get_field('author_opinion_image', 'category_'.get_queried_object_id().'');
					$author_name = get_field('author_name', 'category_'.get_queried_object_id().'');
					$content_opinion = get_field('content_opinion', 'category_'.get_queried_object_id().'');
					$user_description = get_the_author_meta( 'user_description', $post->post_author );
				?>
				<div class="written-by">
					<!-- <img src="<?php echo $author_opinion_image ?>" alt="Author"> -->
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
                    <div class="opinion-content">
						<h4>Escrito por <span class="author-name"><?php the_author(); ?></span></h4>
						<?php if($user_description): ?>
							<p><?php echo $user_description ?></p>
						<?php endif; ?>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="btn black">Ver todas sus publicaciones</a>
                    </div>
                </div>
				<div class="line-separator position-relative separator-small">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/images/footerimg.png" alt="">
				</div>
				<section class="section-last-photos" >
					<div class="container">
						<div>
							<h2>LO ÚLTIMO</h2>
						</div>
						<?php
					$args = array(  
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' => 'DESC',
						'post__not_in'           => array(get_the_ID()),
					);
					$loop = new WP_Query( $args ); ?>
					<div class="row"> <?php
					while ( $loop->have_posts() ) : $loop->the_post(); 
					$featured_img_box = get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_site_url().'/wp-content/uploads/2019/08/hero-bg.jpg'; 
					$photos = get_field('photos');
					?>
							<div class="col-lg-4 col-md-4 col-sm-6 mb-4">
								<div class="post-news post-opinions">
									
									<a class="text-decoration-none" href="<?php  echo get_the_permalink(); ?>">
										<div class="img-post position-relative">
											<button  class="go-to-popup" id="<?php echo get_the_ID(); ?>">
												<img src="<?php echo $featured_img_box ?>" alt="">
											</button>
										</div>
										<div class="content-post text-center">
											<p><?php echo get_the_title() ?></p>
											<p><span><?php echo wp_relative_date(); /* post date in time ago format */ ?></span></p>
										</div>
									</a>
								</div>
							</div>
							<?php
					endwhile; ?>
					</div>
					<?php
					wp_reset_postdata();
					?>
					</div>
				</section>
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
</article><!-- #post-## -->
