<table class="table table-bordered table-striped">
 		 <thead>
			<tr><?php echo $this->Session->Flash(); ?></tr>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __('My Account'); ?>
                <div class="pull-right">
                <?php
							 /* echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Dashboard",array("action"=> "dashboard"),array("class"=>"btn btn-primary","escape"=>false)); */
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-validate form-horizontal"));
  echo $this->Form->hidden('id');

?>
      <div class="row-fluid">
<div class="span12" >
	<div class="row" style="padding:7px 33px;float:left;width:50%;">
			<div class="form-group <?php echo ($this->Form->error('full_name'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.full_name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".full_name",array('class'=>'form-control validate[required]'));  ?>
			</div>
				<div class="form-group <?php echo ($this->Form->error('email'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Email</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.email', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".email",array('class'=>'form-control  validate[required,custom[email]]]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('old_password'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Old Password</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.old_password', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->password($model.".old_password",array('class'=>'form-control  validate[required]',"value"=>""));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('password'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Password</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.password', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->password($model.".password",array('class'=>'form-control  validate[required]',"value"=>""));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('cpassword'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Confirm Password</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.cpassword', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->password($model.".cpassword",array('class'=>'form-control validate[required,equals[UsermgmtPassword]]')); ?>
								</div>			
	
	  
      
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save"),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i>".__('Reset'),array("action"=> "myaccount"),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
          
</div>


</div>
<?php echo $this->Form->end();?>

</div>
          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 