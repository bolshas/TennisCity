<?php
class CourtsController extends AppController {

	public function ajax_Validate() {
	    if ($this->request->is('post')) {
	        $this->layout = 'ajax';
	        
	        $modelName = key($this->request->data);
	        $fieldName = $this->request->data[$modelName]['fieldName'];
	        
	        $this->loadModel($modelName);
	        $this->$modelName->set($this->request->data);
	        
	        if ($this->$modelName->validates(array('fieldList' => array($fieldName)))) {
	        } else {
	            $this->set('errors', json_encode($this->$modelName->validationErrors));
	        }
	    }
	}
}