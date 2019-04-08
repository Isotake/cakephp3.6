<?php

require '../../../vendor/autoload.php';

use Packages\FileUpload\App\FileUpload;
use Packages\FileUpload\App\CsvUpload;

ini_set("display_errors", On);
error_reporting(E_ALL);

if (isset($_FILES['fileupload'])) {

	$config = [
		'upload_dir' => 'uploads',
	];
	$fileupload = new FileUpload($config);
	var_dump($fileupload);

	$csvupload = new CsvUpload($fileupload);
	var_dump($csvupload);

//	$result = $fileupload->upload($_FILES['fileupload']);
//	var_dump($fileupload);
//	var_dump($result);
//
//	if ($result) {
//		$csvupload = new CsvUpload($fileupload);
//		$csv_data = $csvupload->convertCSV($fileupload->uploaded_filepath);
//		var_dump($csv_data);
//	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Title</title>
	</head>
	<body>
		<form action="csvupload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="fileupload" />
			<button type="submit">submit</button>
		</form>
	</body>
</html>
