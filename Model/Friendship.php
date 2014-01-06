<?php

class Friendship extends AppModel {
    
    public $belongsTo = array(
        'UserFrom' => array(
            'className' => 'User',
            'foreignKey' => 'user_from'
        ),
        'UserTo' => array(
            'className' => 'User',
            'foreignKey' => 'user_to'
        )
    );
    
    public $validate = array(
        'user_from' => array(
            'rule' => array('uniqueFriendship'),
            'message' => 'You are already friends.'
        )
    );
    
    public function uniqueFriendship() {
        $from = $this->data[$this->alias]['user_from'];
        $to = $this->data[$this->alias]['user_to'];
        
        $conditions = array (
            'OR' => array( 
                array('user_from' => $from, 'user_to' => $to),
                array('user_from' => $to, 'user_to' => $from)
            )
        );
        return !$this->find('count', array('conditions' => $conditions)) > 0;
    }
    
    public function checkUnique($data, $fields) {
        if (!is_array($fields)) { 
            $fields = array($fields); 
        }
        
        foreach($fields as $key) { 
            $tmp[$key] = $this->data[$this->name][$key]; 
        } 
        
        if (isset($this->data[$this->name][$this->primaryKey])) { 
            $tmp[$this->primaryKey] = "<>".$this->data[$this->name][$this->primaryKey]; 
        } 
        
        return $this->isUnique($tmp, false); 
    } 
}