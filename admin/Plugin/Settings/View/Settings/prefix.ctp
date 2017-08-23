<?php //pr($errors);?>
<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Setting").":".$prefix;?> </h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array(
			'url' => array(
				'controller' => 'settings',
				'action'	 => 'prefix',
				$prefix,
			),
		"class"=>"form-horizontal",'type' =>'file'));

?>
<div class="row" style="padding:7px 33px;float:left;width:50%;">

<div class="span12" >
			
		<?php
		$i = 0;
		//pr($settings);die;
	//	$text_extention = '';
		foreach ($settings AS $setting) {
			$text_extention = '';
			$key = $setting['Setting']['key'];
			$keyE = explode('.', $key);
			$keyTitle = Inflector::humanize($keyE['1']);
		
			$label = $keyTitle;
			if ($setting['Setting']['title'] != null) {
				$label = $setting['Setting']['title'];
			}

			$inputType = 'text';
			if ($setting['Setting']['input_type'] != null) {
				$inputType = $setting['Setting']['input_type'];
			}
			
			if($keyE[0] == 'Video' && $inputType == 'text'){
			 $text_extention = 'Seconds.';
			}else if($keyE[0] == 'Bid' && $inputType == 'text'){
					if($key == 'Bid.initial_amount_of_bidding'){
						$text_extention = '$';
					}else{
						$text_extention = 'Minutes';
					}
					
				}
				
			echo $this->Form->input("Setting.$i.id", array('value' => $setting['Setting']['id'])); 
			echo $this->Form->input("Setting.$i.key", array('type' => 'hidden', 'value' => $key));
			
			
			switch($inputType){
				
			 case 'checkbox':
			 ?>
			<div class="controls">
				<div class="input-prepend">
				   <span class="add-on"> 
					<?php 
						$checked = ($setting['Setting']['value']==1)? 'checked':'';
						echo $this->Form->checkbox("Setting.$i.value",array("label"=>false,'checked' => $checked)); ?>
				   </span>
				   <input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __d("users", $label); ?>" disabled="disabled" style="width:185px;" class="medium">
				</div>
				<div style="padding-top:15px"></div>
			</div>
			 <?php
			 break;	
			 case 'radio':
			 ?>
			<div class="control-group <?php echo ($this->Form->error("Setting.$i.value"))? 'error':'';?>">
				<?php echo $this->Form->label("Setting.$i.value", __d('users', $label, true),array('class'=>"control-label")); ?>
			<div class="controls">
				<div class="input-prepend">
				   <span class="add-on"> 
			<?php  
				 $options = json_decode($setting['Setting']['description']);
					$attributes = array('legend' => false,'label'=>false,  'value' => $setting['Setting']['value'],'class'=>'radio-inline pr10','separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;');
					echo $this->Form->radio("Setting.$i.value", $options, $attributes); ?>	<span class="help-inline"><?php echo $this->Form->error($model.".addersstype",array("wrap"=>false)); ?>
				   </span>
				  
				</div>
				<div style="padding-top:15px"></div>
			</div>
			</div>
			 <?php
			 break;
			 case 'select':
			 ?>
			<div class="control-group <?php echo ($this->Form->error("Setting.$i.value"))? 'error':'';?>">
				<?php echo $this->Form->label("Setting.$i.value", __d('users', $label, true),array('class'=>"control-label")); ?>
			<div class="controls">
				
				   <span class="add-on"> 
			<?php  
				 $options = json_decode($setting['Setting']['description'],true);
				//	 pr($options);
					$attributes = array('legend' => false,'label'=>false,  'value' => $setting['Setting']['value'],'class'=>'radio-inline pr10','separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;');
					echo $this->Form->select("Setting.$i.value", $options,array("empty"=>$setting['Setting']['value'])); ?>	<span class="help-inline"><?php echo $this->Form->error($model.".addersstype",array("wrap"=>false)); ?>
				   </span>
				  
				
			</div>
			</div>
			 <?php
			 break;	
			 case 'image':
			  ?>
			 	<div class="form-group <?php echo ($this->Form->error('Setting.$i.value'))? 'has-error':'';?>">
									<label for="exampleInputEmail1"><?php echo $label; ?></label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?></label>
									<?php 
									echo $this->Form->file("Setting.$i.image",array('class'=>'  validate[required]')); 
									echo $this->Form->text("Setting.$i.value",array('type'=>'hidden','value'=>$setting['Setting']['value'],"class"=>"form-control"));
									
									?>
									<?php echo $images = $this->Html->image("../uploads/setting/".$setting['Setting']['value'],array("class"=>"img-circle" ,"style"=>"width:100px;height:100px;"));?>
                                    
													
				</div>
			 <?php
			 
			 break;
			 case 'textarea':	
			 case 'text':
			 default:
			 if($setting['Setting']['id'] == 19){
				echo "<h1>Verify Calendar</h1>";
			 }else if($setting['Setting']['id'] == 20){
				echo "<h1>Featured Calendar</h1>";
			 }else if($setting['Setting']['id'] == 23){
				echo "<h1>Local/Recommended Calendar </h1>";
			 }else if($setting['Setting']['id'] == 26){
				echo "<h1>Category Calendar</h1>";
			 }
			 ?>
			 	<div class="form-group <?php echo ($this->Form->error('Setting.$i.value'))? 'has-error':'';?>">
									<label for="exampleInputEmail1"><?php echo $label; ?></label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?></label>
									<?php 
									echo $this->Form->{$inputType}("Setting.$i.value",array('value'=>$setting['Setting']['value'],"class"=>"form-control"))." ".$text_extention; 
									?>
													
				</div>
			 <?php
			
			 break;		 
			}
			$i++;
		}
	?>
		  
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> Reset",array("action"=> "prefix",$prefix),array("class"=>"btn primary","escape"=>false));
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
