<?php

class WashroomsController extends AppController {

    var $components = array('RequestHandler');

    function index() {
        $response = $this->{$this->modelClass}->find('all');
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }
	
	function index_distance() {
		
		$lat	=	$this->data["lat"];
		$log	=	$this->data["long"];
		
		
		 $this->Washroom->virtualFields	=	array("distance"=>"SELECT ((ACOS(SIN($lat * PI() / 180) * SIN(lat * PI() / 180) + COS($lat * PI() / 180) * COS(lat * PI() / 180) * COS (($log - log ) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.60934)  FROM washrooms where id=Washroom.id");
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("status"=>1,"distance <="=>Configure::read("Site.rangekm")),"fields"=>array("id","name","address","lat","log","description","decal")));
		//$this->filewrite($response);die; 
		/* $log = $this->{$this->modelClass}->getDataSource()->getLog(false, false);
		debug($log);
		$this->filewrite($log);  */
		if(empty($response)){
			$response = "No record found";
		}
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }
	function index_search() {
		$keyword	=	$this->data["keyword"];
		$this->{$this->modelClass}->virtualFields	=	array("rating"=>"select round(sum(rate)/((select count( distinct user_id) from ratings where washroom_id=Washroom.id)*(select count(*) from rating_types where status=1))) from ratings where washroom_id=Washroom.id");
        $response = $this->{$this->modelClass}->find('all',array("conditions"=>array("status"=>1,"OR"=>array(
			"name like "=>"%".$keyword."%","address like "=>"%".$keyword."%"
		)),"fields"=>array("id","name","address","lat","log","description","rating","decal")));
        $this->set('response', $response);
		$this->set('_serialize', array('response'));		
    }

    function view($id) {
		$this->{$this->modelClass}->virtualFields	=	array("rating"=>"select sum(rate)/((select count( distinct user_id) from ratings where washroom_id=Washroom.id)*(select count(*) from rating_types where status=1)) from ratings where washroom_id=Washroom.id");
		$response = $this->{$this->modelClass}->findById($id);
		$response["image_url"]=WASHROOM_IMAGE_SHOW_PATH;
        $this->set('response', $response);
		$this->set('_serialize', array('response'));
    }

    function add() {
		$this->filewrite($this->request->data);
		$data[$this->modelClass] = $this->request->data;
		$this->request->data = $data;
		$this->{$this->modelClass}->set($this->data);
			//pr($this->data);die;
		if ($this->{$this->modelClass}->addValidate()) {
		/* $image	=	'';
		$filename  				= 	$this->request->params['form']['image']['name'];
		if($filename !=''){
			$tempPath  				= 	$this->request->params['form']['image']['tmp_name'];
			$new_file_name 			=	time().'_'.$filename;
			if(move_uploaded_file($tempPath,WASHROOM_IMAGE_STORE_PATH. $new_file_name)){
				$image		= 	$new_file_name;
			}else{
				$image		= 	'';
			}
		}else{
			$image			= 	'';
		}
		$this->request->data[$this->modelClass]['image']	=	$image ;
	 */
        if ($this->{$this->modelClass}->save($this->data)) {
				if(isset($this->data[$this->modelClass]['rating'])){
					$this->loadModel("Rating");
					$rd	=	array();
					for($i=0;$i<3;$i++){
						$rd[$i]["Rating"]["rate"]	=	isset($this->data[$this->modelClass]['rating'][$i]) ? $this->data[$this->modelClass]['rating'][$i] : 0;
						$rd[$i]["Rating"]["user_id"]	=	$this->data[$this->modelClass]['user_id'];
						$rd[$i]["Rating"]["washroom_id"]	=	$this->{$this->modelClass}->id;
						$rd[$i]["Rating"]["rating_type_id"]	=	($i+1);
					}
					$this->Rating->saveAll($rd);
				}
				
				//pr($rd);
				$response['status'] = true;
				$response['message'] = 'Save successfully';
        } else {
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
	function filewrite($data)
	{
		$writedata = json_encode($data);
		$file = new File("demo1.txt", true);
		$test = $file->write($writedata);
		return $test;		
	}
}