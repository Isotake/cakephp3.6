<?php

use PHPUnit\Framework\TestCase;
use Packages\FileUpload\App\FileUpload;

class FileUploadTest extends TestCase {

	protected $test;

	protected function setUp (): void
	{
		$_SERVER['DOCUMENT_ROOT'] = '/var/www/html';
	}

	protected function tearDown (): void
	{
		unset($_SERVER['DOCUMENT_ROOT']);
	}

	/**
	 * @dataProvider uploadDirProvider
	 *
	 * 正しく設置されているディレクトリでtrueを期待する
	 *
	public function testUploaddir ($dirname) {
		$config = [
			'upload_dir' => $dirname,
		];
		$this->test = new FileUpload($config);
		$this->assertTrue($this->test->checkUploaddir());
	}
	*/

	/**
	 * @dataProvider uploadDirExceptionProvider
	 *
	 * 存在しないディレクトリでRuntimeExceptionを期待する
	 * 書き込み権限のないディレクトリでRuntimeExceptionを期待する
	 *
	 */
	public function testUploaddirException ($testfile) {
		$config = [
			'upload_dir' => $testfile['config'],
		];

		$_FILES = array(
			'test' => $testfile['file']
		);

		$this->expectException(\RuntimeException::class);
		$this->test = new FileUpload($config);
//		$this->assertTrue($this->test->upload($_FILES['test']));
	}

	/**
	 * @dataProvider fileUploadProvider
	 * アップロードされたファイルの正常なコピーを期待する
	 */
	public function testFileUpload ($testfile)
	{
		$config = [
			'upload_dir' => $testfile['config'],
		];

		$_FILES = array(
			'test' => $testfile['file']
		);

		$this->test = new FileUpload($config);
		$this->assertTrue($this->test->upload($_FILES['test']));
	}

	/**
	 * @dataProvider fileUploadExceptionProvider
	 * アップロードされたファイルのRuntimeExceptionを期待する
	 */
	public function testFileuploadException ($testfile)
	{
		$config = [
			'upload_dir' => $testfile['config'],
		];

		$_FILES = array(
			'test' => $testfile['file']
		);

		$this->expectException(\RuntimeException::class);
		$this->test = new FileUpload($config);
		$this->assertTrue($this->test->upload($_FILES['test']));
	}

	public function uploadDirExceptionProvider ()
	{
		return [
			'2 : dir_not_found' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_not_found',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 0,
					],
				],
			],
			'3 : dir_not_writable' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_not_writable',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 0,
					],
				],
			],
		];
	}

	public function fileUploadProvider ()
	{
		return [
			'1 : dir_before' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 0,
					],
				],
			],
		];
	}

	public function fileUploadExceptionProvider ()
	{
		return [
			'2 : empty' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [],
				],
			],
			'3 : tmpfile does not exist' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_not_found/data.csv',
						'error' => 0,
					],
				]
			],
			'4 : 0 byte' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 0,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 0,
					],
				]
			],
			'5 : UPLOAD_ERR_INI_SIZE' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 1,
					],
				]
			],
			'6 : UPLOAD_ERR_FORM_SIZE' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 2,
					],
				]
			],
			'7 : UPLOAD_ERR_PARTIAL' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 3,
					],
				]
			],
			'8 : UPLOAD_ERR_NO_FILE' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 4,
					],
				]
			],
			'9 : UPLOAD_ERR_NO_TMP_DIR' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 6,
					],
				]
			],
			'10 : UPLOAD_ERR_CANT_WRITE' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 7,
					],
				]
			],
			'11 : UPLOAD_ERR_EXTENSION' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 8,
					],
				]
			],
			'12 : ' => [
				[
					'config' => 'caketest/packages/fileupload/test/dir_after',
					'file' => [
						'name' => 'data.csv',
						'type' => 'text/csv',
						'size' => 25,
						'tmp_name' => __DIR__ . '/dir_before/data.csv',
						'error' => 9,
					],
				]
			],
		];
	}

}
