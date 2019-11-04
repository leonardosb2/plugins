<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$today = date('dmY');
 
?>
<?php  $banner_top=get_field('banner_top','option'); 
$banner_top_page = get_field('banner_top_page'); 
?>
<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:10px;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<div class="container">
    <div class="controller d-flex justify-content-between">
        <h2>RESULTALDOS FINALES</h2>
        <div class="order-by">
            Ordenar por
            <div class="caja">
                <form action="" method="GET" id="matchesFilter">

                    <select name="results" id="newscat" onchange="submit();">
                        <option value="equipo"
                            <?php echo ($_GET['results'] == 'equipo') ? ' selected="selected"' : ''; ?>>--</option>
                        <?php 
                                $teamsQuery = new WP_Query( array(
                                    'post_type' => 'equipo',
                                    'posts_per_page' => -1,
                                    'order' => 'Desc',
                                ));
                                while ( $teamsQuery->have_posts() ) : $teamsQuery->the_post(); ?>
                        <option value="<?php echo get_the_ID(); ?>"
                            <?php echo ($_GET['results'] == get_the_ID()) ? ' selected="selected"' : ''; ?>>
                            <?php echo get_the_title(); ?></option>
                        <?php
                                endwhile;
                            ?>

                        <?php 
                            $titleTeam = get_the_ID();
                            $date_pr_wp = new DateTime("now", new DateTimeZone('America/Santo_Domingo') );
                            $in_text= date( "Y-m-d H:i:s" );
                            $date_pr_wp->format("Y-m-d H:i:s");
                            if(isset($_GET['results'])):
                                    $nameTeam = $_GET['results'];
                                    $loop2 = new WP_Query( array(
                                        'post_type' => 'partido',
                                        'posts_per_page' => 0,
                                        'post_status' => 'publish',
                                        'paged' => 1,  
                                        'meta_key'          => 'match_day',
                                        'meta_value'        => $date_pr_wp->format("Y-m-d H:i:s"),  
                                        'meta_compare'      => '<',
                                        'orderby'           => 'meta_value',
                                        'order'             => 'DESC',
                                        'meta_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'key'       => 'game_team_first_team',
                                                'compare'   => '=',
                                                'value'     => $_GET['results'],
                                            ),
                                            array(
                                                'key'       => 'game_team2_team',
                                                'compare'   => '=',
                                                'value'     => $_GET['results'],
                                            )
                                        )
                                        
                                    )
                                );
                            else: 
                                $dateCompare=date('d/m/Y g:i a');
                                $loop2 = new WP_Query( array(
                                    'post_type' => 'partido',
                                    'posts_per_page' => 10,
                                    'post_status' => 'publish',
                                    'paged' => 1,  
                                    'meta_key'          => 'match_day',
                                    'meta_value'        => $date_pr_wp->format("Y-m-d H:i:s"), 
                                    'meta_compare'      => '<',
                                    'orderby'           => 'meta_value',
                                    'order'             => 'DESC'
                                    
                                  )
                                );
                                ?> <p class="important-id" style="    opacity: 0;height: 0;"></p> <?php
                            endif;
                        ?>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
<section class="section-result-matchs">
    <?php  $myArray = array(); 
    ?>
    <div class="container">
        <?php    
            $count=0;
            while ( $loop2->have_posts() ) : $loop2->the_post();
            $date = get_field('match_day');
            $date2 = DateTime::createFromFormat('d/m/Y g:i a', $date);
            $fecha_actual = strtotime(date('d-m-Y g:i a'));
            $fecha_entrada = strtotime($date2->format('d-m-Y g:i a'));
            
            // array_push($myArray,$date2->format('d-m-Y g:i a'));


                  $count++;
                  $game_team = get_field('game_team');
                  $game_team2 = get_field('game_team2');
                  $team=$game_team['first_team'];
                  $team2=$game_team2['team'];
                  setlocale(LC_ALL,"es_ES");
                  ?>
        <div class="match-n">
            <h2></h2>
            <?php  
                if ($date2->format('D')=="Sat") {
                    ?> 
                    <h2 class="sub-title"><?php echo 'Sábado'; echo strftime(" %d %B",$date2->getTimestamp()); ?> - <?php  echo $date2->format('g:i a'); ?></h2><?php
                }else{
                    if ($date2->format('D')=="Wed"){
                        ?> <h2 class="sub-title">Míercoles<?php echo strftime(" %d %B",$date2->getTimestamp());?> - <?php  echo $date2->format('g:i a'); ?></h2>  <?php
                    }else{
                        ?> <h2 class="sub-title"><?php  echo strftime("%A %d %B",$date2->getTimestamp()); ?> - <?php  echo $date2->format('g:i a'); ?></h2>  <?php
                    }
                }
            ?>  
            <div class="row row-match mx-0">
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
                                    <?php  
                                        if ( $game_team['goals1']=="") {
                                            ?> <h3>0</h3>  <?php
                                        }else{
                                            ?> <h3><?php echo  $game_team['goals1']; ?></h3>  <?php
                                        }
                                    ?>
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
                                    <?php  
                                        if ( $game_team2['goals2']=="") {
                                            ?> <h3>0</h3>  <?php
                                        }else{
                                            ?> <h3><?php echo  $game_team2['goals2']; ?></h3>  <?php
                                        }
                                    ?>
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

        <?php
            
      endwhile; wp_reset_query(); 
      if ($count==0) {
         echo "No se encontraron resultados";
      }
      //Get close date
      $testdate=date('d-m-Y g:i a');
      ?>
    </div>
    <div class="text-center">
        <p class="important-id" style="    opacity: 0;height: 0;"><?php  echo $_GET['results'] ?></p>
        <div class="loadmore_matches btn black">CARGAR MÁS RESULTADOS</div>
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
      <div  class="top-cta">
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
                                <p >
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


<script>
jQuery(document).ready(function() {
    //so close match
    var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
    var page = 2;

    jQuery(function($) {
        jQuery('body').on('click', '.loadmore_matches', function() {
            jQuery(".loadmore_matches").addClass("loading");
            idpost = jQuery('.important-id').text();
            var data = {
                'action': 'load_matches_by_ajax',
                'page': page,
                'post_type': 'partido',
                'id_post': idpost,
                // 'posts_per_page':'8',
                'security': '<?php echo wp_create_nonce("load_more_matches"); ?>'
            };
            jQuery.post(ajaxurl, data, function(response) {
                if (response != '') {
                    jQuery('.section-result-matchs .container').append(response);
                    page++;
                    jQuery(".loadmore_matches").removeClass("loading");
                } else {
                    jQuery('.loadmore_matches').hide();
                    jQuery(".loadmore_matches").removeClass("loading");
                }
            });
        });
    });
});
</script>