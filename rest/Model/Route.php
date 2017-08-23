<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Route extends AppModel {

	public $name = 'Route';
	public $validate = array();
	//public $virtualFields	=	array("country"=>"select name from countries where id=country_id");
	function addValidate() {
		$validate1 = array(
				'user_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter User id')
				),
				'name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Route')
				)
				
		);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	

	
}
