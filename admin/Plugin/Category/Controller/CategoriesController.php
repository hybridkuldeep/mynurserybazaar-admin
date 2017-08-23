<?php
/**
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * PHP version 5
 * CakePHP version 1.3
 
*/

/**
 * Categories Users Controller
 *
 * @package Categories
 * @subpackage users.controllers
 */
class CategoriesController extends CategoryAppController {

/**
 * Controller name
 *
 * @var string
 */
	var $name = 'Categories';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');
	//public $paginate = array('limit'=>5,'order'=>'Category.id','page'=>1);
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
 
 
	function index($parent_id = 0) {
		$this->set('parent_id',$parent_id);
		// Breadcrumb
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __(' Category', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Categories ';
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
		$parsedConditions[]['parent_id'] = $parent_id; 
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
	
	function add($parent_id = 0) {
		$this->set('parent_id',$parent_id);
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Category', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Category';
		$this->set('pageHeading',$pageHeading);
		if(!empty($this->data)){	
			$image	=	'';
			$this->{$this->modelClass}->set($this->data);			
			if($this->{$this->modelClass}->validateAdd()) {	
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,CATEGORY_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				$all_parent_id = $this->{$this->modelClass}->findById($parent_id);
				$this->request->data["Category"]["all_parent_id"] = rtrim($parent_id.",".$all_parent_id["Category"]["all_parent_id"], ",");
				$this->request->data["Category"]["image"] = $image;
				//pr($this->data);die;
				if($this->{$this->modelClass}->save($this->data,false)){
					$this->Session->setFlash('Category has been added.', 'success');
					$this->redirect(array('action' => 'index',$parent_id));
				}
			}
		}
	}
	
		
function edit($id = null, $parent_id= 0) {
//id not found
	$this->set('parent_id',$parent_id);
	$this->set('id', $id);
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Category', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Category';
		$this->set('pageHeading',$pageHeading);
		if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash('Invalid Access.', 'error');
			 $this->redirect(array('action' => 'index',$parent_id));
		}
// set model by id & send id to view
		
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
			$parentdata						= 	$this->{$this->modelClass}->read(null, $id);
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->validateAdd()) {	
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,CATEGORY_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				}
				$this->request->data["Category"]["image"] = $image;
			if ($this->{$this->modelClass}->save($this->data)) {
				
				$this->Session->setFlash('Category page has been updated.', 'success');
				$this->redirect(array('action' => 'index',$parent_id));
			}else{
				$this->Session->setFlash('Category page has not been updated.', 'success');
				$this->redirect(array('action' => 'index',$parent_id));
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
				$this->Session->setFlash(__('Category has been deleted.'), 'success');				
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
			$this->Session->setFlash(__('Category has been deleted.'), 'success');				
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
			$this->Session->setFlash(__('Category has been active.'), 'success');				
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
			$this->Session->setFlash(__('Category has been inactive.'), 'success');				
			echo 'Success';
		}	
		exit;
	}

/****************************************End of the code*****************************************************/	
}
