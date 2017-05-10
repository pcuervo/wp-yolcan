<?php 
// $result = feedInstagram();
/**
 * FEED INSTAGRAM
 */
function feedInstagram($tag = 'yolcan', $count = 3){

  $token = '1490790081.113bc44.f051d1732c774cc89e88710fb54a2289';
  $client_id = "113bc4484f5945cf979169f9a640dd6f";
  $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token='.$token.'&count='.$count.'&client_id='.$client_id;
  $decoded_results = processURL($url);

  $new_arr = array();
  if(!empty($decoded_results->data) ):
    foreach ($decoded_results->data as $key => $item):

        $time = $item->caption->created_time;
        $new_arr[$time.'-'.$key]['user_name'] = $item->caption->from->username;
        $new_arr[$time.'-'.$key]['user_image'] = $item->caption->from->profile_picture;
        $new_arr[$time.'-'.$key]['text'] = $item->caption->text;
        $new_arr[$time.'-'.$key]['tiempo_creacion_a'] = humanTiming($time);
        $new_arr[$time.'-'.$key]['comments'] = $item->comments->count;
        $new_arr[$time.'-'.$key]['favorite'] = $item->likes->count;
        $new_arr[$time.'-'.$key]['media'] = $item->images->standard_resolution->url;
        $new_arr[$time.'-'.$key]['url_user_profile'] = 'https://instagram.com/'.$item->caption->from->username;

    endforeach;
  endif;

  return $new_arr;
  
}


function processURL($api_url)
{
    $connection_c = curl_init(); // initializing
  curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
  curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
  curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
  $json_return = curl_exec( $connection_c ); // connect and get json data
  curl_close( $connection_c ); // close connection
  return json_decode( $json_return ); // decode and return
}

/**
 * REGREA LOS MINUTOS Ó HORAS Ó DIAS QUE SE PUBLICO EL EVENTO
 * @param  [datetime] $time [fecha y tiempod e publicacion]
 * @return [type]       [tiempo de publicacion en minutos ó horas ó dias]
 */
function humanTiming($time){
    
    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'año',
        2592000 => 'mes',
        604800 => 'semana',
        86400 => 'día',
        3600 => 'h',
        60 => 'min',
        1 => 'sec'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($text != 'min' && $numberOfUnits>1)?'s':'');
    }

}