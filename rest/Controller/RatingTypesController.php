<?php
class RatingTypesController extends AppController {

    var $components = array('RequestHandler');

    function index() {
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("status"=>1)));
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }  
	
	function indexByWashroomId($id=null) {
		$this->RatingType->virtualFields	=	array("avg"=>"select avg(rate) from ratings where  rating_type_id=RatingType.id and washroom_id=".$id);
		$response['RatingType']	=	$this->RatingType->find("all",array("conditions"=>array("status"=>1),"fields"=>array("id","name","avg")));
		$this->set('response', $response);
		$this->set('_serialize', array('response'));    }

    function view($id) {
		$response = $this->{$this->modelClass}->findById($id);
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
		$response['RatingType']	=	$this->RatingType->find("all",array("conditions"=>array("status"=>1),"fields"=>array("id","name")));
		$this->set('response', $response);
		$this->set('_serialize', array('response'));
	}
}