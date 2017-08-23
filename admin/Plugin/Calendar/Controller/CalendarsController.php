<?php
/**
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * PHP version 5
 * CakePHP version 1.3
 
*/

/**
 * Calendars Users Controller
 *
 * @package Calendars
 * @subpackage users.controllers
 */
class CalendarsController extends CalendarAppController {

/**
 * Controller name
 *
 * @var string
 */
	var $name = 'Calendars';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');
	//public $paginate = array('limit'=>5,'order'=>'Calendar.id','page'=>1);
/**
 * Components
 *
 * @var array
 */
	
	public $components 	= 	array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');
	
	
	public $presetVars = array(

		array('field' => 'title', 'type' => 'value')

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
	function viwer_count(){
		if($this->request->is('Ajax')){
			if($this->data['cal_id'] != null){
					 $ts = strtotime(date("Y-m-d"));
					//$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
					 $start = strtotime(date($this->data['start'] ));
					 $end = strtotime(date($this->data['end'] ));
					// echo "select (count(id)) as count from view_calendars where calendar_id = ".$this->data['cal_id']." AND DATE(created) BETWEEN ".date('Y-m-d', $start)." AND  ".date('Y-m-d', $end)."";
					$data = $this->Calendar->query("select (count(id)) as count from view_calendars where calendar_id = ".$this->data['cal_id']." AND DATE(created) BETWEEN '".date('Y-m-d', $start)."' AND  '".date('Y-m-d', $end)."'");
		
					echo $data[0][0]["count"];
				}
		}	
		exit;
	}
 
	function index($user_id = 0, $tag_id = 0 ,$type =0   ) {
		 $ts = strtotime(date("Y-m-d"));
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
			/* pr( array(date('Y-m-d', $start),
                 date('Y-m-d', strtotime('next saturday', $start))));die; */
	//	echo "select (count(id)) from view_calendars where calendar_id = Calendar.id AND DATE(created) BETWEEN DATE(".date('Y-m-d', $start).") AND  CURDATE()";die;		 
		$this->Calendar->virtualFields  = array(
			"evevnt_count"=>"select count(id) from events where calendar_id = Calendar.id",
			"today_view"=> "select (count(id)) from view_calendars where calendar_id= Calendar.id AND DATE(created) = CURDATE()",
			"week_view"=> "select (count(id)) from view_calendars where calendar_id = Calendar.id AND DATE(created) BETWEEN '".date('Y-m-d', $start)."' AND  CURDATE()",
			"month_view"=> "select (count(id)) from view_calendars where calendar_id = Calendar.id AND DATE(created) BETWEEN '".date('Y-m-01', $start)."' AND  CURDATE()",
			"totle_view"=> "select (count(id)) from view_calendars where calendar_id = Calendar.id "
		
		) ;
		$this->Calendar->belongsTo  = array('User' => array(
            'className' => 'User',
			"foreignKey" => "user_id"
        ));
		// Breadcrumb
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __(' Calendar', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Calendars ';
		$this->set('pageHeading',$pageHeading);
// Pagging
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->title . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ?$this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		if($user_id != 0){
			$parsedConditions["user_id"] = $user_id;
		}
		if($type != 0){
			$parsedConditions["type"] = $type;
		}
		if($tag_id != 0){
			$parsedConditions['OR'][]["follow_tag like"] = $tag_id;
			$parsedConditions['OR'][]["follow_tag like"] = '%,'.$tag_id.',%';
			$parsedConditions['OR'][]["follow_tag like"] = ''.$tag_id.',%';
			$parsedConditions['OR'][]["follow_tag like"] = '%,'.$tag_id.'';
		}
		$parsedConditions[] = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		//pr($parsedConditions);die;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.type' =>"asc",$this->modelClass . '.created' =>"desc")	
		);
		//pr($this->paginate());die;
	
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
	function followed_index($id = 0) {
		$this->loadModel("Follower");
		$this->Follower->virtualFields = array("title"=>"select title from calendars where calendars.id = Follower.calendar_id");
		$data	=	$this->Follower->find("all",array("conditions"=>array("user_id"=>$id,"status"=>1)));
		$this->set("data",$data);
		//pr($data);die;
	}
	
	function add() {
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Calendar', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Calendar';
		$this->set('pageHeading',$pageHeading);
		if(!empty($this->data)){	
			$this->{$this->modelClass}->set($this->data);			
			if($this->{$this->modelClass}->validateAdd()) {	
				if($this->{$this->modelClass}->save($this->data,false)){
					$this->Session->setFlash('Calendar has been added.', 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	function featured($id = null) {
		$this->set("id",$id);
		$this->loadModel("FeatureCalendar");
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Calendar', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Calendar';
		$this->set('pageHeading',$pageHeading);
		if(!empty($this->data)){
			//
			$this->request->data["Calendar"]["payment_id"] = 0;
			$this->request->data["Calendar"]["start_date"] = date("Y-m-d H:i:s",strtotime($this->data["Calendar"]["startdate"])- 21600);
			$this->request->data["Calendar"]["expired"] = date("Y-m-d H:i:s",strtotime($this->data["Calendar"]["expired"])- 21600);
			//pr($this->request->data);die;
				if($this->FeatureCalendar->save($this->data["Calendar"],true)){
					$this->Session->setFlash('Calendar has been added Premium .', 'success');
					$this->redirect(array('action' => 'index'));
				}
			
		}
	}
	function local($id = null, $pay_type = 1) {
		$this->set("id",$id);
		$this->set("pay_type",$pay_type);
		$this->loadModel("Tag");
		$this->loadModel("LocalCalendar");
		$tag = $this->Tag->find("list");
		$this->set("tag",$tag);
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Calendar', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Calendar';
		$this->set('pageHeading',$pageHeading);
		if(!empty($this->data)){
			//pr($this->request->data);die;
			$this->request->data["Calendar"]["start_date"] = date("Y-m-d H:i:s",strtotime($this->data["Calendar"]["startdate"])- 21600);
			$this->request->data["Calendar"]["expired"] = date("Y-m-d H:i:s",strtotime($this->data["Calendar"]["expired"])- 21600);
				if($this->LocalCalendar->save($this->data["Calendar"],true)){
					$this->Session->setFlash('Calendar has been added Premium .', 'success');
					$this->redirect(array('action' => 'index'));
				}
			
		}
	}
	
		
function edit($id = null) {
//id not found
		$pages[__('Dashboard',true)] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages' => $pages, 'active' => __('Calendar', true));		
		$this->set('breadcrumb', $breadcrumb);
		$pageHeading='Calendar';
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
				
				$this->Session->setFlash('Calendar page has been updated.', 'success');
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Calendar page has not been updated.', 'success');
				$this->redirect(array('action' => 'index'));
			}
			}
		
		}
	}
	
	public function change_status_active(){
		if($this->request->is('Ajax')){
			if($this->data['id'] != null){
					$data['is_verified'] = 0;
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
					$data['is_verified'] = 1;
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
				$this->Session->setFlash(__('Calendar has been deleted.'), 'success');				
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
			$this->Session->setFlash(__('Calendar has been deleted.'), 'success');				
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
			$this->Session->setFlash(__('Calendar has been active.'), 'success');				
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
			$this->Session->setFlash(__('Calendar has been inactive.'), 'success');				
			echo 'Success';
		}	
		exit;
	}

/****************************************End of the code*****************************************************/	
}
