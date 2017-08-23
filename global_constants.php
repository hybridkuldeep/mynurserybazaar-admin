<?php
define('SUBDIR','/mynurserybazaar/admin/');
define('DBHOST',"localhost");  //HOST NAME
define('DBUSERNAME',"root"); // DATA BASE USER NAME
define('DBPASSWORD',"");     // DATA BASE PASSWORD
define('DB',"mynurserybazaar");       // DATA BASE NAME

/****************************************** End Database details ******************************************/
define('WEBSITE_URL','http://'.$_SERVER['HTTP_HOST'].''.SUBDIR);
define('WEBSITE_JS_URL',WEBSITE_URL.'js/');
define('WEBSITE_CSS_URL',WEBSITE_URL.'css/');
define('WEBSITE_IMAGE_URL',WEBSITE_URL.'img/');
define('WEBSITE_IMG_URL',WEBSITE_URL.'img/');
define('WEBSITE_CATEGORY',WEBSITE_URL.'uploads/category/');
define('WEBSITE_IMAGES_URL',WEBSITE_URL.'images/');
define('WEBSITE_APP_WEBROOT_ROOT_PATH',dirname(__FILE__).'/app/webroot/');
define('WEBSITE_ADMIN_WEBROOT_ROOT_PATH',dirname(__FILE__).'/admin');
define('WEBSITE_APP_WEBROOT_IMG_ROOT_PATH',dirname(__FILE__).'/admin/webroot/img/');

/****************************************** Include all settings ******************************************/
require_once('settings.php');
/****************************************** Include all settings ******************************************/
$config['pagingViews'] 	= 	array(10=>'10',20=>'20',100=>'100');
$config['defaultPaginationLimit'] 	= 	10;
/* Admin Configuration */
if (!defined('APP_CACHE_PATH')) {
	define("APP_CACHE_PATH", ROOT.'/admin/tmp/cache');
}
if(!defined('ADMIN_FOLDER')) {
	define("ADMIN_FOLDER", "admin");	
}
if (!defined('WEBSITE_ADMIN_URL')) {
	define("WEBSITE_ADMIN_URL", WEBSITE_URL.ADMIN_FOLDER.'/');
}
if (!defined('WEBSITE_ADMIN_IMG_URL')) {
	define("WEBSITE_ADMIN_IMG_URL", WEBSITE_ADMIN_URL.'img/');
}
if (!defined('APP_WEBROOT_ROOT_PATH')) {
	define("APP_WEBROOT_ROOT_PATH", $_SERVER['DOCUMENT_ROOT'].SUBDIR.'app/webroot/');
}
if (!defined('APP_UPLOADS_ROOT_PATH')) {
	define("APP_UPLOADS_ROOT_PATH", APP_WEBROOT_ROOT_PATH.'nodeapp/public/');
}
if (!defined('APP_UPLOADS_HTTP_PATH')) {
	define("APP_UPLOADS_HTTP_PATH", WEBSITE_URL.'nodeapp/public/');
}


if (!defined('USER_IMAGE_STORE_HTTP_PATH')) {
	define("USER_IMAGE_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'profile_pictures/');
}
if (!defined('Calendar_IMAGE_STORE_PATH')) {
	define("Calendar_IMAGE_STORE_PATH", APP_UPLOADS_ROOT_PATH.'calendar_image/');
}
if (!defined('Calendar_IMAGE_STORE_HTTP_PATH')) {
	define("Calendar_IMAGE_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'calendar_image/');
}
if (!defined('Event_IMAGE_STORE_PATH')) {
	define("Event_IMAGE_STORE_PATH", APP_UPLOADS_ROOT_PATH.'event_image/');
}
if (!defined('Event_IMAGE_STORE_HTTP_PATH')) {
	define("Event_IMAGE_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'event_image/');
}

define('MEMORY_TO_ALLOCATE',	'100M');
define('DEFAULT_QUALITY',	90);
define('CACHE_DIR',				WEBSITE_APP_WEBROOT_ROOT_PATH .'imagecache' . DS);
define('DISCOUNT_SYMBOL','%');
$config['CALENDER_SCHEDULE_MINUTE']	= 	60;
//$config['USER_ROLE_ID']	= 	array('admin'=>1,2=>'company',3=>'customer',4=> 'driver',5=>'individual',6=>'Employee');
//$config['INDIVIDUAL_COMPANY']	= 	array(2=>'Company',5=>'individual');
//$config['COMPANY_INDIVIDUAL_COMPANY']	= 	array(0=>'Company',1=>'individual');
//$config['CAB_PERMIN']	= 	array(1=>'State',2=>'Interstate');
$config['status']				= 	array(1=>__('Active'),0=>__('Inactive'));
//$config['PARTNERS_TYPE']		= 	array(1=>__('Individual'),2=>__('Company'));
//$config['CUSTOMER_TYPE']		= 	array(1=>__('Individual'),2=>__('Company'));
$config['WEEK_DAYS']		= 	array(1=>__('Monday'),2=>__('Tuesday'),3=>__('Wednesday'),4=>__('Thursday'),5=>__('Friday'),6=>__('Saturday'),7=>__('Sunday'));
$config['gender']				= 	array('1'=>'Male','0'=>'Female');
$config['AC_NONAC']				= 	array('1'=>'AC','0'=>'Non-AC');

/****************************************** Custom constants  ********************************************/
define('CATEGORY_UPLOAD_IMAGE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/category/');
if (!defined('USER_IMAGE_STORE_PATH')) {
	define("USER_IMAGE_STORE_PATH", WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/user/');
}

define('ALBUM_UPLOAD_IMAGE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/photos/');
define('ALBUM_UPLOAD_IMAGE_PATH1', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/forums/');
define('WASHROOM_IMAGE_STORE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/washroom/');
define('SUPPORTER_IMAGE_STORE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/supporter/');
define('SETTING_IMAGE_STORE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/setting/');
if (!defined('SETTING_FILE_PATH')) {
	define("SETTING_FILE_PATH", ROOT.'/settings.php');
}




$config['valid_mime_types'] 	= 	array('image/jpeg', 'image/png', 'image/gif','image/pjpeg');
$config['file_valid_mime_types']= 	array('text/plain', 'text/plain', 'text/plain','text/plain');
$config['valid_image_types']	= 	array('jpg', 'jpeg', 'png', 'gif','pjpeg');
$config['valid_image_size']		= 	52428800;//50MB
$config['global_ids']	=	array(
								'email_template'=>
									array(
										'registration_successfull'					=>	1,
										'verification_email'						=>	2,
										'forgot_password'							=>	3,
										'user_password_changed_successfully'		=>	4,
										'campaign_highlight_confirmation'			=>  14, 
										'campaign_activated'						=>  6, 
										'social_register'							=>  16, 
										'subscription'								=>  17, 
										'notify_winners'					=>	10,
										
										),
					'admin_default_image'=>
						array(
						'setting_default_image'=>72)
					);
$config['date_format']				= 	array('basic'=>'d M, Y h:i a','profile'=>'F d, Y');	
$config['front_date_format']				= 	array('basic'=>'M d, Y h:i a','profile'=>'d/m/Y');	
$config['date_picker_formate']		= 	'dd/mm/yy';	
$config['Action_options']			=	array('Registration'=>'Registration','VerificationMail'=>'Verification Email','Forgot Password'=>'Forgot Password','UserPasswordChangedSuccessfully'=>'Reset Forgot Password','campaign_activated'=>'Campaign Activated','subscription'=>'Subscription','NotifyWinner'=>'Notify Winner');
$config['registration'] 			= 	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL','verify_link'=>'VERIFY_LINK');
$config['register_verify'] 			= 	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL');
$config['forgot_password'] 			= 	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL','reset_link'=>'RESET');
$config['reset_forgot_password'] 	=	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL');
$config['campaign_activated'] 		=	array('partner_name'=>'PARTNER_NAME','campaign_name'=>'CAMPAIGN_NAME','start_date'=>'START_DATE','end_date'=>'END_DATE','price'=>'PRICE');


define('PDF_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><script  type="text/php">$pdf->page_text(550, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, $color);</script><img src="'.WEBSITE_APP_WEBROOT_ROOT_PATH.'img/logo.png'.'"><br/><br/><table class="Table" width="100%" colspan="0" cellpadding="0" cellspacing="0" style="border:1px solid #000;"><tr>');

define('PRINT_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><img src="'.WEBSITE_APP_WEBROOT_ROOT_PATH.'img/logo.png'.'"><br/><br/>');
				
				


?>