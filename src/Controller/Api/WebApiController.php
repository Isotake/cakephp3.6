<?php
namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * WebApi Controller
 *
 *
 * @method \App\Model\Entity\WebApi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WebApiController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $webApi = $this->paginate($this->WebApi);

        $this->set(compact('webApi'));
    }

    /**
     * View method
     *
     * @param string|null $id Web Api id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $webApi = $this->WebApi->get($id, [
            'contain' => []
        ]);

        $this->set('webApi', $webApi);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $webApi = $this->WebApi->newEntity();
        if ($this->request->is('post')) {
            $webApi = $this->WebApi->patchEntity($webApi, $this->request->getData());
            if ($this->WebApi->save($webApi)) {
                $this->Flash->success(__('The web api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The web api could not be saved. Please, try again.'));
        }
        $this->set(compact('webApi'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Web Api id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $webApi = $this->WebApi->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $webApi = $this->WebApi->patchEntity($webApi, $this->request->getData());
            if ($this->WebApi->save($webApi)) {
                $this->Flash->success(__('The web api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The web api could not be saved. Please, try again.'));
        }
        $this->set(compact('webApi'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Web Api id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $webApi = $this->WebApi->get($id);
        if ($this->WebApi->delete($webApi)) {
            $this->Flash->success(__('The web api has been deleted.'));
        } else {
            $this->Flash->error(__('The web api could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
