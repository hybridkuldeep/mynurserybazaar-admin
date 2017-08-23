<h1>
	<?php echo $this->Html->link($this->Html->image('logo1.png',array('class'=>'retina-ready')),array('controller'=>'/'),array('escape'=>false)); ?>
</h1>
	
<p> <?php 
			if(isset($_SESSION['failed'])){
				?>
				
				<div class="row-fluid margin-top alert-message">
					<div class="span12">
						<div class="alert alert-info">
						<a class="close" href="javascript:void(0)">×</a>
							<?php echo $_SESSION['failed'];?>
						</div>
					</div>
				</div>
				<?php
				unset($_SESSION['failed']);
			}	
 echo $this->Session->flash(); ?>
		
</p>

		<div class="login-body">
		
			<h2><?php echo __('Reset Password'); ?></h2>
			<?php  echo $this->Form->create($model,array('url'=>array('plugin'=>false,'action'=>'resetpassword',$validate_string),'class'=>'form-validate form-horizontal')); ?>
			
				<div class="control-group">
					<div class="pw controls" style='margin-left:0;'>
						<?php echo $this->Form->password('password',array('class'=>'input-block-level','placeholder'=>__('Password'),'data-rule-required'=>true)); ?>
						<span style='color:#FF0000; font-size:11px'>
					<?php if(isset($errors['password'][0]) && (!empty($errors['password'][0]))){
							echo $errors['password'][0];
						}
					?>
				</span>
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls" style='margin-left:0;'>
						<?php echo $this->Form->password('temppassword',array('class'=>'input-block-level','placeholder'=>__('Confirm Password'),'data-rule-required'=>true)); ?>
						 <span style='color:#FF0000; font-size:11px'>
					<?php if(isset($errors['temppassword'][1]) && (!empty($errors['temppassword'][1]))){
							echo $errors['temppassword'][1];
						}
					?>
				</span>
					</div>
				</div>
				
				<div class="submit">
					<div class="remember">&nbsp;</div>
					<input type="submit" value="<?php echo __('Submit'); ?>" class='btn btn-primary'>
				</div>
			<?php echo $this->form->end(); ?>
			<div class="forget">
				&nbsp;
			</div>
		</div>