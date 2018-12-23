<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Zipcode helper
 */
class ZipcodeHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function convert_hasMultiZipcode ($value) {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

    public function convert_isEachAza ($value) {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

    public function convert_hasChou ($value) {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

    public function convert_isMultiZipcode ($value) {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

}
