<?php
class RatingsController extends AppController {

    var $components = array('RequestHandler');

    function index($washroom_id=null) {
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("washroom_id"=>$washroom_id)));
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }
	
	function index_favourite($user_id=null) {
		$this->Favourite->belongsTo	=	array("Washroom"=>array("className"=>"Washroom","forigenKey"=>"washroom_id"));
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("user_id"=>$user_id)));
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }

    function view($id) {
		$response = $this->{$this->modelClass}->findById($id);
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }

	function viewByWashroomId($id) {
		$response = $this->{$this->modelClass}->query("SELECT rating_types.name,rating_types.id as rating_type_id ,avg(rate) as avg_rate FROM `rating_types` inner join `ratings` on  rating_types.id = ratings.rating_type_id 
		where washroom_id = ".$id." and rating_types.status =1  group by rating_type_id");
		foreach($response as $key	=> $data){
			$response[$key]['rating_types']['avg_rate']	= $response[$key][0]['avg_rate'];
			unset($response[$key][0]);
		}
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }

    function add() {
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
		
		$user = $this->{$this->modelClass}->find('first',array("conditions"=>array(
		"user_id"=>$this->data[$this->modelClass]['user_id'],
		"washroom_id"=>$this->data[$this->modelClass]['washroom_id'],
		"rating_type_id"=>$this->data[$this->modelClass]['rating_type_id']
		)));
		if(!empty($user)){$this->Rating->id = $user["Rating"]["id"];}
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
	
	function add_all(){
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
			if(isset($this->data[$this->modelClass]['rating'])){
					
					
					$rd	=	array();
					for($i=0;$i<3;$i++){
						$user = $this->{$this->modelClass}->find('first',array("conditions"=>array(
								"user_id"=>$this->data[$this->modelClass]['user_id'],
								"washroom_id"=>$this->data[$this->modelClass]['washroom_id'],
								"rating_type_id"=>$i+1
						)));
						if(!empty($user)){$rd[$i]["Rating"]["id"]	=	$user["Rating"]["id"];}
						$rd[$i]["Rating"]["rate"]	=	$this->data[$this->modelClass]['rating'][$i];
						$rd[$i]["Rating"]["user_id"]	=	$this->data[$this->modelClass]['user_id'];
						$rd[$i]["Rating"]["washroom_id"]	=	$this->data[$this->modelClass]['washroom_id'];
						$rd[$i]["Rating"]["rating_type_id"]	=	($i+1);
					}
					if($this->Rating->saveAll($rd)){
										$response['status'] = true;
										$response['message'] = 'Save successfully';

					}else{
					            $response['status'] = false;
								$response['message'] = 'Not Saved';

					}
			}else{
				$errors = "Please Enter rate";
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