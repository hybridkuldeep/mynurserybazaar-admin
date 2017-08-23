<script> 
 function remove_secondary(row){
	$(row).parent().parent().remove();
}  
var inputCnt    =   0;
 $(function(){
	$("a.add_more").click(function(e){
		$("#error_message_"+inputCnt).empty();
			if($("#name_"+inputCnt).val()==""){
                        $("#error_message_"+inputCnt).html("Please enter Option.");
                        return false;
              } 
                inputCnt++;
                    var inputText= '<div id="add_id_'+inputCnt+'" style="padding-bottom:20px;"><div class="span3" style="float: left"><span class="input-prepend"><span class="add-on">Name </span></span>&nbsp;<input id="name_'+inputCnt+'" class="span2" type="text" style="width:140px;" name="data[EmailAction][options][]" /><span class="help-inline"></span></div><div class="" style=""><a href="javascript:void(0)" id="remove_primary" class="label btn-danger important" style="text-decoration:none;color:#FFFFFF;" onclick="remove_secondary(this)">Delete</a> &nbsp; <span id="error_message_'+inputCnt+'" class="error_message"  style="color:#B94A48"></span></div><br /></div>';
					$("#more_item_div").append(inputText)
			return false;
  });   });  

</script>
<!-- CKeditor statrs-->		
<?php
	 echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));  

?>
<!-- CKeditor ends-->
<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Add Action
					<div class="pull-right">
                     <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Email Templates", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
					</div>
				</h1>
               </div>
              </th>
    		</tr>
    <tr>
      <td>
      
<?php 
	echo $this->Form->create('EmailAction',array("class"=>"form-horizontal"));
?>
      <div class="row-fluid">
<div class="span12" >
			
		<div class="control-group <?php echo ($this->Form->error('EmailAction.name'))? "error":"";?>">
           <?php echo $this->Form->label('EmailAction.name', "Name: *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text('EmailAction.name'); ?><span class="help-inline"><?php echo $this->Form->error('EmailAction.name',array("wrap"=>false)); ?></span>
            </div>
          </div>
          			<div class="control-group">
					<?php echo $this->Form->label("EmailAction.option", 'Options',array("class"=>"control-label")); ?>
					<div class="controls">
					<?php  
					$totalattributes	=	1;
					if($totalattributes>0) 
					{
						for($i=0;$i<$totalattributes;$i++)
						{
					?>
						<div id="add_id_<?php echo $i; ?>" style="padding-bottom:20px;width:600px;">
							<div class="span3" style="float: left;width:221px;">
								<span class="input-prepend">
									<span class="add-on"><?php echo __("Name"); ?></span>
								</span> 
								<?php echo $this->Form->text('EmailAction.options',array("name"=>"data[EmailAction][options][]","id"=>"name_$i","class"=>"span2",'style'=>'width:140px;')); ?>
							</div>
							
							<?php if($i==0) { ?>
							<div class="" style="">
								<a class="label btn-success add_more" style="text-decoration:none;color:#FFFFFF;" href="javascript:void(0);"><?php echo __("Add More"); ?></a> &nbsp;
								 <span id="error_message_<?php echo $i; ?>" class="error_message" style="color:#B94A48"></span>
							</div>
							
							<?php } else { ?>
							<div class="" style="">
								<a href="javascript:void(0)" id="remove_primary" class="label btn-danger important" style="text-decoration:none;color:#FFFFFF;" onclick="remove_secondary_from_db(<?php echo $i; ?>,this)"><?php echo __("Delete"); ?></a>  &nbsp;
								 <span id="error_message_<?php echo $i; ?>" class="error_message" style="color:#B94A48"></span>
							</div>
							<?php } ?>
						</div> <br />
						<?php  
						} 
					} ?>
					
						 <div id="more_item_div">

						</div>
					</div>
					
				</div>

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("page", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> Reset",array("action"=> "add_dealer"),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
</div>
<?php echo $this->Form->end();?>
</div> 
      </td>
    </tr>
  </thead>
 
</table>

           

 