<?php 
$AdminData 		= 	authComponent::user();
if(isset($AdminData) && !empty($AdminData)){
	if($this->Session->check('Config.admin_menus')){
		$MainMenus	=	$this->Session->read('Config.admin_menus');
	}else{
		if($AdminData['id']==1 || $this->Session->read('access_mode')==1){
			$MainMenus	=	$this->requestAction(array('plugin'=>'menus','controller' => 'menus', 'action' => 'show_all'));
		}else{
			$MainMenus	=	$this->requestAction(array('plugin'=>'menus','controller' => 'menus', 'action' => 'user_privilege',$AdminData['id']));
		}
	}
// pr($this->Session->read('Config.admin_menus'));die;
$this->Menu->get_header_menus($MainMenus);
}

	?> 