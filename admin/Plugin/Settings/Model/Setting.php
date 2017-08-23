<?php
App::uses('File', 'Utility');

/**
 * Setting
 *
 * PHP version 5
 *
 * @category Model
 * @package  
 * @version  1.0
 * @author   
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     
 */
class Setting extends AppModel {

/**
 * Name
 *
 * @var string
 */
	/* public $name = 'EmailTemplate';
	public $useTable='email_templates'; */

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable',
							 
							'Search.Searchable'
						  );

/**
 * Additional Find methods
 *
 * @var array
 */
	public $_findMethods = array('search' => true);

/**
 * @todo comment me
 *
 * @var array
 */
	public $filterArgs = array(
									array('name' => 'name', 
										  'type' => 'string'
										 )
							  );

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'name';
	public $useTable='settings';
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array();

/**
 * Validation parameters
 *
 * @var array
 */
	public $validate = array();

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */

/**
 * Model name
 *
 * @var string
 * @access public
 */
	//public $name = 'Setting';

/**
 * Path to settings file
 *
 * @var string+7
 */
		//public $useTable='settings';
	//public $settingsPath = '';

/**
 * Behaviors used by the Model
 *
 * @var array
 * @access public
 */
	/* public $actsAs = array(
		'Ordered' => array(
			'field' => 'weight',
			'foreign_key' => false,
		)
	); */

/**
 * Validation
 *
 * @var array
 * @access public
 */
	/* public $validate = array(
		'key' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This key has already been taken.',
			),
			'minLength' => array(
				'rule' => array('minLength', 1),
				'message' => 'Key cannot be empty.',
			),
		), 
	); */

/**
 * __construct
 *
 * @param mixed $id
 * @param string $table
 * @param DataSource $ds
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		
		//$this->settingsPath = APP . 'Config' . DS . 'settings.php';
	}
	function AddSettingValidate() {
		/* $validate1 = array( 
			'title' => array('rule' 		=> 'notEmpty',
							'required' 	=> true,
							'message' 	=> __('Please enter title.', true)
							),
			 'key' => array('rule' 		=> 'notEmpty',
										'required' 	=> true,
										'message' 	=> __('Please enter key.', true)
										),
			'value' => array('rule' 		=> 'notEmpty',
							'required' 	=> true,
							'message' 	=> __('Please enter value.', true)
							)	
		  ); 
		$this->validate=$validate1;
		return $this->validates(); */
		return 1;
	} 
	
	function ImageUploadValidate() {
		//pr($dataArray);
		$validate1 = array( 
			'value' => array(
					'rule' => array('checkExtension'),
					'message' => 'Select a valid file'
					)
				); 
		$this->validate=$validate1;
		return $this->validates();
	}  
	
	function checkExtension(){
		$type	=	array('jpeg','jpg','png','gif');
		if($this->data['Setting']['value']['name']!=''){
			$filename	=	$this->data['Setting']['value']['name'];
			$ext 		=	strtolower(substr($filename,strpos($filename,".") + 1));
			if(!in_array($ext,$type)){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
		
	}
	
/**
 * afterSave callback
 *
 * @return void
 */

 
 
	public function afterSave($created) {
		$this->updateSetting();
		
	}

/**
 * afterDelete callback
 *
 * @return void
 */
	public function afterDelete() {
		$this->updateSetting();
		
	}





/**
 * Find list and save  in app/config/settings.php file.
 * Data required in bootstrap.
 *
 * @return void
 */
	public function updateSetting() {
		$list = $this->find('list', array(
			'fields' => array(
				'key',
				'value',
			),
			'order' => array(
				'Setting.key' => 'ASC',
			),
		));
		
		$file = new File(SETTING_FILE_PATH, true);
		
		$settingfile = '<?php ' . "\n";
		foreach($list as $key=>$value){
			$settingfile .= 'Configure::write("'.$key.'", "'.$value.'");' . "\n";
		}
		$file->write($settingfile);
	}
}
