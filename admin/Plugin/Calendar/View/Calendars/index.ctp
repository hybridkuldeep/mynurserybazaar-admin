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
	var v_diloag	= $("#v_div").dialog({
        title: "Viewer Filter",
        resizable: false,
        modal: true,
        autoOpen: false,
        width: 500,
        height: 370,
        buttons: {
            "Search": function() {
                $.ajax({
                     url: "<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'viwer_count')); ?>",
                    data: {
						'cal_id': user_id,
						'start':$("#CalendarStartdate").val(),
						'end':$("#CalendarExpired").val()
						
                    },
                    type: 'post',
                    success: function(r) {
                        if (r == 'error') {
                            $(delete_diloag).dialog("close");
                            alert('Something went wrong. Please try again!');
                        } else {
							$("#vv").html(r)
							console.log(r);
                        }
                    }
                });

            },
            "Close": function() {
				
                $(this).dialog("close");
            }
        }
    });
	
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
                     url: "https://followmycal.com:8018/web_delete_cal",
                    data: {
                        'cal_id': user_id,
						
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
                    url: "<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'change_status_active')); ?>",
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
							$("#status_"+user_id).html("Not verified")
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
                    url: "<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'change_status_inactive')); ?>",
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
							$("#status_"+user_id).html("Verified")
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
function v_function(msg, obj) {
    user_id = $(obj).attr('id').replace("v_", "");
	 $.ajax({
                     url: "<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'viwer_count')); ?>",
                    data: {
                        'cal_id': user_id,
						'start':$("#CalendarStartdate").val(),
						'end':$("#CalendarExpired").val()
						
                    },
                    type: 'post',
                    success: function(r) {
                        if (r == 'error') {
                            $(delete_diloag).dialog("close");
                            alert('Something went wrong. Please try again!');
                        } else {
							$("#vv").html(r)
							console.log(r);
                        }
                    }
                });
    //$("#delete_div").empty().html(msg);
    $("#v_div").dialog('open');
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

<div id='v_div'>
Start Date 
 <?php echo $this->Form->text($model.".startdate",array('value'=>$this->Time->format( date("Y/m/d"),'%m/%d/%Y',"CST"),'class'=>'form-control  validate[required]',"readonly"));  ?>
 End Date
 <?php 

 echo $this->Form->text($model.".expired",array('value'=>$this->Time->format( date("Y/m/d"),'%m/%d/%Y',"CST"),'class'=>'form-control  validate[required]','readonly'));  ?>
</br>
Count of Viewer :<span id="vv">-</span>
</div>
<div id='delete_div'></div>
<div id='active_div'></div>
<div id='inactive_div'></div>
<div id='delete_check' style="display:none">Are you sure you want to delete this Calendar ?</div>
<div id='active_check' style="display:none">Are you sure you want to active this Calendar ?</div>
<div id='inactive_check' style="display:none">Are you sure you want to inactive this Calendar ?</div>
<div id='error_check' style="display:none">Please Select Check Box .</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1><?php echo __($pageHeading,true); ?>
            <div class="pull-right">
             
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
			echo $this->Form->text('title',array('placeholder'=> __('Search By Calendar',true),'class'=>'input-medium')); ?>
          &nbsp;&nbsp;<?php echo $this->Form->button("<i class=' fa fa-search'></i> &nbsp Search",array('class'=>'btn btn-primary','escape'=>false));?> <?php echo $this->Form->end();?></div>
        <table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr style="height:30px;">
				  <td align="center" class="" style="width:300px;"><?php echo __('Image'); ?></td>
              <td  align="left" class="" style="width:180px;"><?php   echo $this->Paginator->sort('title', __('Calendar Name',true),array('char'=>true));?></td>
              <td  align="left" class="" style="width:180px;"><?php   echo $this->Paginator->sort('type', __('Calendar type',true),array('char'=>true));?></td>
			  <td  align="left" class="" style="width:180px;"><?php   echo $this->Paginator->sort('is_verified', __(' Is verified ',true),array('char'=>true));?></td>
			  <td  align="left" class="" style="width:100px;"><?php   echo $this->Paginator->sort('is_premium', __(' Is premium',true),array('char'=>true));?></td>
			  <td  align="left" class="" style="width:450px;"><?php   echo $this->Paginator->sort('totle_view', __(' Viewer',true),array('char'=>true));?></td>
			  <td  align="left" class="" style="width:100px;"><?php   echo $this->Paginator->sort('evevnt_count', __(' Event',true),array('char'=>true));?></td>
              
              <td  align="left" class="" style="width:140px;"><?php   echo $this->Paginator->sort('created',__('Created',true),array('char'=>true));?></td>
               <td align="center" class="" style="width:300px;"><?php echo __('User Detail'); ?></td>
			    <td align="center" class="" style="width:300px;"><?php echo __('Action'); ?></td>
            </tr>
          </thead>
          <tbody >
            <?php 
	if( !empty($result) ) {
		$i =  1; 
		foreach( $result as $records ) { //pr($records);
		?>
            <tr style="height:30px;" class="gallerytr" id="row_<?php echo $records[$model]['id']; ?>">
			<td  align="left" style="text-align:center;">
						<?php 
					$file_path    = Calendar_IMAGE_STORE_PATH ;
					$file_name    = $records[$model]['picture'];
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
						//$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
						
					if(is_file($file_path . $file_name)) {
						echo $images = $this->Html->image($image_url,array('alt' => $records[$model]['title'],'title' => $records[$model]['title']));
					?>
					
					<?php					
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					} 
				?>
		</td>
              <td  align="left" ><?php echo $records[$model]['title'];?> </td>
              <td  align="left" ><?php if($records[$model]['type'] == 1) {echo "Public";} else{echo  $records[$model]['type'] == 2 ? "Private": "Mycal"  ; }?> </td> 
			  <td  align="left" id='status_<?php echo $records[$model]['id']; ?>'><?php echo $records[$model]['is_verified'] == 1 ? "Verified": "Not verified"  ;?> </td>
			  <td  align="left" ><?php echo $records[$model]['is_premium'] == 1 ? "Premium": "Not premium"  ;?> </td>
              <td  align="left" >
			  Today :<?php echo $records[$model]['today_view'];?> </br>
			  This week :<?php echo $records[$model]['week_view'];?> </br>
			  This Month :<?php echo $records[$model]['month_view'];?> </br>
			  Total  :<?php echo $records[$model]['totle_view'] ;?> 
			  </td>
              <td  align="left" ><?php echo $records[$model]['evevnt_count'];?> </td>
             
              <td  align="left"><?php echo $this->Time->format( 'm/d/Y h:i A', $records[$model]['created'],null,"CST"); ?>
			  </td>
              <td  align="left"><?php echo "Email :".$records["User"]['email']."<br>Name :".$records["User"]['full_name'];  ?> </td>
			  <td>
			   <a href='javascript::void(0)' onclick='return v_function("Are you sure you want to delete this Category ?",this);' id='v_<?php echo $records[$model]['id']; ?>' class='btn btn-info' data-toggle="tooltip" data-placement="top" title="Click here to Viewer."><i class="glyphicon glyphicon-calendar"></i> Viewer Filter</a>
			  <?php echo $this->Html->link('<i class="glyphicon glyphicon-calendar"></i> '.__('View Event',true), array('plugin' => 'event','controller' => 'events','action' => 'index',0,$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false)); ?>
			 <?php  if($records[$model]['type'] != 3){ ?>
			   <a href='javascript::void(0)' onclick='return delete_function("Are you sure you want to delete this Category ?",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="Click here to delete."><i class="fa fa-trash-o"></i> Delete</a>
			   <a href='javascript::void(0)' onclick='return inactive_function("Are you sure you want to verify this calendar ?",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="Click here to verify."><i class="icon-remove icon-white"></i> Not verify</a>
			  <a href='javascript::void(0)' onclick='return active_function("Are you sure you want to not verify this calendar ?",this);' id='active_<?php echo $records[$model]['id']; ?>' class='btn btn-info' data-toggle="tooltip" data-placement="top" title="Click here to not verify."><i class="icon-ok icon-white"></i> Verified</a>
			  <?php  if($records[$model]['type'] == 1){ ?>
				<?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Featured',true), array('plugin' => 'calendar','controller' => 'calendars','action' => 'featured',$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false)); ?>
				<?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Local',true), array('plugin' => 'calendar','controller' => 'calendars','action' => 'local',$records[$model]['id'],2),array('class'=>'btn btn-primary','escape' => false)); ?>
				<?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Category',true), array('plugin' => 'calendar','controller' => 'calendars','action' => 'local',$records[$model]['id'],1),array('class'=>'btn btn-primary','escape' => false)); ?>
				
				
			  <?php }} ?>
			
			  </td>
			    <script> <?php if($records[$model]['is_verified'] == 0){
				?>$( "#active_<?php echo $records[$model]['id']; ?>" ).hide();<?php 	}else { ?>$( "#inactive_<?php echo $records[$model]['id']; ?>" ).hide();<?php } 
				if($records[$model]['type'] == 3){
				?>
				$( "#active_<?php echo $records[$model]['id']; ?>" ).hide();
				$( "#inactive_<?php echo $records[$model]['id']; ?>" ).hide();
				<?php }  ?>
				
				</script> 
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
td a{
margin-bottom: 3px !important;
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
			title: "Delete All",
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
							$.post("<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'delete_all')); ?>", data, function(sdata){
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
        title: "Delete All",
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
				$.post("<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'active_all')); ?>", data, function(sdata){
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
        title: "Delete All",
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
				$.post("<?php echo $this->Html->url(array('plugin' => 'calendar','controller' => 'calendars','action' => 'inactive_all')); ?>", data, function(sdata){
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
			 title: "Go Here Validation",
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

<script>
      $(function(){
	  
	 
	  
	  
	   var dateFormat = "mm/dd/yy",
      from = $( "#CalendarStartdate" )
        .datepicker({
			dateFormat:dateFormat,
          defaultDate: "+0d",
          changeMonth: true,
          changeYear: true,
		  maxDate:"+0d",
          numberOfMonths: 1
        })

      from = $( "#CalendarExpired" )
        .datepicker({
			dateFormat:dateFormat,
          defaultDate: "+0d",
          changeMonth: true,
          changeYear: true,
		  maxDate:"+0d",
          numberOfMonths: 1
        })
		
       
		
        
      });
    </script>