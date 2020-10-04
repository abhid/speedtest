<?php
/*
	This script detects the client's IP address and fetches ISP info from ipinfo.io/
	Output from this script is a JSON string composed of 2 objects: a string called processedString which contains the combined IP, ISP, Contry and distance as it can be presented to the user; and an object called rawIspInfo which contains the raw data from ipinfo.io (will be empty if isp detection is disabled).
	Client side, the output of this script can be treated as JSON or as regular text. If the output is regular text, it will be shown to the user as is.
*/
error_reporting(0);
$ip = "";
header('Content-Type: application/json; charset=utf-8');
if(isset($_GET["cors"])){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
}
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, s-maxage=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['X-Real-IP'])) {
    $ip = $_SERVER['X-Real-IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ip = preg_replace("/,.*/", "", $ip); # hosts are comma-separated, client is first
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

echo json_encode(['ip' => $ip, 'ua' => $_SERVER['HTTP_USER_AGENT']]);
?>
