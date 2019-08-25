<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PhotosTags Controller
 *
 * @property \App\Model\Table\PhotosTagsTable $PhotosTags
 *
 * @method \App\Model\Entity\PhotosTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhotosTagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Photos', 'Tags']
        ];
        $photosTags = $this->paginate($this->PhotosTags);

        $this->set(compact('photosTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Photos Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $photosTag = $this->PhotosTags->get($id, [
            'contain' => ['Photos', 'Tags']
        ]);

        $this->set('photosTag', $photosTag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $photosTag = $this->PhotosTags->newEntity();
        if ($this->request->is('post')) {
            $photosTag = $this->PhotosTags->patchEntity($photosTag, $this->request->getData());
            if ($this->PhotosTags->save($photosTag)) {
                $this->Flash->success(__('The photos tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photos tag could not be saved. Please, try again.'));
        }
        $photos = $this->PhotosTags->Photos->find('list', ['limit' => 200]);
        $tags = $this->PhotosTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('photosTag', 'photos', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Photos Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $photosTag = $this->PhotosTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $photosTag = $this->PhotosTags->patchEntity($photosTag, $this->request->getData());
            if ($this->PhotosTags->save($photosTag)) {
                $this->Flash->success(__('The photos tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photos tag could not be saved. Please, try again.'));
        }
        $photos = $this->PhotosTags->Photos->find('list', ['limit' => 200]);
        $tags = $this->PhotosTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('photosTag', 'photos', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Photos Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photosTag = $this->PhotosTags->get($id);
        if ($this->PhotosTags->delete($photosTag)) {
            $this->Flash->success(__('The photos tag has been deleted.'));
        } else {
            $this->Flash->error(__('The photos tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
