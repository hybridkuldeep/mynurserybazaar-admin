<?php
/**
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * PHP version 5
 * CakePHP version 1.3
 
*/

/**
 * Pages Users Controller
 *
 * @package Pages
 * @subpackage users.controllers
 */
class PagesController extends PageAppController {

/**
 * Controller name
 *
 * @var string
 */
	var $name = 'Pages';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');
	//public $paginate = array('limit'=>5,'order'=>'Page.id','page'=>1);
/**
 * Components
 *
 * @var array
 */
	
	public $components 	= 	array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');
	
	
	public $presetVars = array(

		array('field' => 'name', 'type' => 'value')

	);
	 // public $presetVars = 	true;
	 
	
		
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('model', $this->modelClass);
	}
/**
 * Admin Index
 *
 * @return void
 */	
 
 
	function index() {
		// Breadcrumb
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __(' Page', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Pages ';
		$this->set('pageHeading',$pageHeading);
// Pagging
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ?$this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
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
	
	function add() {
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Page', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Page';
		$this->set('pageHeading',$pageHeading);
		if(!empty($this->data)){	
			$this->{$this->modelClass}->set($this->data);			
			if($this->{$this->modelClass}->validateAdd()) {	
				if($this->{$this->modelClass}->save($this->data,false)){
					$this->Session->setFlash('Page has been added.', 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	
		
function edit($id = null) {
//id not found
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Page', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Page';
		$this->set('pageHeading',$pageHeading);
		if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash('Invalid Access.', 'error');
			 $this->redirect(array('action' => 'index'));
		}
// set model by id & send id to view
		$this->set('id', $id);
		$user = $this->{$this->modelClass}->findById($id);
		$this->{$this->modelClass}->set($user);
//Read values from database and edit  the record
	//first time
		if (empty($this->data)) {
			$this->data = $this->{$this->modelClass}->read();
		}
	//second time
		else{
	
	//set model & save data & setFlash session
			
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->validateAdd()) {	
			if ($this->{$this->modelClass}->save($this->data)) {
				
				$this->Session->setFlash('Page page has been updated.', 'success');
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Page page has not been updated.', 'success');
				$this->redirect(array('action' => 'index'));
			}
			}
		
		}
	}
	
	public function change_status_active(){
		if($this->request->is('Ajax')){
			if($this->data['id'] != null){
					$data['status'] = 1;
					$this->{$this->modelClass}->id	=	$this->data['id'];
					$this->{$this->modelClass}->save($data,false);
					echo 'Success';
				}
		}	
		exit;
	}
	public function change_status_inactive(){
		if($this->request->is('Ajax')){
			if($this->data['id'] != null){
					$data['status'] = 0;
					$this->{$this->modelClass}->id	=	$this->data['id'];
					$this->{$this->modelClass}->save($data,false);
					echo 'Success';
				}
		}	
		exit;
}	

function admin_delete() {
		if($this->request->is('Ajax')){
			if($this->data['id']==null){
					echo 'error';
			}else{
				$this->{$this->modelClass}->delete($this->data['id']);
				$this->Session->setFlash(__('Page has been deleted.'), 'success');				
				echo 'Success';
			}
		}	
		exit;	
	}

function delete_all() {
		if($this->request->is('Ajax')){
		$data = array();
			foreach($this->data['fare_ids'] as $fare_id) {
				$this->{$this->modelClass}->delete($fare_id);
			}
			$this->Session->setFlash(__('Page has been deleted.'), 'success');				
			echo 'Success';
		}	
		exit;
	}
	
	function active_all() {
		if($this->request->is('Ajax')){
		$data = array();
			foreach($this->data['fare_ids'] as $fare_id) {
				//pr($fare_id);exit();
				//$this->{$this->modelClass}->delete($fare_id);
				$data['status'] = 1;
				$this->{$this->modelClass}->id	=	$fare_id;
				$this->{$this->modelClass}->save($data,false);
			}
			$this->Session->setFlash(__('Page has been active.'), 'success');				
			echo 'Success';
		}	
		exit;
	}
	
	function inactive_all() {
		if($this->request->is('Ajax')){
		$data = array();
			foreach($this->data['fare_ids'] as $fare_id) {
				$data['status'] = 0;
				$this->{$this->modelClass}->id	=	$fare_id;
				$this->{$this->modelClass}->save($data,false);
			}
			$this->Session->setFlash(__('Page has been inactive.'), 'success');				
			echo 'Success';
		}	
		exit;
	}

/****************************************End of the code*****************************************************/	
}
