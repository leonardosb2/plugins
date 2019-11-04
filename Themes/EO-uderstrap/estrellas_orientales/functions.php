<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'aos-css','https://unpkg.com/aos@2.3.1/dist/aos.css' );
    wp_enqueue_style( 'icons-plugin', get_stylesheet_directory_uri() . '/css/icons.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'aos-js','https://unpkg.com/aos@2.3.1/dist/aos.js' );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );
include_once( get_stylesheet_directory() . '/lib/register.php' );
include_once( get_stylesheet_directory() . '/lib/cpt.php' );
include_once( get_stylesheet_directory() . '/lib/custom.php' );
include_once( get_stylesheet_directory() . '/lib/shortcodes.php' );



//ajax players 
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $post_type = $_POST['post_type'];
    $posts_per_page = $_POST['posts_per_page'];
    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'meta_key'		=> 'player_information_player_state',
        'meta_value'	=> 0,
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
<?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
             $info_player=get_field('player_information');
                        $url_image=get_the_post_thumbnail_url();
            ?>
<div class="item-player col-lg-3 col-md-4 col-sm-6">

    <a href="<?php  echo get_the_permalink(); ?>">
        <div class="content-figure"
            style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);">
            <div class="photo-player">
                <img src="<?php  echo $url_image ?>" alt="">
            </div>
            <div class="number-player">
                <h5><?php  echo $info_player['number_player']; ?></h5>
            </div>
            <div class="description">
                <h2><?php the_title(); ?></h2>
                <p><?php  echo $info_player['years']; ?> años / <?php  echo get_field('position')['label']; ?> </p>
            </div>
        </div>
    </a>
</div>
<?php endwhile; ?>
<?php
    endif;
 
    wp_die();
}
//ajax players RETIRED
add_action('wp_ajax_load_py_by_ajax', 'load_py_by_ajax_callback');
add_action('wp_ajax_nopriv_load_py_by_ajax', 'load_py_by_ajax_callback');
function load_py_by_ajax_callback() {
    check_ajax_referer('load_more_retireds', 'security');
    $paged = $_POST['page'];
    $post_type = $_POST['post_type'];
    $posts_per_page = $_POST['posts_per_page'];
    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'meta_key'		=> 'player_information_player_state',
        'meta_value'	=> 1,
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
<?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
             $info_player=get_field('player_information');
                        $url_image=get_the_post_thumbnail_url();
            ?>
<div class="item-player col-lg-3 col-md-4 col-sm-6">

    <a href="<?php  echo get_the_permalink(); ?>">
        <div class="content-figure"
            style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);">
            <div class="photo-player">
                <img src="<?php  echo $url_image ?>" alt="">
            </div>
            <div class="number-player">
                <h5><?php  echo $info_player['number_player']; ?></h5>
            </div>
            <div class="description">
                <h2><?php the_title(); ?></h2>
                <p><?php  echo $info_player['years']; ?> años / <?php  echo get_field('position')['label']; ?> </p>
            </div>
        </div>
    </a>
</div>
<?php endwhile; ?>
<?php
    endif;
 
    wp_die();
}
//photos
add_action('wp_ajax_load_photos_by_ajax', 'load_photos_by_ajax_callback');
add_action('wp_ajax_nopriv_load_photos_by_ajax', 'load_photos_by_ajax_callback');
function load_photos_by_ajax_callback() {
    check_ajax_referer('load_more_photos', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'foto',
        'post_status' => 'publish',
        'posts_per_page' => 4, 
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) :
        ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); 
             $featured_img_box = get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_site_url().'/wp-content/uploads/2019/08/hero-bg.jpg'; 
             $photos = get_field('photos');
             ?>
             <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="post-news post-opinions">
                    <div class="img-post position-relative">
                        <button class="go-to-popup" id="<?php echo get_the_ID(); ?>">
                            <img src="<?php echo $featured_img_box ?>" alt="">
                        </button>
                        <div class="content-popup <?php echo get_the_ID(); ?>">
                            <button class="close">
                                <span class="yotuicon-close"></span>
                            </button>
                            <?php
                           if( $photos ):
                              $counterPhotos = 0; ?>
                            <div class="popup-gallery slide-photos">
                                <?php foreach( $photos as $image ):
                                    $counterPhotos++; ?>
                                <div class="photo-item  " style="background-image:url(<?php echo $image['url']; ?>);">
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; 
                        ?>
                        </div>
                        <p><?php echo $counterPhotos;?> <i class="fa fa-camera"></i></p>

                    </div>
                    <div class="content-post">
                        <p><?php echo get_the_title() ?></p>
                        <p><span><?php echo calculate_time_ago(); /* post date in time ago format */ ?></span></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php
    endif;
 
    wp_die();
}

//AJAX ROASTER
add_action('wp_ajax_roster_ajax', 'roster_ajax_callback');
add_action('wp_ajax_nopriv_roster_ajax', 'roster_ajax_callback');
function roster_ajax_callback() {
  $from = $_POST['from'];
  $to = $_POST['to'];
                  
                  $args = array(
                    'post_type' => 'roster-semanal',
                    'showposts' => -1,
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key'       => 'roster_hasta',
                            'compare'   => '>=',
                            'value'     => $from,
                        ),
                        array(
                            'key'       => 'roster_de',
                            'compare'   => '<=',
                            'value'     => $to,
                        )
                    )
                  );
                  $loop_roster = new WP_Query( $args );
                  if( $loop_roster->have_posts() ) :
                    ?>
<div id="all-players" class="">
    <?php
                      while ( $loop_roster->have_posts() ):
                        $loop_roster->the_post();

                        if( have_rows('catchers') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Catchers</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('catchers') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;

                        if( have_rows('center_field') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Center Field</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('center_field') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;


                        if( have_rows('first_base') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>First Base</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('first_base') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;



                        if( have_rows('left_field') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Left Field</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('left_field') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;


                        if( have_rows('pitcher') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Pitcher</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('pitcher') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;



                        if( have_rows('right_field') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Right Field</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('right_field') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;


                        if( have_rows('second_base') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Second Base</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('second_base') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;


                        if( have_rows('shortstop') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Shortstop</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('shortstop') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;



                        if( have_rows('third_base') ):
                          ?>
    <section class="section-table">
        <div class="container">
            <div class="row align-items-center">
                <h4>Third Base</h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align-last:center;">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICIÓN</th>
                                <th scope="col">B/T</th>
                                <th scope="col">HT</th>
                                <th scope="col">WT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                      while ( have_rows('third_base') ) : the_row();
                                        echo '<tr>';
                                          $p_id = get_sub_field('player');
                                          $p_info = get_field('player_information', $p_id);
                                          echo '<td>'.get_sub_field('nro').'</td>';
                                          echo '<td>'.get_the_title($p_id).'</td>';
                                          echo '<td>'.get_the_title($p_info['team']->ID).'</td>';
                                          echo '<td>'.get_field('position', $p_id)['label'].'</td>';
                                          echo '<td>'.get_sub_field('bt').'</td>';
                                          echo '<td>'.get_sub_field('ht').'</td>';
                                          echo '<td>'.get_sub_field('wt').'</td>';
                                        echo '</tr>';
                                      endwhile;
                                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
                        endif;

                      endwhile;
                      ?>
</div>
<?php
                    wp_reset_query();
                  else:
                    ?>
<h3>Lo sentimos, no se encontraron resultados para esta semana</h3>
<?php
                  endif;

                 


  wp_die();
}


// Load more Matches
add_action('wp_ajax_load_matches_by_ajax', 'load_matches_by_ajax_callback');
add_action('wp_ajax_nopriv_load_matches_by_ajax', 'load_matches_by_ajax_callback');

function load_matches_by_ajax_callback() {
    check_ajax_referer('load_more_matches', 'security');
    $paged = $_POST['page'];
    $paged = $_POST['page'];
    $titleTeam = get_the_ID();
    $date_pr_wp = new DateTime("now", new DateTimeZone('America/Santo_Domingo') );
    $in_text= date( "Y-m-d H:i:s" );
    $date_pr_wp->format("Y-m-d H:i:s");

    if ($_POST['id_post']=="") {
      $args = array(
        'post_type' => 'partido',
        'posts_per_page' => '10',
        'paged' => $paged,
        'post_status' => 'publish',
        'meta_key'          => 'match_day',
        'meta_value'        =>  $date_pr_wp->format("Y-m-d H:i:s"), 
        'meta_compare'      => '<',
        'orderby'           => 'meta_value',
        'order'             => 'DESC'
      );
    }else{
      $args = array(
        'post_type' => 'partido',
        'posts_per_page' => '10',
        'paged' => $paged,
        'meta_key'          => 'match_day',
        'meta_value'        =>  $date_pr_wp->format("Y-m-d H:i:s"), 
        'meta_compare'      => '<',
        'orderby'           => 'meta_value',
        'order'             => 'DESC',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'       => 'game_team_first_team',
                'compare'   => '=',
                'value'     => $_POST['id_post'],
            ),
            array(
                'key'       => 'game_team2_team',
                'compare'   => '=',
                'value'     => $_POST['id_post'],
            )
        )
      );
    }
    
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
<?php while ( $my_posts->have_posts() ) : $my_posts->the_post(); 
         $date = get_field('match_day');
         $date2 = DateTime::createFromFormat('d/m/Y g:i a', $date);
         $fecha_actual = strtotime(date('d-m-Y g:i a'));
         $fecha_entrada = strtotime($date2->format('d-m-Y g:i a'));
         $count++;
         $game_team = get_field('game_team');
         $game_team2 = get_field('game_team2');
         $team=$game_team['first_team'];
         $team2=$game_team2['team'];
        ?>
 <div class="match-n">
            <h2><?php  echo $date2->format('g:i a'); ?></h2>
            <?php  
                if ($date2->format('D')=="Sat") {
                    ?> 
                    <h2 class="sub-title"><?php echo 'Sábado'; echo strftime(" %d %B",$date2->getTimestamp()); ?> - <?php  echo $date2->format('g:i a'); ?></h2><?php
                }else{
                    if ($date2->format('D')=="Wed"){
                        ?> <h2 class="sub-title"><?php echo 'Míercoles'; echo strftime(" %d %B",$date2->getTimestamp()); ?> - <?php  echo $date2->format('g:i a'); ?></h2>  <?php
                    }else{
                        ?> <h2 class="sub-title"><?php  echo strftime("A% %d %B",$date2->getTimestamp()); ?> - <?php  echo $date2->format('g:i a'); ?></h2>  <?php
                    }
                }
            ?>   
            <div class="row row-match">
                <div class="col-lg-5 ">
                    <div class="team-vs">
                        <div class="stadum">
                            <p> <?php  echo get_field('stadium'); ?> - serie regular</p>
                            <?php  
                                        if (current_user_can('administrator')) {
                                            ?>
                            <a href=" <?php  echo get_edit_post_link(); ?>"> Edit</a>
                            <?php
                                        }
                                    ?>
                        </div>
                        <div class="team-n">
                            <div class="row ">
                                <div class="col-2 col-logo-team pr-0">
                                    <img src="<?php echo get_the_post_thumbnail_url($team); ?>" alt="">
                                </div>
                                <div class="col-8">
                                    <h2>
                                        <?php echo get_the_title($team);  ?>
                                    </h2>
                                </div>
                                <div class="col-2">

                                    <h3><?php echo  $game_team['goals1']; ?></h3>
                                </div>
                            </div>
                        </div>
                        <!-- END TEAM N -->
                        <div class="team-n mt-5">
                            <div class="row">
                                <div class="col-2 col-logo-team pr-0">
                                    <img src="<?php echo get_the_post_thumbnail_url($team2); ?>" alt="">
                                </div>
                                <div class="col-8">
                                    <h2><?php echo get_the_title($team2);  ?></h2>
                                </div>
                                <div class="col-2">
                                    <h3><?php echo  $game_team2['goals2']; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 border-left">
                    <div class="content-table">
                        <div class="table-responsive">
                        <table summary="Calendar">
                            <thead>
                                <tr>
                                    <th abbr="Wednesday" scope="col" title="Wednesday">1</th>
                                    <th abbr="Thursday" scope="col" title="Thursday">2</th>
                                    <th abbr="Friday" scope="col" title="Friday">3</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">4</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">5</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">6</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">7</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">8</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">9</th>
                                    <?php  
                                                if ($game_team['team_10'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">10</th> <?php
                                                }
                                                if ($game_team['team_11'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">11</th> <?php
                                                }
                                                if ($game_team['team_12'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">12</th> <?php
                                                }
                                                if ($game_team['team_13'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">13</th> <?php
                                                }
                                                if ($game_team['team_14'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">14</th> <?php
                                                }
                                                if ($game_team['team_15'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">15</th> <?php
                                                }
                                                if ($game_team['team_16'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">16</th> <?php
                                                }
                                                if ($game_team['team_17'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">17</th> <?php
                                                }
                                            ?>
                                    <th abbr="Saturday" scope="col" title="Saturday">R</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">H</th>
                                    <th abbr="Saturday" scope="col" title="Saturday">E</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php  
                                                array_shift($game_team);
                                                array_pop($game_team);
                                                array_pop($game_team);
                                                $countc=0;
                                                foreach($game_team as $value){
                                                    $countc++;
                                                    if ($value!=='') {
                                                        ?>
                                    <td><?php echo  $value; ?></td>
                                    <?php
                                                    }else{
                                                        if ($countc<=9) {
                                                            ?> <td>0</td> <?php
                                                        }
                                                    }
                                                  }
                                            ?>
                                </tr>
                                <tr>
                                    <?php  
                                                array_shift($game_team2);
                                                array_pop($game_team2);
                                                array_pop($game_team2);
                                                $countc=0;
                                                foreach($game_team2 as $value){
                                                    $countc++;
                                                    if ($value!=='') {
                                                        ?>
                                    <td><?php echo  $value; ?></td>
                                    <?php
                                                    }else{
                                                        if ($countc<=9) {
                                                            ?> <td>0</td> <?php
                                                        }
                                                    }
                                                  }
                                            ?>
                                </tr>
                            </tbody>
                        </table>
                        </div>                
                        
                    </div>
                </div>
                <a class="share face" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                    class="sbtn facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook-f"></i></a>
                <a class="share twiter"
                    href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title_attribute(); ?>"
                    class="sbtn twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>
            </div>
        </div>
<?php endwhile; ?>
<?php
    endif;
 
    wp_die();
}

add_filter('acf/location/rule_types', 'acf_location_rules_types', 999);
function acf_location_rules_types($choices) {
    // create a new group for the rules called Terms
    // if it does not already exist
    if (!isset($choices['Terms'])) {
        $choices['Terms'] = array();
    }
    // create new rule type in the new group
    $choices['Terms']['category_id'] = 'Category Name';
    return $choices;
}

add_filter('acf/location/rule_values/category_id', 'acf_location_rules_values_category');
function acf_location_rules_values_category($choices) {
    // get terms and build choices
    $taxonomy = 'category';
    $args = array('hide_empty' => false);
    $terms = get_terms($taxonomy, $args);
    if (count($terms)) {
        foreach ($terms as $term) {
            $choices[$term->term_id] = $term->name;
        }
    }
    return $choices;
}
add_filter('acf/location/rule_match/category_id', 'acf_location_rules_match_category', 10, 3);
function acf_location_rules_match_category($match, $rule, $options) {
    if (!isset($_GET['tag_ID']) || 
            !isset($_GET['taxonomy']) || 
            $_GET['taxonomy'] != 'category') {
        // bail early
        return $match;
    }
    $term_id = $_GET['tag_ID'];
    $selected_term = $rule['value'];
    if ($rule['operator'] == '==') {
        $match = ($selected_term == $term_id);
    } elseif ($rule['operator'] == '!=') {
        $match = ($selected_term != $term_id);
    }
    return $match;
}



function hide_banner_advertising() {
    $hide_banner_top = get_field('hide_banner_top','option');
    $hide_banner_middle = get_field('hide_banner_middle','option');
    $hide_banner_bottom = get_field('hide_banner_bottom','option');
    $hideTopAds = '<style>
                .banner-content img{display:none;}
                </style>';
    $hideMidAds = '<style>
                .middle-ads{display:none;}
                </style>';
    $hideBotAds = '<style>
                .banner-content img{display:none;}
                </style>';
    if( $hide_banner_top == 'yes' ):
         echo $hideTopAds;
    endif; 
    if( $hide_banner_middle == 'yes' ):
        echo $hideMidAds;
    endif; 
    if( $hide_banner_bottom == 'yes' ):
        echo $hideBotAds;
    endif;
}
//add_filter('the_generator', 'hide_banner_advertising');