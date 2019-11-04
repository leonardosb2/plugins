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
$url_page_image= get_the_post_thumbnail_url();
?>
<div class="breadcrumb">
    <div class="container">
        <?php get_breadcrumb(); ?>
    </div>
</div> 
<?php  $banner_top=get_field('banner_top','option'); ?>
<section class="section-publici" style="background-color:white;<?php if (get_field('banner_top_page')=='') {echo 'padding:10px;';}?>">  
   <div class="banner-content">
        <?php echo get_field('banner_top_page'); ?>
   </div>
</section>
<section class="section-stadium">
    <div class="container">
        <h2>EL TELELO VARGAS</h2>
    </div>
    
    <div class="baner-stadium" style="background-image:url(<?php  echo $url_page_image ?>);">
        <img src="" alt="">
    </div>
    <div class="container">
        <p><?php  the_content(); ?></p>
        <h2 class="mt-5 mb-0">DIRECCIONES AL TELELO VARGAS</h2>
    </div>
    <!--<div class="map" style="width: 100%"><iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&height=600&hl=es&coord=18.4643628,-69.30342163078693&q=Estadio%20Tetelo%20Vargas%2C%20stadium%2C%20San%20Pedro%20de%20Macor%C3%ADs%2C%20Dominican%20Republic+(Telelo%20Vargas)&ie=UTF8&t=&z=17&iwloc=A&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/calcular-ruta.html">mapas y direcciones</a></iframe></div><br />-->
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


