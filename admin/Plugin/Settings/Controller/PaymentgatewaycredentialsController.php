<?php
class PaymentgatewaycredentialsController  extends SettingsAppController {
			
	/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Settings';

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
	
	/* public function index() {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('App Settings', true));		
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
		/* $this->set('title_for_layout', __('Settings'));

		$this->Setting->recursive = 0;
		$this->Paginator->settings['Setting']['order'] = "Setting.weight ASC";
		if (isset($this->request->params['named']['p'])) {
			$this->Paginator->settings['Setting']['conditions'][] = "Setting.key LIKE '" . $this->request->params['named']['p'] . "%'";
		}
		//$this->Paginator->settings['Setting']['conditions']['editable'] = 1;
		$this->set('result', $this->paginate()); 
	}
 */
	

	public function add() {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('App Settings', true)] = array('plugin' => 'settings', 'controller' => 'Emailtemplates', 'action' => 'index');
		$breadcrumb = array('pages' => $pages, 'active' =>'Add New Setting');
		
		$this->set('breadcrumb', $breadcrumb); 
		
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->AddSettingValidate()){
				$this->{$this->modelClass}->save($this->data);
				$this->Session->setFlash(__('App setting has been saved successfully.'),'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->set('data',$this->data);
			}	
		} 
	}

	public function edit($id = null) {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('App Settings', true)] = array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'index');
		$user = $this->{$this->modelClass}->findById($id);
		
		$breadcrumb = array('pages' => $pages, 'active' => __('Edit Setting', true));
		$this->set('breadcrumb', $breadcrumb); 
		$this->{$this->modelClass}->id = $id; 
		$this->set('id', $id);	 
		if (empty($this->data)) {
			$this->data = $this->{$this->modelClass}->read();
		 } else { 
			$this->{$this->modelClass}->set($this->data);
			
			if($this->{$this->modelClass}->AddSettingValidate()) {				
				if ($this->{$this->modelClass}->save($this->data)) {
					$this->Session->setFlash('App settings has been updated.', 'success');
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
		$this->Session->setFlash(__('Setting has been deleted.'),'success');
		$this->redirect(array('action' => 'index'));	
	}
	public function prefix($prefix = null) {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('App Settings', true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('title_for_layout', sprintf(__('Settings: %s'), $prefix));
		
		if (!empty($this->request->data) && $this->Setting->saveAll($this->request->data['Setting'])) {
			$this->Session->setFlash(__("Settings updated successfully"), 'success');
			}
		$settings = $this->Setting->find('all', array(
			'order' => 'Setting.weight ASC',
			'conditions' => array(
				'Setting.key LIKE' => $prefix . '.%',
				'Setting.editable' => 1,
			),
		));
		$this->set(compact('settings'));
		if (count($settings) == 0) {
			$this->Session->setFlash(__("Invalid Setting key"), 'error');
			$this->redirect(array('action' => 'prefix','Site'));
		}

		$this->set("prefix", $prefix);
	}	
}