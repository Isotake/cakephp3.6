<?php

namespace Packages\FileUpload\App;

class FileUpload {

	protected $root_path = null;
	protected $ds = null;
	public $upload_dir = null;
	public $uploaded_filepath = null;

	public function __construct ($config)
	{
		$this->root_path = $_SERVER['DOCUMENT_ROOT'];
		$this->ds = DIRECTORY_SEPARATOR;

		if ($this->checkUploaddir($config['upload_dir'])) {
			$this->upload_dir = $this->getUploadPath($config['upload_dir']);
		}
	}

	/**
	 * @param $upload_dir ex. 'dir_a/dir_b'
	 * @return bool
	 */
	private function checkUploaddir ($upload_dir)
	{
		$upload_dirs = explode($this->ds, $upload_dir);
		$check_dir = '';
		foreach ($upload_dirs as $dirname) {
			$check_dir.=  $dirname;
			$check_path = $this->getUploadPath($check_dir);
			$check_dir.=  $this->ds;
			try {
				if (!is_dir($check_path)) {
					throw new \RuntimeException($check_path . ' is not found.');
				} else if (!is_writable($check_path)) {
					throw new \RuntimeException($check_path . ' is not writable.');
				}
			} catch (RuntimeException $ex) {
				return false;
			}
		}
		return true;
	}

	private function getUploadPath ($dirname)
	{
		$path = $this->root_path . $this->ds . $dirname;
		return $path;
	}

	public function upload ($tmpfile) {

		if (!$this->check_uploadfile($tmpfile)) {
			return false;
		}

		if (copy($tmpfile['tmp_name'], $this->upload_dir . $this->ds . $tmpfile['name'])) {
			$this->uploaded_filepath = $this->upload_dir . $this->ds . $tmpfile['name'];
			return true;
		} else {
			return false;
		}
	}

	public function check_uploadfile ($tmpfile)
	{
		try {
			if (empty($tmpfile)) {
				throw new \RuntimeException('The uploaded file is empty.');
			}

			if (!file_exists($tmpfile['tmp_name'])) {
				throw new \RuntimeException('The uploaded file does not exist.');
			}

			if ($tmpfile['size'] <= 0) {
				throw new \RuntimeException('The uploaded file size is less than 0 byte.');
			}

			switch ($tmpfile['error']) {
				case UPLOAD_ERR_OK: // 0
					break;
				case UPLOAD_ERR_INI_SIZE: // 1
					throw new \RuntimeException('UPLOAD_ERR_INI_SIZE : The uploaded file exceeds the upload_max_filesize directive in php.ini');
					break;
				case UPLOAD_ERR_FORM_SIZE: // 2
					throw new \RuntimeException('UPLOAD_ERR_FORM_SIZE : The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form');
					break;
				case UPLOAD_ERR_PARTIAL: // 3
					throw new \RuntimeException('UPLOAD_ERR_PARTIAL : The uploaded file was only partially uploaded');
					break;
				case UPLOAD_ERR_NO_FILE: // 4
					throw new \RuntimeException('UPLOAD_ERR_NO_FILE : No file was uploaded');
					break;
				case UPLOAD_ERR_NO_TMP_DIR: // 6
					throw new \RuntimeException('UPLOAD_ERR_NO_TMP_DIR : Missing a temporary folder');
					break;
				case UPLOAD_ERR_CANT_WRITE: // 7
					throw new \RuntimeException('UPLOAD_ERR_CANT_WRITE : Failed to write file to disk');
					break;
				case UPLOAD_ERR_EXTENSION: // 8
					throw new \RuntimeException('UPLOAD_ERR_EXTENSION : File upload stopped by extension');
					break;
				default:
					throw new \RuntimeException('Unknown upload error');
					break;
			}

		} catch (RuntimeException $ex) {
			return false;
		}
		return true;
	}
}
