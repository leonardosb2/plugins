<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$banner_top = get_field('banner_top','option');
$banner_adsense_middle = get_field('banner_adsense_middle','option');
$hide_banner_top = get_field('hide_banner_top','option');
$hide_banner_middle = get_field('hide_banner_middle','option');
$hide_banner_bottom = get_field('hide_banner_bottom','option');

$today=date("d/m/Y");
$todayDate = DateTime::createFromFormat('d/m/Y', $today);
$todaymore = $todayDate->format('Y-m-d');
?>
<section class="banner-content top-banner" data-aos="fade-up">
   <div class="container">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<div class="bg-post" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bg-slider.jpg);">
    <div class="container">
        <div class="row">
            <!-- Slider -->
            <div class="col-md-12 col-lg-9">
                <?php  
                $args = array(
                    'post_type' => 'post',
                    'offset' => 0,
                    'posts_per_page' => 12,
                );
                $post_query = new WP_Query($args); 
            ?>
                <section class="section-page-news">
                    <div class="post-slider">
                        <?php  
                        if($post_query->have_posts() ) {
                            while($post_query->have_posts() ) {
                              $post_query->the_post();
                              ?>
                        <!-- <h2><?php the_title(); ?></h2> -->
                        <div class="item" style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                            <div class="item-content">
                                <h2><?php the_title(); ?></h2>
                                <p>
                                    <?php  echo get_the_excerpt(); ?>
                                </p>
                                <a class="link-post" href="<?php echo get_the_permalink(); ?>">leer la noticia
                                    completa</a>
                                <i class=""></i>
                            </div>
                        </div>
                        <?php
                            }
                        }wp_reset_query(); 
                    ?>
                    </div>
                    <div class="slider-nav">
                        <?php  
                     $argsNav = array(
                        'post_type' => 'post',
                        'offset' => 1,
                        'posts_per_page' => 12,
                     );
                    $post_queryNav = new WP_Query($argsNav); 
                        $count=0;
                        if($post_queryNav->have_posts() ) {
                            while($post_queryNav->have_posts() ) {
                              $post_queryNav->the_post();
                              $count++;
                              if ($count==2) {
                                 ?>
                        <div class="item type2 p-0"
                            style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                            <div class="post-down">
                                <h5><?php the_title(); ?></h5>
                            </div>
                        </div>

                        <?php $count=0;
                              }else{
                                 ?>
                        <div class=" item type1">
                            <div class="post-down mr-2"
                                style="background-image: url(<?php echo get_the_post_thumbnail_url()?>);">
                                <h4><?php the_title(); ?></h4>
                            </div>
                        </div>
                        <?php
                              }
                              
                            }
                        }wp_reset_query(); 
                    ?>
                    </div>

                </section>
            </div>

            <!-- / Slider -->
            <div class="recent-posts col-md-12 col-lg-3">
                <h3>Lo más reciente</h3>
                <?php  
               $post_query_cpts = array(
                  'post_type' => array('foto','post'),
                  'orderby' => 'publish_date',
                  'order' => 'DESC',
                  'posts_per_page' => 7,
              );
              $loop_post_cpts = new WP_Query($post_query_cpts); 
              while ( $loop_post_cpts->have_posts() ){
               $loop_post_cpts->the_post();
               $url_featured=get_the_post_thumbnail_url();
                  ?>
                <div class="item">
                    <?php  
                        $title= explode(' ',get_the_title(), 10);
                        array_pop($title);
                        $title = implode(" ",$title)."...";
                    ?>
                    <a class="hedline" href="<?php  echo get_the_permalink(); ?>"><?php echo $title;   ?></a>
                    <?php  $postType = get_post_type_object(get_post_type());
                     if ($postType) {
                        if ("Post"==esc_html($postType->labels->singular_name)) {
                           ?> <a href="<?php  echo get_the_permalink(); ?>">Noticias</a> <?php
                        }else{
                           ?>
                    <button class="go-to-popup" id="<?php echo get_the_ID(); ?>">
                        Fotos
                    </button>
                    <div class="content-popup <?php echo get_the_ID(); ?>">
                        <button class="close">
                            <span class="yotuicon-close"></span>
                        </button>
                        <?php
                           $photos = get_field('photos');
                           if( $photos ):
                              $counterPhotos = 0; ?>
                        <div class="popup-gallery slide-photos">
                            <?php foreach( $photos as $image ):
                                    $counterPhotos++; ?>
                            <div class="photo-item" style="background-image:url(<?php echo $image['url']; ?>);">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; 
                        ?>
                    </div>
                    <?php
                        }
                     } ?>

                </div>
                <?php
               }wp_reset_query();
               ?>
            </div>
        </div>
    </div>
</div>

<div class="container timer-content">

    <?php  
        $date_pr_wp = new DateTime("now", new DateTimeZone('America/Santo_Domingo') );
        $in_text= date( "Y-m-d H:i:s" );
        $date_pr_wp->format("Y-m-d H:i:s");
        $myArray = array();
        $loop2 = new WP_Query( array(
            'post_type' => 'partido',
            'meta_key'          => 'match_day',
            'meta_value'        => $date_pr_wp->format("Y-m-d H:i:s"), 
           'meta_compare'      => '>',
           'orderby'           => 'meta_value',
           'order'             => 'ASC'
       )
     );
     $count_date=1;
      while ( $loop2->have_posts() ){
            setlocale(LC_ALL,"es_ES");
            $loop2->the_post();
            $date = get_field('match_day');
            $date2 = DateTime::createFromFormat('d/m/Y g:i a', $date);
            $fecha_actual = strtotime(date('d-m-Y g:i a'));
            $fecha_entrada = strtotime($date2->format('d-m-Y g:i a'));
            if ($fecha_actual<$fecha_entrada) {
               array_push($myArray,$date2->format('d-m-Y g:i a'));
            }
            if($count_date == 1){
                $date_pr = new DateTime("now", new DateTimeZone('America/Puerto_Rico') );
                $date_game = get_field('match_day');
                $date_game2 = DateTime::createFromFormat('d/m/Y g:i a', $date_game);
                $count_date++;
            }
      }
      wp_reset_query(); 
      $testdate=date('d-m-Y g:i a');
      
      
      if (empty($myArray)) {
         echo '<p class="so-close" style="
         opacity: 0;
         height: 0;
         margin: 0;">nodate</p>';
      }else{
         // echo "<PRE>";print_r($myArray);echo "</PRE>";
         $dateclose=find_closest($myArray, $testdate);
         $date_regresive = DateTime::createFromFormat('d-m-Y g:i a', $dateclose);
         echo '<p class="so-close" style="
         opacity: 0;
         height: 0;
         margin: 0;">'.$date_game2->format("m d, Y H:i:s").'</p>'
         ;
         
      }
     
   ?>

    <div class="timer">
        <h6>Próximo partido</h6>
        <p class="so-close2" style="
         opacity: 0;
         height: 0;
         margin: 0;"> <?php  echo $date_game2->format("D M d Y").' '.$date_game2->format("H:i:s"); ?></p>
        <ul>
            <li><span id="days">00</span>días</li>
            <li><span id="hours">00</span>horas</li>
            <li><span id="minutes">00</span>minutos</li>
            <li><span id="seconds">00</span>segundos</li>
        </ul>
    </div>
    <script>
    jQuery(document).ready(function() {
        //so close match
        
        function isIphone() {
            if (navigator.userAgent.match(/(iPhone|iPod|iPad)/) != null) {
                return true;
            }
            return false;
        }
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf('safari') != -1) {
            if (ua.indexOf('chrome') > -1) {
                var browser = 1 // Chrome
            } else {
                var browser = 2;
            }
        }
        if (isIphone() || browser == 2) {
            if (jQuery(".so-close2").length > 0) {
                var datejs = jQuery('.so-close').text();
                if (datejs == "nodate") {
                    jQuery('.timer').css('opacity', '0');
                } else {
                    let countDown = Date.parse(jQuery('.so-close2').text());
                    var d = new Date();
                    // alert(countDown+"---->"+jQuery('.so-close2').text()+"--->"+d);
                    const second = 1000,
                        minute = second * 60,
                        hour = minute * 60,
                        day = hour * 24;
                    // let countDown = new Date(datejs).getTime(),
                    x = setInterval(function() {
                        let now = new Date().getTime();
                        distance = countDown - now;
                        document.getElementById('days').innerText = pad(Math.floor(distance / (day))),
                            document.getElementById('hours').innerText = pad(Math.floor((distance % (
                                day)) / (hour))),
                            document.getElementById('minutes').innerText = pad(Math.floor((distance % (
                                hour)) / (minute))),
                            document.getElementById('seconds').innerText = pad(Math.floor((distance % (
                                minute)) / second));
                             if(pad(Math.floor(distance / (day))) == 0 && pad(Math.floor((distance % (day)) / (hour))) == 0 && pad(Math.floor((distance % (hour)) / (minute))) == 0 && pad(Math.floor((distance % (minute)) / second)) == 0 ){
                                stopInterval();
                             }
                    }, second);
                    function stopInterval() {
                        clearInterval(x);
                    }
                }
            }
        } else {

            if (jQuery(".so-close").length > 0) {
                var datejs = jQuery('.so-close').text();
                if (datejs == "nodate") {
                    jQuery('.timer').css('opacity', '0');
                } else {
                    const second = 1000,
                        minute = second * 60,
                        hour = minute * 60,
                        day = hour * 24;
                    let countDown = new Date(datejs).getTime(),
                        x = setInterval(function() {
                            let now = new Date().getTime(),
                                distance = countDown - now;
                            document.getElementById('days').innerText = pad(Math.floor(distance / (day))),
                                document.getElementById('hours').innerText = pad(Math.floor((distance % (
                                    day)) / (hour))),
                                document.getElementById('minutes').innerText = pad(Math.floor((distance % (
                                    hour)) / (minute))),
                                document.getElementById('seconds').innerText = pad(Math.floor((distance % (
                                    minute)) / second));
                            if(pad(Math.floor(distance / (day))) == 0 && pad(Math.floor((distance % (day)) / (hour))) == 0 && pad(Math.floor((distance % (hour)) / (minute))) == 0 && pad(Math.floor((distance % (minute)) / second)) == 0 ){
                                stopInterval();
                            }
                        }, second);
                        function stopInterval() {
                            clearInterval(x);
                        }
                }
            }
        }
        
    });
    </script>
</div>
<?php  
      $loop_order = new WP_Query( array(
        'post_type' => 'partido',
        'meta_key'          => 'match_day',
        'meta_value'        => $date_pr_wp->format("Y-m-d H:i:s"), 
       'meta_compare'      => '>',
       'orderby'           => 'meta_value',
       'order'             => 'ASC'
       )
      );
      
      ?>

<section class="container wrap-content games-slider" data-aos="fade-up">
    <div class="float-content">
        <div class="header-title">
            <h6>juegos</h6>
            <a class="btn black" href="<?php echo get_site_url() ?>/calendario">Ver Calendario</a>
        </div>
    </div>
    <div class="carousel-games">
        <?php  
         $res="";
          while ( $loop_order->have_posts() ){
            
            $loop_order->the_post();
            $date = get_field('match_day');
            $date2 = DateTime::createFromFormat('d/m/Y g:i a', $date);
            $game_team = get_field('game_team');
            $game_team2 = get_field('game_team2');
            $team=$game_team['first_team'];
            $team2=$game_team2['team'];
            setlocale(LC_ALL,"es_ES");
            ?>
        <?php  
               $fecha_actual = strtotime(date('d-m-Y g:i a'));
               $fecha_entrada = strtotime($date2->format('d-m-Y g:i a'));               
            //    if ($fecha_actual<$fecha_entrada) {

            //       ?>
        <div class="box">
        <?php $stadiumMatch = get_field('stadium'); ?>
        <!-- <?php if(strpos($stadiumMatch, 'Tetelo Vargas') !== false): echo 'telelo-match'; endif; ?> -->
            <div class="box-header ">
                        <?php  
                              if ($date2->format('D')=="Sat") {
                                ?> <p><?php  echo strftime("Sábado",$date2->getTimestamp());?></p> <?php
                              }else{
                                if ($date2->format('D')=="Wed"){
                                    ?> <p><?php  echo strftime("Míercoles",$date2->getTimestamp());?></p> <?php
                                }else{
                                    ?> <p><?php  echo strftime("%A",$date2->getTimestamp());?></p> <?php
                                }
                              }
                           ?>
                <h6><?php  echo strftime("%d %B",$date2->getTimestamp()); ?></h6>
                <!-- <a href="<?php  echo get_the_permalink() ?>">esto</a>  -->
            </div>
           
            <div class="box-body">
                <p><?php  echo get_field('season_game'); ?></p>
                <div class="img-content">
                    <div class="row">
                        <div class="col-5 pr-0">
                            <div class="d-flex h-100">
                                <img class="m-auto" src="<?php echo get_the_post_thumbnail_url($team); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-2 p-0">
                            <div class="d-flex h-100">
                                <span class="text-vs m-auto ">VS</span>
                            </div>
                        </div>
                        <div class="col-5 pl-3 pr-0">
                            <div class="d-flex h-100">
                                <img src="<?php echo get_the_post_thumbnail_url($team2); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <b><?php  echo $date2->format('g:i'); ?> <span><?php  echo $date2->format('A'); ?></span></b>
                <p class="mb-0 mt-1"><?php  echo get_field('stadium'); ?></p>
            </div>
        </div>

        <?php

                  
            //    }else{
            //       $res.='
            //             <div class="box">
            //                <div class="box-header">
            //                   <p>'.strftime("%A",$date2->getTimestamp()).'</p>
            //                   <h6>'. strftime("%d %B",$date2->getTimestamp()).'</h6>
            //                   <a href="'.get_the_permalink().'">pasado</a>
            //                </div>
            //                <div class="box-body">
            //                   <p>'.get_field('season_game').'</p>
            //                   <div class="img-content">
            //                      <div class="row">
            //                         <div class="col-5">
            //                            <img src="'.get_the_post_thumbnail_url($team).'" alt="">
            //                         </div>
            //                         <div class="col-2 p-0">
            //                            <div class="d-flex h-100">
            //                               <span class="text-vs m-auto " >VS</span>
            //                            </div>
            //                         </div>
            //                         <div class="col-5">
            //                            <img src="'.get_the_post_thumbnail_url($team2).'" alt="">
            //                         </div>
            //                      </div>
            //                   </div>
            //                   <b>'. $date2->format('g:i').'<span>'.$date2->format('A').'</span></b>
            //                   <strong>'.get_field('stadium').'</strong>
            //                </div>
            //             </div>';
            //    } 
            ?>

        <?php 
         } 
         // echo $res;  
         wp_reset_postdata();
               
      ?>
    </div>
</section>
<section class="card-wrap middle-ads">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <?php echo $banner_adsense_middle['banner_1']; ?>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <?php echo $banner_adsense_middle['banner_2']; ?>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <?php echo $banner_adsense_middle['banner_3']; ?>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <?php echo $banner_adsense_middle['banner_4']; ?>
            </div>
        </div>
    </div>
    <div class="line-separator  position-relative separator-small">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footerimg.png" alt="">
    </div>
</section>

<?php 
   $title_videos_slider = get_field('title_videos_slider','option');
   $link_more_videos = get_field('link_more_videos','option');
   $link_subscribe = get_field('link_subscribe','option');
?>
<section class="section-videos-yt videos-section"
    style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bg-videos.png);">
    <div class="youtube-links">
        <h3 class="text-center"><?php echo $title_videos_slider ?></h3>
    </div>
    <?php //echo do_shortcode('[yotuwp type="playlist" id="PLF9I_81o3H9WcKHfVHS9RExiIfm0N_93I" column="4" template="list"]'); ?>
    <?php
      $youtube_channel = get_field('youtube_channel', 'option');
      
      echo do_shortcode('[yotuwp type="channel" id="'.$youtube_channel.'" pagination="off" column="4" template="list"]'); ?>
    <div class="btn-content">
        <?php
      if( $link_more_videos ): 
         $link_url = $link_more_videos['url'];
         $link_title = $link_more_videos['title'];
         $link_target = $link_more_videos['target'] ? $link_more_videos['target'] : '_self';
         ?>
        <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary"
            target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
        <?php endif; 
      if( $link_subscribe ): 
         $link_url = $link_subscribe['url'];
         $link_title = $link_subscribe['title'];
         $link_target = $link_subscribe['target'] ? $link_subscribe['target'] : '_self';
         ?>
        <a href="<?php echo esc_url($link_url); ?>" class="btn btn-primary red"
            target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title ?></a>
        <?php endif; ?>
    </div>
</section>
<section class="last-game">
    <div class="container">
    
    </div>
</section>



<section class="section-table"
    style="background-image:url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bg-slider.jpg);"
    data-aos="fade-up">

    <?php 
   $table_teams = get_field('table_teams','option');
   $order = array();
   foreach( $table_teams as $i => $row ) {
      $order[ $i ] = $row['dif_repiter'];
   }
   array_multisort( $order, SORT_ASC, $table_teams );
   ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 left-content">
                <h4>livestream via</h4>
                <img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/dr.png" alt="dr sports">
                <a href="<?php  echo get_field('link_match'); ?>" class="btn btn-primary blue" tabindex="-1"
                    target="_blank">¡SÍNTONIZA EL PARTIDO!</a>
            </div>
            <div class="col-md-7 pt-lg-0 pt-5">
                <h4>posiciones <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h4>
                <div class="table-responsive">
                    <table class="table sortable">
                        <thead>
                            <tr>
                                <th scope="col">POS</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">J</th>
                                <th scope="col">G</th>
                                <th scope="col">P</th>
                                <th scope="col">PCT</th>
                                <th scope="col">DIF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                     $position=0;
                     foreach ($table_teams as $elements) {
                        $position++;
                        $team_post= $elements['team'];
                        $j_repiter = $elements['j_repiter'];
                        $g_repiter = $elements['g_repiter'];
                        $p_repiter= $elements['p_repiter'];
                        $pct_repiter = $elements['pct_repiter'];
                        $dif_repiter = $elements['dif_repiter'];
                        $url_img=get_the_post_thumbnail_url($team_post->ID);
                        ?>
                            <tr>
                                <th scope="row"><?php  echo $position; ?></th>
                                <td>
                                    <p><img src="<?php echo $url_img; ?>" alt="stars"></p>
                                    <?php  echo $team_post->post_title; ?>
                                </td>
                                <td><?php  echo $j_repiter; ?></td>
                                <td><?php  echo $g_repiter; ?></td>
                                <td><?php  echo $p_repiter; ?></td>
                                <td><?php  echo $pct_repiter; ?></td>
                                <td><?php  echo $dif_repiter ; ?></td>
                            </tr>
                            <?php
                            ?> testee  <?php
                            ?> <style>
                            .su-box.su-box-style-default {
                                border: none !important;
                            }
                        </style>  <?php
                     }
                     ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-last-news" data-aos="fade-up">
    <?php  
         $post_query_category = array(
            'post_type' => 'post',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'posts_per_page' => 4,
      );
      $loop_post_c = new WP_Query($post_query_category);     
   ?>
    <div class="container">
        <div class="top-cta">
            <h2>ÚLTIMAS NOTICIAS</h2>
            <a class="btn black" href="<?php echo get_site_url() ?>/noticias">Ver más NOTICIAS</a>
        </div>
        <div class="row">
            <?php  
            while ( $loop_post_c->have_posts() ){
            $loop_post_c->the_post();
            $url_featured=get_the_post_thumbnail_url();
               ?>
            <div class="col-sm-6 mb-4">
                <a href="<?php  echo get_the_permalink(); ?>" class="post-news post-opinions">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="img-post h-100">
                                <img src="<?php  echo $url_featured ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 p-0">
                            <div class="content-post">
                                <p><span><?php  echo get_the_date(); ?></span></p>
                                <p class="title-post-all"><?php  the_title(); ?></p>
                                <p>
                                    <?php   excerpt(10); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <?php
            }wp_reset_query();
         ?>
            <!-- END COLUMN M6 -->
        </div>
    </div>
</section>

<div class="line-separator position-relative separator-small">
    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/footerimg.png" alt="">
</div>

<section class="section-last-photos">
    <div class="container">
        <div class="top-cta">
            <h2>ÚLTIMAS FOTOS</h2>
            <a class="btn black" href="<?php echo get_site_url() ?>/fotos/">Ver más FOTOS</a>
        </div>
        <?php
   $args = array(  
       'post_type' => 'foto',
       'post_status' => 'publish',
       'posts_per_page' => 4,
       'orderby' => 'date',
       'order' => 'DESC',
   );
   $loop = new WP_Query( $args ); ?>
        <div class="row"> <?php
   while ( $loop->have_posts() ) : $loop->the_post(); 
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
                                <div class="photo-item" style="background-image:url(<?php echo $image['url']; ?>);">
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; 
                        ?>
                        </div>
                        <p><?php echo $counterPhotos;?> <i class="fa fa-camera"></i></p>

                    </div>
                    <div class="content-post">
                        <p class="excerpt-all"><?php echo get_the_title() ?></p>
                        <p><span><?php echo calculate_time_ago(); /* post date in time ago format */ ?></span></p>
                    </div>
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

<!-- END FLEXIBLE CONTENT FOR NOW -->


<!-- / Section table -->
<!-- Section Bottom -->


<section class="section-publici" 
    style="background-color:<?php  echo get_field('background_color') ?>;">
    <div class="container">
        <div class="banner-content">
            <a href="<?php echo get_field('banner_link_home'); ?>">
                <img src="<?php echo get_field('image_banner'); ?>" alt="banner">
            </a> 
        </div>
    </div>
</section>
<?php  
         $args = array(  
            'post_type' => 'jugador',
            'post_status' => 'publish',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'meta_key'		=> 'player_information_player_state',
            'meta_value'	=> 0,
        );
      $players2 = new WP_Query( $args ); 
      $players=get_field('select_players');
      $postsl=  $players;
?>    
<section class="section-single-players home-player"
    style="background-image:url(<?php  echo get_stylesheet_directory_uri(); ?>/images/bgsp.jpg);" data-aos="fade-up">
    <div class="container">
        <div class="slider-current-players">
            <?php  
            $count=0;
            foreach( $players as $post){ 
            setup_postdata($post); 
            $info_player=get_field('player_information');
            $url_image=get_the_post_thumbnail_url();
               if (!$info_player['player_state']) {
                  ?>
            <div class="item-slider-p">
                <div class="content-s-player">
                    <h4><?php  echo $info_player['nickname']; ?></h4>
                    <h2><?php  echo $info_player['number_player']; ?></h2>
                    <h3><span><?php  echo $info_player['name_player']; ?></span>
                        <?php  echo $info_player['last_name_player']; ?></h3>
                    <p><?php  echo CalculaEdad($info_player['birthday_player']); ?> años/
                        <?php  echo get_field('position')['label']; ?> </p>
                    <!-- <ul class="list-faces">
                           <li>
                              <img src="<?php  echo $info_player['photo']; ?>" alt="">
                           </li>
                        </ul> -->
                    <div class="img-center-player">
                        <?php  
                                $count++;
                                if ( $count>=sizeof($postsl)) {
                                 $count=0;
                                }
                                 $shadow3 =$postsl[$count]->ID;
                                 $shadow2 =$postsl[ $count+1]->ID;
                                 $shadow3_url=get_the_post_thumbnail_url($shadow3);
                                 $shadow2_url=get_the_post_thumbnail_url($shadow2);
                           ?>
                        <img class="shadow3" src="<?php  echo $shadow2_url; ?>" alt="">
                        <img class="shadow2" src="<?php  echo $shadow3_url; ?>" alt="">
                        <img src="<?php  echo $url_image; ?>" alt="">
                        <div class="number-player">
                            <h5><?php  echo $info_player['number_player']; ?></h5>
                        </div>
                        <a class="btn black seachs" style="z-index:100;"
                            href="<?php echo get_site_url()?>/jugadores">Ver más jugadores</a>
                    </div>
                </div>
            </div><!-- end item-slider-p -->
            <?php
               }
            }wp_reset_query();
         ?>
        </div>
        <ul class="list-faces slider-nav-players">
            <?php
      $counterData = 1;
      foreach( $players as $post){ 
        setup_postdata($post); 
         $info_player=get_field('player_information');
         if (!$info_player['player_state']) { ?>

            <li>
                <a href="javascript:;" data-slide="<?php echo $counterData; ?>"> <img
                        src="<?php  echo $info_player['photo']; ?>" alt=""></a>
            </li>
            <?php
         $counterData++;
         }
      }
      ?>
        </ul>
    </div>
</section>
<?php  
      // Query Linterna verde
      $post_query_category_lintern = array(
         'post_type' => 'post',
         'category_name' => 'linterna-verde',
         'orderby' => 'publish_date',
         'order' => 'DESC',
         'posts_per_page' => 2,
     );
     $loop_post_opinion_lintern = new WP_Query($post_query_category_lintern);   
     // Query Verde Olivo
     $post_query_category_olivo = array(
      'post_type' => 'post',
      'category_name' => 'al-verde-olivo',
      'orderby' => 'publish_date',
      'order' => 'DESC',
      'posts_per_page' => 2,
      );
      $loop_post_opinion_olivo = new WP_Query($post_query_category_olivo);   
      $tuto=array(
         'post_type' => 'post',
         'category_name' => 'como-tuto-lo-ve',
         'post_status' => 'publish',
         'posts_per_page' => 2,
         'paged' => 1,  
      );  
      $loop_tuto = new WP_Query($tuto);   
?>
<section class="section-opinions" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center">OPINIONES</h2>
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-3">
                <h3>LINTERNA VERDE</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <?php  
               if ( $loop_post_opinion_lintern->have_posts() ) : 
                  while ( $loop_post_opinion_lintern->have_posts() ):
                  $loop_post_opinion_lintern->the_post();
                  $url_featured=get_the_post_thumbnail_url();
               ?>
                        <a href="<?php  echo get_the_permalink(); ?>" class="post-news post-opinions">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="img-post h-100">
                                        <img src="<?php echo  $url_featured?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7 p-0">
                                    <div class="content-post">
                                        <p><span><?php  echo get_the_date(); ?></span></p>
                                        <p class="title-post-all"><?php  the_title(); ?></p>
                                        <p><?php excerpt(10); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <?php  
                 endwhile;
               endif;
               ?>
                    </div>
                </div>
            </div>
            <!-- END COLUMN M6 -->
            <div class="col-md-4 col-sm-6 mb-3">
                <h3>AL VERDE OLIVO</h3>
                <div class="row">
                    <div class="col-12">
                        <?php  
               if ( $loop_post_opinion_olivo->have_posts() ) : 
                  while ( $loop_post_opinion_olivo->have_posts() ):
                  $loop_post_opinion_olivo->the_post();
                  $url_featured=get_the_post_thumbnail_url();
               ?>
                        <a href="<?php  echo get_the_permalink(); ?>" class="post-news post-opinions">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="img-post h-100">
                                        <img src="<?php echo  $url_featured?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7 p-0">
                                    <div class="content-post">
                                        <p><span><?php  echo get_the_date(); ?></span></p>
                                        <p class="title-post-all"><?php  the_title(); ?></p>
                                        <p><?php excerpt(10); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php  
                 endwhile;
               endif;
               ?>
                    </div>
                </div>
            </div>
            <!-- END COLUMN M6 -->
            <div class="col-md-4 col-sm-6 mb-3">
                <h3>COMO TUTO LO VE</h3>
                <div class="row">
                    <div class="col-12">
                        <?php  
                        if ( $loop_tuto->have_posts() ) : 
                            while ( $loop_tuto->have_posts() ):
                            $loop_tuto->the_post();
                            $url_featured=get_the_post_thumbnail_url();
                        ?>
                        <a href="<?php  echo get_the_permalink(); ?>" class="post-news post-opinions">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="img-post h-100">
                                        <img src="<?php echo  $url_featured?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7 p-0">
                                    <div class="content-post">
                                        <p><span><?php  echo get_the_date(); ?></span></p>
                                        <p class="title-post-all"><?php  the_title(); ?></p>
                                        <p><?php excerpt(10); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php  
                 endwhile;
               endif;
               ?>
                    </div>
                </div>
            </div>
            <!-- END COLUMN M6 -->
        </div>
        <div class="text-center">
            <a href="<?php echo get_site_url() ?>/opiniones" class="btn black">VER MÁS OPINIONES</a>
        </div>
    </div>
</section>
<section class="section-retired-players"
    style="background-image: url(<?php  echo get_stylesheet_directory_uri(); ?>/images/prbg.jpg);" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center">JUGADORES RETIRADOS</h2>
        <?php  
         $args = array(  
            'post_type' => 'jugador',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'paged' => 1,  
            'meta_key'		=> 'player_information_player_state',
            'meta_value'	=> 1,
        );
      $loop_retired = new WP_Query( $args ); 
      ?>
        <div class="row slider-players-r">
            <?php  
            while ( $loop_retired->have_posts() ){
            $loop_retired->the_post();
            $info_player=get_field('player_information');
            $url_image=get_the_post_thumbnail_url();
                  ?>
            <div class="col-xs-5">
                <a href="<?php  the_permalink(); ?>">
                    <div class="player-r text-center"
                        style="background-image:url(<?php if($url_image): echo $url_image; else: echo $info_player['photo']; endif; ?>);">
                        <h5><?php  the_title(); ?></h5>
                        <p>Número <?php  echo $info_player['number_player']; ?></p>
                        <p><?php  echo $info_player['date_retired']; ?></p>
                    </div>
                </a>
            </div>
            <?php

            }wp_reset_query();
         ?>
        </div>
    </div>
</section>
<?php  
      $post_query_category = array(
         'post_type' => 'post',
         'category_name' => 'lidom',
         'orderby' => 'publish_date',
         'order' => 'DESC',
         'posts_per_page' => 4,
     );
     $loop_post_c = new WP_Query($post_query_category);     
?>
<section class="section-news" data-aos="fade-up">
    <div class="container">
        <div class="top-cta position-relative">
            <h2>NOTICIAS</h2>
            <img class="img-absolute" src="<?php  echo get_stylesheet_directory_uri(); ?>/images/lidom.png" alt="">
            <a class="btn black" href="<?php  echo get_site_url(); ?>/category/lidom/">Ver más lidom</a>
        </div>
        <div class="row">
            <?php  
            while ( $loop_post_c->have_posts() ){
            $loop_post_c->the_post();
            $url_featured=get_the_post_thumbnail_url();
               ?>
            <div class="col-sm-6">
                <a href="<?php echo get_the_permalink(); ?>" class="post-news">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="img-post h-100">
                                <img class="h-100" src="<?php  echo $url_featured ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-8 p-0">
                            <div class="content-post">
                                <p><span><?php  echo get_the_date(); ?></span></p>
                                <p class="title-post-all"><?php  the_title(); ?></p>
                                <p>
                                    <?php   excerpt(10); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }wp_reset_query();
         ?>
        </div>
    </div>
</section>
<section class="section-socials">
    <div class="container">
        <div class="team-logo text-center">
            <?php 
            $logo_title_feed = get_field('logo_title_feed');
            $subtitle_social_feed = get_field('subtitle_social_feed');
            ?>
            <img src="<?php echo $logo_title_feed; ?>" alt="Estrellas">
            <h3><?php echo $subtitle_social_feed; ?></h3>
        </div>

        <?php
         echo do_shortcode('[ff id="2"]' );
      ?>
        <script>
        jQuery(window).on('load', function() {
            jQuery('.ff-loadmore-wrapper .ff-btn').addClass("btn black");
            jQuery('.ff-loadmore-wrapper .ff-btn').text('CARGAR MÁS');
        });
        </script>
    </div>
</section>
<section class="section-spotify" data-aos="fade-up" style="background:#00603c">
    <div class="container">
        <h2 class="text-center text-uppercase">¿qué estamos escuchando?</h2>
        <div class='embed-container'>

            <iframe src="https://open.spotify.com/embed/playlist/<?php echo get_field('playlist_code');?>" width="300"
                height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

        </div>
        <div class="subscribe-content">
            <a href="https://open.spotify.com/playlist/0UwDXo1BbBmfKgkvJ1jLXR" target="_blank" class="btn btn-primary"
                tabindex="-1">SUSCRÍBETE</a>
            <a href="https://open.spotify.com/playlist/0UwDXo1BbBmfKgkvJ1jLXR" target="_blank">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/Spotify-logo.png" alt="spotify">
            </a>
        </div>
    </div>
</section>
<script>
</script>