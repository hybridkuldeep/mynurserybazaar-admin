<?php 
	  echo $this->Html->script(array('ckeditor/ckeditor','ckeditor/adapters/jquery.js','jquery.validationEngine-en','jquery.validationEngine'));  
	  echo $this->Html->css(array('validationEngine.jquery'));  
	  echo $this->Form->create('Email', array('url' => array('plugin' => 'email','controller' => 'email_templates', 'action' => 'add'))); 
	  echo $this->Form->hidden('Email.id');
?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#EmailAddForm").validationEngine();
	});
</script>

<table class="table table-bordered table-striped">
 <thead>
   <tr>
     <th style="background-color: #EEEEEE;">
		<div class="row-fluid">
				<!--heading-->
               <h1><?php echo __('Add Email Template'); ?>
					<div class="pull-right">
                     <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__("Back To Email Templates"), array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
					</div>
			  </h1>
        </div>
	</th>
  </tr>
  <tr>
    <td>
      <div class="row" style="padding:7px 33px;">
		<div class="clearfx ">
			<?php 
				echo $this->Form->label($model.'.name',__('Name').':*', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="input" style="margin-left:150px;">
				<?php echo $this->Form->text($model.".name",array('class'=>'validate[required]'));  ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		<div class="clearfx ">
			<?php 
				echo $this->Form->label($model.'.subject',__('Subject').':*', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="input" style="margin-left:150px;">
				<?php echo $this->Form->text($model.".subject",array('class'=>'validate[required]'));  ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.subject', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		<div  class="clearfx <?php //echo ($form->error($model.'.action'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.action', 'Action :*', array('style' => "float:left;width:130px;") ); 
			 ?>
			<div class="input" style="margin-left:150px;">
				<?php 
				$Action_options	=	Configure::read('Action_options');
				echo $this->Form->select($model.".action", $Action_options, array('empty' => '-- Select One --','onchange'=>'constant()', 'class'=>'validate[required]')); 
				?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.action', array('wrap' => false) ); ?>
				</span>
			</div>
		</div> 
		
		<div  class="clearfx <?php //echo ($form->error($model.'.constants'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.constants', 'Constants :', array('style' => "float:left;width:130px;") ); 
			 ?>
			<div class="input" style="margin-left:150px;">
		
				<?php //register_verify
				
				if(isset($data['EmailTemplate']['action'])) {
				//echo $data['EmailTemplate']['action']; die;
					if($data['EmailTemplate']['action'] == 'Registration') {
						 $Email_constant	= 	Configure::read('registration');
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => '-- Select One --'));
					} else if($data['EmailTemplate']['action'] == 'Forgot Password') {
						 $Email_constant	= 	Configure::read('forgot_password');
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => '-- Select One --'));
					}else if($data['EmailTemplate']['action'] == 'VerificationMail') {
						 $Email_constant	= 	Configure::read('register_verify');
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => '-- Select One --'));
					}else {
					$Email_subscription	=	Configure::read('Email_subscription');
					echo $this->Form->select($model.".constants",$Email_subscription, array('empty' => '-- Select One --'));
				   }
				} else {
					$Email_subscription	=	Configure::read('Email_subscription');
					echo $this->Form->select($model.".constants",$Email_subscription, array('empty' => '-- Select One --'));
				}
				?>
				<span style = "padding-left:20px;padding-top:0px; valign:top">
				<?php
				echo $this->Html->link('<i class="icon-white "></i>'.__('Insert Variable'), 'javascript:void(0)',array('class'=>'btn  btn-success','escape' => false,'onclick' => 'return InsertHTML()',"escape" => false));
				?></span>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.constants', array('wrap' => false) ); ?>
				</span>
			</div>
		</div> 
		<div class="clearfx " style="padding-bottom:10px;">
		<?php 
			echo $this->Form->label($model.'.body', __('Email Body').':*', array('style' => "float:left;width:130px;") ); 
		?>
			<div class="input" style="margin-left:150px;">
				<?php echo $this->Form->textArea($model.".body"); //echo $this->Fck->load($model.'.body'); ?>
				
				<script type="text/javascript">
				// <![CDATA[
					CKEDITOR.replace( 'EmailTemplateBody' );
					//]]>
				</script>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.body', array('wrap' => false,'class'=>'') ); ?>
				</span>
			</div>
		</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<input class="btn btn-primary" type="submit" value="<?php echo __('Add'); ?>">
			<?php 
				echo $this->Html->link(__("Cancel"),array("action" => "index"), array("class" => "btn", "escape" => false) ); 
			?>
		</div>
	</div>
   
   </div>
		<?php echo $this->Form->end(); ?>
	<!--add form end-->
	<div id="image_div" class="modal hide fade" style="width:500px;height:auto;overflow:auto;"></div>
  </td>
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
