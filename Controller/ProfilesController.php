<?php

class ProfilesController extends AppController {
    public function create() {
        if ($this->request->is('post')) {
            pr($this->request->data);
            // $this->User->Profile->save($this->request->data);
        }
    }
}