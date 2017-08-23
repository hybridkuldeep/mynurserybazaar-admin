<?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
	echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));

 ?>
 <?php 
	echo $this->Html->css(array('validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<SCRIPT language="javascript">
$(function(){
		jQuery("#UsermgmtCustomerForm").validationEngine();
	var Message	=	'Confirmation';
	var status	=	$( "#show_message_div").dialog({
	
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"Yes Continue": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'change_status')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$(status).dialog("close");
							alert('<?php echo __("Something went wrong. Please try again") ;?>!');
						}
						else{
							$(status).dialog("close");
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
		
	var delete_diloag	=$( "#delete_user_div").dialog({
			
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 200,
			buttons:{
				"Yes Continue": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$(delete_diloag).dialog("close");
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


function show_message(msg,obj){
		user_id	=	$(obj).attr('id').replace("inactive_","");
		$( "#show_message_div").empty().html(msg);
		$( "#show_message_div").dialog('open');return false;
		
	} 
	
function delete_user(msg,obj){
		user_id	=	$(obj).attr('id').replace("delete_","");
		$( "#delete_user_div").empty().html(msg);
		$( "#delete_user_div").dialog('open');return false;
		
	}
$(document).ready(function(){
	$('.btn').tooltip();
	 $("#single_1").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
}) 





		<!----------------------------by ambrish start----------------------------------------->
		
		
		//================================for change status==============================================================
		
		$(".my_status").on('click',function(){
						var id=$(this).attr('id');
				
			$('#'+id).hide();
			var main_status_id=id.split("_");
			var status_id=main_status_id[1];
			$('#status_aja_'+status_id).show();
		$.ajax({
			url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'status_ajax')); ?>",
			data:{'id':status_id},
			type:'post',
			//dataType:'json',
			success:function(subcat_data){
				
				if(subcat_data==1)
				{
					$("#"+id).attr('src',"<?php echo WEBSITE_URL."img/active.png"; ?>");
					$("#"+id).attr('title',"Click here for Inactive");
				}
				else
				{
					$("#"+id).attr('src',"<?php echo WEBSITE_URL."img/inactive.png"; ?>");
					$("#"+id).attr('title',"Click here for Active");
				}
				
				$('#status_aja_'+status_id).hide();
				$('#'+id).show();
				
			},
			error:function(e){
				alert('fali');
				$('#status_aja_'+status_id).hide();
			}
		});
		});
		<!----------------------------by ambrish end----------------------------------------->




function confirmDelete()
{
   return confirm("Are you sure you want to delete this?");
}

</SCRIPT>
<div id='show_message_div'></div>
<div id='delete_user_div'></div>

<table class="table table-bordered table-striped">
	<thead>
		
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1><?php echo __($pageHeading,true); ?><div class="pull-right">
					<?php 
					  //echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add_customer'),array('class'=>'btn btn-primary','escape'=>false));	
					  
				?> 
				<a href="#" class="export btn btn-primary">Export Table data into Excel</a>
				  </div></h1>
			  </div>
			</th>
		</tr>
		<tr>
			<td> 
			<div class=" pull-left"><?php  echo $this->element('paging_info'); //pr($this->request['params']); ?></div>
			<div class=" pull-right">
			<?php 
if(!isset($this->request->params['named']['full_name'])){
	$this->request->params['named']['full_name']="";
}
if(!isset($this->request->params['named']['email'])){
	$this->request->params['named']['email']="";
}
if(!isset($this->request->params['named']['address'])){
	$this->request->params['named']['address']="";
}
if(!isset($this->request->params['named']['sex'])){
	$this->request->params['named']['sex']="";
}
if(!isset($this->request->params['named']['phone'])){
	$this->request->params['named']['phone']="";
}
if(!isset($this->request->params['named']['ages'])){
	$this->request->params['named']['ages']="";
}
if(!isset($this->request->params['named']['agee'])){
	$this->request->params['named']['agee']="";
}
if(!isset($this->request->params['named']['tag'])){
	$this->request->params['named']['tag']="";
}
if(!isset($this->request->params['named']['share'])){
	$this->request->params['named']['share']="";
}

			echo $this->Form->create($model, array('novalidate','class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
			//echo $this->Form->select('status',array('1' => 'Active', '0' => 'Inactive'),array('default'=>$this->request->params['named']['status'],'empty'=> __('Search By Status',true),'class'=>'input-medium')).'&nbsp;';
			echo $this->Form->text('full_name',array('placeholder'=> __('Search By user name',true),'class'=>'input-medium','value'=>$this->request->params['named']['full_name'])).'&nbsp;'; 
			echo $this->Form->text('phone',array('placeholder'=> __('Search By user phone',true),'class'=>'input-medium','value'=>$this->request->params['named']['phone'])).'&nbsp;'; 
			echo $this->Form->text('email',array('placeholder'=> __('Search By email',true),'class'=>'input-medium','value'=>$this->request->params['named']['email'])).'&nbsp;'; 
			echo $this->Form->text('address',array('placeholder'=> __('Search By address',true),'class'=>'input-medium','value'=>$this->request->params['named']['address'])).'&nbsp;'; 
			
			?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " .__("Search", true),array('class'=>'btn btn-primary','escape'=>false));?>
			<?php echo $this->Form->end();?></div>
            
            <?php 	//echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false))); ?>
            <?php //echo $this->Form->submit("" .__("Delete All", true),array('class'=>'btn btn-primary','escape'=>false,'disabled'=>true ,'onClick'=>'return confirmDelete()')); ?>
			
                

<table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>
   <tr style="height:30px;">
   
  <?php /*?>	<td  align="left" class="" style="width:90px;"><?php   echo $this->Paginator->sort('image', __('User Photo',true),array('char'=>true));?></td><?php */?>
	<td  align="left" class="" style="width:90px;"><?php   echo $this->Paginator->sort('full_name', __(' Name',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:90px;"><?php   echo $this->Paginator->sort('phone', __('Phone',true),array('char'=>true));?></td>
	<?php /*?><td  align="left" class="" style="width:90px;"><?php   echo $this->Paginator->sort('mobile', __('Mobile Number',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:90px;"><?php   echo $this->Paginator->sort('address', __('Address',true),array('char'=>true));?></td><?php */?>
	<td  align="left" class="" style="width:100px;"><?php  echo $this->Paginator->sort('email',__('Email',true),array('char'=>true));?></td>
	
	<td  align="left" class=""><?php   echo $this->Paginator->sort('created',__('Created',true),array('char'=>true));?></td>
	
	<td align="center" class="" ><?php echo __('Action'); ?></td>
  </tr>
  </thead>
   <tbody >
	<?php 
	if( !empty($result) ) {
	
	$i =  1; 	
	// $albums_categories = $this->requestAction(array('plugin'=>'category','controller'=>'categories','action'=>'get_categories','id','categories'));
		
		foreach( $result as $records ) { 
		?>
		<tr style="height:30px;" class="gallerytr">
       
		<?php /*?><td  align="left" >
			<?php 
				$file_path		=	ALBUM_UPLOAD_IMAGE_PATH ;
				$file_name		=	$records[$model]['image'];
				$image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',100,100,base64_encode($file_path),$file_name),true);
				$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
				if(is_file($file_path . $file_name)) {

					$images = $this->Html->image($image_url,array('alt' => $records[$model]['firstname'],'title' => $records[$model]['firstname']));
				?>
				<a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['firstname']); ?>'>
					<?php echo $images; ?>
				</a>
				<?php	
				}else {
					echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
				}
			?>
			</td><?php */?>
			
		<td  align="left" >
				<?php if($records[$model]['full_name'] != "undefined undefined" )echo $this->Html->link($records[$model]['full_name'], array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'detail_customer',$records[$model]['id']),array('class'=>'','escape' => false));?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['phone'];?>
			</td>
			<?php /*?><td  align="left" >
				<?php echo $this->Html->link($records[$model]['mobile'], array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'detail_customer',$records[$model]['id']),array('class'=>'','escape' => false));?>
				
			</td>
			<td  align="left" >
				<?php echo $records[$model]['address'];?>
			</td><?php */?>
			<td  align="left" ><a href='mailto:<?php echo $records[$model]['email'];?>'>
				<?php echo $records[$model]['email'];?> </a>
			</td>
				
			<td  align="left">
				<?php echo $records[$model]['created']; ?>

			</td>
	
			
			<td >
			
			
			<?php echo $this->Html->link('<i class="fa fa-key"></i> '.__('Change Password',true), array('plugin' => 'usermgmt','controller' => 'usermgmt','action' => 'change_password',$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false)); ?>
			<a href='javascript::void(0)' onclick='return delete_user("Are you sure you want to delete this user ?",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="Click here to delete."><i class="fa fa-trash-o"></i><?php echo __(" Delete");?></a>
			<?php if($records[$model]['status'] == 1) { ?>
							<a href='javascript::void(0)' onclick='return show_message("Are you sure you want to inactive this user?",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='btn btn-info' data-toggle="tooltip" data-placement="top" title="Click here to inactive."><i class="fa  fa-thumbs-up"></i><?php echo __(" Active"); ?></a>
						
						<?php }else { ?>
							<a href='javascript::void(0)' onclick='return show_message("Are you sure you want to active this user?",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="Click here to Active."><i class="fa fa-thumbs-down"></i><?php echo __(" Inactive"); ?></a>


						<?php } ?>
			</td>
		</tr>
      <?php //if($i=='10'){echo "a";exit;}?>
		<?php
			$i++;
			} 
			?><tr><td align="right" colspan="9" >&nbsp;</td></tr>
			</tbody>
			  </table>
			 <!--paging information-->
		<?php echo $this->element('pagination');
		} else { ?>
		<tr>
		<td align="center" style="text-align:center;" colspan="9" class=""><?php echo __('No Result Found'); ?></td>
		</tr>
	  <?php } ?>        
 
   </td>
    </tr>
	</thead> 
</table>

<script>

var checkboxes = $("input[type='checkbox']"),
    submitButt = $("input[type='submit']");

checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});
$('#selectall').click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
						
          $('.case').attr('checked', this.checked);
		  if($(".case:checked").length==0)
			{
				 $('input[type="submit"]').attr('disabled','disabled');
			};	
		   
    });
	
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
</script>
<style>
.input-medium {
    height: 30px;
    margin: 7px 2px;
}
#dvData{display:none;}
</style>
<?php //pr($result); ?>

<div id="dvData">
  <table>
   <tr>
      <td>SN</td>
      <td>Name</td>
      <td>Phone</td>
	  <td>Email</td>
	  <td>Facebook id</td>
	  <td>Age</td>
	  <td>address</td>
	 
	  <td>Created</td>
	
    </tr>
  	<?php 
	if( !empty($result) ) {
	$i =  1; 	
	foreach( $result as $records ) { 
		?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $records[$model]['name']; ?></td>
      <td><?php echo $records[$model]['phone']; ?></td>
      <td><?php echo $records[$model]['email']; ?></td>
      <td><?php echo $records[$model]['fbid']; ?></td>
      <td><?php echo $records[$model]['age']; ?></td>
      <td><?php echo $records[$model]['address']; ?></td>
     
      <td><?php echo $this->Time->format( 'm/d/Y h:i A',$records[$model]['created'],null,"CST"); ?></td>

     
    </tr>
   <?php 
   $i++;
			} 
	}
			?>
  </table>
</div>
<script>
$(document).ready(function() {

  function exportTableToCSV($table, filename) {

    var $rows = $table.find('tr:has(td)'),

      // Temporary delimiter characters unlikely to be typed by keyboard
      // This is to avoid accidentally splitting the actual contents
      tmpColDelim = String.fromCharCode(11), // vertical tab character
      tmpRowDelim = String.fromCharCode(0), // null character

      // actual delimiter characters for CSV format
      colDelim = '","',
      rowDelim = '"\r\n"',

      // Grab text from table into CSV formatted string
      csv = '"' + $rows.map(function(i, row) {
        var $row = $(row),
          $cols = $row.find('td');

        return $cols.map(function(j, col) {
          var $col = $(col),
            text = $col.text();

          return text.replace(/"/g, '""'); // escape double quotes

        }).get().join(tmpColDelim);

      }).get().join(tmpRowDelim)
      .split(tmpRowDelim).join(rowDelim)
      .split(tmpColDelim).join(colDelim) + '"';

    // Deliberate 'false', see comment below
    if (false && window.navigator.msSaveBlob) {

      var blob = new Blob([decodeURIComponent(csv)], {
        type: 'text/csv;charset=utf8'
      });

      // Crashes in IE 10, IE 11 and Microsoft Edge
      // See MS Edge Issue #10396033
      // Hence, the deliberate 'false'
      // This is here just for completeness
      // Remove the 'false' at your own risk
      window.navigator.msSaveBlob(blob, filename);

    } else if (window.Blob && window.URL) {
      // HTML5 Blob        
      var blob = new Blob([csv], {
        type: 'text/csv;charset=utf-8'
      });
      var csvUrl = URL.createObjectURL(blob);

      $(this)
        .attr({
          'download': filename,
          'href': csvUrl
        });
    } else {
      // Data URI
      var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

      $(this)
        .attr({
          'download': filename,
          'href': csvData,
          'target': '_blank'
        });
    }
  }

  // This must be a hyperlink
  $(".export").on('click', function(event) {
    // CSV
    var args = [$('#dvData>table'), 'export.csv'];

    exportTableToCSV.apply(this, args);

    // If CSV, don't do event.preventDefault() or return false
    // We actually need this to be a typical hyperlink
  });
});
</script>