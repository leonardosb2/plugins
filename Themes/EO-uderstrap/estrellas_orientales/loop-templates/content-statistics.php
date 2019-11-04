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


<div class="container">

    <div class="row">
        <div class="col-md-9">
        <section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?>">  
            <div class="banner-content">
                    <?php echo get_field('banner_top_page'); ?>
            </div>
        </section>
             <h2>ESTADÍSTICAS</h2>
             <div class="content-statistics">
                 <?php  
                    $table_pitchers = get_field('table_pitchers');
                 ?>
                 <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="title-tab">Lanzadores</h2> 
                    <ul class="tab">
                        <li class="d-flex"><p class="m-auto">FILTRAR POR</p></li>
                        <li><button  id="init" class="btn black tablinks " onclick="filer(event, 'bateadores')">Bateadores</button></li>
                        <li><button  class="btn black tablinks" onclick="filer(event, 'lanzadores')">Lanzadores</button></li>
                    </ul>
                 </div>
                <div id="lanzadores" class="tabcontent">
                    <!-- start -->
                    <section class="section-table" >
                        <div class="container">
                            <div class="row align-items-center justify-content-between">

                                    <h4>Lanzadores estrellas</h4>
                                    <img class="swipe-gif" src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table">
                                    <div class="table-responsive">
                                    <table class="table sortable">
                                        <thead>
                                            <tr>
                                                <th class="text-left" scope="col">JUGADOR</th>
                                                <th scope="col">ERA</th>
                                                <th scope="col">IP</th>
                                                <th scope="col">H</th>
                                                <th scope="col">R</th>
                                                <th scope="col">ER</th>
                                                <th scope="col">BB</th>
                                                <th scope="col">SO</th>
                                                <th scope="col">HR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php  
                                                    foreach ($table_pitchers as $elements) {
                                                        $player_st= $elements['player_st'];
                                                        $era_st = $elements['era_st'];
                                                        $ip_st= $elements['ip_st'];
                                                        $h_st = $elements['h_st'];
                                                        $r_st = $elements['r_st'];
                                                        $er_st = $elements['er_st'];
                                                        $bb_st = $elements['bb_st'];
                                                        $so_st = $elements['so_st'];
                                                        $hr_st = $elements['hr_st'];
                                                            ?>
                                                            <tr>
                                                            <td>
                                                                <a href="<?php  echo get_the_permalink($player_st); ?> "><?php  echo get_the_title($player_st); ?></a>                           
                                                            </td>
                                                            <td><?php  echo $era_st ?></td>
                                                            <td><?php  echo $ip_st ?></td>
                                                            <td><?php  echo $h_st ?></td>
                                                            <td><?php  echo $r_st ?></td>
                                                            <td><?php  echo $er_st ?></td>
                                                            <td><?php  echo $bb_st ?></td>
                                                            <td><?php  echo $so_st ?></td>
                                                            <td><?php  echo $hr_st ?></td>
                                                        </tr>
                                                            <?php
                                                    }
                                                ?>
                                                
                                        </tbody>
                                    <tfoot></tfoot></table>
                                    </div>

                            </div>
                        </div>
                    </section>
                    <!-- end -->

                </div>

                <div id="bateadores" class="tabcontent">
                     <!-- start -->
                    <?php  
                            $table_batters = get_field('table_batters');
                    ?>
                     <section class="section-table" >
                        <div class="container">
                            <div class="row align-items-center justify-content-between">

                                    <h4>bateadores estrellas</h4>
                                    <img class="swipe-gif" src="<?php  echo get_stylesheet_directory_uri(); ?>/images/swipe.gif" alt="Swipe Table">
                                    <div class="table-responsive">
                                    <table class="table sortable">
                                        <thead>
                                            <tr>
                                                <th class="text-left" scope="col">JUGADOR</th>
                                                <th scope="col">AB</th>
                                                <th scope="col">R</th>
                                                <th scope="col">H</th>
                                                <th scope="col">RBI</th>
                                                <th scope="col">2B</th>
                                                <th scope="col">3B</th>
                                                <th scope="col">HR</th>
                                                <th scope="col">SB</th>
                                                <th scope="col">BB</th>
                                                <th scope="col">SO</th>
                                                <th scope="col">AVG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php  
                                                    foreach ($table_batters as $elements) {
                                                            $player_st= $elements['player_st'];
                                                            $ab_st = $elements['ab_st'];
                                                            $r_st= $elements['r_st'];
                                                            $h_st = $elements['h_st'];
                                                            $rbi = $elements['rbi'];
                                                            $a2b = $elements['2b'];
                                                            $a3b = $elements['3b'];
                                                            $hr = $elements['hr'];
                                                            $sb = $elements['sb'];
                                                            $bb = $elements['bb'];
                                                            $so = $elements['so'];
                                                            $avg = $elements['avg'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="<?php  echo get_the_permalink($player_st); ?> "><?php  echo get_the_title($player_st); ?>   </a>
                                                                                          
                                                                </td>
                                                                <td><?php  echo $ab_st ?></td>
                                                                <td><?php  echo $r_st ?></td>
                                                                <td><?php  echo $h_st ?></td>
                                                                <td><?php  echo $rbi ?></td>
                                                                <td><?php  echo $a2b ?></td>
                                                                <td><?php  echo $a3b ?></td>
                                                                <td><?php  echo $hr ?></td>
                                                                <td><?php  echo $sb ?></td>
                                                                <td><?php  echo $bb ?></td>
                                                                <td><?php  echo $so ?></td>
                                                                <td><?php  echo $avg ?></td>
                                                                
                                                            </tr>
                                                            <?php
                                                    }
                                                ?>
                                        </tbody>
                                    <tfoot></tfoot></table>
                                    </div>

                            </div>
                        </div>
                    </section>
                    <!-- end -->
                </div>
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
document.getElementById("init").click();
function filer(evt, position){
    jQuery('.title-tab').text(position);
    
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        tablinks[i].className = tablinks[i].className.replace(" btn-primary", " black");
    }
    document.getElementById(position).style.display = "block";
    evt.currentTarget.className += " active";
    evt.currentTarget.className += " btn-primary";
    jQuery(evt.currentTarget).removeClass('black');
}
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

