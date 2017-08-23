<?php
class FavouritesController extends AppController {

    var $components = array('RequestHandler');

    function index($washroom_id=null) {
		
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("washroom_id"=>$washroom_id)));
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }
	
	function index_favourite($user_id=null) {
		$this->loadModel("Washroom");
		$this->Washroom->virtualFields	=	array("rating"=>"select round(sum(rate)/((select count( distinct user_id) from ratings where washroom_id=Washroom.id)*(select count(*) from rating_types where status=1))) from ratings where washroom_id=Washroom.id");
		$this->Favourite->belongsTo	=	array("Washroom"=>array("className"=>"Washroom","foreignKey"=>"washroom_id","fields"=>array("name","address","lat","log","description","rating","decal"),"order"=>array("Washroom__rating"=>"desc")));
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("user_id"=>$user_id)));
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }

    function view($id) {
		$response = $this->{$this->modelClass}->findById($id);
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }

    function add() {
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
		if ($this->{$this->modelClass}->addValidate()) {
		$user = $this->{$this->modelClass}->find('first',array("conditions"=>array(
		"user_id"=>$this->data[$this->modelClass]['user_id'],
		"washroom_id"=>$this->data[$this->modelClass]['washroom_id']
		
		)));
		if(empty($user)){
       if ($this->{$this->modelClass}->save($this->data)) {
				$response['status'] = true;
				$response['message'] = 'Save successfully';
			} else {
				$response['status'] = false;
				$response['message'] = 'Not Save';
			}
		}else{
			$response['status'] = false;
			$response['message'] = 'This Washroom already Favorited by you .';
		}
		}else{
			$errors = $this->{$this->modelClass}->validationErrors;
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