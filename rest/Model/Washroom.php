<?php
header("Access-Control-Allow-Origin: *");
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Washroom extends AppModel {

	public $name = 'Washroom';
	public $validate = array();
	//public $virtualFields	=	array("country"=>"select name from countries where id=country_id");
	function addValidate() {
		$validate1 = array(
				'name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter title')
				),
				'description'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter description ')
				),
				
				'address'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter address '),
					'duplicate' => array(
													'rule' => 'isUnique',
													'on' => 'create',
													'message' => 'This Washroom is already exist.'
											)
				
				),
				'postal_code'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter postal_code ')
				),
				'lat'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter lat ')
				),
				'log'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter log ')
				)
				
		);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	

	
}
