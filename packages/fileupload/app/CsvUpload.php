<?php

namespace Packages\FileUpload\App;

class CsvUpload {

	protected $fileupload = null;

	public function __construct(FileUpload $fileupload)
	{
		$this->fileupload = $fileupload;
	}

	public function convertCSV($csvfile) {
		$file = new \SplFileObject($csvfile);
		$file->setFlags(\SplFileObject::READ_CSV);
		foreach ($file as $line) {
			$records[] = $line;
		}
		$csvdata = $this->convertCsvData($records);
		return $csvdata;
	}

	private function convertCsvData($records, $skip_header = true) {

		//$func = $this->setting['convert_function'];

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

			$data = $this->zipcodesFunc($row);

			$rows[] = $data;

		}
		return $rows;
	}

	public function zipcodesFunc ($row) {

		return [
			'jis_code' => $row[0],          //全国地方公共団体コード（JIS X0401、X0402）- 半角数字
			'zipcode_old' => $row[1],       //（旧）郵便番号（5桁）- 半角数字
			'zipcode' => $row[2],           //郵便番号（7桁）- 半角数字
//			'prefecture_mb' => $row[3],   //都道府県名 - 半角カタカナ（コード順に掲載）
//			'city_mb' => $row[4],         //市区町村名 - 半角カタカナ（コード順に掲載）
//			'town_mb' => $row[5],         //町域名 - 半角カタカナ（五十音順に掲載）
//			'prefecture' => $row[6],        //都道府県名 - 漢字（コード順に掲載）
//			'city' => $row[7],              //市区町村名 - 漢字（コード順に掲載）
//			'town' => $row[8],              //町域名 - 漢字（五十音順に掲載）
//			'has_multi_zipcode' => $row[9], //一町域が二以上の郵便番号で表される場合の表示（「1」は該当、「0」は該当せず）
//			'is_each_AZA' => $row[10],      //小字毎に番地が起番されている町域の表示（「1」は該当、「0」は該当せず）
//			'has_CHOU' => $row[11],         //丁目を有する町域の場合の表示　（「1」は該当、「0」は該当せず）
//			'is_multi_zipcode' => $row[12], //一つの郵便番号で二以上の町域を表す場合の表示（「1」は該当、「0」は該当せず）
//			'update_reason' => $row[13],    //更新の表示（「0」は変更なし、「1」は変更あり、「2」廃止（廃止データのみ使用））
//			'change_reason' => $row[14],    //変更理由　（「0」は変更なし、「1」市政・区政・町政・分区・政令指定都市施行、「2」住居表示の実施、「3」区画整理、「4」郵便区調整等、「5」訂正、「6」廃止（廃止データのみ使用））
		];

	}

}