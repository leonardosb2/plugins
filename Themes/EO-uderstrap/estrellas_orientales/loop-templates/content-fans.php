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

$size = 'full'; // (thumbnail, medium, large, full or custom size)
$url_page_image= get_the_post_thumbnail_url();
?>

<div class="breadcrumb">
    <div class="container">
        <?php get_breadcrumb(); ?>
    </div>
</div> 
<?php  
$banner_top=get_field('banner_top','option');
$banner_top_page = get_field('banner_top_page'); 
?>

<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0px;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<?php  $header = get_field('header','option'); ?>

<section class="section-baner-fans" style="background-image: url(<?php  echo get_stylesheet_directory_uri() ?>/images/baner-fanszone.jpg);">
    <div class="container">
        <div class="content-baner">
            <div class="logo_header">
                <a href="<?php  echo get_home_url() ?>"><img src="<?php  echo $header['logo']; ?>" alt=""></a>
            </div>
            <h3><?php the_title(); ?></h3>
        </div>
        
    </div>
</section>
<section class="section-socials">
   <div class="container">
        <h3><?php  echo get_field('header_posts'); ?></h3>
      <?php
         echo do_shortcode(get_field('shortcode_feed') );
      ?>
      <script>
         jQuery(window).on('load', function(){
            jQuery('.ff-loadmore-wrapper .ff-btn').addClass("btn black");
            jQuery('.ff-loadmore-wrapper .ff-btn').text('CARGAR MÁS');
         });
      </script>
   </div>
</section>
<section class="section-wallpapers" style="background-image: url(<?php  echo get_stylesheet_directory_uri() ?>/images/wallpapers.jpg);">
    <div class="container">
         <h2>wallparers</h2>
         <div class="the-content">
            <p>Instrucciones de instalación:</p>
            <h3>USUARIOS DE WINDOWS</h3>
            <p>
                Haga click con el botón derecho en la imagen, seleccione "Establecer como fondo de pantalla" para guardar la imagen como imagen de fondo de su escritorio o "Guardar imagen como ..." para guardarla en su disco duro.
            </p>
            <h3>Usuarios de Mac (OS X)</h3>
            <p>Haga click en la imagen y guarde el archivo en su escritorio. En el menú Apple en la esquina superior izquierda de la pantalla, seleccione "Preferencias del sistema ...". Seleccione "Escritorio y protector de pantalla". Arrastre la imagen desde su archivo de escritorio al cuadro de imagen en el panel de control.</p>
         </div>
         <!-- start wallpapers players -->
         <h2>EQUIPOS</h2>
         <?php  
             $repeaters = get_field('wallpapers_teams');
         ?>
         <div class="row pb-5">
            <?php  
                foreach ($repeaters as $elements) {
                    $descktop_images= $elements['descktop_images'];
                    $mobile_image= $elements['mobile_image'];
                    
                    $image1= $descktop_images['1680_x_1050'];
                    $image2= $descktop_images['1600_x_1200'];
                    $image3= $descktop_images['1280_x_1024'];

                    $imageb1= $mobile_image['1209_x_600'];
                    $imageb2= $mobile_image['800_x_600'];
                    $imageb3= $mobile_image['400_x_540'];
                    ?>
                    <div class="col-md-3">
                        <img class="img-wallpaper" src="<?php  echo $image1; ?>" alt="">
                        <div class="row ml-0">
                            <div class="col-5">
                                <div class="select-resolution">
                                    <p class="m-0"><button class="cta">DESKTOP</button></p>
                                    <ul class="descktop-menu">
                                        <?php  
                                            if (!$image1=="") {
                                               ?> <li><a href="<?php  echo $image1 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$image2=="") {
                                               ?> <li><a href="<?php  echo $image2 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$image3=="") {
                                               ?> <li><a href="<?php  echo $image3 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="select-resolution">
                                    <p class="m-0"><button class="cta">MOBILE</button></p>
                                    
                                    <ul class="mobile-menu">
                                        <?php  
                                            if (!$imageb1=="") {
                                               ?> <li><a href="<?php  echo $imageb1 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$imageb2=="") {
                                               ?> <li><a href="<?php  echo $imageb2 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$imageb3=="") {
                                               ?> <li><a href="<?php  echo $imageb3 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                    <?php
                }
            ?>
         </div>
         <!-- end wallpapers players -->
         <!-- start wallpapers players -->
         <h2>JUGADORES</h2>
         <?php  
             $repeaters = get_field('wallpapers_players');
         ?>
         <div class="row pb-5">
            <?php  
                foreach ($repeaters as $elements) {
                    $descktop_images= $elements['descktop_images'];
                    $mobile_image= $elements['mobile_image'];
                    
                    $image1= $descktop_images['1680_x_1050'];
                    $image2= $descktop_images['1600_x_1200'];
                    $image3= $descktop_images['1280_x_1024'];

                    $imageb1= $mobile_image['1209_x_600'];
                    $imageb2= $mobile_image['800_x_600'];
                    $imageb3= $mobile_image['400_x_540'];
                    ?>
                    <div class="col-md-3">
                        <img class="img-wallpaper" src="<?php  echo $image1; ?>" alt="">
                        <div class="row ml-0">
                            <div class="col-5">
                                <div class="select-resolution">
                                    <p class="m-0"><button class="cta">DESKTOP</button></p>
                                    <ul class="descktop-menu">
                                        <?php  
                                            if (!$image1=="") {
                                               ?> <li><a href="<?php  echo $image1 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$image2=="") {
                                               ?> <li><a href="<?php  echo $image2 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$image3=="") {
                                               ?> <li><a href="<?php  echo $image3 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="select-resolution">
                                    <p class="m-0"><button class="cta">MOBILE</button></p>
                                    
                                    <ul class="mobile-menu">
                                        <?php  
                                            if (!$imageb1=="") {
                                               ?> <li><a href="<?php  echo $imageb1 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$imageb2=="") {
                                               ?> <li><a href="<?php  echo $imageb2 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                            if (!$imageb3=="") {
                                               ?> <li><a href="<?php  echo $imageb3 ?>" class="" download>1680 x 1050</a></li>  <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                    <?php
                }
            ?>
         </div>
         <!-- end wallpapers players -->
    </div>
</section>



