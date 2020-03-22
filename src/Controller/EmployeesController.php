<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $connection = \Cake\Datasource\ConnectionManager::get('default'); // DB接続を取得
        $connection->logQueries(true); // SQL Queryのログ出力を有効化

        // 内部構造を構築する
//        $this->Employees->recover();

        // 部下の数を調べる
//        $node = $this->Employees->get(1);
//        echo $this->Employees->childCount($node);

        // 深さを取得する - ルートは0
//        $node = $this->Employees->get(5);
//        echo $this->Employees->getLevel($node);

        // ノードの子孫のフラットなリストを取得する
//        $descendants = $this->Employees->find('children', ['for' => 3]);
//        foreach ($descendants as $descendant) {
//            echo $descendant->name . '<br />';
//        }

        // 各ノードの子が階層内にネストされているスレッドリストが必要な場合
//        $descendants = $this->Employees
//            ->find('children', ['for' => 1])
//            ->find('threaded')
//            ->toArray();
//        foreach ($descendants as $descendant) {
//            echo "{$descendant->name} は、直下の子が " . count($descendant->children) . " あります。<br>";
//        }

        // スレッド化された結果を取得
//        $list = $this->Employees->find('treeList', [
//            'keyPath' => 'id',
//            'valuePath' => 'name',
//            'spacer' => ' * '
//        ])->toArray();
//        foreach ($list as $node) {
//            echo $node . '<br />';
//        }

        // ノードまでのパスを取得する
//        $crumbs = $this->Employees->find('path', ['for' => 5]);
//        foreach ($crumbs as $crumb) {
//            echo $crumb->name . ' > ';
//        }

        // 同じレベルの一番先頭に移動
//        $node = $this->Employees->get(5);
//        $this->Employees->moveUp($node, true);

        $connection->logQueries(false); // SQL Queryのログ出力を無効化
        $this->log($connection, 'debug');

        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);

        $this->set('employee', $employee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
