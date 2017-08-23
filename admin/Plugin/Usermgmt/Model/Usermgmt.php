<?php
class Usermgmt extends UsermgmtAppModel {
	var $name 			= 	'User';
	var $actsAs 		= 	array('Search.Searchable');
	// var $actsAs 		= 	array('Tree');
	 
	// public $filterArgs 	= 	array(
								// 'name' => array('type' => 'like')
							// ); 

	public $useTable	=	"users";
	public $filterArgs 	= 	array(
		
		array('name' => 'full_name', 'type' => 'string'),
		
		array('name' => 'email', 'type' => 'string'),
		array('name' => 'address', 'type' => 'string'),
		array('name' => 'phone', 'type' => 'string')
		
	);
	

	public function filtershare($data = array()) {
		if(!isset($data['share']) ) { 
			return array();
		}
		
		return array(
			
				'share' => $data['share'],

			
		);
	}
	public function filterAGE($data = array()) {
		//$data['agee'] = (int)$data['agee'];
		if(!isset($data['ages']) || !isset($data['agee']) ) { 
			return array();
		}
		if($data['ages'] =="" && $data['agee'] != ""){
				return array();
			}else if($data['ages'] !="" && $data['agee'] == ""){
				return array();
			}else if($data['ages'] > $data['agee']){
				return array();
			}
		
		return array(
			'AND' => array(
				'Usermgmt.age >=' => $data['ages'],
				'Usermgmt.age <=' => $data['agee']
			)
		);
	}
	public function filterFB($data = array()) {
		if(!isset($data['fbid'])) { 
			return array();
		}
		if($data['fbid'] == 1){
			return array(
				'OR' => array(
					'Usermgmt.fbid' => ""
				)
			);
		}else{
			return array(
				'OR' => array(
					'Usermgmt.fbid !=' => ""
				)
			);
		}
	}
	public function filterTAG($data = array()) {
		if(!isset($data['tag'])) { 
			return array();
		}
		return array(
			'OR' => array(
				'Usermgmt.interest_category LIKE ' => $data['tag'],
				'Usermgmt.interest_category LIKE  ' => '%,'.$data['tag'].',%',
				'Usermgmt.interest_category LIKE   ' => ''.$data['tag'].',%',
				'Usermgmt.interest_category LIKE' => '%,'.$data['tag'].''
			)
		);
	}
	public function filterQuery($data = array()) {
		if(!isset($data['status'])) { 
			return array();
		}
		$query = '%'.$data['status'].'%';
		return array(
			'OR' => array(
				'Usermgmt.status LIKE' => $query
			)
		);
	}
	/* public $hasMany = array(
						'Folder'
	); */
	public $validate 	= 	array(
								'email' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for email.'
											),
											'duplicate' => array(
													'rule' => 'isUnique',
													'on' => 'create',
													'message' => 'This email is already exist.'
											),
											'duplicate1' => array(
													'rule' => 'email',
													'message' => 'Please enter valid email.'
											)
									),
									'full_name' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for first name.'
											)
									),
								'password' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for password.'
											)
									),
								'confirm_password' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for confirm password.'
											),
											'duplicate2' => array(
													'rule' => 'matchpassword',
													'on' => 'create',
													'message' => 'Password must be same.'
											)
									),	
								
							); 
							
	function EditValidate() {
		$validate1 = array(
				'firstname'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter first name')
					),
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email',
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => 'Please enter valid email',
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This email is already registered',
						)
					),
				'image' => array(
						'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','pjpeg')),
						'message' => 'Please upload a valid image.',
						'on' => 'create'
						)	
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	function EmployeeValidate() {
		$validate1 = array(
				'firstname'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter first name')
					)
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	
	function ChangePassword() {
		$validate1 = array(
				'password' => array(
										'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for password.'
											)
									),
								'confirm_password' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for confirm password.'
											),
											'duplicate2' => array(
													'rule' => 'matchpassword',
													'on' => 'create',
													'message' => 'Password must be same.'
											)
									)
			);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	
	
	
	public function matchpassword(){
		 $password		=	$this->data[$this->alias]['password'];
		 $temppassword	=	$this->data[$this->alias]['confirm_password'];
		if($password==$temppassword)
			return true;
		else
			return false; 
	
	}						

}
?>