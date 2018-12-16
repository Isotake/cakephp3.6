<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Filesystem\Folder;
use RuntimeException;

/**
 * CsvImport component
 */
class CsvImportComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'dirname_csv_uploaded' => 'uploads_csv',
    ];

    protected $setting = null;

    protected $controller = null;

    public function initialize(array $config) {
        parent::initialize($config);

        $this->controller = $this->_registry->getController();

        $this->setting = [
            'dirname_csv_uploaded' => $this->_defaultConfig['dirname_csv_uploaded'],
            'dirname_uploaded' => $config['dirname_uploaded'],
            'convert_function' => $config['convert_function'],
        ];

    }

    /*
     *
     */

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

        $func = $this->setting['convert_function'];

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

            $data = $this->controller->$func($row);

            $rows[] = $data;

        }
        return $rows;
    }

    /*
     *
     */

    public function uploadFile($tmpfile) {
        $dir = $this->getUploadDir();
        $info = pathinfo($tmpfile['name']);
        $filepath = $dir->path . DS . $info['filename'] . '-' . date('YmdHis') . '.' . $info['extension'];

        try {
            $this->validateUploadFile($tmpfile);
        } catch (RuntimeException $ex){
            $this->log($ex->getMessage());
            return false;
        }

        if (move_uploaded_file($tmpfile['tmp_name'], $filepath)) {
            return (is_file($filepath)) ? $filepath : false ;
        }

        return false;
    }

    private function getUploadDir() {
        $base_dir = ROOT . DS . $this->setting['dirname_csv_uploaded'] . DS . $this->setting['dirname_uploaded'];
        $upload_dir = $base_dir;

        if (!is_dir($upload_dir)) {
            $dir = new Folder($upload_dir, true, 0755);
        } else {
            $dir = new Folder($upload_dir);
        }

        return $dir;
    }

    private function validateUploadFile($tmpfile) {
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
