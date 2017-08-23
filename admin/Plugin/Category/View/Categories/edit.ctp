 <?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5','validationEngine.jquery'));
	echo $this->Html->script(array('plugins/ckeditor/ckeditor','jquery.fancybox.js?v=2.1.5','jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	<!--
		jQuery(document).ready(function() {
		jQuery("#CountryEditForm").validationEngine();
		});
	-->
</script>
<?php 
	  echo $this->Form->create($model, array('url' => array('plugin' => 'category','controller' => 'categories', 'action' => 'edit',$id,$parent_id),'enctype' => 'multipart/form-data')); 
	  echo $this->Form->hidden('id');
	  
?>

<table class="table table-bordered table-striped">
 <thead>
   <tr>
     <th style="background-color: #EEEEEE;">
		<div class="row-fluid">
				<!--heading-->
               <h1><?php echo __('Edit Category',true); ?>
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
	    <div class="row" style="padding:7px 33px;float:left;width:100%;">
										
													
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
								<?php 
					$file_path    = CATEGORY_UPLOAD_IMAGE_PATH ;
					$file_name    = $this->request->data[$model]['image'];
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
						$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
				
					if(is_file($file_path . $file_name)) {
						echo $images = $this->Html->image($image_url);
					?>
					
					<?php					
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					} 
				?>
								
					
								
		
	<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->submit( __('Save',true),array('class'=>'btn btn-primary btn-size','div'=>false));?>
			<?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "index"), array("class" => "btn btn-info", "escape" => false) ); 
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