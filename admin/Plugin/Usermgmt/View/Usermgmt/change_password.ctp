<?php 
	echo $this->Html->css(array('validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#UsermgmtChangePasswordForm").validationEngine();
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
  <tr><?php echo $this->Session->Flash(); ?></tr>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Change Password'); ?>
            <div class="pull-right">
               <?php 
					//	echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __('Back',true)."", $this->request->referer(), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt','controller' => 'usermgmt', 'action' => 'change_password'),'enctype' => 'multipart/form-data')); 
				echo $this->Form->hidden('id');
		  ?>
         <div class="row" style="padding:7px 33px;float:left;width:50%;">
			
								<div class="form-group <?php echo ($this->Form->error('password'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Password</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.password', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->password($model.".password",array('class'=>'form-control  validate[required, minSize[6]]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('confirm_password'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Confirm Password</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.confirm_password', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->password($model.".confirm_password",array('class'=>'form-control validate[required,equals[UsermgmtPassword]]')); ?>
								</div><div class="form-actions">
							<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?> <?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "customer"), array("class" => "btn", "escape" => false) ); 
			?>
		</div>
	</div>	
	</div>	
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>