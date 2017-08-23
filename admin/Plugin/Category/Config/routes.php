<?php
/**
 * This file is part of Cms.
 * Routes configuration
 *
 * Author:  Bharat Singh <007bharatsingh@gmail.com>
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * Copyright 2012, PromoSoft. (http://www.promosoft.in)
 *
 * @copyright Copyright 2010, PromoSoft. (http://www.promosoft.in)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * PHP version 5
 * CakePHP version 1.3
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, PromoSoft. (http://www.promosoft.in)
 * @link          http://www.promosoft.in
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	
/**
 * Here, we are connecting 'admin/cms-pages/*' (base path) to plugin frontusers and controller called 'cms_pages' for Routing.prefixes admin,
 * its action called 'admin_index', and we pass a param to select the view file
 * to use (in this case, /app/plugins/frontusers/views/cms_pages/admin_index.ctp)...
 */		 
	
	Router::connect('/timemgmt/add/*', array('plugin'=>'timemgmt','controller' => 'timemgmts', 'action' => 'add'));
	Router::connect('/timemgmt/edit/*', array('plugin'=>'timemgmt','controller' => 'timemgmts', 'action' => 'edit'));
	Router::connect('/timemgmt/delete/*', array('plugin'=>'timemgmt','controller' => 'timemgmts', 'action' => 'delete'));
	Router::connect('/timemgmt/change-status/*', array('plugin'=>'timemgmt','controller' => 'timemgmts', 'action' => 'ChangeStatus'));
	Router::connect('/timemgmt/*', array('plugin'=>'timemgmt','controller' => 'timemgmts', 'action' => 'index'));
?>