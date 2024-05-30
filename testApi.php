<?php

$ch = curl_init();

$url = "https://la2interlude.com/api.php";

$link =  $_POST['link'];
$login = $_POST['login'];


$postData = [
    'link' => $link,
    'login' => $login
];

$jsonData = json_encode($postData);

curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo "cURL Error: " . curl_error($ch);
} else {
    $data = json_decode($response, true);
    echo "link: " . ($data);

}
curl_close($ch);
?>