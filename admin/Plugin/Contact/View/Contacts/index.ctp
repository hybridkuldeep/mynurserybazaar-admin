<?php
echo $this->Html->script(array(
	'jquery-ui'
));
?>
<script type="text/javascript">
$(function(){

	var Message	=	'Confirmation';
	delete_diloag = $( "#delete_user_div").dialog({
			
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"Yes Continue": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'contact','controller' => 'contacts','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again"); ?>!');
						}
						else{
							$(delete_diloag).dialog("close");
							window.location.reload(true);
						}
					}
				});
					
				},
				"No": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		
});
function delete_user(msg,obj){
		user_id	=	$(obj).attr('id').replace("delete_","");
		$( "#delete_user_div").empty().html(msg);
		$( "#delete_user_div").dialog('open');return false;
		
	}
$(document).ready(function(){
	$('.btn').tooltip();
}) 

</script>
<div id='delete_user_div'></div>
    <table class="table table-bordered table-striped">
 		 <thead>
    		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid"><h1><?php echo __("Contact "); ?><div class="pull-right">
                 <?php 
					// echo $this->Html->link('<i class="icon-plus icon-white"></i> Add',array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));
				?> 
              </div></h1></div>
              </th>
    		</tr>
			<tr>
				<td>
		<div class=" pull-left"><?php  echo $this->element('paging_info');  ?></div>
			<div class=" pull-right">
			<?php 
			echo $this->Form->create($model, array('novalidate','class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
			echo $this->Form->text('name',array('placeholder'=> __('Search By Name',true),'class'=>'input-medium')).'&nbsp;';
			?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " .__("Search", true),array('class'=>'btn btn-primary','escape'=>false));?>
			<?php echo $this->Form->end();?></div>

          <table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>
   <tr style="height:30px;">
	
	<td  align="left" class="" style="width:100px;"><?php  echo $this->Paginator->sort('name',__('Name'),array('char'=>true));?></td>
	<td  align="left" class="" style="width:130px;"><?php  echo $this->Paginator->sort('email',__('Email'),array('char'=>true));?></td>
	<td  align="left" class="" style="width:100px;"><?php  echo $this->Paginator->sort('message',__('Message'),array('char'=>true));?></td>

	<td  align="left" class="" style="width:130px;"><?php  echo $this->Paginator->sort('created',__('Created'),array('char'=>true));?></td>
	<td align="center" class="" style="width:150px;"><?php echo __("Action"); ?></td>
  </tr>
  </thead>
   <tbody >
                <?php 
				//pr($result);
              if( !empty($result) ) {
				
				  $i =  1; 
				foreach( $result as $records ) { 
			  ?>
              <tr style="height:30px;" class="gallerytr">
					<td  align="left" class="">
					     <?php echo __($records[$model]['name']);?>
           
           
                      </td>
					   <td  align="left" class="">
					     <?php echo __($records[$model]['email']);?>
           
           
                      </td>
					  <td  align="left" class="">
					     <?php echo __(substr($records[$model]['message'],0,200));?>
           
           
                      </td>
					  
                      
					
                      <td  align="left"><?php echo $this->Time->format( 'm/d/Y h:i A',$records[$model]['created'],null,"CST"); ?></td>
                    
                      <td  align="center">
						<?php echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('View'), array('plugin' => 'contact','controller' => 'contacts','action' => 'edit',$records[$model]['id']),array('class'=>'btn btn-primary','onclick' => 'return InsertHTML()','escape' => false));
					?>&nbsp;
                      <a href='javascript::void(0)' onclick='return delete_user("<?php echo __("Are you sure you want to delete this template"); ?>?",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="<?php echo __("Click here to delete"); ?>."><i class="icon-trash icon-white"></i> <?php echo __('Delete');?></a>
	 
					  </td>
              </tr>
              <?php
					$i++;
					} ?><tr><td align="right" colspan="6" >&nbsp;</td></tr>
                    </tbody>
					  </table>
					  <?php ?> 
              <?php } 
			 		else { ?>
               <tr>
                <td align="center" style="text-align:center;" colspan="6" class=""><?php echo __("No Result Found"); ?> </td>
              </tr></table>
              <?php } ?>
      
        
      </td>
    </tr>
  </thead>
 
</table>
