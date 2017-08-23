<?php
/**
 * Settings Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SettingsController extends AppController {
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
	public $helpers = array('Html', 'Form', 'Session', 'Time','Fck', 'Text');

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
	
	}  
	

	public function add() {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('App Settings', true)] = array('plugin' => 'settings', 'controller' => 'Emailtemplates', 'action' => 'index');
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New Setting'));
		
		$this->set('breadcrumb', $breadcrumb); 
		
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);
			//if($this->{$this->modelClass}->AddSettingValidate()){
				$this->{$this->modelClass}->save($this->data);
				$this->Session->setFlash('App setting has been saved successfully.','success');
				$this->redirect(array('action' => 'index'));
			/* }
			else
			{
				$this->set('data',$this->data);
			}	 */
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
		$this->set('title_for_layout', __('Edit Setting'));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Setting'),  'error');
			$this->redirect(array('action' => 'index'));
		}
		/*
		if (!empty($this->request->data)) {
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The Setting has been saved'),  'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Setting could not be saved. Please, try again.'),'error');
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Setting->read(null, $id);
		} */
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
		$error	=	'';
		 if (!empty($this->data)) {
			
			$data		=	$this ->data['Setting'];
			
			$dataArray = array();
			foreach($data as $key=>$val){
				 if(isset($val['image']) && is_array($val['image'])){
					$image		=	'';
					$filename  				= 	$val['image']['name'];
					if($filename !=''){
						$tempPath  			= 	$val['image']['tmp_name'];
						$new_file_name 		=	time().'_'.$filename;
						if(move_uploaded_file($tempPath,SETTING_IMAGE_STORE_PATH. $new_file_name)){
							$image		= 	$new_file_name;
						}else{
							$image		= 	$val['value'];
						}
					}else{
							$image		= 	$val['value'];
					}
					//$this->request->data{$this->modelClass}["image"]=$image;
					
					$data[$key]['value']	=	$image;;
					$dataArray[$this->modelClass]['value']	=	$image;;
					//$dataArray[$this->modelClass]['tmp_name']	=	$val['value']['tmp_name'];
				} 
			
				
			}
				
		//	if(!empty($dataArray) || (isset($dataArray['Setting']['value']) && $dataArray['Setting']['value']=='')){
				if (!empty($this->request->data) && $this->Setting->saveAll($data)) {
					$this->Session->setFlash(__("Settings updated successfully"), 'success');
				}
			
		//	}
		
		$list = $this->Setting->find('list', array(
			'fields' => array(
				'key',
				'value',
			),
			'order' => array(
				'Setting.key' => 'ASC',
			),
		));
		$file = new File(SETTING_FILE_PATH, true);
		$settingfile = '<?php ' . "\n";
		foreach($list as $key=>$value){
			$settingfile .= 'Configure::write("'.$key.'", "'.$value.'");' . "\n";
		}
		$file->write($settingfile);
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

	public function moveup($id, $step = 1) {
		if ($this->Setting->moveUp($id, $step)) {
			$this->Session->setFlash(__('Moved up successfully'),  'success');
		} else {
			$this->Session->setFlash(__('Could not move up'), 'error');
		}

		$this->redirect(array('action' => 'index'));
	}
   
	 public function movedown($id, $step = 1) {
		if ($this->Setting->moveDown($id, $step)) {
			$this->Session->setFlash(__('Moved down successfully'),  'success');
		} else {
			$this->Session->setFlash(__('Could not move down'), 'error');
		}

		$this->redirect(array('action' => 'index'));
	} 
	
	public function delete_image($filename=''){
	
		@unlink(IMAGE_STORE_PATH.$filename);
		
		$smallfilename	=	substr($filename,0,strrpos($filename,"."));
		$ext 		=	strtolower(substr($filename,strrpos($filename,".") + 1));
		
		@unlink(IMAGE_STORE_PATH.'27x31_'.$smallfilename.".".$ext);
		@unlink(IMAGE_STORE_PATH.'38x44_'.$smallfilename.".".$ext);
		@unlink(IMAGE_STORE_PATH.'71x83_'.$smallfilename.".".$ext);
		@unlink(IMAGE_STORE_PATH.'155x130_'.$smallfilename.".".$ext);
		
		
		$this->{$this->modelClass}->id	=	Configure::read('global_ids.admin_default_image.setting_default_image');//72;
		$array	=	array('value'=>'');
		$this->{$this->modelClass}->save($array);
		$this->Session->setFlash(__('Default Image deleted successfully'),  'success');
		$this->redirect(array('action' => 'prefix','Site'));
	}

}
