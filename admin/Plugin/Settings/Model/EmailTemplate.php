<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cms Plugin CmsPage Model
 *
 * @package Cms
 * @subpackage CmaPage.models
 */
class EmailTemplate extends SettingsAppModel {

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
	public $useTable='email_templates';
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
	 public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		//validation for cms updation
		}
		function AddTemplateValidate() {
		$validate1 = array( 'name' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter name.', true)
												),
								 'subject' => array('rule' 		=> 'notEmpty',
															'required' 	=> true,
											                'message' 	=> __('Please enter subject.', true)
															),
								'action' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select email action.', true)
												),
								/* 'constants' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select email constants.', true)
												), */
						       
								 'body' => array('rule' 		=> 'notEmpty',
											    'required' 	=> true,
											    'message' 	=> __('Please enter email body.', true)
												)
													
		                      ); 
		$this->validate=$validate1;
		return $this->validates();
	} 
	
	function EditTemplateValidate() {
		$validate1 = array( 'name' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter name.', true)
												),
								 'subject' => array('rule' 		=> 'notEmpty',
															'required' 	=> true,
											                'message' 	=> __('Please enter subject.', true)
															),
								
								/* 'constants' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select email constants.', true)
												), */
						       
								 'body' => array('rule' 		=> 'notEmpty',
											    'required' 	=> true,
											    'message' 	=> __('Please enter email body.', true)
												)
													
		                      ); 
		$this->validate=$validate1;
		return $this->validates();
	} 
}