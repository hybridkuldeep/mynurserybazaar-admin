<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	// Validate image type
	function _validate_image($files_array=array()){
		
		if(!empty($files_array) && $files_array['name']!=""){
			$valid_mime_types 	= 	Configure::read('valid_mime_types');
			$valid_image_types 	= 	Configure::read('valid_image_types');
			$filename 			= 	$files_array['tmp_name'];
			
			$result 			= 	getimagesize($filename);
			
			//check file extension 
			$extension			=	strtolower(substr($files_array['name'],strrpos($files_array['name'],".") + 1)); 
			$mime_type			=	$result['mime'];
			$error				=	true;
			/************ Check valid file Mime type ****************************************************/
			if($result){
				if ($files_array['name'] != '') {
					// Catch I/O Errors.
					// Check valid exttension 
					if(in_array($extension,$valid_image_types)){
						
						if (!is_readable($filename)) {
							// failed to read input file: {$filename}");
							$error		=	false;
						}
						else if (in_array($files_array['type'],$valid_mime_types)) {
							
							// Retrieve the MimeType of Image, if none is returned, it's invalid
							if (!$mime_type) {
								// Uploaded file does not have a mime-type");
								$error		=	false;
							}
							// Check the MimeType against the array of valid ones specified above
							else if (!in_array($mime_type, $valid_mime_types)) {
								//Uploaded image has rejected Mime Type: {$mime_type}");
								$error		=	false;
							}
							
						} else {
							$error		=	false;
						}
					}else{
						
						$error		=	false;
					}
				}else{
					$error		=	false;
				}
			}else{
				
				$error		=	false;
			}
		}else{
			$error		=	false;
		}
		return $error; // return 
	}
}
