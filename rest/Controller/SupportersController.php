<?php
class SupportersController extends AppController {

    var $components = array('RequestHandler');

    function index($supporter_type_id=null) {
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("supporter_type_id"=>$supporter_type_id),"fields"=>array("id","name","image")));
		$response["image_url"]=SUPPORTER_IMAGE_SHOW_PATH;
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }

    function view($id) {
		$response = $this->{$this->modelClass}->findById($id);
		$response["image_url"]=SUPPORTER_IMAGE_SHOW_PATH;
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }

    function add() {
		
        if ($this->{$this->modelClass}->save($this->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
         $this->set('response', $message);
		$this->set('_serialize', array('response'));
    }
	
	function add_report_abuse() {
		
		$this->loadModel("ReportAbuse");
        if ($this->ReportAbuse->save($this->data)) {
			$this->ReportAbuse->updateAll(array('ReportAbuse.modified' =>" now()"), array('ReportAbuse.id' => $this->ReportAbuse->id));
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
         $this->set('response', $message);
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