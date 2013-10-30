<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    
    public $components = array('Password');
    public $helpers = array('Html');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'confirm');
    }

    public function confirm() {
        if ($this->request['pass']) {
            $u = $this->User->findByValidation($this->request['pass'][0]);
            if (empty($u)) {
                $this->Session->setFlash(__('Incorrect validation code.'));
            }
            else {
                if ($u['User']['state'] == 0) {  // the user is found but is inactive
                    $this->User->id = $u['User']['id'];
                    $this->User->saveField('state', 1); // activate the email
                    $this->Session->setFlash(__('Email validated successfully.'));
                }
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
        else {
            $this->Session->setFlash(__('The validation code has been sent to your email address. Please follow the instructions there.'));
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
                
                $this->Session->setFlash(__('The validation code has been sent to your email address. Please follow the instructions there.'));
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
            $this->Session->setFlash(__('Invalid username or password, please try again'));
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
    } 
    
    public function edit($id = null) {
        $this->User->id = $id;
        
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please try again.'));
        }
        else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowdException(__('Invalid user'));
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}