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
        
        $this->Auth->allow('validateField');
        
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
    
    public function validateField() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $modelName = key($this->request->data);
            $fieldName = $this->request->data[$modelName]['fieldName'];
            
            $this->loadModel($modelName);
            $this->$modelName->set($this->request->data);
            
            if ($this->$modelName->validates(array('fieldList' => array($fieldName)))) {
                $message = $this->$modelName->success[$fieldName];
                $status = 'has-success';
            } else {
                $errors = reset($this->$modelName->validationErrors);
                $message = reset($errors);
                $status = 'has-error';
            }
            echo json_encode(array('status' => $status, $fieldName => $message));
        }
        else {
            echo '<form action="/TennisCity/users/validate" id="UserAjaxValidateForm" method="post" accept-charset="utf-8">';
            echo '<label for="UserFieldName">Field Name</label>';
            echo '<input name="data[User][fieldName]" type="text" id="UserFieldName"/>';
            echo '<label for="UserEmail">Email</label>';
            echo '<input name="data[User][email]" maxlength="100" type="email" id="UserEmail" required="required"/>';
            echo '<input type="submit" value="Submit"/>';
            echo '</form>';
        }
    }
}