<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
/**
* Helpers
*
* @var array
*/
	public $helpers = array(
							'Html',
							'Form',
							'Session',
							'Time',
							'Text');

/**
* Components
*
* @var array
*/
public $components = array(
						'Auth',
						'Session',
						'Cookie',
						'Paginator');
	

/**
* beforeFilter callback
*
* @return void
*/
public function beforeFilter() {
	$scope = array('User.role_id' => array(1));
	$loginAction = array('plugin'=>'','controller' => 'users', 'action' => 'login');
	$loginRedirect	='/';
	$logoutRedirect	='/';
	$this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'email','password' => 'password'),'scope' => $scope));
 	$this->Auth->authError = __('Did you really think you are allowed to see that?');
	$sessionKey    = 'Auth.Admin';
	authComponent::$sessionKey = $sessionKey;
	$this->Auth->loginRedirect = $loginRedirect;
	$this->Auth->logoutRedirect = $logoutRedirect;
	$this->Auth->loginAction = array('plugin'=>'', 'controller' => 'users', 'action' => 'login');
	$this->Auth->allow('login');
	//$admin_menus=array("home");
	//$this->Session->write("admin_menus",);
	
	/* $this->loadModel("User");
	$user_app	=	$this->User->findById($this->Auth->user("id"));
	if(!empty($user_app)){
	$this->loadModel("ReportAbuse");
	$report_count	= $this->ReportAbuse->find("count",array("conditions"=>array("ReportAbuse.modified >="=>$user_app["User"]["modified"])));
	$this->set("report_count",$report_count);
	$this->ReportAbuse->virtualFields	=	array(
				"username"=>"select username from users where id=ReportAbuse.user_id",
				"userimage"=>"select value from settings  where id=3",
				"comment"=>"select name from comments where id=ReportAbuse.comment_id"
			);
	$this->loadModel("ReportAbuse");
	$report_app	= $this->ReportAbuse->find("all",array("conditions"=>array("ReportAbuse.modified >="=>$user_app["User"]["modified"])));
	$this->set("report_app",$report_app);
	//pr($report);
	
	
	$this->loadModel("Setting");
	$admin_avatar	= $this->Setting->find("first",array("conditions"=>array("id"=>2),"fields"=>array("value")));
	$this->set("admin_avatar",$admin_avatar);
	//pr($admin_avatar);
	} */
	$this->loadModel("Setting");
	$admin_avatar	= $this->Setting->find("first",array("conditions"=>array("id"=>2),"fields"=>array("value")));
	$this->set("admin_avatar",$admin_avatar);
}


public function isAuthorized() {
return true;
}


function downloadFile($filename, $downloadPath,$alt_name = '') {
	  $file = $downloadPath . $filename;
	  if (!is_file($file)) { die("<b>404 File not found!</b>"); }

	 //Gather relevent info about file
	 $len = filesize($file);
	 $filename = basename($file);
	 $file_extension = strtolower( substr( strrchr( $filename, "." ), 1 ) );
	
	 //This will set the Content-Type to the appropriate setting for the file
	 switch( $file_extension ) {
	   case "pdf": $ctype 	= "application/pdf"; break;
	   case "exe": $ctype 	= "application/octet-stream"; break;
	   case "zip": $ctype 	= "application/zip"; break;
	   case "docx": $ctype 	= "application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
	   case "doc": $ctype 	= "application/msword"; break;
	   case "xlsx": $ctype 	= "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
	   case "xls": $ctype 	= "application/vnd.ms-excel"; break;
	   case "ppt": $ctype 	= "application/vnd.ms-powerpoint"; break;
	   case "gif": $ctype 	= "image/gif"; break;
	   case "png": $ctype 	= "image/png"; break;
	   case "jpeg":
	   case "jpg": $ctype 	= "image/jpg"; break;
	   case "mp3": $ctype 	= "audio/mpeg"; break;
	   case "wav": $ctype 	= "audio/x-wav"; break;
	   case "mpeg":
	   case "mpg":
	   case "mpe": $ctype 	= "video/mpeg"; break;
	   case "mov": $ctype 	= "video/quicktime"; break;
	   case "avi": $ctype 	= "video/x-msvideo"; break;
	
	   //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
	   case "php":
	   case "htm":
	   case "html": die("<b>".__("Cannot be used for") . $file_extension . __("files")."!</b>"); break;
	
	   default: $ctype = "application/force-download";
	 }
	
	 //Begin writing headers
	 header("Pragma: public");
	 header("Expires: 0");
	 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	 header("Cache-Control: public"); 
	 header("Content-Description: File Transfer");
	 
	 //Use the switch-generated Content-Type
	 header("Content-Type: $ctype");
	
	 //Force the download
	 if($alt_name==''){ $alt_name = $filename;}else{ $alt_name = $alt_name . '.' . $file_extension;}
	 $header="Content-Disposition: attachment; filename=" . $alt_name . ";";
	 header($header );
	 header("Content-Transfer-Encoding: binary");
	 header("Content-Length: " . $len);
	 @readfile($file);
	 exit();
	}
	

	public function favicon(){
		$this->loadModel("ImageGallery");
		return $favicon	=	$this->ImageGallery->findById(104);
		die;
	}
}