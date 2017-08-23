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
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

public $components 	= 	array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');
/**
 * This controller does not use a model
 *
 * @var array
 */
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
		$this->loadModel('User');
		$this->loadModel('ProfessionalCategory');
		$y=date('Y',time());
		
		if($uid==1){
		
		
		$customer_counts=$this->User->query("SELECT MONTH(created) MONTH, COUNT(*) COUNT FROM `users` WHERE user_role_id=2 AND YEAR(created)='$y' GROUP BY MONTH(created)");
		$this->set('customer_counts',$customer_counts);
		//pr($customer_counts);		
	
		
	/*	$Customers=$this->ProfessionalCategory->query("select * from professional_categories WHERE status=1 ORDER BY id desc LIMIT 6");
		$this->set('Customers',$Customers);*/
		//pr($Customers);
		
	    $users=$this->User->query("select * from users WHERE user_role_id=2 ORDER BY id desc LIMIT 6");
		$this->set('users',$users);
				
				
				
				}
		
	
		
		/*// echo implode('/', $path);exit;
		$this->loadModel('Users');
		$allCustomers = $this->Users->find('all', array('conditions' => array('user_role_id'=>3, 'status'=>1), 'order' => array('id' => 'desc'),array('limit' => 5)));
		$this->set('allCustomers', $allCustomers);
		*/
		
		/* $this->loadModel('Assigns'); */
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
	
/* 
		$options['order'] = array('Assigns.id' => 'desc');
		
		$options['limit'] = 5;
		
		$assigns = $this->Assigns->find('all', $options); 
		$this->set('Assigns', $assigns);
		$this->set(compact('page', 'subpage', 'title_for_layout')); */
		$this->render(implode('/', $path));
		
	}
}
