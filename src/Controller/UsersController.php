<?php
namespace App\Controller;

use App\Controller\AppController;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Activations\IlluminateActivationRepository as Activation;
use Cartalyst\Sentinel\Reminders\IlluminateReminderRepository as Reminder;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Database\Capsule\Manager as Capsule;
use Cake\Mailer\Email;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    private $sentinel;

    public function initialize()
    {
        parent::initialize();


        $dbuser = Configure::read('App.sentinel.dbuser');
        $dbpass = Configure::read('App.sentinel.dbpass');
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'caketest',
            'username'  => $dbuser,
            'password'  => $dbpass,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
        $capsule->bootEloquent();

        $this->sentinel = (new Sentinel())->getSentinel();
    }

    public function signupRegister()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $credential = [
                'email' => $request_data['email'],
                'password' => $request_data['password'],
                'created_at' => \Cake\I18n\Time::now('Asia/Tokyo'),
                'updated_at' => \Cake\I18n\Time::now('Asia/Tokyo'),
            ];
            $user_data = $this->Users->patchEntity($user, $credential);

            if (!$user_data->errors()) {
                $this->request->session()->write('Signin.valid', $user_data);
                return $this->redirect(['action' => 'signup-confirm']);
            } else {
                $this->Flash->error('The user could not be saved. Please try again.');
            }
        }
        $this->set(compact('user'));
    }

    public function signupConfirm()
    {
        $user_session_data = $this->request->session()->read('Signin.valid');
        $credential = [
            'email' => $user_session_data['email'],
            'password' => $user_session_data['password'],
            'created_at' => \Cake\I18n\Time::now('Asia/Tokyo'),
            'updated_at' => \Cake\I18n\Time::now('Asia/Tokyo'),
        ];
        $user_entity = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user_entity, $credential);

        if ($this->request->is('post')) {
            $activation_repository = new Activation;

            $user_entity = $this->Users->newEntity();
            $request_data = $this->request->getData();
            $user_data = $this->Users->patchEntity($user_entity, $credential);
            if (!$user_data->errors()) {
                $credential = [
                    'email' => $request_data['email'],
                    'password' => $request_data['password'],
                    'created_at' => \Cake\I18n\Time::now('Asia/Tokyo'),
                    'updated_at' => \Cake\I18n\Time::now('Asia/Tokyo'),
                ];
                $user = $this->sentinel->register($credential);
                $activation = $activation_repository->create($user);
                $this->sendActivationCode($user['email'], $activation->code);
            }

            return $this->redirect(['action' => 'signup-mailed']);
        }
        $this->set(compact('user'));
    }

    public function signupMailed()
    {

    }

    public function sendActivationCode($user_email, $code) {
        $content = 'http://192.168.1.133/caketest/users/activate?email=' . base64_encode($user_email) . '&code=' . $code;

        $email = new Email('mail');
        $email->setFrom(['info@takehaya.jp' => 'My Site']);
        $email->setTo($user_email);
        $email->setSubject('About');
        $email->Send($content);
    }

    public function activate() {
        $request_email = base64_decode($this->request->getQuery('email'));
        $request_code = $this->request->getQuery('code');

        $user = $this->sentinel->findByCredentials(['email' => $request_email]);

        if (!$user) {

        }

        $activation_repository = new Activation;
        if ($activation_repository->completed($user)) {

        }

        if (!$activation_repository->complete($user, $request_code)) {

        }

        return $this->redirect(['action' => 'signup-complete']);

    }

    public function signupComplete()
    {

    }

    public function login()
    {
        //$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $credential = [
                'email' => $request_data['email'],
                'password' => $request_data['password'],
            ];

            try
            {
                $user = $this->sentinel->authenticate($credential);
            }
            catch (NotActivatedException $notActivated)
            {
                $this->Flash->error('Account is not activated.');
                return $this->redirect(['action' => 'login']);
            }
            catch (ThrottlingException $throttling)
            {
                $delay = $throttling->getDelay();
                $this->Flash->error('Your account is blocked for ' . $delay . 'second(s).');
                return $this->redirect(['action' => 'login']);
            }

            if (!$user) {
                $this->Flash->error('Invalid email or password.');
                return $this->redirect(['action' => 'login']);
            }

            $this->Flash->success('you are logged in.');
            return $this->redirect(['action' => 'mypage']);

        }
        //$this->set(compact('user'));
    }

    public function mypage()
    {

    }

    public function logout()
    {
        $this->sentinel->logout();
        $this->Flash->success('you are now logged out.');
        return $this->redirect(['action' => 'login']);
    }

    public function reminder()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $credential = [
                'email' => $request_data['email'],
            ];
            $user = $this->sentinel->findByCredentials($credential);
            if (!$user) {

            }

            $reminder_repository = $this->sentinel->getReminderRepository();
            $reminder = $reminder_repository->create($user);
            $reminder_code = $reminder->code;
            $this->sendReminderCode($user['email'], $reminder_code);
            return $this->redirect(['action' => 'reminder-mailed']);
        }

        $this->set(compact('user'));
    }

    public function reminderMailed()
    {

    }

    public function sendReminderCode($user_email, $code) {
        $content = 'http://192.168.1.133/caketest/users/reminder-complete?email=' . base64_encode($user_email) . '&code=' . $code;

        $email = new Email('mail');
        $email->setFrom(['info@takehaya.jp' => 'My Site']);
        $email->setTo($user_email);
        $email->setSubject('About');
        $email->Send($content);
    }

    public function reminderComplete()
    {
        $request_email = base64_decode($this->request->getQuery('email'));
        $request_code = $this->request->getQuery('code');

        $user = $this->sentinel->findByCredentials(['email' => $request_email]);

        if (!$user) {

        }

        $reminder_repository = $this->sentinel->getReminderRepository();
        if ($reminder_repository->complete($user, $request_code, 'new_password')) {

        }

        return $this->redirect(['action' => 'login']);

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Activations', 'Persistences', 'Reminders', 'RoleUsers', 'Throttle']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
