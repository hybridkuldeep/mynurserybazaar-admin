<?php
class MenuHelper extends AppHelper{
	
	var $helpers = array('Html');
	function get_menus($MainMenus,$class=0){
		unset($MainMenus[1]);
		unset($MainMenus[2]);
		unset($MainMenus[4]);
		foreach($MainMenus as $menudetails){
			$newclass	=	"";
			$new_ul_class	=	"";
			if($class==0){
				$newclass	=	"";
				$new_ul_class	=	'';
			}else if($class==1){
				$newclass	=	"has_menu";
				$new_ul_class	=	'dropdown-menu';
			} else if($class>=2){
				$newclass	=	"dropdown";
				$new_ul_class	=	'dropdown-menu';
			}
			$caret = ' ';
			$options	=	array('escape'=>false);
			if(isset($menudetails['sub_menu'])){
				$newclass	=	"has_menu";
				$caret 		= 	'<i class="icon-angle-down"></i>';
				if($class>=1){
					$newclass	=	"dropdown";
					$caret 	= 	'<i class="icon-angle-down"></i>';
				}
				$options	=	array('escape'=>false,'class'=>' SideMenu_toggle','data-toggle'=>"dropdown",'id'=>str_replace(' ','_',$menudetails['Menu']['menuName'])."_".$menudetails['Menu']['id']);
			}else{ 
				$newclass	=	"";
				$options	=	array('escape'=>false,'id'=>str_replace(' ','_',$menudetails['Menu']['menuName'])."_".$menudetails['Menu']['id']);
			}
			$menu_html		=	"";
			?>
			<li class="<?php echo $newclass;?>">
			<?php
			if($this->params['controller']==$menudetails['Menu']['name']){
				$options["class"]	=	"active";
			}
			//pr($options);
			if(strtolower($menudetails['Menu']['menuName'])=="home"){
				echo $this->Html->link(__("<span class='".$menudetails['Menu']['menuName']."'>".$menudetails['Menu']['menuName']."</span>").$caret,"/",$options);
			}elseif(isset($menudetails['sub_menu'])){
				echo $this->Html->link(__("<span class='".$menudetails['Menu']['menuName']."'>".$menudetails['Menu']['menuName']."</span>").$caret,'javascript:void(0);',$options);
			}else{
				echo $this->Html->link(__("<span class='".$menudetails['Menu']['menuName']."'>".$menudetails['Menu']['menuName']."</span>").$caret,array('plugin'=>$menudetails['Menu']['plugin'],'controller'=>$menudetails['Menu']['name'],'action'=>$menudetails['Menu']['action']),$options);
			}
			if(isset($menudetails['sub_menu'])){
			$cl = $class;
				?><ul class="<?php echo $new_ul_class; ?>"><?php $this->get_menus($menudetails['sub_menu'],++$cl); ?></ul><?php 
			}
			?></li>
			<?php
		}
	}
	/*-----------Header Menu Function Start Here dropdown-menu---------*/
	
	function get_header_menus($MainMenus,$class=0){
		
		
		$newMainMenus	=	$MainMenus;
		$MainMenus	=	array();
		if(isset($newMainMenus[1]))
		$MainMenus[1]	=	$newMainMenus[1];
		if(isset($newMainMenus[2]))
		$MainMenus[2]	=	$newMainMenus[2];
		if(isset($newMainMenus[4]))
		$MainMenus[4]	=	$newMainMenus[4];
		
		foreach($MainMenus as $menudetails){
			$newclass	=	"";
			if($class==0){
				$newclass	=	"";
			}else if($class==1){
				$newclass	=	"dropdown";
			} else if($class>=2){
				$newclass	=	"dropdown-submenu";
			}
			$caret = '';
			$options	=	array('escape'=>false);
			if(isset($menudetails['sub_menu'])){
				$newclass	=	"dropdown";
				$caret 		= 	'<b class="caret"></b>';
				if($class>=1){
					$newclass	=	"dropdown-submenu";
					$caret 	= 	'';
				}
				$options	=	array('escape'=>false,'class'=>'dropdown-toggle','data-toggle'=>'dropdown','id'=>str_replace(' ','_',$menudetails['Menu']['menuName'])."_".$menudetails['Menu']['id']);
			}else{ 
				$newclass	=	"";
				$options	=	array('escape'=>false,'id'=>str_replace(' ','_',$menudetails['Menu']['menuName'])."_".$menudetails['Menu']['id']);
			}
			$menu_html		=	"";
			?>
			<li class="<?php echo $newclass;?>">
			<?php
			if(strtolower($menudetails['Menu']['menuName'])=="home"){
				echo $this->Html->link(__($menudetails['Menu']['menuName']).$caret,"/",$options);
			}else{
				echo $this->Html->link('<span>'.__($menudetails['Menu']['menuName']).'</span>'.$caret,array('plugin'=>$menudetails['Menu']['plugin'],'controller'=>$menudetails['Menu']['name'],'action'=>$menudetails['Menu']['action']),$options);
			}
			if(isset($menudetails['sub_menu'])){
			$cl = $class;
				?><ul class="dropdown-menu"><?php $this->get_menus($menudetails['sub_menu'],++$cl); ?></ul><?php 
			}
			?></li>
			<?php
		}
	}	
	
	

}
?>