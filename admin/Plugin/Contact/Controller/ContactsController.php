<?php
/**
 * Copyright 2012, Gempulse Infotech Pvt. Ltd. (http://www.fullestop.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://www.fullestop.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cms CmsPages Controller
 *
 * @package cms
 * @subpackage CmsPages.controllers
 */

 //uses('sanitize'); 
class ContactsController extends ContactAppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Contacts';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Fck','Text');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');

/**
 * $presetVars
 *
 * @var array $presetVars
 */
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value')
	);

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {//die("hi");
		parent::beforeFilter();
		$this->set('model', $this->modelClass);
	}

/**
 * Common Index action
 *
 * @return void
 */
	
	public function index() {
		$pages[__d('users','Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages'=>$pages, 'active'=>__d('users','Contact templates',true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->Prg->commonProcess();
		//$this->{$this->modelClass}->virtualFields	=	array('first_name' => '(SELECT value FROM user_details WHERE user_id = '.$this->modelClass.'.id and field = "User.first_name")', 'last_name' => '(SELECT value FROM user_details WHERE user_id = '.$this->modelClass.'.id and field = "User.last_name")');

		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		$this->Paginator->settings[$this->modelClass]['conditions'] = $parsedConditions;
		$this->Paginator->settings[$this->modelClass]['order'] = array($this->modelClass . '.created' => 'desc');
		//$this->Paginator->settings[$this->modelClass]['limit'] = 1;

		$this->{$this->modelClass}->recursive = 0;
		try{
			$this->set('result', $this->paginate());
		}catch(Exception $e){
			$d	= explode("/page:",$this->request->url);
			$u = $d[0];
			$dd	= explode("/",$d[1]);
			if(!empty($dd)){
				foreach($dd as $k=>$v){
					if($k != 0){
						$u .= "/".$v;
					}
				}
			}
		return $this->redirect(WEBSITE_URL."admin/".$u); 
		}			
	}
	/*  function for add contact template  */
	public function add() {
		 $pages[__d('users','Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$pages[__d('users','Contact Templates',true)] = array('plugin'=>'contact','controller'=>'contacts','action'=> 'index');
		$breadcrumb = array('pages'=>$pages, 'active'=>__d('add','Add Contact template',true));		
		$this->set('breadcrumb', $breadcrumb); 
		
		if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()){
					$this->{$this->modelClass}->save($this->data);
					$this->Session->setFlash(__('Your contact template has been saved successfulley.'),'success');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->set('data',$this->data);
				}
			
		} 
	}
	
	/*  function for edit contact template  */
	
	public function edit($id = null) {
	 $pages[__d('users','Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$pages[__d('users','Contact Templates',true)] = array('plugin'=>'contact','controller'=>'contacts','action'=> 'index');
		$breadcrumb = array('pages'=>$pages, 'active'=>__d('edit','Edit Contact template',true));		
		$this->set('breadcrumb', $breadcrumb);
	
		$this->{$this->modelClass}->id = $id; 
		$this->set('id', $id);
		if (!empty($this->data)) {
		
			$this->{$this->modelClass}->set($this->data);
			
				if ($this->{$this->modelClass}->save($this->data)) {
				$this->Session->setFlash(__('Your contact template has been updated successfulley.'),'success');
				$this->redirect(array('action' => 'index'));
			}  
				
		}  else {
				$this->data = $this->{$this->modelClass}->read();
		}  
	}
	
	/*  function for delete template  */
	
	public function delete($id = null) {
		$this->layout = false;
		if($this->request->is('Ajax')) {
		if($this->data['id'] != null){
				$this->{$this->modelClass}->id = $this->data['id']; 
				$this->{$this->modelClass}->delete($this->data['id']);
				echo 'Success';
			}	
		}
	  exit;	
	}
	
	/*  function for template constant  */
	
	public function constants() {
		 $this->layout 		= 	'ajax';
		$constant_name 	= 	$_POST['constant'];
		 if($constant_name == 'Registration'){
			$Contact_constant	= 	Configure::read('registration');
			
		} else if($constant_name == 'Forgot Password'){
			$Contact_constant	= 	Configure::read('forgot_password');
			
		}else if($constant_name == 'VerificationMail'){
			$Contact_constant	= 	Configure::read('register_verify');
			
		}else if($constant_name == 'UserPasswordChangedSuccessfully'){
			$Contact_constant	= 	Configure::read('reset_forgot_password');
			
		}else if($constant_name == 'PaymentQuotation'){
			$Contact_constant	= 	Configure::read('payment_quotation');
			
		}else if($constant_name == 'CompanyPaymentQuotation'){
			$Contact_constant	= 	Configure::read('company_quotation');
			
		}else if($constant_name == 'PaymentSuccessful'){
			$Contact_constant	= 	Configure::read('payment_success');
			
		}   
		echo json_encode($Contact_constant);
		exit;
	}
	

}
