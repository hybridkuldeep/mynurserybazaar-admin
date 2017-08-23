<?php
class EmailtemplatesController extends SettingsAppController {
	/**
 * Controller name
 *
 * @var string
 */
	public $name = 'EmailTemplates';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time','Fck','Javascript', 'Text', 'Utils.Gravatar');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');

/**
 * $presetVars
 *
 * @var array $presetVars
 */
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'body', 'type' => 'value')
	);

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->set('model', $this->modelClass);
	}
	
	public function index() {
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Email Template', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}	
		
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
				
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.word' => 'asc')	
		);		
		$result= $this->paginate();
		$this->set('result', $result);
		
	}
	public function add(){
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Email Templates', true)] = array('plugin' => 'settings', 'controller' => 'Emailtemplates', 'action' => 'index');
		$breadcrumb = array('pages' => $pages, 'active' =>'Add Email Template');
		
		$this->set('breadcrumb', $breadcrumb); 
		 $this->loadModel('EmailAction');
		 $Action_options = $this->EmailAction->find('list', array('fields' => array('action','action')));
		 $this->set('Action_options',$Action_options); 
		 
		if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->AddTemplateValidate()){
					$action = $this->data['EmailTemplate']['action'];
					$consts = $this->data['EmailTemplate']['constants'];
					$count = $this->{$this->modelClass}->find('count', array('conditions' => array('action' => $action)));
					if($count == 0) {
						$this->{$this->modelClass}->save($this->data);
						$this->Session->setFlash('Your email template has been saved successfully.','success');
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Your email template already exists.'),'error');
						$this->redirect(array('action' => 'index'));
					}
				}  else {
					
					  $data =$this->data;
					  $this->data = $data;
				}
		
			/* $this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->AddTemplateValidate()){
				$this->{$this->modelClass}->save($this->data);
				$this->Session->setFlash('Email template has been saved successfully.','success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->set('data',$this->data);
			}	 */
		} 
	}
	
public function edit($id = null) {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Email Templates', true)] = array('plugin' => 'settings', 'controller' => 'Emailtemplates', 'action' => 'index');
		$user = $this->{$this->modelClass}->findById($id);
		//pr($user);
		$breadcrumb = array('pages' => $pages, 'active' => __($user['EmailTemplate']['name'], true));
		$this->set('breadcrumb', $breadcrumb); 
		$this->{$this->modelClass}->id = $id; 
		$this->set('id', $id);	
		$this->loadModel('EmailAction');
		$Action_options = $this->EmailAction->find('list', array('fields' => array('action','action')));
		$this->set('Action_options',$Action_options);	
		if (empty($this->data)) {
			$this->data = $this->{$this->modelClass}->read();
		 } else { 
			$this->{$this->modelClass}->set($this->data);
			
			if($this->{$this->modelClass}->EditTemplateValidate()) {				
				if(isset($this->data['EmailTemplate']['action'])){
					if($this->data['EmailTemplate']['action'] != $user['EmailTemplate']['action']){
						$this->Session->setFlash('Your email template already exist.','success');
						$this->redirect(array('action' => 'index'));
						exit;
					}
				}
				
				if ($this->{$this->modelClass}->save($this->data)) {
					$this->Session->setFlash(__('Your email template has been updated successfully.'),'success');
					$this->redirect(array('action' => 'index'));
					}  
				
			}else{
				//pr($this->{$this->modelClass}->invalidFields()); exit;
			}
		}
				
	}  
public function delete($id = null) {
	$this->layout = false;
	$this->{$this->modelClass}->id = $id; 
	$this->{$this->modelClass}->delete($id);
	$this->Session->setFlash(__('Email template has been deleted.'),'success');
	$this->redirect(array('action' => 'index'));
		
	}
	
public function addaction() {
		 
	if(!empty($this->data)){
		$this->loadModel('EmailAction');
		$this->EmailAction->set($this->data);
		$this->EmailAction->validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true, 'allowEmpty' => false,
				'message' => __d('title', 'Please enter action name.', true)),
				
		),
		
		);
	
			if($this->EmailAction->validates()){
				$name = $this->data['EmailAction']['name'];
				$options = implode(',',$this->data['EmailAction']['options']);
				$data['action']   = $name;
				$data['options'] = $options;
				$this->EmailAction->save($data);
				$this->Session->setFlash(__('Your email action has been inserted successfully.'),'success');
				$this->redirect(array('action' => 'index')); 
		}
	}
}

public function constants() {
		 $this->layout 		= 	'ajax';
		 $constant_name 	= 	$_POST['constant'];
		 
		 $this->loadModel('EmailAction');
		 $options = $this->EmailAction->find('list', array('fields' => array('action','options'), 'conditions' => array('action' =>  $constant_name)));
		 $a = explode(',',$options[$constant_name]);
		if($constant_name == $constant_name){
			$Email_constant	= 	$a;
			
		} else {
			$Email_constant	=	Configure::read('Email_subscription');
		}
		echo json_encode($Email_constant);
		exit;
	}	

}