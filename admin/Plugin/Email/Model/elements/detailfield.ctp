<?php
$field = $DetailField['field'];
$label = $DetailField['label'];
$input = $DetailField['input'];
$required = ($DetailField['validate'])? '*' : '';
switch ($input){
	case 'text':
?>
<div class="control-group <?php echo ($form->error("$field") && $DetailField['validate'])? "error":"";?>">
           <?php echo $form->label('users', "$label: ".$required, array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $form->text($field,array()); ?><span class="help-inline"><?php echo $form->error($field,array("wrap"=>false)); ?></span>
            </div>
          </div>
<?php 
	break;
	case 'select':
	$options = $DetailField['options'];
	$selected = $DetailField['selected'];
	$attributes = $DetailField['attributes'];
?>
<div class="control-group <?php echo ($form->error("$field") && $DetailField['validate'])? "error":"";?>">
           <?php echo $form->label('users', "$label: ".$required, array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $form->select($field, $options , $selected , $attributes ); ?><span class="help-inline"><?php echo $form->error($field,array("wrap"=>false)); ?></span>
            </div>
          </div>
<?php 
	break;
	case 'checkbox':

	$options = $DetailField['options'];
	$fields  = explode(".",$field); 
	
?>


          
<div class="control-group <?php echo ($form->error("$field") && $DetailField['validate'])? "error":"";?>">
           <?php echo $form->label('users', "$label: ".$required, array("class"=>"control-label")); ?>
            <div class="controls">
           
           <?php 
		   $i = 0;
			foreach($options as $optionvalue => $optiontext ){
				//pr( $this->data[$model][$field]);
				echo ' <label class="checkbox inline">' . $form->{$input}($field.'.'.$optionvalue, array('value' => $optionvalue,'hiddenField'=>false,'checked'=>(isset($this->data[$model][$fields[1]][$optionvalue]) && $this->data[$model][$fields[1]][$optionvalue] == $optionvalue) ? 'checked':'') );  echo '&nbsp;'.$optiontext .'</label>'; 
				$i++;
			}
			?>
           
           <span class="help-inline"><?php echo $form->error($field,array("wrap"=>false)); ?></span>
            </div>
          </div>
<?php 
	break;

	case 'radio':
	$options = $DetailField['options'];
	$fields  = explode(".",$field); 
	
?>


          
<div class="control-group <?php echo ($form->error("$field") && $DetailField['validate'])? "error":"";?>">
           <?php echo $form->label('users', "$label: ".$required, array("class"=>"control-label")); ?>
            <div class="controls">
           
           <?php 
		   $i = 0;		//$options['legend'] = false;
		   		//		echo ' <label class="checkbox inline">' . $form->{$input}($field,$options,array('legend'=>false,'hiddenField'=>false,'label'=>false) );  echo '&nbsp;'.'</label>'; 

			foreach($options as $optionvalue => $optiontext ){
			//	pr( $this->data[$model][$field]);
				echo '<label class="radio inline">' . $form->{$input}($field,array($optionvalue => $optiontext), array('legend'=>false,'hiddenField'=>false,'label'=>false,'checked'=>(isset($this->data[$model][$field]) && $this->data[$model][$field] == $optionvalue) ? 'checked':'') );  echo '&nbsp;'.'</label>'; 
				$i++;
			}/**/
			?>
           
           <span class="help-inline"><?php echo $form->error($field,array("wrap"=>false)); ?></span>
            </div>
          </div>
<?php 
	break;	

} ?>          