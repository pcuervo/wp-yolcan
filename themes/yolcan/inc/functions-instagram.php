<?php 

/**
 * FEED INSTAGRAM
 */
function feedInstagram($tag = 'yolcan'){

  $token = '1490790081.a1d3805.155714f6209241a9b0dffe474faa7ce3';
  $client_id = "a1d380535cd44bc48a981f4740239281";
  $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token=1490790081.a1d3805.155714f6209241a9b0dffe474faa7ce3&count=10&client_id='.$client_id;
  // $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
  // $url = 'https://api.instagram.com/v1/tags/search?q='.$tag.'&access_token='.$token;
  
  $all_result = processURL($url);
  
  $decoded_results = json_decode($all_result, true);

  $new_arr = array();

  // foreach ($decoded_results['data'] as $key => $item):

    // if ( $key <= 8):
    //   $time = $item['caption']['created_time'];
    //   $new_arr[$time.'-'.$key]['type_social'] = 'ins';
    //   $new_arr[$time.'-'.$key]['user_name'] = $item['caption']['from']['username'];
    //   $new_arr[$time.'-'.$key]['user_image'] = $item['caption']['from']['profile_picture'];
    //   $new_arr[$time.'-'.$key]['text'] = $item['caption']['text'];
    //   $new_arr[$time.'-'.$key]['tiempo_creacion_a'] = humanTiming($time);
    //   $new_arr[$time.'-'.$key]['comments'] = $item['comments']['count'];
    //   $new_arr[$time.'-'.$key]['favorite'] = $item['likes']['count'];
    //   $new_arr[$time.'-'.$key]['media'] = $item['images']['standard_resolution']['url'];
    //   $new_arr[$time.'-'.$key]['url_user_profile'] = 'https://instagram.com/'.$item['caption']['from']['username'];
    // endif;
  // end(array)dforeach;

  return $new_arr;
  
}


function processURL($url)
{
    $ch = curl_init();
    curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 2
    ));
 
   $result = curl_exec($ch);
   curl_close($ch);
   return $result;
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