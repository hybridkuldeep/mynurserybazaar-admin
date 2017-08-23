<ul class="nav">
<?php 
$AdminData 		= 	$this->Session->read('Auth.admin');

if($AdminData['group_id']==1 ){
	$MainMenus	=	$this->requestAction('admin/show-all');
}else{
	$MainMenus	=	$this->requestAction('admin/user-privilege/'.$AdminData['group_id']);
}
	foreach($MainMenus as $index=>$menudetails){
			if(count($menudetails)>1){
				$i=0;
				foreach($menudetails as $submenus){
					 if($i==0){
						$i++;
						?> 
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $submenus['Menu']['menuName'];?><b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php
					}else{
						?>	<li>
							<?php 
								echo $this->Html->link($submenus['Menu']['menuName'],array('plugin'=>$submenus['Menu']['plugin'],'controller'=>$submenus['Menu']['name'],'action'=> $submenus['Menu']['action']),array('pass'=>array('name'=>'abc'),'escape'=>false));
							?> 
							</li>
							<?php
						}
				}
					?> 
					</ul>
					</li>
					<?php 
			}else{
				
				 ?> 
				<li class="">
				<?php 
					echo $this->Html->link($menudetails[0]['Menu']['menuName'],array('plugin'=>$menudetails[0]['Menu']['plugin'],'controller'=>$menudetails[0]['Menu']['name'],'action'=>$menudetails[0]['Menu']['action'],'admin'=>true),array('class'=>'','escape'=>false));
				?> 
				</li>
				<?php
			}
		}
	?> 
</ul>