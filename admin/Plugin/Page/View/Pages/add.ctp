<?php 
	echo $this->Html->css(array('validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#PageAddForm").validationEngine();
	});
</script>
<?php 
echo $this->Form->create($model, array('url' => array('plugin' => 'page','controller' => 'pages', 'action' => 'add')));
?>

<table class="table table-bordered table-striped">
 <thead>
   <tr>
     <th style="background-color: #EEEEEE;">
		<div class="row-fluid">
				<!--heading-->
               <h1><?php echo __('Add Pages'); ?>
					<div class="pull-right">
                     <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __('Back To Pages',true)."", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
					</div>
			  </h1>
        </div>
	</th>
  </tr>
  <tr>
    <td>
      <div class="row" style="padding:7px 33px;float:left;width:50%;">
										
								<div class="form-group <?php echo ($this->Form->error('name'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".name",array('class'=>'form-control  validate[required]'));  ?>
								</div>
										
								<div class="form-group <?php echo ($this->Form->error('status'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">Status</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.status', array('wrap' => false) ); ?></label>
                                           <?php echo $this->Form->select($model.'.status',array('1'=>'Active','0'=>'Inactive'), array('class'=>"form-control",'empty' => false)); ?>
								</div>
								
								
								
		
	<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->submit( __('Add',true),array('class'=>'btn btn-primary btn-size','div'=>false));?>
			<?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "index"), array("class" => "btn btn-info disabled", "escape" => false) ); 
			?>
		</div>
	</div>
   
   </div>
		<?php echo $this->Form->end(); ?>
	<!--add form end-->
  </td>
 </tr>
</thead>
</table>