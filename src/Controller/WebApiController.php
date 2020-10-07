<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * WebApi Controller
 *
 *
 * @method \App\Model\Entity\WebApi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WebApiController extends AppController
{

    public function responseJsonData()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout(false);

        $this->request->accepts('application/json');
        $request_data = $this->request->getData();

        $result = [1,2,3];

        $this->response->getCharset('UTF-8');
        $this->response->getType('json');
        $this->response->getHeaders('Access-Control-Allow-Origin: *');
        $this->response->getHeaders('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }

}
