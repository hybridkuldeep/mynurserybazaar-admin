<?php
class MenuHelper extends AppHelper{
	
	var $helpers = array('Html');
	function get_menus($MainMenus,$class=0){
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
				$options	=	array('id'=>str_replace(' ','_',$menudetails['Menu']['menuName'])."_".$menudetails['Menu']['id']);
			}
			$menu_html		=	"";
			?>
			<li class="<?php echo $newclass;?>">
			<?php
			if(strtolower($menudetails['Menu']['menuName'])=="home"){
				echo $this->Html->link(__($menudetails['Menu']['menuName']).$caret,"/",$options);
			}else{
				echo $this->Html->link(__($menudetails['Menu']['menuName']).$caret,array('plugin'=>$menudetails['Menu']['plugin'],'controller'=>$menudetails['Menu']['name'],'action'=>$menudetails['Menu']['action']),$options);
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