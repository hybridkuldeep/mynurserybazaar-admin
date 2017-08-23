<script type='text/javascript'>
<!--
$(function() {
	
	// Call jquery on load or on ready event
	
    var Message = 'Confirmation';
    // Show dialog box on delete user link
	var delete_diloag	= $("#delete_div").dialog({
        title: Message,
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'payment_type','controller' => 'payment_types','action' => 'admin_delete')); ?>",
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

        title: Message,
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'payment_type','controller' => 'payment_types','action' => 'change_status_active')); ?>",
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

        title: Message,
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 170,
        buttons: {
            "Yes Continue": function() {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'payment_type','controller' => 'payment_types','action' => 'change_status_inactive')); ?>",
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
<div id='delete_check' style="display:none">Are you sure you want to delete this Payment Type ?</div>
<div id='active_check' style="display:none">Are you sure you want to active this Payment Type ?</div>
<div id='inactive_check' style="display:none">Are you sure you want to inactive this Payment Type ?</div>
<div id='error_check' style="display:none">Please Select Check Box .</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1><?php echo __($pageHeading,true); ?>
            <div class="pull-right">
              <?php 
				 echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Broadcast to all',true),array('action'=> 'broadcast_message',"0"),array('class'=>'btn btn-primary','escape'=>false));	
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
		  if(!isset($this->request->params['named']['full_name'])){
	$this->request->params['named']['full_name']="";
}
			echo $this->Form->create($model, array('novalidate','class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
			echo $this->Form->text('full_name',array('placeholder'=> __('Search By name',true),'class'=>'input-medium' ,'value'=>$this->request->params['named']['full_name'])); ?>
          &nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i>" .__("Search", true),array('class'=>'btn btn-primary','escape'=>false));?> <?php echo $this->Form->end();?></div>
        <table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr style="height:30px;">
			<td style="width:30px"></td>
              <td  align="left" class="" style="width:180px;"><?php   echo $this->Paginator->sort('full_name', __('Name',true),array('char'=>true));?></td>
              
              <td  align="left" class="" style="width:140px;"><?php   echo $this->Paginator->sort('email',__('Email',true),array('char'=>true));?></td>
			  <td  align="left" class=""><?php   echo $this->Paginator->sort('created',__('Created',true),array('char'=>true));?></td>
	
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
			<td style="width:30px">
			<?php echo $this->form->checkbox('id',array('hiddenField'=>false,'class'=>'case','name'=>'data[id][]','div'=>false,'label'=>false,'value'=>$records[$model]['id'])); ?>
			</td>
              <td  align="left" ><?php echo $records[$model]['full_name'];?> </td>
             
              <td  align="left"><?php echo $records[$model]['email'];  ?> </td>
             <td  align="left">
				<?php echo $this->Time->format( 'm/d/Y h:i A',$records[$model]['created'],null,"CST"); ?>

			</td>
              <td  align="center" id="action_<?php echo $records[$model]['id']; ?>"><?php
				
				echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Send',true), array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'broadcast_message',$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false));
				
				?>
              
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
			 <tr>
              <td align="right" colspan="9" >
			 
				<a href="javascript:void(0)" class="btn btn-primary"  id="broad"><i class="icon-pencil icon-white"></i> Broadcast to selected</a>
				
			  
				<style type="text/css">
					<!--
						#sysOpt {
							margin: 0;
							float: right;
							width: 120px;
						}
					-->
				</style>
			  </td>
            </tr>
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
	
	$('#broad').on('click', function() {
	if($('.case:checked').is(':checked') == true) {
		ids = ""
		var data = { 'fare_ids[]' : []};
							$(".case:checked").each(function() {
								ids += $(this).val()+","
							data['fare_ids[]'].push($(this).val());
		});
		console.log(data)
		console.log(ids)
		window.location.href = "<?php echo WEBSITE_URL; ?>"+"admin/usermgmt/usermgmt/broadcast_message/"+ids
	
	}else{
		$( "#error_check").dialog({
			 title: "Followmycal Validation",
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