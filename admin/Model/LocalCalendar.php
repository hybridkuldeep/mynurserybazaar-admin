<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Users Plugin User Model
 *
 * @package User
 * @subpackage User.Model
 */
class LocalCalendar extends AppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'LocalCalendar';

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'username';
	public $virtualFields = array(
    'name' => 'select title from calendars where id =  LocalCalendar.calendar_id'
);
}
