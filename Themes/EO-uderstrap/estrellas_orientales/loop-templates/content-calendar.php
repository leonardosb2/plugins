<?php
/** 
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$loop2 = new WP_Query( array(
    'post_type' => 'partido',
    'meta_key'			=> 'match_day',
         'orderby'			=> 'meta_value',
         'order'				=> 'ASC'
    )
);
// echo "<PRE>";print_r($loop2);echo "</PRE>";
global $wp;
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$url_components = parse_url($url);
parse_str($url_components['query'], $params); 
$calendar = $params['date'];
if ($calendar =="") {
    $dominicana_date = new DateTime("now", new DateTimeZone('America/Santo_Domingo') );
    $today=$dominicana_date->format("d/m/Y");
    $todayDate = DateTime::createFromFormat('d/m/Y', $today);
    $todaymore = $todayDate->format('Y-m-d');
}else{
   $todayDate = DateTime::createFromFormat('d/m/Y', $calendar);
   $today = $todayDate->format('d/m/Y');
   $todaymore = $todayDate->format('Y-m-d');
}
$oldDate = '2013-05-15';
$newDate = date('Y-m-d',"+5 days");
$date1 = date("d/m/Y", strtotime($todaymore.'-3 days')); 
$date2 = date("d/m/Y", strtotime($todaymore.'-2 days')); 
$date3 = date("d/m/Y", strtotime($todaymore.'-1 days')); 
$date4 = date("d/m/Y", strtotime($todaymore.'+1 days')); 
$date1=DateTime::createFromFormat('d/m/Y', $date1);
$date2=DateTime::createFromFormat('d/m/Y', $date2);
$date3=DateTime::createFromFormat('d/m/Y', $date3);
$date4=DateTime::createFromFormat('d/m/Y', $date4);
?>
<?php  
$banner_top=get_field('banner_top','option'); 
$banner_top_page = get_field('banner_top_page'); 
?>
<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:15px;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<section class="section-match-date">
    <div class="container">
        <div class="row no-gutters justify-content-sm-between justify-content-center">
            <div class="col-sm-6 contetn-date-current">
                <h2>CALENDARIO</h2>
                <div id="calendar_wrap">
                    <table summary="Calendar">
                        <?php  
                            $dias = array("DOM","LUN","MAR","MIER","JUV","VIER","SAB");
                        ?>
                        <thead>
                            <tr>
                                <th abbr="Wednesday" scope="col" title="Wednesday"><?php echo $dias[$date2->format('w')];  ?>
                                </th>
                                <th abbr="Thursday" scope="col" title="Thursday"><?php echo $dias[$date3->format('w')]; ?></th>
                                <th abbr="Friday" scope="col" title="Friday"><?php echo $dias[$todayDate->format('w')]; ?></th>
                                <th abbr="Saturday" scope="col" title="Saturday"><?php echo $dias[$date4->format('w')]; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        href="<?php echo home_url( $wp->request ).'?date='.$date2->format('d/m/Y');  ?>"><?php echo $date2->format('d'); ?></a>
                                </td>
                                <td>
                                    <a
                                        href="<?php  echo home_url( $wp->request ).'?date='.$date3->format('d/m/Y'); ?>"><?php echo $date3->format('d'); ?></a>
                                </td>
                                <td id="today">
                                    <a
                                        href="<?php echo home_url( $wp->request );  ?>"><?php  echo $todayDate->format('d'); ?></a>
                                </td>
                                <td>
                                    <a
                                        href="<?php echo home_url( $wp->request ).'?date='.$date4->format('d/m/Y');  ?>"><?php echo $date4->format('d'); ?></a>
                                </td>
                                <td>
                                    <button class="calendar-btn"><i class="fa fa-calendar"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
                    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <div id="datepicker"></div>

                    <script>
                    jQuery("#datepicker").datepicker({
                        dateFormat: "dd-mm-yy"
                    });
                    jQuery('#datepicker').toggle()
                    jQuery("#datepicker").on("change", function() {
                        var selected = jQuery(this).val();
                        var newStr = selected.replace(/-/g, "/");
                        var url = window.location;
                        var query_string = url.search;
                        var search_params = new URLSearchParams(query_string);
                        search_params.set('date', newStr);
                        url.search = search_params.toString();
                        var new_url = url.toString();
                    });
                    jQuery(".calendar-btn").on("click", function() {
                        jQuery('#datepicker').toggle()
                    });
                    </script>
                </div>
            </div>
            <div class="col-sm-6 timer px-4">
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
                    
                    ?>
                <h6>Próximo partido</h6>
                
                <ul>
                    <li><span id="days">00</span>días</li>
                    <li><span id="hours">00</span>horas</li>
                    <li><span id="minutes">00</span>minutos</li>
                    <li><span id="seconds">00</span>segundos</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="section-result-matchs">
    <?php  $myArray = array(); ?>
    <div class="container">
        <?php    
            $count=0;
            while ( $loop2->have_posts() ) : $loop2->the_post();
            $date = get_field('match_day');
            $date2 = DateTime::createFromFormat('d/m/Y g:i a', $date);
            $fecha_actual = strtotime(date('d-m-Y g:i a'));
            $fecha_entrada = strtotime($date2->format('d-m-Y g:i a'));
            if ($fecha_actual<$fecha_entrada) {
               array_push($myArray,$date2->format('d-m-Y g:i a'));
            }
            // array_push($myArray,$date2->format('d-m-Y g:i a'));

            if ($date2->format('d/m/Y')==$today) {
                  $count++;
                  $game_team = get_field('game_team');
                  $game_team2 = get_field('game_team2');
                  $team=$game_team['first_team'];
                  $team2=$game_team2['team'];
                  setlocale(LC_ALL,"es_ES");
                  ?>
                <div class="match-n">
                    <h2 class="text-uppercase"><?php  echo $date2->format('g:i a'); ?></h2>
                    <?php  
                        if ($date2->format('D')=="Sat") {
                            ?> 
                            <h2 class="sub-title"><?php echo 'Sábado'; echo strftime(" %d %B",$date2->getTimestamp()); ?></h2><?php
                        }else{
                            if ($date2->format('D')=="Wed"){
                                ?> <h2 class="sub-title">Míercoles <?php echo strftime(" %d %B",$date2->getTimestamp()); ?></h2>  <?php
                            }else{
                                ?> <h2 class="sub-title"><?php  echo strftime("%A %d %B",$date2->getTimestamp()); ?></h2>  <?php
                            }
                        }
                    ?>  
                    <div class="row row-match mx-0">
                        <div class="col-lg-5 ">
                            <div class="team-vs">
                                <div class="stadum">
                                    <p> <?php  echo get_field('stadium'); ?> - serie regular</p>
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
                                <?php  
                                if (current_user_can('administrator')) {
                                    ?>
                                    <a href=" <?php  echo get_edit_post_link(); ?>"> Edit</a>
                                    <?php
                                }
                                ?>
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
                                                    ?> <th abbr="Saturday" scope="col" title="10">10</th>  <?php
                                                }
                                                if ($game_team['team_11'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">11</th>  <?php
                                                }
                                                if ($game_team['team_12'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">12</th>  <?php
                                                }
                                                if ($game_team['team_13'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">13</th>  <?php
                                                }
                                                if ($game_team['team_14'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">14</th>  <?php
                                                }
                                                if ($game_team['team_15'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">15</th>  <?php
                                                }
                                                if ($game_team['team_16'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">16</th>  <?php
                                                }
                                                if ($game_team['team_17'] !== '') {
                                                    ?> <th abbr="Saturday" scope="col" title="10">17</th>  <?php
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
                                                            ?> <td>0</td>    <?php
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
                                                            ?> <td>0</td>    <?php
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
            }
      endwhile; wp_reset_query(); 
      if ($count==0) {
         echo "No se encontraron resultados";
      }
      //Get close date
      $testdate=date('d-m-Y g:i a');
        if (empty($myArray)) {
            echo '<p class="so-close" style="
            opacity: 0;
            height: 0;
            margin: 0;">nodate</p>';
        }else{
            $dateclose=find_closest($myArray, $testdate);
            $date_regresive = DateTime::createFromFormat('d-m-Y g:i a', $dateclose);
            echo '<p class="so-close" style="
            opacity: 0;
            height: 0;
            margin: 0;">'.$date_game2->format("m d, Y H:i:s").'</p>';
            ?> <p class="so-close2" style="
            opacity: 0;
            height: 0;
            margin: 0;"> <?php  echo $date_game2->format("D M d Y").' '.$date_game2->format("H:i:s"); ?></p>  <?php
        }
      ?>
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
      function isIphone() {
         if (navigator.userAgent.match(/(iPhone|iPod|iPad)/) != null) {
            return true;
         }
         return false;
      }   
      var ua = navigator.userAgent.toLowerCase(); 
      if (ua.indexOf('safari') != -1) { 
         if (ua.indexOf('chrome') > -1) {
            var browser=1 // Chrome
         } else {
            var browser=2;
         }
      }
      if (isIphone()||browser==2 ) {
         if ( jQuery(".so-close2").length > 0 ) {
            var datejs=jQuery('.so-close').text();
            if (datejs=="nodate") {
               jQuery('.timer').css('opacity', '0');
            }else{
               let countDown=Date.parse(jQuery('.so-close2').text());
               const second = 1000,
               minute = second * 60,
               hour = minute * 60,
               day = hour * 24;
               // let countDown = new Date(datejs).getTime(),
               x = setInterval(function() {
               let now =new Date().getTime();
               distance = countDown - now;
               document.getElementById('days').innerText =pad(Math.floor(distance / (day))),
               document.getElementById('hours').innerText = pad(Math.floor((distance % (day)) / (hour))) ,
               document.getElementById('minutes').innerText = pad(Math.floor((distance % (hour)) / (minute))) ,
               document.getElementById('seconds').innerText = pad(Math.floor((distance % (minute)) / second)) ;
               if(pad(Math.floor(distance / (day))) == 0 && pad(Math.floor((distance % (day)) / (hour))) == 0 && pad(Math.floor((distance % (hour)) / (minute))) == 0 && pad(Math.floor((distance % (minute)) / second)) == 0 ){
                    stopInterval();
                }
               }, second);
               function stopInterval() {
                    clearInterval(x);
                }
            }
         }
      }else{
         
         if ( jQuery(".so-close").length > 0 ) {
         var datejs=jQuery('.so-close').text();
            if (datejs=="nodate") {
               jQuery('.timer').css('opacity', '0');
            }else{
               const second = 1000,
               minute = second * 60,
               hour = minute * 60,
               day = hour * 24;
               let countDown = new Date(datejs).getTime(),
               x = setInterval(function() {
               let now = new Date().getTime(),
               distance = countDown - now;
               document.getElementById('days').innerText =pad(Math.floor(distance / (day))),
               document.getElementById('hours').innerText = pad(Math.floor((distance % (day)) / (hour))) ,
               document.getElementById('minutes').innerText = pad(Math.floor((distance % (hour)) / (minute))) ,
               document.getElementById('seconds').innerText = pad(Math.floor((distance % (minute)) / second)) ;
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