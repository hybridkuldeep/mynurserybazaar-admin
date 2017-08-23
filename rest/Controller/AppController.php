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
header("Access-Control-Allow-Origin: *");
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

/**
* Components
*
* @var array
*/
public $components = array('RequestHandler');
	

/**
* beforeFilter callback
*
* @return void
*/
public function beforeFilter() {
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
	

	function _sendMail($to, $from, $replyTo, $subject, $element , $parsingParams  = array() ,$attachments ="", $sendAs = 'html', $bcc = array()) {
		
		$toAraay = array();
		if ( !is_array($to) ) {
		
			$toAraay[] = $to;
		} else {
			$toAraay = $to;
		}
		
		
	
		$this->Email->smtpOptions = array(
        'port'=>MAIL_PORT, 
        'host' => MAIL_HOST,
        'username'=>MAIL_USERNAME,
        'password'=>MAIL_PASSWORD,
        'client' => MAIL_CLIENT
		);
//pr($toAraay); die;
		$this->Email->delivery = 'smtp';
		
		if(is_array($parsingParams)){
			foreach ($parsingParams as $key => $value) {
				$this->set($key, $value);
			}
		}
		
		
		foreach ($toAraay as $email) {
			$this->Email->to = $email;
			
			$this->Email->subject = $subject;
			$this->Email->replyTo = $replyTo;
			$this->Email->from = $from;
			if($attachments!=""){
				$this->Email->attachments = array();
        		$this->Email->attachments[0] = ALBUM_UPLOAD_IMAGE_PATH.$attachments ;
			}
			$this->Email->template = $element; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$this->Email->sendAs = $sendAs; // because we like to send pretty mail
			$this->Email->send();
			$this->Email->reset();
		} 
	}
}