<?php
//pr($this->data);
	echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js','jquery.validationEngine-en','jquery.validationEngine')); 
	echo $this->Html->css(array('validationEngine.jquery'));  
	//echo $this->Form->create('Email', array('url' => array('plugin' => 'email', 'controller' => 'email_templates', 'action' => 'edit', $id))); 
	//echo $this->Form->hidden('Email.id', array('value' => $id));
?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#EmailBroadcastMessageForm").validationEngine();
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Broadcast message');$model="Broadcast"; ?>
            <div class="pull-right">
               <?php 
						//link to back  Cms Page
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__("Back To Broadcast"), array("action" => "broadcast"), array("class" => "btn btn-primary", "escape" => false) );
					?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create('Broadcast', array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'broadcast_message', $id))); 
				echo $this->Form->hidden('id',array("value"=>$id));
		  ?>
	   <div class="row" style="padding:7px 33px;float:left;width:50%;">
										
								
								<div class="form-group <?php echo ($this->Form->error('subject'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Subject</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.subject', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".subject",array('class'=>'form-control validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('body'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Body</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.body', array('wrap' => false) ); ?></label>
                                    <?php //echo $this->Form->textArea($model.".body");  ?>
									<textArea name="data[Broadcast][body]" id="BroadcastBody">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mailer</title>
</head>

<body>
<table border="0" cellpadding="0"  cellspacing="0" align="center" style="background:#00b0ff url(<?php echo WEBSITE_URL; ?>mailimages/table-bg.jpg) no-repeat 0 0; background-size:100% 100%;  max-width:600px;">
  <tr>
    <td valign="top" align="center" style="padding:15px 0 20px;"><img src="<?php echo WEBSITE_URL; ?>mailimages/logo.png" style="outline:none; border:none;"></td>
  </tr>
  <tr>
    <td valign="top" style="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10"></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:rgba(255,255,255,0.9); padding:0 10px;">
        <tr>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td valign="top" style="font-size:25px; color:#595959; font-family:Arial; text-align:left; font-weight:bold; padding-left:20px; padding-top:43px;">Hi User</td>
              </tr>
              <tr>
                <td valign="top" style="font-family:Arial; font-size:17px; color:#848383; border-bottom:solid 1px #00adfa; padding-bottom:10px; padding-left:20px; line-height:18px;">The FollowMyCal Team would like to inform you of a few things:</td>
              </tr>
              <tr>
                <td style="padding:0 20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="13" valign="top" style=" padding-top:17px;"><img src="<?php echo WEBSITE_URL; ?>mailimages/aeroplane.png" style="outline:none; border:none;"></td>
                      <td valign="top" style="font-family:Arial; font-size:14px; color:#646464; padding-top:15px; padding-left:20px;">It                   is a long established fact that a reader will be distracted by the readable content. </td>
                    </tr>
                     </table></td>
              </tr>
              <tr>
                <td style="padding:0 20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:28px;">
                    <tr>
					
                      <td valign="top" style="font-size:14px; font-family:Arial; padding:20px 0px 20px 19px; background-color:rgba(244,244,244,0.9);">
					  Best Regards,</br>
The FollowMyCal Team</br style="panding-bottom:5px;">
					  If you feel you have received this email in error or if you wish to unsubscribe<a href="#" style="color:#030303; ">&nbsp;info@followmycal.com</a></td>
                    </tr>
                  </table></td>
              </tr>
              
            </table></td>
        </tr>
      </table></td>
        <td width="10"></td>
      </tr>
    </table>

    </td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td align="left" style="font-family:Arial; font-size:12px; padding-left:8px; color:#FFF;">© 2017 Follow My calendar. All Rights Reserved.</td>
          <td align="right" style="padding:15px 32px;"><img src="<?php echo WEBSITE_URL; ?>mailimages/logo.png" style="outline:none; border:none; max-width:100%; width:118px;"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>



									</textarea>
								</div>
						
				<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->button(__d("Send", "Send", true),array("class"=>"btn btn-primary")); ?> <?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "broadcast"), array("class" => "btn", "escape" => false) ); 
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
	 CKEDITOR.replace('BroadcastBody',{filebrowserBrowseUrl : '<?php echo WEBSITE_URL; ?>admin/js/ckfinder/ckfinder.html',filebrowserWindowWidth : '600',filebrowserWindowHeight : '700'} );
	//]]> 
</script>
<?php $this->Html->script(array('ckeditor/ckeditor.js','ckfinder/ckfinder.js','editor.js'), array('block' => 'scriptBottom'));?>