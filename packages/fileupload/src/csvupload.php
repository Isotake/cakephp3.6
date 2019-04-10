<?php

require '../../../vendor/autoload.php';

use Packages\FileUpload\App\FileUpload;
use Packages\FileUpload\App\CsvUpload;

ini_set("display_errors", On);
error_reporting(E_ALL);

if (isset($_FILES['fileupload'])) {

	$config = [
		'upload_dir' => 'caketest/uploads_csv/zipcodes',
	];
	$fileupload = new FileUpload($config);
	$csvupload = new CsvUpload($fileupload);

	$result = $csvupload->fileupload->upload($_FILES['fileupload']);
	if ($result) {
		$csv_data = $csvupload->convertCSV($csvupload->fileupload->uploaded_filepath);
		var_dump($csv_data);
	}
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
