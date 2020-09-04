<?php

ini_set('display_errors', 1);
error_reporting(-1);

$option = [
    CURLOPT_RETURNTRANSFER => true, //文字列として返す
    CURLOPT_TIMEOUT        => 3, // タイムアウト時間
];

$ch = curl_init('http://192.168.1.133/caketest/WebApi/response_json_data');
curl_setopt_array($ch, $option);

$json    = curl_exec($ch);
$info    = curl_getinfo($ch);
$errorNo = curl_errno($ch);

var_dump($json);
