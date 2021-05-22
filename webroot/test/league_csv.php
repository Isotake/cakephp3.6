<?php
require 'vendor/autoload.php';

// League\Csv
use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\CharsetConverter;

// 読み込むCSVファイルを指定
$reader = Reader::createFromPath('webroot/data/KEN_ALL.CSV', 'r');

// 文字エンコードを指定(SJIS-win -> UTF-8)
CharsetConverter::addTo($reader, 'SJIS-win', 'UTF-8');

// レコード件数を取得
echo $reader->count();

// データ読み込み
$records = $reader->getRecords();
foreach($records as $idx => $row) {
    echo $idx.":".$row[0];

    // 各レコードごとの処理は割愛
}
