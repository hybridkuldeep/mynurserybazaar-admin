<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Favourite extends AppModel {

	public $name = 'Favourite';
	public $validate = array();
	//public $virtualFields	=	array("country"=>"select name from countries where id=country_id");
	function addValidate() {
		$validate1 = array(
				'user_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter User id')
				),
				'washroom_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter washroom id')
				)
				
		);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	

	
}
