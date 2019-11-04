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
$background_contactImage=get_field('background_contact');
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
<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:0;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<section class="section-contact" style="background-image:url(<?php  echo $background_contactImage ?>);">
   <div class="container">

      <div class="row">
         <div class="col-md-8">
            <h2>¿EN QUÉ PODEMOS AYUDAR?</h2>
            <hr>
            <div class="content-form-page">
               <?php  
                        echo do_shortcode( '[contact-form-7 id="542" title="Contact Page"]' );
                    ?>
            </div>
            <hr class="type-two-hr">
            <h2 class="text-uppercase">¡Síguenos en las redes!</h2>
            <?php  $header = get_field('header','option');
        $socials = $header['socials']; ?>
            <ul class="social-top">
               <?php foreach ($socials as $social) {
                    ?>
               <li><a href="<?php echo $social['url']?>"><i class="fa fa-<?php echo $social['social_icon']?>"></i></a>
               </li>
               <?php
                    }
                    ?>
            </ul>
         </div>
         <div class="col-md-4 info-numbers">
            <h2>NÚMEROS IMPORTANTES</h2>
            <hr>
            <div class="info-contact-page">
               <?php 
                $numbers_i = get_field('numbers_i');
                if ($numbers_i) {
                    foreach ($numbers_i as $elements) {
                        $title_number= $elements['title_number'];
                        $number_n = $elements['number_n'];
                        $element3= $elements['name_element_3'];
                        $element4 = $elements['name_element_4'];
                        ?>
                <p><?php  echo $title_number ?></p>
                <a class="text-decoration-none" href="tel:<?php  echo $number_n ?>"> <h3><?php  echo $number_n ?></h3></a>
                
                <?php
                        }
                    }else{
                        ?> <p>Estadio Tetelo Vargas</p>
               <h3>809-529-3618</h3>
               <p>Oficinas Administrativas</p>
               <h3>809-508-8270</h3>
               <p>Patrocinios y Mercadeo</p>
               <h3>809-258-2050</h3>
               <?php
                    }
                    ?>

            </div>
         </div>
      </div>
   </div>
</section>
<section class="adress">
   <div class="container">
      <h2>DIRECCIONES AL TELELO VARGAS</h2>
   </div>

   <div class="map" id="map" style="height:600px;"></div>
   <script>
   var map;

   function initMap() {
      map = new google.maps.Map(
         document.getElementById('map'), {
            center: new google.maps.LatLng(18.464284, -69.303539),
            zoom: 17
         });

      var iconBase =
         '<?php echo get_stylesheet_directory_uri(); ?>/images/';

      var icons = {
         info: {
            icon: iconBase + 'marker.png'
         }
      };

      var features = [{
         position: new google.maps.LatLng(18.464284, -69.303539),
         type: 'info'
      }];

      // Create markers.
      for (var i = 0; i < features.length; i++) {
         var marker = new google.maps.Marker({
            position: features[i].position,
            icon: icons[features[i].type].icon,
            map: map,
            title: 'Uluru (Ayers Rock)'
         });
      };
      //Info Window
      var siteUrl = window.location.href;
      var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Estadio Tetelo Vargas</h1>'+
            '<div id="bodyContent">'+
            '<p>San Pedro de Macoris 21000 <br>República Dominicana</p>'+
            '<div class="view-link"> <a target="_blank" jstcache="6" href="https://maps.google.com/maps?ll=18.464353,-69.303543&amp;z=19&amp;t=m&amp;hl=es-419&amp;gl=US&amp;mapclient=apiv3&amp;cid=17665710708608907527"> <span>Ver en Google Maps</span> </a> </div>'+
            '</div>'+
            '</div>';
      var infowindow = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 400
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
   }
   </script>
   <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCki8SDgrOCoyPstZyom_QTdzIFWKUurmo&callback=initMap">
   </script>
   <br>
</section>

<!-- / Section video -->