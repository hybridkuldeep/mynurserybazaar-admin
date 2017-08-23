<?php
class Calendar extends CalendarAppModel {
	// Name of the model whose extends to CalendarAppModel
	// Here CalendarAppModel extends to AppModel
	
	var $title = 'Calendar';
	
	public $actsAs = array('Containable','Search.Searchable',);
	
	public $filterArgs = array(
		array('name' => 'title', 'type' => 'string')
	);
	public $validate = array();
	
	// Create validation function for checking unique or empty value or already exists in database value check
	
	public function validateAdd(){
		$my_validate = array(
			'title' => array(
				'valid' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Please enter a name of time managment relationship.'
				),
			'mustUnique'=>array(
				'rule' =>'isUnique',
				'message' => __('This name is already exist.'),
				)
			)
		); 
		$this->validate=$my_validate;
		return $this->validates();					
		
	}

}
?>