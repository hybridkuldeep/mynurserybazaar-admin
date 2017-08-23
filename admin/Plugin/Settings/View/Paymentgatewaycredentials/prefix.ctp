<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Setting:<?php echo $prefix;?>
                </h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array(
			'url' => array(
				'controller' => 'settings',
				'action' => 'prefix',
				$prefix,
			),
		"class"=>"form-horizontal"));

?>

      <div class="row-fluid">
<div class="span12" >
			
		<?php
		$i = 0;
		
		foreach ($settings AS $setting) {
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
			 case 'textarea':	
			 case 'text':
			 default:
			 ?>
			<div class="control-group <?php echo ($this->Form->error("Setting.$i.value"))? 'error':'';?>">
				<?php echo $this->Form->label("Setting.$i.value", __d('users', $label, true),array('class'=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->{$inputType}("Setting.$i.value",array('value'=>$setting['Setting']['value'])); ?>
				</div>
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
