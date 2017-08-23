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
class UsermgmtController extends UsermgmtAppController {

/**
 * Controller name
 *
 * @var string
 */
	var $name = 'Usermgmt';

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
	
	
	public $presetVars = 	array(
								
								array('field' => 'full_name','type'=>'value'),
								array('field' => 'email','type'=>'value'),
								array('field' => 'address','type'=>'value'),

								array('field' => 'phone','type'=>'value'),
							); 
	 //public $presetVars = 	true;
	 
	
		
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('model', $this->modelClass);
	}
	
	function array2csv(){
		$list = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
);

$fp = fopen('php://output', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);die;
}
	
	function detail_customer($id=0) {
		$result	=	$this->{$this->modelClass}->findById($id);
		$this->set("result",$result);
		
		$this->loadModel("Share");
		$Share	=	$this->Share->find("count",array("conditions"=>array("user_id"=>$id,"type"=>1)));
		$this->set("Share",$Share);

		$eShare	=	$this->Share->find("count",array("conditions"=>array("user_id"=>$id,"type"=>2)));
		$this->set("eShare",$eShare);
		
		$this->loadModel("Follower");
		$Follower	=	$this->Follower->find("count",array("conditions"=>array("user_id"=>$id,"status"=>1)));
		$this->set("Follower",$Follower);
		
		$this->loadModel("Like");
		$Like	=	$this->Like->find("count",array("conditions"=>array("user_id"=>$id,"likes"=>1)));
		$this->set("Like",$Like);
		
		$this->loadModel("Flag");
		$Flag	=	$this->Flag->find("count",array("conditions"=>array("user_id"=>$id)));
		$this->set("Flag",$Flag);
		
		$this->loadModel("CalendarEvent");
		$CalendarEvent1	=	$this->CalendarEvent->query("SELECT count(id) as count FROM `calendar_events` WHERE  user_id = ".$id." AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )");
		$this->set("CalendarEvent1",$CalendarEvent1);
		
		$CalendarEvent2	=	$this->CalendarEvent->query("SELECT count(id) as count FROM `calendar_events` WHERE calendar_id = (select id from calendars where user_id = ".$id." AND type =3) AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )");
		$this->set("CalendarEvent2",$CalendarEvent2);
		
		$CalendarEvent3	=	$this->CalendarEvent->query("SELECT count(id) as count FROM `calendar_events` WHERE (SELECT calendar_id FROM events WHERE id = event_id) = (select id from calendars where user_id = ".$id." AND type =3) AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )");
		$this->set("CalendarEvent3",$CalendarEvent3);
		
		$this->loadModel("Payment");
		$Payment	=	$this->Payment->find("first",array("conditions"=>array("user_id"=>$id),"fields"=>"sum(amount) as tamount"));
		$this->set("Payment",$Payment);
		//pr($Payment);die;
		 $this->loadModel("LocalCalendar");
		//$this->LocalCalendar->virtualFields = array("user_id"=>"select user_id from calendars where calendars.id = LocalCalendar.calendar_id");
		$this->LocalCalendar->belongsTo = array(
			"Calendar"=>array(
				"foreignKey"=>"calendar_id",
				"className"=>"Calendar"
			)
		);
		
		$local_calendars	=	$this->LocalCalendar->find("count",array("conditions"=>array("Calendar.user_id"=>$id),"group"=>"calendar_id"));
		$this->set("local_calendars",$local_calendars); 
		
		$this->loadModel("FeatureCalendar");
		$this->loadModel("FeatureCalendar");
		$this->FeatureCalendar->belongsTo = array(
			"Calendar"=>array(
				"foreignKey"=>"calendar_id",
				"className"=>"Calendar"
			)
		);
		//$this->FeatureCalendar->virtualFields = array("user_id"=>"select user_id from calendars where calendars.id = FeatureCalendar.calendar_id");
		$feature_calendars	=	$this->FeatureCalendar->find("count",array("conditions"=>array("user_id"=>$id),"group"=>"calendar_id"));
		$this->set("feature_calendars",$feature_calendars); 
			$this->loadModel("Event");
	$Event	= $this->Event->find("count",array("conditions"=>array("user_id"=>$id)));
	$this->set("Event",$Event);
	
	$this->loadModel("Calendar");
	$Calendar	= $this->Calendar->find("count",array("conditions"=>array("user_id"=>$id)));
	$this->set("Calendar",$Calendar);
	$Public_Calendar	= $this->Calendar->find("count",array("conditions"=>array("type"=>1,"user_id"=>$id)));
	$this->set("Public_Calendar",$Public_Calendar);
	$Private_Calendar	= $this->Calendar->find("count",array("conditions"=>array("type"=>2,"user_id"=>$id)));
	$this->set("Private_Calendar",$Private_Calendar);
		
	}
	function calendar_share_index($id = 0) {
		$this->loadModel("Share");
		$this->Share->virtualFields = array("title"=>"select title from calendars where calendars.id = Share.content_id");
		$data	=	$this->Share->find("all",array("conditions"=>array("user_id"=>$id,"type"=>1),"order"=>"id desc"));
		$this->set("data",$data);
		//pr($data);die;
	}
	function event_share_follow_index($id = 0) {
		$this->loadModel("Share");
		$this->Share->virtualFields = array("title"=>"select title from events where events.id = Share.content_id");
		$data	=	$this->Share->find("all",array("conditions"=>array("user_id"=>$id,"type"=>2),"order"=>"id desc"));
		$this->set("data",$data);
	}
	
	function message_index($id = 0) {
		$data	=	array();
		$this->set("data",$data);
	}
	function comment_index($id = 0) {
		$data	=	array();
		$this->set("data",$data);
	}
	
	function followed_index($id = 0) {
		$this->loadModel("Follower");
		$this->Follower->virtualFields = array("title"=>"select title from calendars where calendars.id = Follower.calendar_id");
		$data	=	$this->Follower->find("all",array("conditions"=>array("user_id"=>$id,"status"=>1),"order"=>"id desc"));
		$this->set("data",$data);
		//pr($data);die;
	}
	function liked_index($id = 0) {
		$this->loadModel("Like");
		$this->Like->virtualFields = array("title"=>"select title from events where events.id = Like.event_id");
		$data	=	$this->Like->find("all",array("conditions"=>array("user_id"=>$id,"likes"=>1),"order"=>"id desc"));
		$this->set("data",$data);
		//pr($data);die;
	}
	function flag_index($id = 0) {
		
		$this->loadModel("Flag");
		$this->Flag->virtualFields = array("title"=>"select title from events where events.id = Flag.event_id");
		$data	=	$this->Flag->find("all",array("conditions"=>array("user_id"=>$id),"order"=>"id desc"));
		$this->set("data",$data);
		//pr($data);die;
	}
	function event_share_index($id = 0) {
		$this->loadModel("CalendarEvent");
		$data	=	$this->CalendarEvent->query("SELECT *,(SELECT title FROM events WHERE id = calendar_events.event_id ) as title FROM `calendar_events` WHERE  user_id = ".$id." AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id ) ORDER BY calendar_events.id desc");
		$this->set("data",$data);
		//pr($data);die;
	}

	
	function event_share__mycal_index($id = 0) {
		$this->loadModel("CalendarEvent");
		$data	=	$this->CalendarEvent->query("SELECT *,(SELECT title FROM events WHERE id = calendar_events.event_id ) as title ,(SELECT title FROM calendars WHERE id = (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )) as cal_title FROM `calendar_events` WHERE calendar_id = (select id from calendars where user_id = ".$id." AND type =3) AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )  ORDER BY calendar_events.id desc");
		$this->set("data",$data);
		//pr($data);die;
	}
	function event_share__on_mycal_index($id = 0) {
		$this->loadModel("CalendarEvent");
		$data	=	$this->CalendarEvent->query("SELECT *,(SELECT title FROM events WHERE id = calendar_events.event_id ) as title ,(SELECT title FROM calendars WHERE id = calendar_id) as cal_title FROM `calendar_events` WHERE (SELECT calendar_id FROM events WHERE id = event_id) = (select id from calendars where user_id = ".$id." AND type =3) AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )  ORDER BY calendar_events.id desc");
		$this->set("data",$data);
	}
	
	
	function influencers() {
		$this->loadModel("Share");
		$data	=	$this->{$this->modelClass}->query("SELECT *,(SELECT count(id) as count FROM shares where user_id = users.id AND type=1) as cal_share_count,(SELECT count(id) as count FROM `calendar_events` WHERE  user_id = users.id AND calendar_id != (SELECT calendar_id FROM events WHERE id = calendar_events.event_id )) as share_count from users ORDER BY (share_count+cal_share_count) DESC,cal_share_count DESC ");
		$this->set("data",$data);
		//pr($data);die;
	}
	
	function calendar_influencers() {
		$this->loadModel("Share");
		$data	=	$this->{$this->modelClass}->query("SELECT *,(SELECT email from users where id = calendars.user_id) as email,(SELECT name from users where id = calendars.user_id) as name,(SELECT count(id) as count FROM shares where content_id = calendars.id AND type=1) as cal_share_count,(SELECT count(id) as count FROM `events` WHERE  calendar_id = calendars.id ) as share_count from calendars where (SELECT email from users where id = calendars.user_id) != '' ORDER BY (cal_share_count+share_count) DESC ,cal_share_count DESC ");
		$this->set("data",$data);
		//pr($data);die;
	}
	
	
	
	
/**
 * Admin Index
 *
 * @return void
 */	
	function welcome_broadcast_message($id){
		//id not found
		
		if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash('Invalid Access.', 'error');
			 $this->redirect(array('action' => 'broadcast'));
		}

		$this->set('id', $id);
		$this->loadModel("LandingUser");
		if ($this->request->is(array('post', 'put'))) {
			$e = array();
			
				$u = $this->LandingUser->find("all",array("fields"=>array("email")));
				foreach($u as $k=>$v){
					
					$e[] = $v["LandingUser"]["email"];
				}
	
				
			$Email = new CakeEmail('gmail');
						$Email->to($e);
						$Email->emailFormat('html');
						//$Email->template('booking')->viewVars( array('booking' => $booking,"mb"=>$mb));
						$Email->subject($this->request->data["Broadcast"]["subject"]);
						$Email->from (Configure::read("Site.email_send_mail"));
						$Email->send($this->request->data["Broadcast"]["body"]); 
					$this->Session->setFlash(__('Mail has been sent'),'success');
					$this->redirect(array('action' => 'welcome_broadcast_message/0'));
			
		}
		
	}
	
	function broadcast_message($id){
		//id not found
		
		if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash('Invalid Access.', 'error');
			 $this->redirect(array('action' => 'broadcast'));
		}

		$this->set('id', $id);
		$this->loadModel("User");
		if ($this->request->is(array('post', 'put'))) {
			$e = array();
			if($this->request->data["Broadcast"]["id"]==0){
				$u = $this->User->find("all",array("conditions"=>array("role_id"=>2),"fields"=>array("email")));
				foreach($u as $k=>$v){
					
					$e[] = $v["User"]["email"];
				}
			}else{
				$this->request->data["Broadcast"]["id"] = trim($this->request->data["Broadcast"]["id"],",");
				$u_id = explode(",",$this->request->data["Broadcast"]["id"]);
			
				
				
				foreach($u_id as $k=>$v){
					$u = $this->User->findById($v);
					$e[] = $u["User"]["email"];
				}
				
						
			}
				
			$Email = new CakeEmail('gmail');
						$Email->bcc($e);
						$Email->emailFormat('html');
						//$Email->template('booking')->viewVars( array('booking' => $booking,"mb"=>$mb));
						$Email->subject($this->request->data["Broadcast"]["subject"]);
						$Email->from (Configure::read("Site.email_send_mail"));
						$Email->send($this->request->data["Broadcast"]["body"]); 
					$this->Session->setFlash(__('Mail has been sent'),'success');
					$this->redirect(array('action' => 'broadcast'));
			
		}
		
	}
	function broadcast() {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Users'));
		
		$this->set('breadcrumb', $breadcrumb);
		
		 if(!empty($this->data))
		{
			if(!empty($this->data['id']))
			{
				foreach($this->data['id'] as $mainid)
				{
					if($mainid!='')
					{
						$this->Usermgmt->delete($mainid);
					}
				}
				$this->Session->setFlash('Deleted successfully','default',array('class'=>'success'));
			}
			else
			{
				if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
					$limitValue = $limit = $this->data['recordsPerPage'];
					$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
				} else {
					// pr($this->data);
					$this->Prg->commonProcess();
				}
			}
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		//pr($this->passedArgs);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('Broadcast');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 2;
	//	pr($parsedConditions);
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
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
		//pr($this->data);
	}
	function index() {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Employee / CEO'));
		
		$this->set('breadcrumb', $breadcrumb);

		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			// pr($this->data);
			$this->Prg->commonProcess();
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('Customers');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = array(3);
		$parsedConditions['role'] = 3;
		$parsedConditions['id !='] 		  = 1;
		$condtn2=null;
		if(authComponent::user('id')!=1){
			$parsedConditions['role'] = 3;
			$this->loadModel('Customer');
			$k=$this->Customer->query("select customer_id from customers inner join restrorants on (customers.restro_id = restrorants.id) where restrorants.user_id=".authComponent::user('id'));
			
			$l=sizeof($k);//die;
			$d=null;
			for($i=0;$i<$l;$i++){
				
				$d.=$k[$i]['customers']['customer_id'].',';
				
				
				}
				$condtn2="Usermgmt.id IN ('$d')";
			}
		$this->paginate = array(
			'conditions' => array($condtn2, $parsedConditions),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('result', $this->paginate());
		
	}
	
	function customer( ) { 
	
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Users'));
		
		$this->set('breadcrumb', $breadcrumb);
		
		 if(!empty($this->data))
		{
			if(!empty($this->data['id']))
			{
				foreach($this->data['id'] as $mainid)
				{
					if($mainid!='')
					{
						$this->Usermgmt->delete($mainid);
					}
				}
				$this->Session->setFlash('Deleted successfully','default',array('class'=>'success'));
			}
			else
			{
				if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
					$limitValue = $limit = $this->data['recordsPerPage'];
					$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
				} else {
					// pr($this->data);
					$this->Prg->commonProcess();
				}
			}
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		
		
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('User List');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 3;
		if(isset($parsedConditions["share"])){
			
			$this->{$this->modelClass}->virtualFields =	array(
										'share'=>'select count(id) from calendar_events where calendar_events.user_id= Usermgmt.id'
									);
									$parsedConditions['Usermgmt.share <='] = $parsedConditions["share"];
									unset($parsedConditions["share"]);
		}
		if(isset($this->passedArgs['ages']) && isset($this->passedArgs['ages'])  ){
			if($this->passedArgs['ages'] =="" && $this->passedArgs['agee'] != ""){
				$this->Session->setFlash(__('Please enter start age also. '),'success');
			}else if($this->passedArgs['ages'] !="" && $this->passedArgs['agee'] == ""){
				$this->Session->setFlash(__('Please enter end age also. '),'success');
			}else if($this->passedArgs['ages'] > $this->passedArgs['agee']){
				$this->Session->setFlash(__('Please enter start age less then end age. '),'success');
			}
		}
		//pr($parsedConditions);die;
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
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
		//pr($this->paginate());
	}
	function employee( ) { 
	
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Users'));
		
		$this->set('breadcrumb', $breadcrumb);
		
		 if(!empty($this->data))
		{
			if(!empty($this->data['id']))
			{
				foreach($this->data['id'] as $mainid)
				{
					if($mainid!='')
					{
						$this->Usermgmt->delete($mainid);
					}
				}
				$this->Session->setFlash('Deleted successfully','default',array('class'=>'success'));
			}
			else
			{
				if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
					$limitValue = $limit = $this->data['recordsPerPage'];
					$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
				} else {
					// pr($this->data);
					$this->Prg->commonProcess();
				}
			}
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		
		
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('User List');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 2;
		if(isset($parsedConditions["share"])){
			
			$this->{$this->modelClass}->virtualFields =	array(
										'share'=>'select count(id) from calendar_events where calendar_events.user_id= Usermgmt.id'
									);
									$parsedConditions['Usermgmt.share <='] = $parsedConditions["share"];
									unset($parsedConditions["share"]);
		}
		if(isset($this->passedArgs['ages']) && isset($this->passedArgs['ages'])  ){
			if($this->passedArgs['ages'] =="" && $this->passedArgs['agee'] != ""){
				$this->Session->setFlash(__('Please enter start age also. '),'success');
			}else if($this->passedArgs['ages'] !="" && $this->passedArgs['agee'] == ""){
				$this->Session->setFlash(__('Please enter end age also. '),'success');
			}else if($this->passedArgs['ages'] > $this->passedArgs['agee']){
				$this->Session->setFlash(__('Please enter start age less then end age. '),'success');
			}
		}
		//pr($parsedConditions);die;
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
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
		//pr($this->paginate());
	}
	function employeee() {
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Employee / CEO'));
		
		$this->set('breadcrumb', $breadcrumb);
      if(!empty($this->data))
		{
			if(!empty($this->data['id']))
			{
				foreach($this->data['id'] as $mainid)
				{
					if($mainid!='')
					{
						$this->Usermgmt->delete($mainid);
					}
				}
				$this->Session->setFlash('Deleted successfully','default',array('class'=>'success'));
			}
			else
			{
				if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
					$limitValue = $limit = $this->data['recordsPerPage'];
					$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
				} else {
					// pr($this->data);
					$this->Prg->commonProcess();
				}
		
			}
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('Employee / CEO');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 6;
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('result', $this->paginate());
		
	}
	function individual() {
		$this->loadModel("Company");
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Individual'));
		
		$this->set('breadcrumb', $breadcrumb);
		
		
		 if(!empty($this->data))
		{
			if(!empty($this->data['id']))
			{
				foreach($this->data['id'] as $mainid)
				{
					if($mainid!='')
					{
						$this->Usermgmt->delete($mainid);
					}
				}
				$this->Session->setFlash('Deleted successfully','default',array('class'=>'success'));
			}
			else
			{
				if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
					$limitValue = $limit = $this->data['recordsPerPage'];
					$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
				} else {
					// pr($this->data);
					$this->Prg->commonProcess();
				}
			}
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('Individual / Company');
		$this->{$this->modelClass}->hasOne	=	array("Company"=>array("className"=>"Company","foreignKey"=>"user_id"));
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = array(2,5);
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('result', $this->paginate());
		
		/* pr($this->paginate());
		die; */
		
	}
	
	
	function driver($id = null) {
		
		if($id != null) {
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
			$breadcrumb 			= 	array('pages' => $pages, 'active' => __('My Profile'));
			
			$this->set('breadcrumb', $breadcrumb);
		}else {
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
			$breadcrumb 			= 	array('pages' => $pages, 'active' => __('Driver'));
			
			$this->set('breadcrumb', $breadcrumb);
		
		}	

		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			// pr($this->data);
			$this->Prg->commonProcess();
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('Driver');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 4;
		if($id != null){
			$parsedConditions['id'] = $id;
		}
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('result', $this->paginate());
	}
	function manager($id = null) {
		
		if($id != null) {
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
			$breadcrumb 			= 	array('pages' => $pages, 'active' => __('My Profile'));
			
			$this->set('breadcrumb', $breadcrumb);
		}else {
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
			$breadcrumb 			= 	array('pages' => $pages, 'active' => __('manager'));
			
			$this->set('breadcrumb', $breadcrumb);
		
		}	

		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			// pr($this->data);
			$this->Prg->commonProcess();
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('manager');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 5;
		if($id != null){
			$parsedConditions['id'] = $id;
		}
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('result', $this->paginate());
	}
	function company($id = null) {
		
		if($id != null) {
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
			$breadcrumb 			= 	array('pages' => $pages, 'active' => __('My Profile'));
			
			$this->set('breadcrumb', $breadcrumb);
		}else {
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
			$breadcrumb 			= 	array('pages' => $pages, 'active' => __('company'));
			
			$this->set('breadcrumb', $breadcrumb);
		
		}	


		 if(!empty($this->data))
		{
			if(!empty($this->data['id']))
			{
				foreach($this->data['id'] as $mainid)
				{
					if($mainid!='')
					{
						$this->Usermgmt->delete($mainid);
					}
				}
				$this->Session->setFlash('Deleted successfully','default',array('class'=>'success'));
			}
			else
			{
				if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
					$limitValue = $limit = $this->data['recordsPerPage'];
					$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
				} else {
					// pr($this->data);
					$this->Prg->commonProcess();
				}
			}
		}
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = __('Company');
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['role_id'] = 2;
		if($id != null){
			$parsedConditions['id'] = $id;
		}
		$this->paginate = array(
			'conditions' => array($parsedConditions ),
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('result', $this->paginate());
	}
	
	
	
	
	public function getcustomers() {
		// Check cakephp ajax request
		
		if($this->request->is('Ajax')){
		
		// Load users model
		
		$this->loadModel('Users');
		
		// Fire custom query to get all users count by each month and each year.
		
		$res = $this->Users->query("select
		year(`created`) as 'YEAR',
		sum(month(`created`) = 1) as '1',
		sum(month(`created`) = 2) as '2',
		sum(month(`created`) = 3) as '3',
		sum(month(`created`) = 4) as '4',
		sum(month(`created`) = 5) as '5',
		sum(month(`created`) = 6) as '6',
		sum(month(`created`) = 7) as '7',
		sum(month(`created`) = 8) as '8',
		sum(month(`created`) = 9) as '9',
		sum(month(`created`) = 10) as '10',
		sum(month(`created`) = 11) as '11',
		sum(month(`created`) = 12) as '12'
		FROM `users`
		WHERE role_id = '3'
		AND year(`created`) = '".date('Y')."'
		GROUP BY 1");
		
		// Unser year column
		
		unset($res[0][0]['YEAR']);
		
		// Set new array
		
		$cdata = array();
		
		foreach($res[0][0] as $ydata) {
			$cdata[]['count'] = $ydata;
		}		
		echo '{"success":{"users":'.json_encode($cdata).'}}';exit();
		} 
		exit();
	}
	
	function add() {
	
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Employee', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'index');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Add Customers', true));
		$this->set('breadcrumb', $breadcrumb);
		$this->loadModel('Restrorant');
		$uid=authComponent::user('id');
		$restrorantlist=$this->Restrorant->find('list',array('conditions'=>array('user_id'=>$uid)));
		$this->set('restrorantlist',$restrorantlist);
		
		
		if (!empty($this -> data) ) {
			$image	=	'';
				$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->validates()) {
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				
				$data 					=	array();
				$data['role_id']	=	3;
				$data['role']	=	3;
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['mobile']		=	$this->data{$this->modelClass}['mobile'];
				$data['name']		=	$this->data{$this->modelClass}['email'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['created']			= date('Y-m-d h:i:s',time());
				$data['image']			=	$image;
				//pr($data); die;
				if($this->{$this->modelClass}->save($data, false))
				{
					$cid=$this->{$this->modelClass}->getLastInsertId();
					$this->loadModel('Customer');
					$this->Customer->save(array(
					'customer_id'		  => $cid,
					'restro_id'			=> $this->data{$this->modelClass}['restrorant'],
					'arrival_time'		 => date('Y-m-d h:i:s',time())
					
					));
					
					
					
					$this->Session->setFlash(__('Customer has been added'),'success');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->Session->setFlash(__('Customer has not been added.'),'error');
				}
			}
		} 
	}
	
	function add_customer() {
	
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Passenger', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'customer');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Add Passenger', true));
		$this->set('breadcrumb', $breadcrumb);
		
		if (!empty($this -> data) ) {
			$image	=	'';
				$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->validates()) {
				//pr($this->data); die;
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				//unset($this->data{$this->modelClass}['image']);
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,USER_IMAGE_STORE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				
				$data 					=	array();
				$data	=	$this->request->data;
				//$data['role']	=	2;
				$data['Usermgmt']['role_id']	=	2;
				//$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				//$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				
				//$data['name']		=	$this->data{$this->modelClass}['name'];
				//$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['Usermgmt']['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				//$data['status']			=	$this->data{$this->modelClass}['status'];
				//$data['active']			=	1;
				$data['Usermgmt']['image']			=	$image;
			//	pr($data); die;
				if($this->{$this->modelClass}->save($data, false))
				{
					//$arr=array(6,57,67,68,69,70,71,74);
					/*$arr=array(6,70,71,57,67,68,75,76,77,73,74,78,79,81,82,83);
					$uid=$this->{$this->modelClass}->getLastInsertId();
					for($i=0;$i<16;$i++){
						
						$this->loadModel('user_privilege');
						
						$this->user_privilege->query("INSERT INTO `user_privileges`(`user_id`, `menuId`, `can_view`, `can_add`, `can_edit`, `can_delete`, `status`) VALUES ('$uid','$arr[$i]',1,1,1,1,1)");
					}*/
					
					$this->Session->setFlash(__('User has been added'),'success');
					$this->redirect(array('plugin'=>'usermgmt','controller'=>'usermgmt','action' => 'employee'));
				}
				else
				{
					$this->Session->setFlash(__('User has not been added.'),'error');
				}
			}
		} 
	}
	function add_employee() {
	
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Passenger', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'employee');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Add employee', true));
		$this->set('breadcrumb', $breadcrumb);
		$this->loadModel('Country');
			$country	=	$this->Country->find('list',array('order'=>'created desc'));
			$this->set('country',$country);
		if (!empty($this -> data) ) {
			$image	=	'';
				$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->EmployeeValidate()) {
				//pr($this->data); die;
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				
				$emp	=	$this->{$this->modelClass}->query("select max(emp_id) from users");
				$emp_id	=	$emp[0][0]['max(emp_id)']+1;
				
				$data 					=	array();
				$data['role_id']	=	6;
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				//$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['firstname'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['image']			=	$image;
				$data['emp_id']			=	$emp_id;
				//pr($data); die;
				if($this->{$this->modelClass}->save($data, false))
				{
					$this->Session->setFlash(__('employee has been added'),'success');
					$this->redirect(array('action' => 'employee'));
				}
				else
				{
					$this->Session->setFlash(__('employee has not been added.'),'error');
				}
			}
		} 
	}
	function add_individual() {
		
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Customer', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'individual');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Add Individual', true));
		$this->set('breadcrumb', $breadcrumb);
		$this->loadModel('Country');
			$country	=	$this->Country->find('list',array('order'=>'created desc'));
			$this->set('country',$country);
		if (!empty($this -> data) ) {
			$image	=	'';
				$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->validates()) {
				//pr($this->data); die;
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				
				if(!empty($this->data{$this->modelClass}['company_id'])){
					$this->loadModel("Company");
					$this->Company->id = $this->data{$this->modelClass}['company_id'];
					$this->Company->saveField('assign', 1);
				}
				
				
				$data 					=	array();
				$data['role_id']	=	$this->data{$this->modelClass}['role_id'];
				$data['company_id']	=	isset($this->data{$this->modelClass}['company_id'])?$this->data{$this->modelClass}['company_id']:"";
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				//$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['firstname'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['image']			=	$image;
				//pr($data); die;
				if($this->{$this->modelClass}->save($data, false))
				{
					//if($this->data{$this->modelClass}['role_id']==2){
						$c_id	=	$this->{$this->modelClass}->id;
						$this->loadModel("Company");
						$this->request->data["Company"]["user_id"]	=	$c_id;
						$this->Company->save($this->data["Company"],false);
						
					//}
					$this->Session->setFlash(__('Individual has been added'),'success');
					$this->redirect(array('action' => 'Individual'));
				}
				else
				{
					$this->Session->setFlash(__('Customer has not been added.'),'error');
				}
			}
		} 
		$this->loadModel("Company");
		$company	=	$this->Company->find("list",array("conditions"=>array("status"=>1,"assign"=>0)));
		$this->set("company",$company);
	}
	
	
	function add_driver() {
	
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Driver', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'driver');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Add Driver', true));
		$this->set('breadcrumb', $breadcrumb);
		
		if (!empty($this -> data) ) {
			$image	=	'';
				$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->validates()) {
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				
				$data 					=	array();
				$data['role_id']	=	4;
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['name'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['image']			=	$image;
				//pr($data); die;
				if($this->{$this->modelClass}->save($data, false))
				{
					$this->Session->setFlash(__('Driver has been added'),'success');
					$this->redirect(array('action' => 'driver'));
				}
				else
				{
					$this->Session->setFlash(__('Driver has not been added.'),'error');
				}
			}
		} 
		$this->loadModel("Country");
		$this->loadModel("User");
		$this->loadModel("Company");
		$country	=	$this->Country->find("list",array("conditions"=>array("status"=>1)));
		$company	=	$this->Company->find("list",array("conditions"=>array("status"=>1)));
		$this->set("country",$country);
		$this->set("company",$company);
	}
	function add_company() {
	
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('company', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'company');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Add company', true));
		$this->set('breadcrumb', $breadcrumb);
		
		if (!empty($this -> data) ) {
			$image	=	'';
				$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->validates()) {
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image		= 	$new_file_name;
					}else{
						$image		= 	'';
					}
				}else{
						$image			= 	'';
				}
				
				$data 					=	array();
				$data['role_id']	=	2;
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['name'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['image']			=	$image;
				//pr($data); die;
				if($this->{$this->modelClass}->save($data, false))
				{
					$this->Session->setFlash(__('company has been added'),'success');
					$this->redirect(array('action' => 'company'));
				}
				else
				{
					$this->Session->setFlash(__('company has not been added.'),'error');
				}
			}
		} 
		$this->loadModel("Country");
		$this->loadModel("User");
		$country	=	$this->Country->find("list",array("conditions"=>array("status"=>1)));
		$company	=	$this->User->find("list",array("conditions"=>array("status"=>1,"role_id"=>2)));
		$this->set("country",$country);
		$this->set("company",$company);
	}
	
	
	
	function edit($user_id=0,$id=null) {
			
		$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
		$pages[__('Employee', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'index');		
		$breadcrumb 					=	array('pages' => $pages, 'active' => __('Edit Employee', true));
		$this->set('breadcrumb', $breadcrumb);
		$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);
		$this->set("id",$user_id);
		$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('name'))); // to get list for dropdowns

		$this->set("users",$users);
		$this->set("result",$parentdata);
		if (!empty($this->data)) {
			
			$this->{$this->modelClass}->set($this->data); 
			if ($this->{$this->modelClass}->EditValidate()) {
				
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				}
				
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['name'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['image']			=	$image;
			
				$this->{$this->modelClass}->id = $user_id; 
				if($this->{$this->modelClass}->save($data, false)){
					$this->Session->setFlash(__('Employee has been edited'),'success');
				}else{
					$this->Session->setFlash(__('Error saving Employee.'),'error');
				}
				$this->redirect(array('action'=>'index'));
			}
		}else{
			if($user_id==null) die(__("No ID received"));
				
				$data = $this->{$this->modelClass}->read(null, $user_id);
				unset($data['Usermgmt']['password']);
				$this->data = $data;
				//pr($this->data);
		}
	}
	
	function edit_customer($user_id=0,$id=null) {
			$this->loadModel("User");
		$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
		$pages[__('User', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'customer');		
		$breadcrumb 					=	array('pages' => $pages, 'active' => __('Edit User', true));
		$this->set('breadcrumb', $breadcrumb);
		$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);
		$this->set("id",$user_id);
		$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('full_name'))); // to get list for dropdowns

		$this->set("users",$users);
		//pr($users);
		$this->set("result",$parentdata);
		
		if (!empty($this->data)) {
			
			$this->{$this->modelClass}->set($this->data); 
			if ($this->{$this->modelClass}->EditValidate()) {
				
				//pr($this->data); die;
				 $filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,USER_IMAGE_STORE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				} 
				
				
				$data 					=	array();
				$data	=	$this->request->data;
			   //  $data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				//$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				//$data['full_name']		=	$this->data{$this->modelClass}['full_name'];
				//$data['email']			=	$this->data{$this->modelClass}['email'];
				//$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				//$data['status']			=	$this->data{$this->modelClass}['status'];
				//$data['active']			=	1;
				
				$this->request->data["Usermgmt"]["image"] = $image;
				pr($this->data);
				
				//$data['image']			=	$image;
			//	$this->{$this->modelClass}->id = $user_id; 
				if($this->{$this->modelClass}->save($this->data, false)){
					//$this->User->updateAll(array('User.modified' =>" now()"), array('User.id' => $user_id));
					$this->Session->setFlash(__('User has been updated'),'success');
				}else{
					$this->Session->setFlash(__('Error updating Passenger.'),'error');
				}
				$this->redirect($this->referer());
			}
		}else{
			if($user_id==null) die(__("No ID received"));
				
				$data = $this->{$this->modelClass}->read(null, $user_id);
				unset($data['Usermgmt']['password']);
				$this->data = $data;
				//pr($this->data);
		}
	}
	function edit_employee($user_id=0,$id=null) {
			
		$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
		$pages[__('Passenger', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'employee');		
		$breadcrumb 					=	array('pages' => $pages, 'active' => __('Edit employee', true));
		$this->set('breadcrumb', $breadcrumb);
		$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);
		$this->set("id",$user_id);
		$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('name'))); // to get list for dropdowns

		$this->set("users",$users);
		$this->set("result",$parentdata);
		$this->loadModel('Country');
		$country	=	$this->Country->find('list',array('order'=>'created desc'));
		$this->set('country',$country);
		if (!empty($this->data)) {
			
			$this->{$this->modelClass}->set($this->data); 
			if ($this->{$this->modelClass}->EditValidate()) {
				unset($this->request->data['User']['emp_id']);
				//pr($this->data); die;
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				}
				
				
				$data 					=	array();
				
			$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				//$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['firstname'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				//$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['image']			=	$image;
				$this->{$this->modelClass}->id = $user_id; 
				
				//pr($data);die;
				if($this->{$this->modelClass}->save($data, false)){
					$this->Session->setFlash(__('employee has been updated'),'success');
				}else{
					$this->Session->setFlash(__('Error updating employee.'),'error');
				}
				$this->redirect(array('action'=>'employee'));
			}
		}else{
			if($user_id==null) die(__("No ID received"));
				
				$data = $this->{$this->modelClass}->read(null, $user_id);
				unset($data['Usermgmt']['password']);
				$this->data = $data;
				//pr($this->data);
		}
	}
	function edit_individual($user_id=0,$id=null) {
		$this->{$this->modelClass}->hasOne	=	array("Company"=>array("className"=>"Company","foreignKey"=>"user_id"));	
		$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
		$pages[__('Customer', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'individual');		
		$breadcrumb 					=	array('pages' => $pages, 'active' => __('Edit Individual', true));
		$this->set('breadcrumb', $breadcrumb);
		$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);
		$this->set("id",$user_id);
		$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('name'))); // to get list for dropdowns

		$this->set("users",$users);
		$this->set("result",$parentdata);
		$this->loadModel('Country');
		$country	=	$this->Country->find('list',array('order'=>'created desc'));
		$this->set('country',$country);
		$d	=	$this->{$this->modelClass}->findById($user_id);
	//	pr($d);die;
		if (!empty($this->data)) {
			//pr($d);die;
			$this->{$this->modelClass}->set($this->data); 
			if ($this->{$this->modelClass}->EditValidate()) {
				
				//pr($this->data); die;
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				}
				
				
				$data 					=	array();
				
				$this->loadModel("Company");				
				/* if($this->data{$this->modelClass}['role_id']==5){
						$this->Company->id	=	$d["Company"]["id"];
						if($this->Company->exists()){
							$this->Company->delete($d["Company"]["id"]);
						}
				}else{  */
						$this->request->data["Company"]["user_id"]	=	$user_id;
						$this->Company->id	=	$d["Company"]["id"];
						$this->Company->save($this->data["Company"],false);
				/* } */
				
				$data['role_id']	=	$this->data{$this->modelClass}['role_id'];
			$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				//$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['firstname'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				//$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['active']			=	1;
				$data['image']			=	$image;
				$this->{$this->modelClass}->id = $user_id; 
				if($this->{$this->modelClass}->save($data, false)){
					$this->User->updateAll(array('User.modified' =>" now()"), array('User.id' => $user_id));
					$this->Session->setFlash(__('Individual has been updated'),'success');
				}else{
					$this->Session->setFlash(__('Error updating Individual.'),'error');
				}
				$this->redirect(array('action'=>'individual'));
			}
		}else{
			if($user_id==null) die(__("No ID received"));
				
				$data = $this->{$this->modelClass}->read(null, $user_id);
				unset($data['Usermgmt']['password']);
				$this->data = $data;
				//pr($this->data);
		}
		
		$this->loadModel("State");
		$this->loadModel("City");
		
		
		//pr($user);
		$state	=	$this->State->find("list",array("conditions"=>array("country_id"=>$d['Company']["country_id"])));
		$city	=	$this->City->find("list",array("conditions"=>array("state_id"=>$d['Company']["state_id"])));
		
		
		$this->set("state",$state);
		$this->set("city",$city);
		
		/* $this->loadModel("Company");
		
		$company	=	$this->Company->find("list",array("conditions"=>array(
																			"OR"=>array(array("status"=>1,"assign"=>0),
																			      array("id"=>$d['Usermgmt']['company_id']))
																			)));
		$this->set("company",$company); */
	}
	
	
	function edit_driver($user_id=0,$id=null) {
			
		$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
		//$pages[__('Driver', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'driver');		
		$breadcrumb 					=	array('pages' => $pages, 'active' => __('Edit Driver', true));
		$this->set('breadcrumb', $breadcrumb);
		$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);
		$this->set("id",$user_id);
		$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('name'))); // to get list for dropdowns
		$user	=	$this->{$this->modelClass}->findById($user_id);
		$this->set("users",$users);
		$this->set("result",$parentdata);
		if (!empty($this->data)) {
			
			$this->{$this->modelClass}->set($this->data); 
			if ($this->{$this->modelClass}->EditValidate()) {
				
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				}
				
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['name'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['image']			=	$image;
			
				$this->{$this->modelClass}->id = $user_id; 
				if($this->{$this->modelClass}->save($data, false)){
					$this->Session->setFlash(__('Driver has been edited'),'success');
				}else{
					$this->Session->setFlash('Error saving Driver.','error');
				}
				$this->redirect($this->referer());
			}
		}else{
			if($user_id==null) die(__("No ID received"));
				
				$data = $this->{$this->modelClass}->read(null, $user_id);
				unset($data['Usermgmt']['password']);
				$this->data = $data;
				//pr($this->data);
		}
		$this->loadModel("Country");
		$this->loadModel("State");
		$this->loadModel("City");
		$this->loadModel("User");
		$this->loadModel("Company");
		$company	=	$this->Company->find("list",array("conditions"=>array("status"=>1)));
		//pr($user);
		$state	=	$this->State->find("list",array("conditions"=>array("country_id"=>$user['Usermgmt']["country_id"])));
		$city	=	$this->City->find("list",array("conditions"=>array("state_id"=>$user['Usermgmt']["state_id"])));
		$country	=	$this->Country->find("list",array("conditions"=>array("status"=>1)));
		$this->set("country",$country);
		$this->set("state",$state);
		$this->set("city",$city);
		$this->set("company",$company);
	}
	function edit_company($user_id=0,$id=null) {
			
		$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
		//$pages[__('Driver', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'driver');		
		$breadcrumb 					=	array('pages' => $pages, 'active' => __('Edit company', true));
		$this->set('breadcrumb', $breadcrumb);
		$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);
		$this->set("id",$user_id);
		$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('name'))); // to get list for dropdowns
		$user	=	$this->{$this->modelClass}->findById($user_id);
		$this->set("users",$users);
		$this->set("result",$parentdata);
		if (!empty($this->data)) {
			
			$this->{$this->modelClass}->set($this->data); 
			if ($this->{$this->modelClass}->EditValidate()) {
				
				$filename  				= 	$this->data{$this->modelClass}['image']['name'];
				if($filename !=''){
					$tempPath  				= 	$this->data{$this->modelClass}['image']['tmp_name'];
					$new_file_name 			=	time().'_'.$filename;
					if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH. $new_file_name)){
						$image			= 	$new_file_name;
					}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
					}
				}else{
						$image			= 	$parentdata{$this->modelClass}['image'];
				}
				
				$data['firstname']		=	$this->data{$this->modelClass}['firstname'];
				$data['lastname']		=	$this->data{$this->modelClass}['lastname'];
				$data['name']		=	$this->data{$this->modelClass}['name'];
				$data['email']			=	$this->data{$this->modelClass}['email'];
				$data['status']			=	$this->data{$this->modelClass}['status'];
				$data['image']			=	$image;
			
				$this->{$this->modelClass}->id = $user_id; 
				if($this->{$this->modelClass}->save($data, false)){
					$this->Session->setFlash(__('company has been edited'),'success');
				}else{
					$this->Session->setFlash('Error saving company.','error');
				}
				$this->redirect($this->referer());
			}
		}else{
			if($user_id==null) die(__("No ID received"));
				
				$data = $this->{$this->modelClass}->read(null, $user_id);
				unset($data['Usermgmt']['password']);
				$this->data = $data;
				//pr($this->data);
		}
		$this->loadModel("Country");
		$this->loadModel("State");
		$this->loadModel("City");
		$this->loadModel("User");
		$company	=	$this->User->find("list",array("conditions"=>array("status"=>1,"role_id"=>2)));
		//pr($user);
		$state	=	$this->State->find("list",array("conditions"=>array("country_id"=>$user['Usermgmt']["country_id"])));
		$city	=	$this->City->find("list",array("conditions"=>array("state_id"=>$user['Usermgmt']["state_id"])));
		$country	=	$this->Country->find("list",array("conditions"=>array("status"=>1)));
		$this->set("country",$country);
		$this->set("state",$state);
		$this->set("city",$city);
		$this->set("company",$company);
	}
	
	
	function change_password($user_id=0,$id=null) {
				
			$pages[__('Dashboard', true)]	=	array('plugin' => '', 'controller' => '/');
			$breadcrumb 					=	array('pages' => $pages, 'active' => __('Change Password', true));
			$this->set('breadcrumb', $breadcrumb);

			$parentdata						= 	$this->{$this->modelClass}->read(null, $user_id);

			$this->set("id",$user_id);
			$users							=	$this->{$this->modelClass}->find('list', array('fields' => array('full_name')));
			$this->set("users",$users);
			$this->set("result",$parentdata);
			if (!empty($this->data)) {
				
				$this->{$this->modelClass}->set($this->data); 
				if ($this->{$this->modelClass}->ChangePassword()) {
				
					$data 					=	array();
					$data['password']		=	AuthComponent::password($this->data{$this->modelClass}['password']);
					$this->{$this->modelClass}->id = $user_id; 
					if($this->{$this->modelClass}->save($data, false)){
						$this->Session->setFlash(__('Password has been successfully changed'),'success');
					}else{
						$this->Session->setFlash(__('Error updating password.'),'error');
					}
					$this->redirect($this->referer());
				}
			}else{
				if($user_id==null) die(__("No ID received"));
					
					$data = $this->{$this->modelClass}->read(null, $user_id);
					unset($data['Usermgmt']['password']);
					$this->data = $data;
			}
		}
	
	
	
	public function delete(){
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
				
				if($this->{$this->modelClass}->delete($this->data['id'])){
					$this->Session->setFlash(__('User has been deleted'),'success');
					echo 'Success';
				}else{
					$this->Session->setFlash(__('User has not been deleted'),'success');
					echo 'error';
				}
		    }	
		}	
		exit;
	}
	
	
  public function change_status(){
		if($this->request->is('Ajax')){
			if($this->data['id'] != null){
				$getdata	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('id'=>$this->data['id'])));
					if($getdata[$this->modelClass]['status'] == 1){
						$data['status'] = 0;
					}else {
						$data['status'] = 1;
					}
					
				$this->{$this->modelClass}->id	=	$this->data['id'];
				$this->{$this->modelClass}->save($data,false);
					echo 'Success';
				}
		}	
		exit;
	}	
  
	
	function detail_employee($id=0) {
		$result	=	$this->{$this->modelClass}->findById($id);
		$this->set("result",$result);
	}
	function detail_individual($id=0) {
		
		$result	=	$this->{$this->modelClass}->findById($id);
		if($result[$this->modelClass]['role_id']==2){
			$this->loadModel("Company");
			$this->Company->virtualFields =	array(
										'country'=>'select name from countries where countries.id=Company.country_id',
										'state'=>'select name from states where states.id=Company.state_id',
										'city'=>'select name from cities where cities.id=Company.city_id',
									);
			$this->{$this->modelClass}->hasOne	=	array("Company"=>array("className"=>"Company","foreignKey"=>"user_id"));
		}
		$result	=	$this->{$this->modelClass}->findById($id);
		$this->set("result",$result);
	
	}
   
	function detail_driver($id=0) {
		$result	=	$this->{$this->modelClass}->findById($id);
		$this->set("result",$result);
	}
   
	function detail_company($id=0) {
		$result	=	$this->{$this->modelClass}->findById($id);
		$this->set("result",$result);
	}
	
	
	
  public function status_ajax(){
		if($this->request->is('Ajax')){
			if($this->data['id'] != null){
				$all_data=$this->{$this->modelClass}->findById($this->data['id']);
				if($all_data[$this->modelClass]['status']==1)
				{	
					$new_value=0;
					$data['status'] = 0;
				}
				else
				{
					$new_value=1;
					$data['status'] = 1;
				}
					$this->{$this->modelClass}->id	=	$this->data['id'];
					$this->{$this->modelClass}->save($data,false);
					echo $new_value;
				}
		}	
		exit;
	}
    
}
