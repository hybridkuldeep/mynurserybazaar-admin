<?php
	 echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));  

?>  
  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Edit Email Template
                <div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Email Templates",array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>

<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));
	
?>
      <div class="row-fluid">
<div class="span12" >
			
		<div class="control-group <?php 	 echo ($this->Form->error($model.".name"))? "error":"";?>">
           <?php echo $this->Form->label($model.".name", "Name: *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".name"); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
            </div>
          </div>
          <div class="control-group <?php echo ($this->Form->error($model.".subject"))? "error":"";?>">
           <?php echo $this->Form->label($model.".subject", "Subject: *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".subject"); ?><span class="help-inline"><?php echo $this->Form->error($model.".subject",array("wrap"=>false)); ?></span>
            </div>
          </div>
		 <div class="control-group <?php echo ($this->Form->error($model.".action"))? "error":"";?>">
		 <?php 
				echo $this->Form->label($model.'.action', 'Action :*',array("class"=>"control-label") ); 
			//$Action_options	=	Configure::read('Action_options'); ?>
			<div class="controls">
			<?php 
				 $action='';
				   if(isset($this->data['EmailTemplate']['action']) && $this->data['EmailTemplate']['action']!='')
				   {
				    $action = $this->data['EmailTemplate']['action'];
				   }
				echo $this->Form->select($model.".action", $Action_options, array('empty' => '-- Select One --','onchange'=>'constant()','disabled'=>'disabled')); 
				//echo $this->Form->hidden($model.".action");
				?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.action', array('wrap' => false) ); ?>
				</span>
            </div>
          </div>
		  
		  
		  <div  class="control-group <?php echo ($this->Form->error($model.".constants"))? "error":"";?>">
			<?php 
				echo $this->Form->label($model.'.constants', 'Constants :', array("class"=>"control-label")); 
			 ?>
			<div class="controls">
		
				
				<?php 
				$constant='';
				   if(isset($this->data['EmailTemplate']['constants']) && $this->data['EmailTemplate']['constants']!='')
				   {
				    $constant = $this->data['EmailTemplate']['constants'];
				   }
					echo $this->Form->select($model.".constants",'', array('empty' => '-- Select One --'));

				
				?>
				<span style = "padding-left:20px;padding-top:0px; valign:top">
				<?php
				echo $this->Html->link('Insert Variable', 'javascript:void(0)',array('class'=>'btn  btn-success','escape' => false,'onclick' => 'return InsertHTML()',"escape" => false));
				?></span>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.constants', array('wrap' => false) ); ?>
				</span>
			</div>
		</div> 
		  
		 <div class="control-group <?php echo ($this->Form->error($model.".body"))? "error":"";?>">
           <?php echo $this->Form->label($model.".body", "Email Body: *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".body",array('id'=>'body')); ?><span class="help-inline"><?php echo $this->Form->error($model.".body",array("wrap"=>false)); ?></span>
            </div>
			<script type="text/javascript">
					// CKEDITOR.replace( 'body' );
					CKEDITOR.replace( 'body',
					{
						height: 700,
						width: 850,
						enterMode : CKEDITOR.ENTER_BR
					});
			</script>
			
          </div>
		<div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> Reset",array("action"=> "add_dealer"),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
</div>
<?php echo $this->Form->end();?>
<div id="image_div" class="modal hide fade" style="width:500px;height:auto;overflow:auto;"></div>
</div>    
      </td>
    </tr>
  </thead>
 
</table>
<script type='text/javascript'>
var myText = '<?php  echo $constant; ?>';
var action = '<?php echo $action; ?>';
$(function(){
	constant();
	
	});
    function InsertHTML() {
		var strUser = document.getElementById("EmailTemplateConstants").value;
		if(strUser != ''){
			var newStr = '{'+strUser+'}';
			var oEditor = CKEDITOR.instances["body"];
			oEditor.insertHtml(newStr) ;	
		}
    }
	 function constant() {
		var constant = document.getElementById("EmailTemplateAction").value;
		//alert(constant);
		if(action!=constant)
		{
			CKEDITOR.instances["body"].setData('') ;
		}
			$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'settings',"controller" => "emailtemplates","action" => "constants")); ?>",
					type: "POST",
					data: { constant: constant},
					dataType: 'json',
					success: function(r){
						//alert(r); return false;
						$('#EmailTemplateConstants').empty();
						$('#EmailTemplateConstants').append( '<option value="">-- Select One --</option>' );
						$.each(r, function(val, text) {
						    var sel ='';
							if(myText == text)
							 {
							   sel ='selected="selected"';
							 }
							 
							$('#EmailTemplateConstants').append( '<option value="'+text+'" '+sel+'>'+text+'</option>');
						});	
				   }
			});
			
		return false; 
	}
	
</script>