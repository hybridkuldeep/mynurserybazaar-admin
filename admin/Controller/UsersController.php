<?php
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AppController {
	
	/**
* Helpers
*
* @var array
*/
//public $helpers = array('Goodies.Gravatar');

/**
* Components
*
* @var array
*/
/**
/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->_setupAuth();
		//$this->Auth->allow('login');
		$this->set('model', $this->modelClass);
		$this->Auth->allow('footer');
		if (!Configure::read('App.defaultEmail')) {
			Configure::write('App.defaultEmail', 'noreply@' . env('HTTP_HOST'));
		}
	}
	public function layout(){
	$this->layout	=	"layout";
	
	$this->loadModel("User");
	$user	= $this->User->find("count",array("conditions"=>array("role_id"=>2)));
	$this->set("user",$user);

	$this->loadModel("User");
	$user3	= $this->User->find("count",array("conditions"=>array("role_id"=>3)));
	$this->set("user3",$user3);
	$verify_user	= $this->User->find("count",array("conditions"=>array("role_id"=>3,'email_verified'=>1)));
	$this->set("verify_user",$verify_user);

	$fb_user	= $this->User->find("count",array("conditions"=>array("role_id"=>3,'fbid !='=>"")));
	$this->set("fb_user",$fb_user);
	$nfb_user	= $this->User->find("count",array("conditions"=>array("role_id"=>3,'fbid '=>"")));
	$this->set("nfb_user",$nfb_user);
	
	
	//pr($user_data);die;
	$user_data_map	= $this->User->find("all",array("fields"=>array("lat","lng","full_name","fbid","address"),"conditions"=>array("role_id"=>2),"order"=>array("created "=>"desc")));
	
//	pr($user_data_map);
	$umap = array();
	foreach($user_data_map as $d => $v){
		$umap[] = $v["User"];
	}

	$this->set("umap",$umap);
//echo json_encode($umap);die;
	
	$this->loadModel("User");
	$user_data	= $this->User->find("all",array("conditions"=>array("role_id"=>3),"limit"=>10,"order"=>array("created "=>"desc")));
	$this->set("user_data",$user_data);
	
		$this->loadModel("User");
	$page_data	= $this->User->find("all",array("conditions"=>array("role_id"=>2),"limit"=>10,"order"=>array("created "=>"desc")));
	$this->set("page_data",$page_data); 
	//pr($washroom_data);
	
	}
	public function login() {
		
		$this->layout	=	'login';
		$this->request->is('post') && $this->Auth->login();
		if ($this->Auth->user()) {
		
			if ($this->here == $this->Auth->loginRedirect) {
				$this->Auth->loginRedirect = '/';
			}	
			$this->Session->setFlash(sprintf(__('%s you have successfully logged in'), $this->Auth->user('full_name')),'success');
			$this->Session->delete('error');
			$this->redirect($this->Auth->redirect('/'));
		} else {
			if(!empty($this->data))
			$this->Session->write("error",'Invalid e-mail / password combination. Please try again');
			else
			$this->Session->write("error",'Enter email and Password for Login ');
			
		}
	}

	public function logout() {
		$user = $this->Auth->user();
		$this->User->updateAll(array('User.modified' =>'now()'), array('User.id' => "1"));
		$this->Session->setFlash(sprintf(__('%s you have successfully logged out'), $this->Auth->user('full_name')),'success');
		$this->redirect($this->Auth->logout());
	}
	
	
function forgot_password(){
	if(!empty($this->data)) {
	
		$this->{$this->modelClass}->set($this->data);
		if($this->{$this->modelClass}->ForgotPasswordValidate()) {
			$email_data	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('email'=>$this->data[$this->modelClass]['email'],'is_verified'=>1,'status'=>1)));
				
			if(!empty($email_data)){
				$forgot_password_validate_string	=	Security::hash($email_data[$this->modelClass]['email'].time(), 'sha1', true);
				$validate['forgot_password_validate_string']	= 	$forgot_password_validate_string;
				$this->{$this->modelClass}->id					=	$email_data[$this->modelClass]['id'];
				$this->{$this->modelClass}->save($validate,false);
			
				$this->loadModel('EmailTemplate');
				$this->loadModel('Setting');
				$settingsEmail = $this->Setting->find('first', array(
										'conditions' => array(
										'Setting.key ' =>  'Site.email',
										)
								));
				$settingstitle = $this->Setting->find('first', array(
							'conditions' => array(
							'Setting.key ' =>  'Site.title',
							)
					));
						
				$email 				=  $email_data[$this->modelClass]['email'];
				$WEBSITE_URL    	=  WEBSITE_URL;
				
				$varify_link    	=   WEBSITE_URL."users/resetpassword/".$forgot_password_validate_string."/"."?enc=".md5(time());	
				$varify_link		=	'<a href="'.$varify_link.'">Click here</a>';
				$forg_pass_id		=	Configure::read('global_ids.email_template.forgot_password');
				
				$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$forg_pass_id));
				
				$to 				= $this->data[$this->modelClass]['email'];
				$from_email 		= $settingsEmail['Setting']['value'];
				$from_name 			= $settingstitle['Setting']['value'];
				$from 				= $from_name . "<" . $from_email . ">";
				$replyTo 			= "";
				$subject 			= $email_template['EmailTemplate']['subject'];

				/**********************************************************************/
				
				$ac 				= str_replace(' ','',$email_template['EmailTemplate']['action']);
				$this->loadModel('EmailAction');
					
				$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$ac)));
				$cons = explode(',',$action['EmailAction']['options']);
				$constants = array();
				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}
			//	pr($constants); die;
				$rep_Array = array($email,$varify_link,$WEBSITE_URL); 
				$message 	= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);	
				//pr($message); die;
				$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  array('message' => $message) , "", 'html', $bcc = array());
				
				$this->Session->setFlash(__('A reset password link has been sent to your email. Please check your email.'), 'inner/success');
				$this->data	=	'';	
				//$this->redirect(array('plugin'=>'', 'controller'=>'users', 'action'=>'forgot_password'));	
			} else{
			
				$this->Session->write(__('email'),$this->data['User']['email']);
				//$this->set('email',$email_data[$this->modelClass]['email']);
				/* pr($this->data);die; */
				$this->Session->write('forgot_popup',__('This email is not registered with cargo'));
			}
		} else {
				$this->set('errors',$this->{$this->modelClass}->invalidFields());
		}
		$this->redirect('/');
	  }
	}
	public function myaccount() {
		$pages[__('Dashboard')] = array('controller'=>'/');
			
		$breadcrumb = array('pages'=>$pages, 'active'=>__('My Account',true));	
		
		$this->set('breadcrumb', $breadcrumb);
		$userId = $this->Auth->user('id');
		
		$user_data = $this->{$this->modelClass}->read(null, $userId);
		
		//pr($user_data); die;
		
		if(!empty($this->request->data)) {
			$user_pass	=	$user_data['User']['password'];
			
			$data 		=	$this->data;
			
			$data['User']['user_pass'] = $user_pass;
			
			$this->data = $data;
			
			$this->{$this->modelClass}->set($this->data);	
		
			if($this->{$this->modelClass}->EditValidate()) {
				
				$password 						= 	Security::hash($this->data['User']['password'], 'sha1', true);
				
				$save_data['User']['id']		= $this->data['User']['id'];
				$save_data['User']['email']		= $this->data['User']['email'];
				$save_data['User']['password']	= $password;
				
				if($this->{$this->modelClass}->save($save_data,false)) {
					$this->Session->setFlash(__('Account settings saved'),'success');
					$this->redirect(array('action' => 'myaccount'));
				} else {
					$this->Session->setFlash($e->getMessage(),'error');
					$this->redirect(array('action' => 'myaccount'));
				}
			}
		
		} else if (empty($this->request->data)) {
			
			//pr($user_data);
			$this->request->data = $user_data;
			
			
		}

	}
	
	function footer(){
		$this->layout	=	false;
		$this->loadModel('Setting');
		$footers['copyright_text']	=	$this->Setting->find('first',array('fields'=>array('id','key','value'),'conditions'=>array('key'=>'Site.copyright_text')));
		return $footers;
	}
	public function get_driver(){
		$this->layout	=	false;
		$subcategory	=	array();
		if(!empty($this->data)){
			$subcategory	=	$this->{$this->modelClass}->find('list',array('fields'=>array('id','firstname'),'conditions'=>array('city'=>$this->data['city_id'],"id"=>$this->data['company_id'])));
		}
		echo json_encode($subcategory);
		die;
	}
	public function test(){
		$u	=	$this->requestAction("app/favicon");
		pr($u);
		die;
	}
	public function update_modified(){
		$this->layout	=	false;
		$this->User->updateAll(array('User.modified' =>" now()"), array('User.id' => "1"));
		die;
	}
	public function testt(){
				$Email = new CakeEmail('gmail');
                $Email->to("kiplphp53@gmail.com");
                $Email->subject('Forget Password');
              
                $Email->from ('kiplphp53@gmail.com');
                $Email->send();die;
	//	$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  array('message' => $message) , "", 'html', $bcc = array());
		//	$this->_sendMail("kiplphp53@gmail.com", "kuldeepkardhani@gmail.com", "", "subkect", 'sendmail',  array('message' => "dsddf") , "", 'html', $bcc = array());
			die;
	}
	
	

// lagisatu
public function lagisatu(){	
		
		header('Content-Type: text/html; charset=utf-8');	
		$data = json_decode(file_get_contents('http://www.lagisatu.com/uploads/csvfile/singapore/singaporesingapore_enex.txt'),true);
		$arr= array();
		foreach($data as $d)
		{
		
			$dumy	=	explode('--',$d['picture_path']);
			$picture 	=	explode(";",$dumy[1]);
			$newpic = array();
			foreach($picture as $key => $p){
				$file_headers = @get_headers($p);
				if($file_headers[0] == 'HTTP/1.0 404 Not Found') {
					//echo "not $p<br/>";
					
				}
				else {
					$newpic[] = $p;
					//echo "found $p<br/>";
				}
				
			}
			$d['picture_path'] = $dumy[0]."--".implode(";",$newpic);
			$arr[]=$d;
			pr($arr); 
			//echo "<br/> ".json_encode($arr);
			die;
		}
		
}
function demo(){

			$file = 'http://media.expedia.com/hotels/2000000/1780000/1778600/1778579/1778579_26_b.jpg';
$file_headers = @get_headers($file);
if($file_headers[0] == 'HTTP/1.0 404 Not Found') {
    $exists = "not";
}
else {
    $exists = "found";
}
echo $exists;
die;
}
}