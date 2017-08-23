<?php
/* <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
 */?>
<script type='text/javascript'>
<!--
$(function() {
	
	// Call jquery on load or on ready event
	
    var Message = 'Confirmation';
    // Show dialog box on delete user link
	var delete_diloag	= $("#delete_div").dialog({
        name: Message,
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'admin_delete')); ?>",
                    data: {
                        'id': user_id
                    },
                    type: 'post',
                    success: function(r) {
                        if (r == 'error') {
                            $(delete_diloag).dialog("close");
                            alert('Something went wrong. Please try again!');
                        } else {
							$(delete_diloag).dialog("close");
							$( "#row_"+user_id ).remove();
                        }
                    }
                });

            },
            "No": function() {
				
                $(this).dialog("close");
            }
        }
    });
   var myDialogClose = $("#active_div").dialog({

        name: Message,
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'change_status_active')); ?>",
                    data: {
                        'id': user_id
                    },
                    type: 'post',
                    success: function(r) {
                        if (r == 'error') {
                            $(this).dialog("close");
                            alert('Something went wrong. Please try again!');
                        } else {
							myDialogClose.dialog('close');
							$("#inactive_"+user_id).toggle();
							$("#active_"+user_id).toggle();
						
                        }
                    }
                });

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

   var myInDialogClose 	=	$("#inactive_div").dialog({

        name: Message,
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'change_status_inactive')); ?>",
                    data: {
                        'id': user_id
                    },
                    type: 'post',
                    success: function(r) {
                        if (r == 'error') {
                            $(this).dialog("close");
                            alert('Something went wrong. Please try again!');
                        } else {
							$(this).closest('#inactive_div').dialog('close');
							myInDialogClose.dialog('close');
							$("#inactive_"+user_id).toggle();
							$("#active_"+user_id).toggle();
                        }
                    }
                });

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });




})
$(document).ready(function() {
    $('.btn').tooltip();

});

function delete_function(msg, obj) {
    user_id = $(obj).attr('id').replace("delete_", "");
    $("#delete_div").empty().html(msg);
    $("#delete_div").dialog('open');
    return false;

}

function active_function(msg, obj) {
    user_id = $(obj).attr('id').replace("active_", "");
    $("#active_div").empty().html(msg);
    $("#active_div").dialog('open');
    return false;

}

function inactive_function(msg, obj) {
    user_id = $(obj).attr('id').replace("inactive_", "");
    $("#inactive_div").empty().html(msg);
    $("#inactive_div").dialog('open');
    return false;

}
-->
</script>

<div id='delete_div'></div>
<div id='active_div'></div>
<div id='inactive_div'></div>
<div id='delete_check' style="display:none">Are you sure you want to delete this Category ?</div>
<div id='active_check' style="display:none">Are you sure you want to active this Category ?</div>
<div id='inactive_check' style="display:none">Are you sure you want to inactive this Category ?</div>
<div id='error_check' style="display:none">Please Select Check Box .</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1><?php echo __($pageHeading,true); ?>
            <div class="pull-right">
              <?php 
				 echo $this->Html->link('<i class="fa fa-plus"></i> &nbspAdd',array('action'=> 'add',$parent_id),array('class'=>'btn btn-primary','escape'=>false));	
			?>
            </div>
          </h1>
        </div></th>
    </tr>
    <tr>
      <td><div class=" pull-left">
          <?php  echo $this->element('paging_info'); ?>
        </div>
        <div class=" pull-right">
          <?php 
			echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
			echo $this->Form->text('name',array('placeholder'=> __('Search By Category',true),'class'=>'input-medium')); ?>
          &nbsp;&nbsp;<?php echo $this->Form->button("<i class=' fa fa-search'></i> &nbsp Search",array('class'=>'btn btn-primary','escape'=>false));?> <?php echo $this->Form->end();?></div>
        <table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr style="height:30px;">
			<td align="center" class="" style="width:300px;"><?php echo __('Image'); ?></td>
              <td  align="left" class="" style="width:180px;"><?php   echo $this->Paginator->sort('name', __('Category Name',true),array('char'=>true));?></td>
              
              <td  align="left" class="" style="width:140px;"><?php   echo $this->Paginator->sort('created',__('Created',true),array('char'=>true));?></td>
              <td align="center" class="" style="width:300px;"><?php echo __('Action'); ?></td>
            </tr>
          </thead>
          <tbody >
            <?php 
	if( !empty($result) ) {
		$i =  1; 
		foreach( $result as $records ) { 
		?>
            <tr style="height:30px;" class="gallerytr" id="row_<?php echo $records[$model]['id']; ?>">
                <td  align="left" style="text-align:center;">
						<?php 
					$file_path    = CATEGORY_UPLOAD_IMAGE_PATH ;
					$file_name    = $records[$model]['image'];
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
						//$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
						
					if(is_file($file_path . $file_name)) {
						echo $images = $this->Html->image($image_url,array('alt' => $records[$model]['name'],'title' => $records[$model]['name']));
					?>
					
					<?php					
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					} 
				?>
		</td>
              <td  align="left" ><?php echo $records[$model]['name'];?> </td>
             <td  align="left"><?php echo $this->Time->format( 'm/d/Y h:i A',$records[$model]['created'],null,"CST"); ?></td>		
             
              <td  align="center" id="action_<?php echo $records[$model]['id']; ?>">
			  <?php echo $this->Html->link('<i class="glyphicon glyphicon-calendar"></i> '.__('SubCategory',true), array('plugin' => 'category','controller' => 'categories','action' => 'index',$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false)); ?>
			  <?php
				
				echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit',true), array('plugin' => 'category','controller' => 'categories','action' => 'edit',$records[$model]['id'],$parent_id),array('class'=>'btn btn-primary','escape' => false));
				
				?>
                <?php 
				//	if($records[$model]['status'] == 1){
				?>
                <a href='javascript::void(0)' onclick='return inactive_function("Are you sure you want to inactive this  value?",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" name="Click here to inactive."><i class="fa fa-thumbs-down"></i>Inactive</a>
                <?php 	
					//}else { ?>
                <a href='javascript::void(0)' onclick='return active_function("Are you sure you want to active this  value?",this);' id='active_<?php echo $records[$model]['id']; ?>' class='btn btn-info' data-toggle="tooltip" data-placement="top" name="Click here to active."><i class="fa  fa-thumbs-up"></i> Active</a>
                <?php //}
				?>
				<a href='javascript::void(0)' onclick='return delete_function("Are you sure you want to delete this Category ?",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" name="Click here to delete."><i class="fa fa-trash-o"></i> Delete</a>
              </td>
			  <script> <?php if($records[$model]['status'] == 1){
				?>$( "#active_<?php echo $records[$model]['id']; ?>" ).hide();<?php 	}else { ?>$( "#inactive_<?php echo $records[$model]['id']; ?>" ).hide();<?php } ?></script> 
            </tr>
            <?php
			$i++;
			} ?>
            <?php
				if(isset($result)) {
			?>
			
			<?php
			}
			?>
          </tbody>
        </table>
        <!--paging information-->
        <?php echo $this->element('pagination');
		} else { ?>
    <tr>
      <td align="center" style="text-align:center;" colspan="5" class=""><?php echo __('No Result Found'); ?></td>
    </tr>
</table>
<?php } ?>
</td>
</tr>
</thead>
</table>
<div class="processModal"></div>
<style type="text/css">
/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   speak for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.processModal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 0, 0, 0, .2 ) url("<?php echo $this->html->url('/webroot/images', true).'/loading.gif'; ?>") 50% 50% no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .processModal {
    display: block;
}
</style>
<script type="text/javascript">


$(document).ready(function() {
	$('#selectall').click(function(event) {  //on click
		if(this.checked) { // check select status
            $('.case').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.case').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	
	$('#sysOpt').on('change', function() {
	if($('.case:checked').is(':checked') == true) {
		var dad	=	$("#delete_check").dialog({
			name: "Delete All",
			resizable: false,
			modal: true,
			autoOpen: false,
			width: 500,
			height: 170,
			buttons: {
				"Yes Continue": function() {
					var data = { 'fare_ids[]' : []};
							$(".case:checked").each(function() {
							data['fare_ids[]'].push($(this).val());
							});
							$.post("<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'delete_all')); ?>", data, function(sdata){
								if(sdata == 'Success') {
									$(".case:checked").each(function() {
										dad.dialog('close');
										$( "#row_"+$(this).val() ).remove();
									});
									
								}
							});
				}
			},
			"No": function() {
					$(this).dialog("close");
			}
		
    });	
	var aad	=	$("#active_check").dialog({
        name: "Delete All",
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
               	var data = { 'fare_ids[]' : []};
				$(".case:checked").each(function() {
				data['fare_ids[]'].push($(this).val());
				});
				$.post("<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'active_all')); ?>", data, function(sdata){
        			if(sdata == 'Success') {
						$(".case:checked").each(function() {
								aad.dialog('close');
								$("#inactive_"+$(this).val()).fadeIn();
								$("#active_"+$(this).val()).fadeOut();
								//$("#inactive_"+$(this).val()).toggle();
								//$("#active_"+$(this).val()).toggle();
								//$( "#row_"+$(this).val() ).remove();
						});
						
						//window.location.reload(true);
					}
    			});

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });	
	var iaad	=	$("#inactive_check").dialog({
        name: "Delete All",
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
               var data = { 'fare_ids[]' : []};
				$(".case:checked").each(function() {
				data['fare_ids[]'].push($(this).val());
				});
				$.post("<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'inactive_all')); ?>", data, function(sdata){
        			if(sdata == 'Success') {
						$(".case:checked").each(function() {
								iaad.dialog('close');
								$("#active_"+$(this).val()).fadeIn();
								$("#inactive_"+$(this).val()).fadeOut();
								//$("#inactive_"+$(this).val()).toggle();
								//$("#active_"+$(this).val()).toggle();
								//$( "#row_"+$(this).val() ).remove();
						});
						
					}
    			});

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });
	if($(this).val() == 1) {
		$( "#delete_check").dialog('open');
	}else if($(this).val() == 2) {
		$( "#active_check").dialog('open');
	}else if($(this).val() == 3) {
		$( "#inactive_check").dialog('open');
	}
	}else{
		$( "#error_check").dialog({
			 name: "Go Here Validation",
			resizable: false,
			modal: true,
			autoOpen: false,
			width: 500,
			height: 170,
			buttons:{
				
				"Close": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		$( "#error_check").dialog('open');
	}
		
	});
});
-->
</script>