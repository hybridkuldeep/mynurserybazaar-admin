<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class WebservicesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Webservice';

public $components 	= 	array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');
/**
 * This controller does not use a model
 *
 * @var array
 */
 public function beforeFilter(){
		parent::beforeFilter();
		error_reporting(0);
		$this->set('model',$this->modelClass);
		$this->Auth->allow('addCustomer','login','logout','registration','addSalary','getProfessionCategory','getExpenseCategory','addExpense');
	}
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
public function display() {
		//echo "hi";exit;	
		$path = func_get_args(); // returns array([0] => 'home');
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;
		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$uid=$this->Auth->user('id');
		$this->set('uid',$uid);
		$this->loadModel('Customer');
		$y=date('Y',time());
		
		if($uid!=1){
		
		
		$customer_counts=$this->Customer->query("SELECT MONTH(arrival_time) MONTH, COUNT(*) COUNT FROM `customers` WHERE (restro_id IN (SELECT id from `restrorants` WHERE user_id='$uid') OR company_id IN (SELECT id from `companies` WHERE user_id='$uid')) AND YEAR(arrival_time)='$y' GROUP BY MONTH(arrival_time)");
		$this->set('customer_counts',$customer_counts);
		//pr($customer_counts);
		
		$Customers=$this->Customer->query("select * from customers WHERE restro_id  IN (SELECT id from restrorants WHERE user_id='$uid') OR company_id  IN (SELECT id from companies WHERE user_id='$uid') ORDER BY id desc LIMIT 6");
		$this->set('Customers',$Customers);
		//pr($Customers);
		
		$winners=$this->Customer->query("select * from customers inner join winners on (customers.id=winners.customer_id) where winners.user_id='$uid' ORDER BY winners.id desc LIMIT 6");
		$this->set('winners',$winners);
		//pr($winners);	
			}else{
				
				$customer_counts=$this->Customer->query("SELECT MONTH(arrival_time) MONTH, COUNT(*) COUNT FROM `customers` WHERE (restro_id IN (SELECT id from `restrorants` ) OR company_id IN (SELECT id from `companies` )) AND YEAR(arrival_time)='$y' GROUP BY MONTH(arrival_time)");
		$this->set('customer_counts',$customer_counts);
		//pr($customer_counts);
		
		$Customers=$this->Customer->query("select * from customers WHERE restro_id  IN (SELECT id from restrorants ) OR company_id  IN (SELECT id from companies  ) ORDER BY id desc LIMIT 6");
		$this->set('Customers',$Customers);
		//pr($Customers);
		
		$winners=$this->Customer->query("select * from customers inner join winners on (customers.id=winners.customer_id) ORDER BY winners.id desc LIMIT 6");
		$this->set('winners',$winners);
		//pr($winners);
				
				
				
				}
		
	
		
		/*// echo implode('/', $path);exit;
		$this->loadModel('Users');
		$allCustomers = $this->Users->find('all', array('conditions' => array('user_role_id'=>3, 'status'=>1), 'order' => array('id' => 'desc'),array('limit' => 5)));
		$this->set('allCustomers', $allCustomers);
		*/
		
		$this->loadModel('Assigns');
/*
		$options['joins'] = array(
        array('table' => 'companies',
              'alias' => 'Company',
              'type' => 'INNER',
              'conditions' => array('Company.id = Assigns.company_id')
               ),
		
        array('table' => 'users',
              'alias' => 'Driver',
              'type' => 'INNER',
              'conditions' => array( 
                'Driver.id = Assigns.driver_id' 
            )
                ),
		
        array('table' => 'taxis',
              'alias' => 'Taxi',
              'type' => 'INNER',
              'conditions' => array( 
                'Taxi.id = Assigns.taxi_id' 
            )
                )
            );*/
	

		$options['order'] = array('Assigns.id' => 'desc');
		
		$options['limit'] = 5;
		
		$assigns = $this->Assigns->find('all', $options); 
		$this->set('Assigns', $assigns);
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
		
	}
	
	function login(){
		$this->layout=false;
		$this->loadModel("User");
		$data["User"] = $this->request->data;
		$this->request->data = $data;
		$this->User->set($this->data);
	//pr($this->request->data);die;
		
		if(!empty($this->request->data['User']['email']) && !empty($this->request->data['User']['password'])){
		$User=array($this->data);
			
	
		
		
		$this->request->is('post') && $this->Auth->login();
		//echo 'in';
		if ($this->Auth->user()) {
		//echo 'kuldeep';//die;
			
			$this->loadModel('User');
			$user	=	$this->User->find("first",array("conditions"=>array("email"=>$this->data['User']['email'],"password"=>AuthComponent::password($this->data['User']['password']))));
		//pr($user);
		$data=array();
		$data['id']=$user['User']['id'];
		$data['firstname']=$user['User']['firstname'];
		$data['lastname']=$user['User']['lastname'];
		$data['email']=$user['User']['email'];
		$data['gender']=$user['User']['gender'];
		$data['dob']=$user['User']['dob'];
		
		
		
		$response=array();
		if (!empty($user)) {
			
			 $response['status']  = true;
			 $response['data'] = $data;
			 $response['message'] = 'login successfully';
			 
		} else {
			 		 $response['status']  = false;
    		         $response['message'] = 'Invalid Username Password';
	   		
		}
       
		    
			echo json_encode($response);		
			
		}else{
			
					 $response['status']  = false;
    		         $response['message'] = 'Invalid Email Password';
					 echo json_encode($response);	
			} 
	}else {
			$response['status']  = false;
			$response['params'] = 'please enter email and password';
			
			echo json_encode($response);		
		}
	
	exit;	
		}
		
		
	public function logout() {
		$this->layout=false;
		$response['status'] = true;
		$response['message'] = 'logout successfully';
	   	$this->set('response', $response);
		$this->set('_serialize', array('response'));
		echo json_encode($response);
	}
	
	
	function addCustomer(){
		$this->layout=false;
		$this->loadModel("User");
				//echo 'in';
				//pr($this->request->data);//die;
		if (!empty($this->request->data['name'])&&!empty($this->request->data['lastname'])&& !empty($this->request->data['phone']) && !empty($this->request->data['email']) && !empty($this->request->data['location'])) {
		//echo 'kuldeep';//die;
			
		$address= $this->request->data['location'];
		$prepAddr = str_replace(' ','+',$address);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);
		@$lat = $output->results[0]->geometry->location->lat;
		@$long = $output->results[0]->geometry->location->lng;
		
		//echo $address.'<br>Lat: '.$lat.'<br>Long: '.$long;//die;
			
			
		$this->loadModel('Company');
		$Company_details	=	$this->Company->find("first",array("conditions"=>array("latitude"=>$lat,"longitude"=>$long)));
	if(!empty($Company_details)){
		$this->loadModel('Customer');
			if ($this->Customer->save(
				array(
					'company_id'=>$Company_details['Company']['id'],
					'name'=>$this->request->data['name'],
					'last_name'=>$this->request->data['lastname'],
					'phone_code'=>$this->request->data['phone'],
					'email'=>$this->request->data['email'],
					
					)
			
				)) {
					//die('compny');
				 $response['status']  = true;
			     $response['message'] = 'company visitors added successfully';
				
			}
			
	  }else{
		
		$this->loadModel('Restrorant');
		$restro_details	=	$this->Restrorant->find("first",array("conditions"=>array("latitude"=>$lat,"longitude"=>$long)));
			if(!empty($restro_details)){
				
			
		$this->loadModel('Customer');
			if ($this->Customer->save(
				array(
					'restro_id'=>$restro_details['Restrorant']['id'],
					'name'=>$this->request->data['name'],
					'last_name'=>$this->request->data['lastname'],
					'phone_code'=>$this->request->data['phone'],
					'email'=>$this->request->data['email'],
					
					)
			
				)) {
				 $response['status']  = true;
			     $response['message'] = 'Restaurant customers added successfully';
				
			        }		
	  
				
				}		
		  }
		
		if(empty($restro_details) && empty($Company_details)){
			$response['status']  = false;
		    $response['message'] = 'No Company and retaurant exist on this location';		
			}
		
		    
				
		    
			echo json_encode($response);		
			
		} else {
			$response['status']  = false;
			$response['params'] = 'please provide required params (name,lastname,phone,email,location)';
			
			echo json_encode($response);		
		}
	
	  exit;	
	}
	
	function registration(){
	  // $this->layout=false;
	  	  
	   $firstname=$_POST['firstname'];
	   $lastname=$_POST['lastname'];
	   $email=$_POST['email'];
	   $password=$_POST['password'];
	   $dob=$_POST['dob'];
	   $gender=$_POST['gender'];
	 try {	
		 if($firstname==''){
			  throw new Exception('(params:firstname) firstname must not be empty');
			  break;
			 }elseif($lastname==''){
			  throw new Exception('(params:lastname) lastname must not be empty');
			  break;
			 }elseif($email==''){
			  throw new Exception('(params:email) Email must not be empty');
			  break;
			 }elseif($password==''){
			  throw new Exception('(params:password) Password must not be empty');
			  break;
			 }elseif($dob==''){
			  throw new Exception('(params:dob) date of birth must not be empty');
			  break;			
			 }elseif($gender!='m' && $gender!='f' ){
			  throw new Exception('Gender should be either m or f');
			  break;
			 }
			 else{								
				  $this->loadModel('User');
				$em=$this->User->find('all',array('conditions'=>array('email'=>$email)));
				//pr($em);
			if(count($em)==0){			
				
				
				 $password=AuthComponent::password($password);
				 $created= date('Y-m-d h:i:s',time());
				 // pr($password);//exit;
				 
				$this->User->query("insert into users (user_role_id,role,firstname,lastname,email,password,dob,gender,status,created) values (2,2,'$firstname','$lastname','$email','$password','$dob','$gender',1,'$created')");
			//	pr($this->getInsertID());die;
			
				$data=array();
				$data['id']=$this->User->getInsertID();
				$data['firstname']=$firstname;
				$data['lastname']=$lastname;
				$data['email']=$email;
				$data['gender']=$gender;
				$data['dob']=$dob;
				
					$response['status'] = true;
					$response['data'] = $data;
					$response['message'] = 'user registration successfully';
					$this->set('response', $response);
					$this->set('_serialize', array('response'));
					echo json_encode($response);
					exit;				  
					
			}else{
					$response['status'] = false;
					$response['message'] = 'Email already exists';
					echo json_encode($response);
					exit;
				
				}
				
			}
				 
			 }catch (Exception $e) {
				 
				$response = array();
				$response['status'] = false;			
				$response["Exception"]=$e->getMessage();
				echo json_encode($response);
				exit;
				}
				
	
		
		}	
		
	
		
	function getProfessionCategory(){
		
		$this->layout=false;
		$this->loadModel('ProfessionalCategory');
		$profcategorylist=$this->ProfessionalCategory->find('list',array('conditions'=>array('status'=>1)));
		//pr($profcategorylist);die;
		
					$response['status'] = true;
					$response['data']=$profcategorylist;
					$response['message'] = 'Professional Categories list';
					echo json_encode($response);
					exit;
		
		
		
		}			
		
		
		function getExpenseCategory(){
		
		$this->layout=false;
		$this->loadModel('ExpenseCategory');
		$profcategorylist=$this->ExpenseCategory->find('list');
		
					$response['status'] = true;
					$response['data']=$profcategorylist;
					$response['message'] = 'Expenses Categories list';
					echo json_encode($response);
					exit;
		
		
		
		}
		
		
		function addSalary(){
	  // $this->layout=false;
	  	  
	   $userid=$_POST['userid'];
	   $salary=$_POST['salary'];
	   $salary_date=$_POST['salary_date'];
	 
	 try {	
		 if($userid==''){
			  throw new Exception('(params:userid) userid must not be empty');
			  break;
			 }elseif($salary==''){
			  throw new Exception('(params:salary) salary must not be empty');
			  break;
			 }elseif($salary_date==''){
			  throw new Exception('(params:salary_date) salary_date must not be empty');
			  break;
			 }
			 else{								
							
				
				
				 $password=AuthComponent::password($password);
				 $created= date('Y-m-d h:i:s',time());
				 // pr($password);//exit;
				 $this->loadModel('Salary');
				$this->Salary->save(array(
				
				'user_id'=>$userid,
				'salary'=>$salary,
				'salary_date'=>$salary_date,
				'created'=>date('Y-m-d h:i:s',time())
				));
			//	pr($this->getInsertID());die;
			
					$data=array();
				
				
					$response['status'] = true;
					$response['message'] = 'Salary added successfully';
					$this->set('response', $response);
					$this->set('_serialize', array('response'));
					echo json_encode($response);
					exit;				  
					
			
				
			}
				 
			 }catch (Exception $e) {
				 
				$response = array();
				$response['status'] = false;			
				$response["Exception"]=$e->getMessage();
				echo json_encode($response);
				exit;
				}
				
	
		
		}	
		
		
		function addExpense(){
	  // $this->layout=false;
	  	  
	   $userid=$_POST['userid'];
	   $exp_id=$_POST['exp_id'];
	   $expense=$_POST['expense'];
	 
	 
	 try {	
		 if($userid==''){
			  throw new Exception('(params:userid) userid must not be empty');
			  break;
			 }elseif($exp_id==''){
			  throw new Exception('(params:exp_id) expense id must not be empty');
			  break;
			 }elseif($expense==''){
			  throw new Exception('(params:expense) expense price must not be empty');
			  break;
			 }
			 else{								
							
				
				
				 $password=AuthComponent::password($password);
				 $created= date('Y-m-d h:i:s',time());
				 // pr($password);//exit;
				 $this->loadModel('Expense');
				$this->Expense->save(array(
				
				'user_id'=>$userid,
				'exp_id'=>$exp_id,
				'expense'=>$expense,
				'created'=>date('Y-m-d h:i:s',time())
				));
			//	pr($this->getInsertID());die;
			
					$data=array();
				
				
					$response['status'] = true;
					$response['message'] = 'Expense added successfully';
					$this->set('response', $response);
					$this->set('_serialize', array('response'));
					echo json_encode($response);
					exit;				  
					
			
				
			}
				 
			 }catch (Exception $e) {
				 
				$response = array();
				$response['status'] = false;			
				$response["Exception"]=$e->getMessage();
				echo json_encode($response);
				exit;
				}
				
	
		
		}	
		
		
}