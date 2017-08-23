<?php
  $AdminData = array('username'=>'Admin');
  $pc	=	$this->params['plugin'].'/'.$this->params['controller'];	
  $dashboardclass		=	'';
  $userclass			=	'';
  $catclass				=	'';

  if(in_array($pc,array('/pages'))){
	$dashboardclass	=	'active';
  }else if(in_array($pc,array('usermgmt/customers','usermgmt/promoters','usermgmt/partners'))){
	$userclass	=	'active';
  }else {
	$catclass	=	'active';
  }
?>
<div class="container-fluid">
		<?php //echo $this->Html->link($this->Html->image('logo2.png'),array('plugin'=>false,'controller'=>'pages','action'=>'display'),array('id'=>'brand','escape'=>false)); ?>
        <?php echo $this->Html->link(Configure::read('Site.title'),array('plugin'=>false,'controller'=>'pages','action'=>'display'),array('id'=>'brand','escape'=>false,'style'=>'margin-top: 11px;color: #C0C0C0;margin-left: 20px;')); ?>
			
			<ul class='main-nav'>
				<?php echo $this->element('header_menu'); ?>
			
			</ul>
			<div class="user">
				<ul class="icon-nav">
					
					
				</ul>
				<div class="dropdown">
					<a href="javascript:void(0);" class='dropdown-toggle' data-toggle="dropdown"><?php echo __('Welcome'); ?> <?php echo authComponent::user('username');//$AdminData['username'];?>
                  
                  
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
						<?php echo $this->Html->link(__('Account settings'),array('plugin'=>false,'controller'=>'users','action'=>'myaccount'),array('escape'=>false)); ?>
							
						</li>
						
						<?php 
							if($this->Session->check('access_mode')){
							$mode = $this->Session->read('access_mode');
							$allow_mode = $this->Session->read('allow_access_mode');
							$user_role_id = authComponent::user('user_role_id');
							if($user_role_id != 1 && $allow_mode == 1){
							if($mode==2){ ?>
							<li><?php echo $this->Html->link(__('Switch to Administrator Mode'),array('plugin'=>false,'controller'=>'users','action'=>'change_access_mode'),array('escape'=>false)); ?></li>
							<?php }elseif($mode==1){ ?>
							<li><?php echo $this->Html->link(__('Switch to Promoter Mode'),array('plugin'=>false,'controller'=>'users','action'=>'change_access_mode'),array('escape'=>false)); ?></li>
							<?php } } } ?>
							
						
						<li>
							<?php echo $this->Html->link(__('Sign Out'),array('plugin'=>false,'controller'=>'users','action'=>'logout'),array('escape'=>false)); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>