<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $components = array(
//        'DebugKit.Toolbar',
        'Cookie',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts', 
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages', 
                'action' => 'display', 
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email'
                    )
                )
            )
        )
    );
    
    public $uses = array('User');
    
    public function beforeFilter() {
        $this->Cookie->key = 'gWlW9AiZjB6OA3uFdeA45anRNT5LxF7DoWUVrJxi';
        $this->Cookie->httpOnly = true;
        
        if ($this->Auth->loggedIn()) {
            $this->layout = 'default';
        }
        else {
            $this->layout = 'welcome';
            if ($this->Cookie->read('remember_me_cookie')) {
                $cookie = $this->Cookie->read('remember_me_cookie');
                
                $user = $this->User->find('first', array(
                    'conditions' =>array(
                        'User.username' => $cookie['email'],
                        'User.password' => $cookie['password'])
                    )
                );
                
                if($user && !$this->Auth->login($user)) {
                    $this->redirect($this->Auth->logout());
                }
            }
        }
    }
}