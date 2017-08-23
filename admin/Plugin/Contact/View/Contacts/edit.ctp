<?php
//pr($this->data);
	echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js','jquery.validationEngine-en','jquery.validationEngine')); 
	echo $this->Html->css(array('validationEngine.jquery'));  
	echo $this->Form->create('Contact', array('url' => array('plugin' => 'contact', 'controller' => 'contacts', 'action' => 'edit', $id))); 
	echo $this->Form->hidden('Contact.id', array('value' => $id));
?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#ContactEditForm").validationEngine();
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('View Contact'); ?>
            <div class="pull-right">
               <?php 
						//link to back  Cms Page
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__("Back To Contact "), array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create('Contact', array('url' => array('plugin' => 'contact', 'controller' => 'contacts', 'action' => 'edit', $id))); 
				echo $this->Form->hidden('id');
		  ?>
	   <div class="row" style="padding:7px 33px;float:left;width:50%;">
										
								<div class="form-group <?php echo ($this->Form->error('name'))? 'has-error':'';?>">
									<label for="exampleInputContact1">Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".name",array("readonly",'class'=>'form-control validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('subject'))? 'has-error':'';?>">
									<label for="exampleInputContact1">Email</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.subject', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".email",array("readonly",'class'=>'form-control validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('body'))? 'has-error':'';?>">
									<label for="exampleInputContact1">Message</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.body', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->textArea($model.".message",array("readonly","rows"=>10,"cols"=>72));  ?>
										<script type="text/javascript">
										// <![CDATA[
											//CKEDITOR.replace( 'ContactMessage' );
										//]]>	
										</script>
								</div>
						
				<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
		 <?php 
				echo $this->Html->link( __("Back to Contact",true),array("action" => "index"), array("class" => "btn", "escape" => false) ); 
			?>
		</div>
	</div>	
		
      </div>
  
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>
<script type='text/javascript'>
// <![CDATA[
    function InsertHTML() {
		var strUser = document.getElementById("ContactConstants").value;
		var oEditor = CKEDITOR.instances["ContactBody"] ;
        oEditor.insertHtml('{'+strUser+'}') ;	
    }
function constant() {
		var constant = document.getElementById("ContactAction").value;
		 CKEDITOR.instances["ContactBody"].setData('') ;
			$.ajax({
				url: "<?php echo $this->Html->url(array('plugin' => 'contact',"controller" => "contacts","action" => "constants")); ?>",
				type: "POST",
				data: { constant: constant},
				dataType: 'json',
				success: function(r){
					$('#ContactConstants').empty();
					$('#ContactConstants').append( new Option('-- Select One --','') );
					$.each(r, function(val, text) {
						$('#ContactConstants').append( new Option(text,text) );
					});	
				}
			});
			
	return false; 
		
	 }
	//]]> 
</script>
