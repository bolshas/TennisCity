<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $hasOne = array(
        'Profile' => array(
            'dependent' => true
        )
    );
    
    public $hasMany = array(
    	'FriendFrom' => array(
    		'className' => 'Friendship',
    		'foreignKey' => 'user_from'
    	),
    	'FriendTo' => array(
    		'className' => 'Friendship',
    		'foreignKey' => 'user_to'
    	)
    );
    
    public $hasAndBelongsToMany = array(
    	'UserFriendship' => array (
    		'className' => 'User',
    		'joinTable' => 'friendships',
    		'foreignKey' => 'user_from',
    		'associationForeignKey' => 'user_to',
    		'with' => 'Friendship'
    	)
    );
    
    function __construct() {
        $this->success = array(
            'username' => __('This is how others will see you.'),
            'email' => __('We\'ll send you an email in order to make sure it is yours.'),
            'password' => __('Your password is strong.'));
        return parent::__construct();
    }
    
    public $success = array();

    public $validate = array(
        'username' => array(
            'not_empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Your name as others will see you.',
                'last' => true
            ),
            'minimum' => array(
                'rule' => array('minLength', 3),
                'message' => 'At least 3 characters long.',
                'last' => true
            ),
            'real_name' => array(
                'rule' => "/^\pL{2,} ?\pL{2,}( ?\pL{2,})?$/i",
                'message' => "That doesn't look like a real name.",
                'last' => true
            )
        ),

        'email' => array(
            'not_empty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field is required.',
                'last' => true
            ),
             
            'real_email' => array(
                'rule' => array('email', true),
                'message' => 'Please provide a valid email address.',
                'last' => true
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This email is already in use.',
                'last' => true
            )
        ),
        
        'password' => array(
            'not_empty' => array(
                'rule' => 'notEmpty',
                'message' => 'A password is required.',
                'last' => true
            ),
            'minimum' => array(
                'rule' => array('minLength', 8),
                'message' => 'At least 8 characters.',
                'last' => true
            ),
            'strong' => array(
                'rule' => "/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[\d]).*$/",
                'message' => 'At least one lowercase and one uppercase letter, and one number.',
                'last' => true
            )
        )
    );
    
    public function friends() { 
        $conditions = array('status' => '0', 'OR' => array('user_from' => $this->id, 'user_to' => $this->id));
        $fields = array('UserFrom.username', 'UserTo.username', 'UserFrom.id', 'UserTo.id');
        $data = $this->Friendship->find('all', array('conditions' => $conditions, 'fields' => $fields));
        
        foreach ($data as $friend) {
            if ($friend['UserFrom']['id'] != $this->id) $friends[] = $friend['UserFrom']['id'];
            if ($friend['UserTo']['id'] != $this->id) $friends[] = $friend['UserTo']['id'];
        }
        
        return $friends;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
    }
}