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

            $this->set([
                'data' => $data[0],
                'value' => 'abc'
            ]);
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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $zipcodes = $this->paginate($this->Zipcodes);

        $this->set(compact('zipcodes'));
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
