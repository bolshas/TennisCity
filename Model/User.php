<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'dependent' => true
        )
    );
    
    public $success = array(
        'username' => 'This is how others will see you.',
        'email' => 'We\'ll send you an email to make sure it is yours.',
        'password' => 'Your password is strong.'
        );

    public $validate = array(
        'username' => array(
            'not_empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Your name as other will see you.',
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

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
    }
}