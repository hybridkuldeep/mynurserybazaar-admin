<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Add Setting
                <div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Settings",array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));

?>

      <div class="row-fluid">
<div class="span12" >
			
		
		
		<div class="control-group <?php echo ($this->Form->error('title'))? 'error':'';?>">
		 <?php echo $this->Form->label($model.".title", "Title: *",array("class"=>"control-label")); ?>
				<div class="controls">
					<?php echo $this->Form->text($model.".title"); ?><span class="help-inline" id="ContentTypeNameSpan"><?php echo $this->Form->error('title',array('wrap'=>false)); ?></span>
				</div>
			</div>
		<div class="control-group <?php echo ($this->Form->error('key'))? 'error':'';?>">
			 <?php echo $this->Form->label($model.".key", "Key: *",array("class"=>"control-label")); ?>
				<div class="controls">
					<?php echo $this->Form->text($model.".key"); ?><span class="help-inline" id="ContentTypeNameSpan"><?php echo $this->Form->error('key',array('wrap'=>false)); ?></span><br /><small>e.g., 'Site.title'</small>
				</div>
			</div>
		<div class="control-group <?php echo ($this->Form->error('value'))? 'error':'';?>">
			 <?php echo $this->Form->label($model.".value", "Value: *",array("class"=>"control-label")); ?>
				<div class="controls">
					<?php echo $this->Form->textarea($model.'.value'); ?><span class="help-inline" id="ContentTypeNameSpan"><?php echo $this->Form->error('value',array('wrap'=>false)); ?></span>
				</div>
			</div>
           
			
        <div class="control-group <?php echo ($this->Form->error('input_type'))? 'error':'';?>">
			<?php echo $this->Form->label('input_type', __d('users', 'Input Type', true),array('class'=>"control-label")); ?>
				<div class="controls">
					<?php echo $this->Form->text('input_type'); ?><span class="help-inline" id="ContentTypeNameSpan"><?php echo $this->Form->error('input_type',array('wrap'=>false)); ?></span><br /><small><em>e.g., 'text' or 'textarea'</em></small>
				</div>
			</div>
		 
            
          
          
         
        
               
            <div class="controls">
             <div class="input-prepend">
           <span class="add-on"> <?php echo $this->Form->input($model.".editable",array("label"=>false)); ?></span><input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __d("users", "Editable"); ?>" disabled="disabled" style="width:185px;" class="medium">
           </div>
            </div>
        
          
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> Reset",array("action"=> "add"),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
		</div>
</div>
<?php echo $this->Form->end();?>


   </td>
    </tr>
  </thead>
 
</table>

           

 
