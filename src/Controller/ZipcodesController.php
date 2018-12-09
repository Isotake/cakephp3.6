<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use RuntimeException;

class ZipcodesController extends AppController
{

    public function import() {

        if ($this->request->is('post')) {

            $filepath = $this->uploadFile($_FILES['zipcodes_csv']);

            $data = self::convertZipcodesByCSV($filepath);

            $this->set([
                'data' => $data[0],
                'value' => 'abc'
            ]);
        }

    }

    static protected function zipcodesFunc ($row) {

        return [
            'jis_code' => $row[0],          //全国地方公共団体コード（JIS X0401、X0402）- 半角数字
            'zipcode_old' => $row[1],       //（旧）郵便番号（5桁）- 半角数字
            'zipcode' => $row[2],           //郵便番号（7桁）- 半角数字
            'prefecture_kana' => $row[3],   //都道府県名 - 半角カタカナ（コード順に掲載）
            'city_kana' => $row[4],         //市区町村名 - 半角カタカナ（コード順に掲載）
            'town_kana' => $row[5],         //町域名 - 半角カタカナ（五十音順に掲載）
            'prefecture' => $row[6],        //都道府県名 - 漢字（コード順に掲載）
            'city' => $row[7],              //市区町村名 - 漢字（コード順に掲載）
            'town' => $row[8],              //町域名 - 漢字（五十音順に掲載）
            'has_multi_zipcode' => $row[9], //一町域が二以上の郵便番号で表される場合の表示（「1」は該当、「0」は該当せず）
            'is_each_AZA' => $row[10],      //小字毎に番地が起番されている町域の表示（「1」は該当、「0」は該当せず）
            'has_CHOU' => $row[11],         //丁目を有する町域の場合の表示　（「1」は該当、「0」は該当せず）
            'is_multi_zipcode' => $row[12], //一つの郵便番号で二以上の町域を表す場合の表示（「1」は該当、「0」は該当せず）
            'update_reason' => $row[13],    //更新の表示（「0」は変更なし、「1」は変更あり、「2」廃止（廃止データのみ使用））
            'change_reason' => $row[14],    //変更理由　（「0」は変更なし、「1」市政・区政・町政・分区・政令指定都市施行、「2」住居表示の実施、「3」区画整理、「4」郵便区調整等、「5」訂正、「6」廃止（廃止データのみ使用））
        ];

    }

    static protected function convertCsvToZipcodes($records, $skip_header = true) {

        $func = 'zipcodesFunc';

        $rows = [];
        foreach ($records as $row) {
            // skip header
            if ($skip_header) {
                $skip_header = false;
                continue;
            }

            //empty record
            if (empty($row[0])) {
                continue;
            }

            $data = self::$func($row);

            $rows[] = $data;

        }
        return $rows;
    }

    static protected function convertZipcodesByCSV($csvfile) {
        $file = new \SplFileObject($csvfile);
        $file->setFlags(\SplFileObject::READ_CSV);
        foreach ($file as $line) {
            $records[] = $line;
        }
        $zipcodes = self::convertCsvToZipcodes($records);
        return $zipcodes;
    }

    protected function uploadFile($tmpfile) {
        $dir = self::getUploadDir();
        $info = pathinfo($tmpfile['name']);
        $filepath = $dir->path . DS . $info['filename'] . '-' . date('YmdHis') . '.' . $info['extension'];

        try {
            self::validateUploadFile($tmpfile);
        } catch (RuntimeException $ex){
            $this->log($ex->getMessage());
            return false;
        }

        if (move_uploaded_file($tmpfile['tmp_name'], $filepath)) {
            return (is_file($filepath)) ? $filepath : false ;
        }

        return false;
    }

    static protected function getUploadDir() {
        $base_dir = ROOT . DS . 'uploads_csv' . DS . 'zipcodes';
        $upload_dir = $base_dir;

        if (!is_dir($upload_dir)) {
            $dir = new Folder($upload_dir, true, 0755);
        } else {
            $dir = new Folder($upload_dir);
        }

        return $dir;
    }

    static protected function validateUploadFile($tmpfile) {
        switch ($tmpfile['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            case UPLOAD_ERR_PARTIAL:
                throw new RuntimeException('upload file is partial.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        if ($tmpfile['size'] <= 0) {
            throw new RuntimeException('file size is 0 byte.');
        }
    }

}


