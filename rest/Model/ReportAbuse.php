<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class ReportAbuse extends AppModel {

	public $name = 'ReportAbuse';
	public $validate = array();
	//public $virtualFields	=	array("country"=>"select name from countries where id=country_id");
	function addValidate() {
		$validate1 = array(
				'user_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter User id')
				),
				'comment_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter comment id')
				)
				
		);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	

	
}
