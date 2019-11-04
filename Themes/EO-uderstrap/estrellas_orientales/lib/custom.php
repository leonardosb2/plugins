<?php  
/* Function which displays your post date in time ago format */
function calculate_time_ago() {
    $currentTime = human_time_diff( get_the_time( 'U' ) );
    $timeAgoPost = human_time_diff_chinese( get_the_time( 'U' ), current_time( 'timestamp' ) );
    // printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
    return 'Hace '.$timeAgoPost ;
}

	
function wp_relative_date() {
    return 'Hace '.human_time_diff_chinese( get_the_time('U'), current_time( 'timestamp' ) );
}
  add_filter( 'get_the_date', 'wp_relative_date' ); // for posts
  function human_time_diff_chinese( $from, $to = '' ) {
    if ( empty( $to ) ) {
      $to = time();
    }
  
    $diff = (int) abs( $to - $from );
  
    if ( $diff < HOUR_IN_SECONDS ) {
      $mins = round( $diff / MINUTE_IN_SECONDS );
      if ( $mins <= 1 )
        $mins = 1;
      /* translators: min=minute */
      $since = sprintf( _n( '%s minuto', '%s minutos', $mins ), $mins );
    } elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
      $hours = round( $diff / HOUR_IN_SECONDS );
      if ( $hours <= 1 )
        $hours = 1;
      $since = sprintf( _n( '%s hora', '%s horas', $hours ), $hours );
    } elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
      $days = round( $diff / DAY_IN_SECONDS );
      if ( $days <= 1 )
        $days = 1;
      $since = sprintf( _n( '%s día', '%s días', $days ), $days );
    } elseif ( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
      $weeks = round( $diff / WEEK_IN_SECONDS );
      if ( $weeks <= 1 )
        $weeks = 1;
      $since = sprintf( _n( '%s semana', '%s semanas', $weeks ), $weeks );
    } elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
      $months = round( $diff / MONTH_IN_SECONDS );
      if ( $months <= 1 )
        $months = 1;
      $since = sprintf( _n( '%s mes', '%s meses', $months ), $months );
    } elseif ( $diff >= YEAR_IN_SECONDS ) {
      $years = round( $diff / YEAR_IN_SECONDS );
      if ( $years <= 1 )
        $years = 1;
      $since = sprintf( _n( '%s año', '%s años', $years ), $years );
    }
  
    return apply_filters( 'human_time_diff_chinese', $since, $diff, $from, $to );
  }
  


  // Changing excerpt more
  function understrap_all_excerpts_get_more_link( $post_excerpt ) {

    return $post_excerpt ;
}
add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );


function excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."...";
    echo $excerpt;
}

//BREADCRUMB=================================
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
      echo "&nbsp;&nbsp; <i class='fa fa-chevron-right'></i> &nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
              if(is_singular( 'jugador' )){
                echo "<a href='".get_site_url()."/jugadores'>JUGADORES&nbsp;&nbsp;</a><i class='fa fa-chevron-right'></i> &nbsp;&nbsp;".get_the_title();
              }
              else{
                echo "&nbsp;&nbsp; <i class='fa fa-chevron-right'></i> &nbsp;&nbsp;".get_the_title();
              }
               
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp; <i class='fa fa-chevron-right'></i> &nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}


function timeago($date) {
    $timestamp = strtotime($date);       

    $strTime = array("segundo", "minuto", "hora", "dia", "mes", "año");
    $length = array("60","60","24","30","12","10");

    $currentTime = time();
    if($currentTime >= $timestamp) {
                    $diff     = time()- $timestamp;
                    for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                    $diff = $diff / $length[$i];
                    }

                    $diff = round($diff);
                    return "Hace " . $diff . " " . $strTime[$i] . "(s)";
    }
 } 
//Calculator date mare clossest
function find_closest($array, $datecurrent)
{
    foreach($array as $day)
    {
    if ((strtotime($datecurrent) - strtotime($day))<0) {
        $interval[] = abs(strtotime($datecurrent) - strtotime($day));
    }
    }
    // echo "<PRE>";print_r($interval);echo "</PRE>";
    asort($interval);
    $closest = key($interval);
    return $array[$closest];
}
//calculate years
function CalculaEdad( $fecha ) {
    $birthDate = $fecha;
    $birthDate = explode("/", $birthDate);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")  ? ((date("Y") - $birthDate[2]) - 1): (date("Y") - $birthDate[2]));
    return $age;
}
