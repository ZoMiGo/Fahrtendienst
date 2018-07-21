/*************************************************************************************************************************************
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * @e-mail gorance@live.de
 * Fahrtendienst Software v3.0
 ************************************************************************************************************************************/
$termin = $_POST['termin'];
$location = $_POST['location'];
$droplocation = $_POST['droplocation'];

function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=de";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
$time = $response_a['rows'][0]['elements'][0]['duration']['value'];

    return array('distance' => $dist, 'time' => $time);
}
function get_coordinates($city, $street, $province)
{
    $address = urlencode($city.','.$street.','.$province);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Austria&key=$api";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $status = $response_a->status;

    if ( $status == 'ZERO_RESULTS' )
    {
        return FALSE;
    }
    else
    {
        $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
        return $return;
    }
}
$coordinates1 = get_coordinates('', "$location", '');
$coordinates2 = get_coordinates('', "$droplocation", '');

$dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
$result = $dist["time"];
$hours = floor($result / 3600);
$mins = floor($result / 60 % 60);
$secs = floor($result % 60);
$endTime1 = strtotime("+ $hours hours + $mins minutes + 10 minutes", strtotime($termin)); 
$result1 = date('H:i', $endTime1);
$termin1 ="$termin - $result1";

$vreme = "$termin1";
$distanc = $dist["distance"]; // Berechnung der Entfernung in Kilometer