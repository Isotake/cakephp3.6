<?php

ini_set('display_errors', 1);
error_reporting(-1);

$headers = [
    "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)",
    "Accept-Language: ja",
    "Cookie: test=hoge",
    "Content-Type: application/x-www-form-urlencoded",
];

$data = [
    'title' => '送信テスト',
    'body' => 'テスト',
];

$opts = [
    'http' => [
        'method' => 'POST',
        'header' => implode("\r\n", $headers),
        'content' => http_build_query($data),
//        'ignore_errors' => true,
    ],
];

$ctx = stream_context_create($opts);

// CSRFが有効
//$result = file_get_contents('http://192.168.1.133/caketest/WebApi/response_json_data', false, $ctx);

// プレフィックスapiはCSRFが無効
$result = file_get_contents('http://192.168.1.133/caketest/api/WebApi/response_json_data', false, $ctx);

var_dump($result);
var_dump($http_response_header);
