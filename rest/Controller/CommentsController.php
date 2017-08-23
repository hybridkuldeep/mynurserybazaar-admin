<?php
App::uses('Controller', 'Controller');
header("Access-Control-Allow-Origin: *");
class CommentsController extends AppController {

    var $components = array('RequestHandler');

    function index($washroom_id=null) {
		$this->{$this->modelClass}->virtualFields	=	array("avatar"=>"select value from settings where id=3",
				"username"=>"select username from users where id=Comment.user_id "
		);
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("status"=>1,"washroom_id"=>$washroom_id)
		,"fields"=>array("name","username","avatar","id","created")
		));
	//	$response["image_url"]	=	SETTING_IMAGE_SHOW_PATH;
	   $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }

    function view($id) {
		$this->{$this->modelClass}->virtualFields	=	array("avatar"=>"select value from settings where id=3",
				"username"=>"select username from users where id=Comment.user_id "
		);
		$response = $this->{$this->modelClass}->findById($id);
		//$response["image_url"]	=	SETTING_IMAGE_SHOW_PATH;
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }

    function add() {
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
		if ($this->{$this->modelClass}->addValidate()) {
          if ($this->{$this->modelClass}->save($this->data)) {
				$response['status'] = true;
				$response['message'] = 'Save successfully';
			} else {
				$response['status'] = false;
				$response['message'] = 'Not Save';
			}
		}else{
			$errors = $this->{$this->modelClass}->validationErrors;
			$response = array('status'=>false,'message'=>'ValidationError','data'=>$errors);
		}
          $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }
	
	function add_report_abuse() {
		$this->loadModel("ReportAbuse");
		$data["ReportAbuse"] = $this->request->data;
		$this->request->data = $data;
		$this->ReportAbuse->set($this->data);
		if ($this->ReportAbuse->addValidate()) {
			$user = $this->ReportAbuse->find('first',array("conditions"=>array(
		"user_id"=>$this->data["ReportAbuse"]['user_id'],
		"comment_id"=>$this->data["ReportAbuse"]['comment_id']
		
		)));
		if(empty($user)){
        if ($this->ReportAbuse->save($this->data)) {
			$this->ReportAbuse->updateAll(array('ReportAbuse.modified' =>" now()"), array('ReportAbuse.id' => $this->ReportAbuse->id));
           $response['status'] = true;
				$response['message'] = 'Save successfully';
        } else {
            $response['status'] = false;
				$response['message'] = 'Not Save';
        }
		}else{
			$response['status'] = false;
			$response['message'] = 'This Comment already Report Abuse by you .';
		}
		}else{
			$errors = $this->ReportAbuse->validationErrors;
			$response = array('status'=>false,'message'=>'ValidationError','data'=>$errors);
		}
         $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }
	
	function edit($id) {
		$image	=	'';
		$filename  				= 	$this->request->params['form']['image']['name'];
		if($filename !=''){
			$tempPath  				= 	$this->request->params['form']['image']['tmp_name'];
			$new_file_name 			=	time().'_'.$filename;
			if(move_uploaded_file($tempPath,PRODUCT_IMAGE_STORE_PATH. $new_file_name)){
				$image		= 	$new_file_name;
			}else{
				$image		= 	'';
			}
		}else{
			$image			= 	'';
		}
		$this->request->data['image']	=	$image ;
        $this->{$this->modelClass}->id = $id;
        if ($this->{$this->modelClass}->save($this->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
         $this->set('response', $message);
		$this->set('_serialize', array('response'));
    }

    function delete($id) {
        if($this->{$this->modelClass}->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set('response', $message);
		$this->set('_serialize', array('response'));
    }
	function deleteAll($id) {
		$ids	=	explode(",",$id);
        if($this->{$this->modelClass}->delete($ids)) {
            $response['status'] = true;
				$response['message'] = 'delete successfully';
        } else {
            $response['status'] = true;
				$response['message'] = 'not delete successfully';
        }
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }
	function fatch(){
		$this->loadModel("Division");
		$response['Division']	=	$this->Division->find("all",array("fields"=>array("id","name")));
		$this->loadModel("Vendor");
		$response['Vendor']	=	$this->Vendor->find("all",array("fields"=>array("id","name")));
		
		
		
		
		$this->set('response', $response);
		$this->set('_serialize', array('response'));
	}
}