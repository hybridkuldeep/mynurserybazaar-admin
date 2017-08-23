<?php
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AppController {
public $components	=	 array("Auth");
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->Allow("login","add","edit","access_card","forgot","password_replace");
	}
	
	public function login() {
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
		if(isset($this->data['User']['email']) && isset($this->data['User']['password'])){
		if ($this->{$this->modelClass}->LoginValidate()) {
			
			$user	=	$this->User->find("first",array("conditions"=>array("password"=>AuthComponent::password($this->data['User']['password']),"email"=>$this->data['User']['email'])));
		if (!empty($user)) {
			 $response['status'] = true;
			 $response['message'] = 'login successfully';
			 $response['user_id']	=	$user["User"]["id"];
			 $response['username']	=	$user["User"]["username"];
			 $response['user']	=	$user["User"];
		} else {
			$response['status'] = false;
			$response['message'] = 'login not successfully';
			$response['user_id']	=	"";
		}
       
		}else{
			$errors = $this->{$this->modelClass}->validationErrors;
			$response = array('status'=>false,'message'=>'ValidationError','data'=>$errors);
		}
		}else{
			$response = array('status'=>false,'message'=>'Invalid Argument ! ');
		}
		$this->set('response', $response);
		$this->set('_serialize', array('response'));
	}

	public function add() {
		  $userReg = $emailExist = 0;
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
		if( isset($this->data['User']['username'])){
			$conditions = array();
			$addUser = array();
			$addUser ["user_role_id"]=2;
            switch ($_POST['regtype']) {
                case 'facebook' :
                    $addUser['regtype'] = 'facebook';
                    $addUser['fb_id'] = $_POST['registerId'];
                    $conditions[] = array('OR'=>array(array('User.email' => $_POST['email']),array('User.fb_id' => $_POST['registerId'])));
                    break;
                case 'twitter' :
                    $addUser['regtype'] = 'twitter';
                    $addUser['twitter_id'] = $_POST['registerId'];
                    $conditions[] = array('User.twitter_id' => $_POST['registerId']);
                    break;
                default :
                    $addUser['regtype'] = 'normal';
                    $conditions[] = array('User.email' => $_POST['email']);
                    break;
            }
			
			if ($addUser['regtype'] == 'twitter') {
                $_POST['email'] = '';
                $_POST['password'] = '';
            }
			
			$isUserExist = $this->User->find('first', array('conditions' => $conditions));
			if (!empty($isUserExist)) {
				if ($addUser['regtype'] == 'facebook'  ||  $addUser['regtype'] == 'twitter') {
						$response['status'] = true;
						 $response['message'] = 'login successfully';
						 $response['user_id']	=	$isUserExist["User"]["id"];
						 $response['username']	=	$isUserExist["User"]["username"];
						 $response['user']	=	$isUserExist["User"];
				}else{
					$response = array('status'=>false,'message'=>'This User is already exit . ');
					$emailExist = 1;
				}
            } elseif ($addUser['regtype'] == 'facebook') {
                $this->User->create();
                if (isset($_POST['email'])) {
                    $addUser['email'] = $_POST['email'];
                }
                if (isset($_POST['username'])) {
                    $addUser['username'] = $_POST['username'];
                }
               
                if ($this->User->save($addUser)) {
                    $userReg = 1;
                }
            } elseif ($addUser['regtype'] == 'twitter') {
                $this->User->create();

               if (isset($_POST['username'])) {
                    $addUser['username'] = $_POST['username'];
                }
              
                if ($this->User->save($addUser)) {
                    $userReg = 1;
                }
            }elseif ($addUser['regtype'] == 'normal') {
					if ($this->{$this->modelClass}->addValidate()) {
					$this->request->data["User"]["password"]=AuthComponent::password($this->data['User']['password']);
					$this->request->data["User"]["user_role_id"]=2;
					$this->request->data["User"]['regtype'] = 'normal';
					if ($this->{$this->modelClass}->save($this->data)) {
					$id	=	$this->{$this->modelClass}->id;
					$user	=	$this->User->findById($id);		
						$response['status'] = true;
						$response['user_id'] = $id;
						 $response['username']	=	$user["User"]["username"];
							 $response['user']	=	$user["User"];
						$response['message'] = 'Save successfully';
					} else {
						$response['status'] = false;
						$response['message'] = 'Not Save';
					}
				}else{
					$errors = $this->{$this->modelClass}->validationErrors;
					$response = array('status'=>false,'message'=>'ValidationError','data'=>$errors);
				}
			
			}
			
			
			
			
			 if ($emailExist == 0) {
                if ($userReg == 1) {
					$id	=	$this->{$this->modelClass}->id;
					$user	=	$this->User->findById($id);		
					$response['status'] = true;
					$response['user_id'] = $id;
					$response['username']	=	$user["User"]["username"];
					$response['user']	=	$user["User"];
					$response['message'] = 'Save successfully';
				}
        } else {
            $response['status'] = false;
			$response['message'] = 'Not Save';
        }
			
			//die;
          
		
		
		
		}else{
			$response = array('status'=>false,'message'=>'Invalid Argument ! ');
		}
         $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }
	function edit($id=null) {
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
      
		if( isset($this->data['User']['postal_code'])&& isset($id) ){
		  $this->{$this->modelClass}->id = $id;
		if($this->{$this->modelClass}->editValidate()) {
		if(isset($this->data["User"]["password"]) && !empty($this->data["User"]["password"]) && isset($this->data["User"]["new_password"]) && !empty($this->data["User"]["new_password"])){
			$q	=	"select * from users where id = ".$id ." and user_role_id =2 and password = '".AuthComponent::password($this->data['User']['password'])." ' ";
			$userdataq	=	$this->User->query($q);
			if(!empty($userdataq)){
				$this->request->data["User"]["password"]	=	AuthComponent::password($this->data['User']['new_password']);
				if ($this->{$this->modelClass}->save($this->data) ) {
				$response['status'] = true;
				$response['message'] = 'Save successfully';
				} else {
					$response['status'] = false;
					$response['message'] = 'Not Save';
				}
			}else{
				$response['status'] = false;
				$response['message'] = 'Not Save . Password not correct ';
				
				
			}
		}else{
				unset($this->request->data['User']['password']);
				if ($this->{$this->modelClass}->save($this->data) ) {
					$response['status'] = true;
					$response['message'] = 'Save successfully';
				} else {
					$response['status'] = false;
					$response['message'] = 'Not Save';
				}
		}
		}else{
			$errors = $this->{$this->modelClass}->validationErrors;
			$response = array('status'=>false,'message'=>'ValidationError','data'=>$errors);
		}
		}else{
			$response = array('status'=>false,'message'=>'Invalid Argument ! ');
		}
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }
	function access_card($id=null) {
		$this->{$this->modelClass}->id	=	$id;
		if(isset($id) && $this->{$this->modelClass}->exists()){
		$this->{$this->modelClass}->virtualFields	=	array("avatar"=>"select value from settings where id=3");
		$response = $this->{$this->modelClass}->find("first",array("conditions"=>array("id"=>$id),"fields"=>array("id","username","year","avatar")));
		$response["image_url"]	=	SETTING_IMAGE_SHOW_PATH;
		}else{
			$response = array('status'=>false,'message'=>'Invalid Argument ! ');
		}
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }
	
	public function forgot(){
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
		if(isset($this->data['User']['email']) ){
		if ($this->{$this->modelClass}->forgotValidate()) {
	
			$email_data	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('email'=>$this->request->data['User']['email'])));
			if(!empty($email_data)){
				$forgot_password_validate_string	=	Security::hash($email_data[$this->modelClass]['email'].time(), 'sha1', true);
				$validate['forgot_password_validate_string']	= 	$forgot_password_validate_string;
				$this->{$this->modelClass}->id					=	$email_data[$this->modelClass]['id'];
				$this->{$this->modelClass}->save($validate,false);
				$varify_link    	=   WEBSITE_URL."users/resetpassword/".$forgot_password_validate_string."/"."?enc=".md5(time());	
				//$varify_link		=	'<a href="'.$varify_link.'">Click here</a>';
				$message	=	"Hello ".$email_data["User"]["username"]."
  To reset password click below link .
  ".$varify_link."
				
  Best Regards	
  Go Here Team
				";
				$Email = new CakeEmail('gmail');
                $Email->to($this->request->data['User']['email']);
                $Email->subject('Forget Password');
				$Email->from (Configure::read("Site.email_send_mail"));
                $Email->send($message);
				$response['status'] = true;
				$response['message'] = 'A reset password link has been sent to your email. Please check your email.';
			}else{
				$response['status'] = false;
				$response['message'] = 'Email not registered';
			}
		}else{
			$errors = $this->{$this->modelClass}->validationErrors;
			$response = array('status'=>false,'message'=>'ValidationError','data'=>$errors);
		}
		}else{
			$response = array('status'=>false,'message'=>'Invalid Argument ! ');
		}
         $this->set('response', $response);
		$this->set('_serialize', array('response'));
			
	}
	public function password_replace(){
		$result	=	$this->User->find("all");
		foreach($result as $k => $v){
			if(!empty($v["User"]["password"])){
				$this->User->updateAll(array('password'=>"'".AuthComponent::password($v["User"]["password"])."'"),array("id"=>$v["User"]["id"]));
			}
			
		}
		echo "success";
		die;
	}

}