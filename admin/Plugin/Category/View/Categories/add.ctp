 <?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5','validationEngine.jquery'));
	echo $this->Html->script(array('plugins/ckeditor/ckeditor','jquery.fancybox.js?v=2.1.5','jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#CategoryAddForm").validationEngine();
	});
</script>
<?php 
echo $this->Form->create($model, array('url' => array('plugin' => 'category','controller' => 'categories', 'action' => 'add',$parent_id),'enctype' => 'multipart/form-data'));
echo $this->Form->hidden('parent_id',array("value"=>$parent_id));
?>

<table class="table table-bordered table-striped">
 <thead>
   <tr>
     <th style="background-color: #EEEEEE;">
		<div class="row-fluid">
				<!--heading-->
               <h1><?php echo __('Add Categories'); ?>
					<div class="pull-right">
                     <?php 
						echo $this->Html->link("<i class='fa fa-arrow-left'></i>&nbspBack To Categories", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
					</div>
			  </h1>
        </div>
	</th>
  </tr>
  <tr>
    <td>
      <div class="row" style="padding:7px 5%;float:left;width:100%;">
										
								<div class="form-group <?php echo ($this->Form->error('name'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".name",array('class'=>'form-control  validate[required]'));  ?>
								</div>
									
								<div class="form-group <?php echo ($this->Form->error('scientific_name'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Scientific Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.scientific_name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".scientific_name",array('class'=>'form-control'));  ?>
								</div>
								
								<div class="form-group <?php echo ($this->Form->error('description'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">Description</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.description', array('wrap' => false) ); ?></label>
											 <?php echo $this->Form->textarea($model.".description",array('class'=>'form-control  validate[required]',"id"=>"editor1"));  ?>
                                           
										<script type="text/javascript">
										$(function() {
											// Replace the <textarea id="editor1"> with a CKEditor
											// instance, using default configuration.
											CKEDITOR.replace('editor1');
											//bootstrap WYSIHTML5 - text editor
											$(".textarea").wysihtml5();
										});
									</script>
								</div>
								
								<div class="form-group <?php echo ($this->Form->error('status'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">Status</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.status', array('wrap' => false) ); ?></label>
                                           <?php echo $this->Form->select($model.'.status',array('1'=>'Active','0'=>'Inactive'), array('class'=>"form-control",'empty' => false)); ?>
								</div>
								
								<div class="form-group <?php echo ($this->Form->error('has_child'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">Has child</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.has_child', array('wrap' => false) ); ?></label>
                                           <?php echo $this->Form->select($model.'.has_child',array('0'=>'Yes','1'=>'No this is last'), array('class'=>"form-control",'empty' => false)); ?>
								</div>
								
									<div class="form-group <?php echo ($this->Form->error('image'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Image</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.image', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->file($model.".image",array('class'=>' validate[checkFileType[jpg|jpeg|png|gif]]'));  ?>
								</div> 
								
								
		
	<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->submit( __('Add',true),array('class'=>'btn btn-primary btn-size','div'=>false));?>
			<?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "index"), array("class" => "btn btn-info ", "escape" => false) ); 
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