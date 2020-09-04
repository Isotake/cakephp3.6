<?php

ini_set('display_errors', 1);
error_reporting(-1);

$result = file_get_contents('http://192.168.1.133/caketest/WebApi/response_json_data');

var_dump($result);
var_dump($http_response_header);
