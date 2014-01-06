<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    
    public $components = array('Password', 'Paginator');
    public $helpers = array('Html', 'BSForm', 'BSPaginator', 'Country');
    
    public $paginate = array (
    	'limit' => 24,
    	'order' => array('User.username' => 'asc'),
    	'conditions' => array('User.state' => '1')
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'confirm');
    }
    
    public function info() {
    	$this->autoRender = false;
    	
    	require_once('../Vendor/Faker/src/autoload.php');
    	$faker = Faker\Factory::create('lt_LT');
    	
    	$directory = IMAGES . 'faces/';
    	$handler = opendir($directory);
    	
    	while ($file = readdir($handler)) {
    		if($file != '.' && $file != '..') {
	            $data['User']['username'] = $faker->firstname . ' ' . $faker->lastname;
	            $data['User']['password'] = 'Password123';
	            $data['User']['email'] = $faker->unique()->email;
	            $data['User']['validation'] = $this->Password->random();
	            $data['User']['state'] = 1;
	            $data['User']['id'] = '';
	            
	            $data['Profile']['photo'] = $file;
	            $data['Profile']['born'] = array('year' => $faker->year, 'month' => $faker->month, 'day' => $faker->dayOfMonth);
	            $data['Profile']['started'] = array('year' => $faker->year, 'month' => $faker->month, 'day' => $faker->dayOfMonth);
	            $data['Profile']['experience'] = $faker->randomElement(array('professional','amateur'));
	            $data['Profile']['hand'] = $faker->randomElement(array('left','right'));
	            $data['Profile']['sex'] = $faker->randomElement(array('male','female'));
	 			$data['Profile']['country'] = $faker->countryCode;
	 			$data['Profile']['id'] = '';
	 			
	 			$this->User->create($data);
    			// $this->User->saveAssociated($data);
    		}
        }
        closedir($handler);
    }
    
    public function home() {
        $user = $this->User->findById($this->Session->read('Auth.User.id'));
        $this->request->data = $this->User->read(null, $user['User']['id']);
        $this->set('cities', $this->User->Profile->City->find('list'));
    }
    
    public function index() {
    	$this->Paginator->settings = $this->paginate;
    	
    	$data = $this->Paginator->paginate('User');
    	$this->set('users', $data);
    	
        $loggedIn = $this->User->read(null, $this->Session->read('Auth.User.id'));
    	$this->set('friends', $this->User->friends());
    	$this->set('loggedIn', $loggedIn);
    }

    public function confirm() {
        if ($this->request['pass']) {
            $u = $this->User->findByValidation($this->request['pass'][0]);
            if (empty($u)) {
                $this->Session->setFlash(__('Incorrect validation code.'), 'danger');
            }
            else {
                if ($u['User']['state'] == 0) {  // the user is found but is inactive
                    $this->User->id = $u['User']['id'];
                    $this->User->saveField('state', 1); // activate the email
                    $this->Session->setFlash(__('Email validated successfully.'), 'success');
                }
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
        else {
            $this->Session->setFlash(__('The validation code has been sent to your email address. Please follow the instructions there.'), 'success');
        }
    }

    public function register() {
        if ($this->request->is('post')) {
            $validation = $this->Password->random();
            $userEmail = $this->request->data['User']['email'];
            $this->User->create();         
            $this->request->data['User']['validation'] = $validation;
            
            if ($this->User->save($this->data)) {
                $email = new CakeEmail('default');
                $email->to($userEmail);
                $email->subject('Account activation');
                $email->emailFormat('html');
                $email->template('confirm');
                $email->viewVars(array('validation' => $validation));
                $email->send();
                
                $this->Session->setFlash(__('The validation code has been sent to your email address. Please follow the instructions there.'), 'success');
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('state') == 1) { //check if the user has confirmed their email.
                    if ($this->request->data['User']['remember_me'] == 1) {
                        unset($this->request->data['User']['remember_me']);
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                        $this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '2 weeks');
                    }
                    $this->User->id = $this->Auth->user('id');
                    $this->User->saveField('online', date("Y-m-d H:i:s"));
                    return $this->redirect($this->Auth->redirectUrl());
                } 
                else {
                    $this->Auth->logout();
                    return $this->redirect(array('controller' => 'users', 'action' => 'confirm'));
                }
            }
            $this->Session->setFlash(__('Invalid username or password, please try again'), 'danger');
        }
    }
    
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
        $this->set('friends', $this->User->Friendship->getFriends($id));
        // $this->set('friends', $this->User->Friendship->showFriends($id));
    } 
    
    public function edit($id = null) {
        $this->User->id = $id;
        
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'success');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please try again.'), 'danger');
        }
        else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('Invalid user'));
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'), 'danger');
        return $this->redirect(array('action' => 'index'));
    }
}