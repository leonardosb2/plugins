<?php
/**
 * Partial template for content in page-photos.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$banner_top = get_field('banner_top','option');
$banner_adsense_middle = get_field('banner_adsense_middle','option');
$banner_top_page = get_field('banner_top_page'); 
$size = 'full'; // (thumbnail, medium, large, full or custom size)

?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
                    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    
<div class="container">

    <div class="row">
        <div class="col-md-9">
        <section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?>">  
          <div class="banner-content">
                <?php echo get_field('banner_top_page'); ?>
          </div>
        </section>
            <div class="row mt-5">
              <div class="col-md-6">
                <h2>ROSTER SEMANAL</h2>
              </div>
              <?php
              $day = date('w');
              $week_start = date('d-m-Y', strtotime('-'.$day.' days'));
              $week_end = date('d-m-Y', strtotime('+'.(6-$day).' days'));
              ?>
              <div class="col-md-6 mb-4 mb-md-0 text-center text-md-right  date-txt">
                <label>SEMANA DEL</label> <span id="startDate"><?php echo $week_start; ?></span> AL <span id="endDate"><?php echo $week_end; ?></span>
                <span class="container-calendar-roster"><button class="calendar-btn"><i class="fa fa-calendar"></i></button>
                <div class="week-picker" style="display:none;"></div></span>
                <script type="text/javascript">

                  var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
                  var startDate;
                  var endDate;
                  var selectCurrentWeek = function() {
                      window.setTimeout(function () {
                          jQuery('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
                      }, 1);
                  }
                  jQuery('.container-calendar-roster .calendar-btn').on('click', function(e){
                    e.preventDefault();
                    jQuery('.week-picker').toggle(300);
                  });
                  jQuery(".week-picker").datepicker({
                    dateFormat: "dd-mm-yy",
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    onSelect: function(dateText, inst) { 
                        var date = $(this).datepicker('getDate');
                        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
                        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                        $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
                        $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                        jQuery('.week-picker').hide(300);
                        selectCurrentWeek();
                        var data = {
                            'action': 'roster_ajax',
                            'from': $.datepicker.formatDate( 'yymmdd', startDate, inst.settings ),
                            'to': $.datepicker.formatDate( 'yymmdd', endDate, inst.settings )
                        };
                        $.post(ajaxurl, data, function(response) {
                            if(response != '') {
                                jQuery('.content-statistics').html(response);
                            }else {
                                jQuery('.content-statistics').html('<h3>Lo sentimos, no se encontraron resultados para esta semana</h3>');
                            }
                        });
                    },
                    beforeShowDay: function(date) {
                        var cssClass = '';
                        if(date >= startDate && date <= endDate)
                            cssClass = 'ui-datepicker-current-day';
                        return [true, cssClass];
                    },
                    onChangeMonthYear: function(year, month, inst) {
                        selectCurrentWeek();
                    }
                  });
                  jQuery('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
                  jQuery('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
                </script>
              </div>
            </div>
             

             <div class="content-statistics">
                 <?php  
                  $table_pitchers = get_field('table_pitchers');
                  
                  $today = date('Ymd');
                  $args = array(
                    'post_type' => 'roster-semanal',
                    'showposts' => -1,
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key'       => 'roster_hasta',
                            'compare'   => '>=',
                            'value'     => $today,
                        ),
                        array(
                            'key'       => 'roster_de',
                            'compare'   => '<=',
                            'value'     => $today,
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Catchers <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Center Field <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>First Base <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Left Field <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Pitcher <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Right Field <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Second Base <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Shortstop <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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
                          <section class="section-table" >
                            <div class="container">
                              <div class="row align-items-center">
                                <h4>Third Base  <img class="swipe-gif"
                        src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table"></h2></h4>
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
                                          ?> <td> <a href="<?php  echo get_the_permalink($p_id); ?>"><?php echo  get_the_title($p_id) ?> </a>  </td>  <?php
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

                 ?>
                 <!--<div class="d-flex justify-content-between align-items-center">
                    <h2 class="title-tab">Lanzadores</h2> 
                    <ul class="tab">
                        <li class="d-flex"><p class="m-auto">FILTRAR POR</p></li>
                        <li><button  id="init" class="btn black tablinks " onclick="filer(event, 'bateadires')">Bateadores</button></li>
                        <li><button  class="btn black tablinks" onclick="filer(event, 'lanzadores')">Lanzadores</button></li>
                    </ul>
                 </div>-->
                 <!-- end tables componetns -->
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


<script>

</script>
<!-- / Section video -->

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


