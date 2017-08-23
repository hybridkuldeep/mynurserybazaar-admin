<?php echo $this->Session->flash(); ?>
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
		
			<h2><?php echo __('Forgot Password'); ?></h2>
			<?php 
				echo $this->Form->create($model,array('type'=>'file','class'=>'form-validate form-horizontal')); ?> 
			
				<div class="control-group">
					<div class="email controls" style='margin-left:0;'>
						<?php echo $this->Form->text('email',array('class'=>'input-block-level','placeholder'=>__('Email'),'data-rule-required'=>true,'data-rule-email'=>true)); ?>
					</div>
				</div>
				
				<div class="submit">
					<div class="remember">&nbsp;</div>
					<?php echo $this->Html->link(__('Back To Login'),array('controller'=>'/'),array('class'=>'','escape'=>false)); ?>
					<input type="submit" value="<?php echo __('Submit'); ?>" class='btn btn-primary'>
				</div>
			<?php echo $this->form->end(); ?>
			<div class="forget">
				&nbsp;
			</div>
		</div>