<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use RuntimeException;

/**
 * Zipcodes Controller
 *
 * @property \App\Model\Table\ZipcodesTable $Zipcodes
 *
 * @method \App\Model\Entity\Zipcode[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZipcodesController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->loadComponent('CsvImport', [
            'dirname_uploaded' => 'zipcodes',
            'convert_function' => 'zipcodesFunc',
        ]);
    }

    public function import() {

        if ($this->request->is('post')) {

            $filepath = $this->CsvImport->uploadFile($_FILES['zipcodes_csv']);

            $data = $this->CsvImport->convertCSV($filepath);

            $conn = $this->Zipcodes->getConnection();
            $conn->begin();
            try {
                $this->insertZipcodesByChunk($data);

                $conn->commit();
                $this->Flash->success('The zipcode has been saved.');
                return $this->redirect(['action' => 'index']);
            } catch (Exception $ex) {
                $conn->rollback();
                $this->log($ex->getMessage());
                $this->Flash->error('The zipcode could not be saved. Please, try again.');
            }

            $this->set([]);
        }

    }

    public function zipcodesFunc ($row) {

        return [
            'jis_code' => $row[0],          //全国地方公共団体コード（JIS X0401、X0402）- 半角数字
            'zipcode_old' => $row[1],       //（旧）郵便番号（5桁）- 半角数字
            'zipcode' => $row[2],           //郵便番号（7桁）- 半角数字
            'prefecture_mb' => $row[3],   //都道府県名 - 半角カタカナ（コード順に掲載）
            'city_mb' => $row[4],         //市区町村名 - 半角カタカナ（コード順に掲載）
            'town_mb' => $row[5],         //町域名 - 半角カタカナ（五十音順に掲載）
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

    private function insertZipcodesByChunk ($data) {

        $data_chunked = array_chunk($data, 300);

        $result = [];
        foreach ($data_chunked as $data) {
            $result = $this->insertZipcodes($data);
        }

        return $result;
    }

    private function insertZipcodes ($data = []) {

        $zipcodes = $this->Zipcodes;

        $columns = [
            '`jis_code`',
            '`zipcode_old`',
            '`zipcode`',
            '`prefecture_mb`',
            '`city_mb`',
            '`town_mb`',
            '`prefecture`',
            '`city`',
            '`town`',
            '`has_multi_zipcode`',
            '`is_each_AZA`',
            '`has_CHOU`',
            '`is_multi_zipcode`',
            '`update_reason`',
            '`change_reason`',
        ];

        $zipcodes_query = $zipcodes->query();
        $zipcodes_query->insert($columns);

        foreach ($data as $row) {
            $zipcodes_query->values($row);
        }

        return $zipcodes_query->execute();

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $session = $this->getRequest()->getSession();

        if ($this->request->is('post')) {
            $search_params = $this->request->getData('Search');
            $session->write('Search.name', $search_params['name']);
            $session->write('Search.kana', $search_params['kana']);
            $where = $this->zipcodesWhereClause($search_params);
            $entities = $this->Zipcodes->find()->where($where);
        } else {
            $search_params = [
                'name' => $session->read('Search.name'),
                'kana' => $session->read('Search.kana')
            ];
            $entities = $this->Zipcodes;
        }

        $zipcodes = $this->paginate($entities);

        $this->set(compact('zipcodes', 'search_params'));
    }

    private function zipcodesWhereClause($params)
    {
        if (isset($params['name']) && strlen(trim($params['name'])) > 0){
            $where['OR'] = [
                ['prefecture LIKE' => '%' . trim($params['name']) . '%'],
                ['city LIKE' => '%' . trim($params['name']) . '%'],
                ['town LIKE' => '%' . trim($params['name']) . '%']
            ];
        }
        return $where;
    }

    /**
     * View method
     *
     * @param string|null $id Zipcode id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zipcode = $this->Zipcodes->get($id, [
            'contain' => []
        ]);

        $this->set('zipcode', $zipcode);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $zipcode = $this->Zipcodes->newEntity();
        if ($this->request->is('post')) {
            $zipcode = $this->Zipcodes->patchEntity($zipcode, $this->request->getData());
            if ($this->Zipcodes->save($zipcode)) {
                $this->Flash->success(__('The zipcode has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zipcode could not be saved. Please, try again.'));
        }
        $this->set(compact('zipcode'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Zipcode id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $zipcode = $this->Zipcodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zipcode = $this->Zipcodes->patchEntity($zipcode, $this->request->getData());
            if ($this->Zipcodes->save($zipcode)) {
                $this->Flash->success(__('The zipcode has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zipcode could not be saved. Please, try again.'));
        }
        $this->set(compact('zipcode'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Zipcode id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $zipcode = $this->Zipcodes->get($id);
        if ($this->Zipcodes->delete($zipcode)) {
            $this->Flash->success(__('The zipcode has been deleted.'));
        } else {
            $this->Flash->error(__('The zipcode could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
