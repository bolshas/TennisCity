<?php

class ProfilesController extends AppController {
    public function update() {
        if ($this->request->is('post')) {
            $user = $this->User->findById($this->Auth->user('id'));
            
            $this->request->data['Profile']['user_id'] = $user['User']['id'];
            $this->request->data['Profile']['id'] = $user['Profile']['id'];
            
            $this->request->data['Profile']['started']['month'] = '1';
            $this->request->data['Profile']['started']['day'] = '1';
            
            if ($this->User->Profile->save($this->request->data)) {
                $this->Session->setFlash(__('Thank you for updating your profile.'), 'success');
                return $this->redirect(array('controller' => 'users', 'action' => 'home'));
            }
        }
    }
}