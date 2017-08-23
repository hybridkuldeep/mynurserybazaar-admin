<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Rating extends AppModel {

	public $name = 'Rating';
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
				),
				'rating_type_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter rating type id')
				),
				'rate'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter rate ')
				),
				
		);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	

	
}
