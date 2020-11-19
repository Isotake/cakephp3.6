<?php
ini_set('display_errors', 1);
error_reporting(-1);

require dirname(__DIR__) . '/../vendor/autoload.php';

use League\Flysystem\Filesystem as FlyFilesystem;
use League\Flysystem\Adapter\Local as FlyLocal;

$adapter = new FlyLocal('/var/www/html');
$fs = new FlyFilesystem($adapter);

try {
    $entries = $fs->listContents('/caketest/webroot');
} catch (NotSupportedException $e) {
    throw $e;
    // => Links are not supported, encountered link at ...
}

foreach ($entries as $entry) {
    // ローカルストレージの場合、各 $entry は以下のキーを持つ連想配列
    // - type
    // - path
    // - timestamp
    // - size
    // - dirname
    // - basename
    // - extension
    // - filename
    if ($entry['type'] === 'file') {
        print($entry['path'] . ' is a file.' . PHP_EOL);
    }
    elseif ($entry['type'] === 'dir') {
        print($entry['path'] . ' is a directory.' . PHP_EOL);
    }
}
