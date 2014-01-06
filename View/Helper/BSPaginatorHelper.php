<?php

App::uses('PaginatorHelper', 'View/Helper');

class BSPaginatorHelper extends PaginatorHelper {
    private $numbersSettings = array(
        'before' => '',
        'after' => '',
        'separator' => '',
        'tag' => 'li',
        'currentClass' => 'active',
        'currentTag' => 'span'
        );
    
    private $jumpSettings = array(
        'tag' => 'li',
        'disabledTag' => 'li',
        'escape' => false,
        'class' => false
        );

    private $jumpDisabledSettings = array(
        'tag' => 'li',
        'disabledTag' => 'a',
        'escape' => false,
        'class' => 'disabled'
        );
        
    public function BSnumbers() {
        $return = '<div class="text-center"><ul class="pagination">' . 
        $this->prev('&laquo;', $this->jumpSettings, '&laquo;', $this->jumpDisabledSettings) .
        $this->numbers($this->numbersSettings) .
        $this->next('&raquo;', $this->jumpSettings, '&raquo;', $this->jumpDisabledSettings) .
        '</ul></div>';
        
        return $return;
    }
}