<?php

class FriendshipsController extends AppController {
    public function add() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->request->data['user_from'] = $this->Auth->user('id');
            $this->request->data['status'] = 0;
            $this->Friendship->create();
            $this->Friendship->save($this->request->data);
            echo 0;
            // pr($this->request->data);
        }
        // $this->Friendship->create();
        // $this->Friendship->set('user_from', '8');
        // $this->Friendship->set('user_to', '9');
        // $this->Friendship->save($this->request->data);
        
    }
    public function index() {
        $this->autoRender = false;
        pr ($this->Friendship->find('all'));
    }
}
    