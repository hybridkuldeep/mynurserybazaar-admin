<?php
//pr($this->data);
	echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js','jquery.validationEngine-en','jquery.validationEngine')); 
	echo $this->Html->css(array('validationEngine.jquery'));  
	echo $this->Form->create('Email', array('url' => array('plugin' => 'email', 'controller' => 'email_templates', 'action' => 'edit', $id))); 
	echo $this->Form->hidden('Email.id', array('value' => $id));
?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#EmailEditForm").validationEngine();
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Edit Email Templates'); ?>
            <div class="pull-right">
               <?php 
						//link to back  Cms Page
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__("Back To Email Templates"), array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create('Email', array('url' => array('plugin' => 'email', 'controller' => 'email_templates', 'action' => 'edit', $id))); 
				echo $this->Form->hidden('id');
		  ?>
	   <div class="row" style="padding:7px 33px;float:left;width:50%;">
										
								<div class="form-group <?php echo ($this->Form->error('name'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".name",array('class'=>'form-control validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('subject'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Subject</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.subject', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".subject",array('class'=>'form-control validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('body'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Body</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.body', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->textArea($model.".body");  ?>
										<script type="text/javascript">
										// <![CDATA[
											CKEDITOR.replace( 'EmailTemplateBody' );
										//]]>	
										</script>
								</div>
						
				<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?> <?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "index"), array("class" => "btn", "escape" => false) ); 
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
		var strUser = document.getElementById("EmailTemplateConstants").value;
		var oEditor = CKEDITOR.instances["EmailTemplateBody"] ;
        oEditor.insertHtml('{'+strUser+'}') ;	
    }
function constant() {
		var constant = document.getElementById("EmailTemplateAction").value;
		 CKEDITOR.instances["EmailTemplateBody"].setData('') ;
			$.ajax({
				url: "<?php echo $this->Html->url(array('plugin' => 'email',"controller" => "email_templates","action" => "constants")); ?>",
				type: "POST",
				data: { constant: constant},
				dataType: 'json',
				success: function(r){
					$('#EmailTemplateConstants').empty();
					$('#EmailTemplateConstants').append( new Option('-- Select One --','') );
					$.each(r, function(val, text) {
						$('#EmailTemplateConstants').append( new Option(text,text) );
					});	
				}
			});
			
	return false; 
		
	 }
	//]]> 
</script>
