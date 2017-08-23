<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {

	public $name = 'User';
	public $validate = array();
	//public $virtualFields	=	array("country"=>"select name from countries where id=country_id");
	function addValidate() {
		$validate1 = array(
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email'),
						'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => 'Please enter valid email',
						'last'=>true),
						'duplicate' => array(
													'rule' => 'isUnique',
													'on' => 'create',
													'message' => 'This email is already exist.'
											)
					),
					'password'=> array(
						'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter password')
					),
					'username'=> array(
						'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter username')
					),
					'postal_code'=> array(
						'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter   postal_code')
					)/* ,
					'year'=> array(
						'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter year')
					) */
					
					
			     );
			
		$this->validate=$validate1;
		return $this->validates();
	}
	
	function forgotValidate() {
		$validate1 = array(
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email'),
						'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => 'Please enter valid email',
						'last'=>true)
					)
					
			     );
			
		$this->validate=$validate1;
		return $this->validates();
	}
	
	function editValidate() {
		$validate1 = array(
					'postal_code'=> array(
						'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter   postal_code')
					),
					'year'=> array(
						'mustNotEmpty'=>array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter year')
					)
					
					
			     );
			
		$this->validate=$validate1;
		return $this->validates();
	}
	
	function LoginValidate() {
		$validate1 = array(
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email'),
						'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => 'Please enter valid email',
						'last'=>true)
					),
					'password'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter password')
					)
			     );
			
		$this->validate=$validate1;
		return $this->validates();
	}
	
}
