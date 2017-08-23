<?php
/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<script type="text/javascript">
$(function(){
	$("a.btn-danger").click(function(e){
		if(confirm('Are you sure you want to delete this template?')){
		$(this).parents('tr.gallerytr').slideUp('slow').remove();
			$.ajax({
				url:$(this).attr('href'),
				success:function(r)
				{
					window.location.reload();
				}
			});
		}
	 	e.preventDefault();
	});
});
</script>
        <table class="table table-bordered table-striped">
 		 <thead>
    		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid"><h1>Email Templates
			  <div class="pull-right" style="display:block;">
                 <?php 
				// echo $this->Html->link('<i class="icon-plus icon-white"></i> Add Action',array('action'=> 'addaction'),array('class'=>'btn btn-primary','escape'=>false));
				 
				 echo ' '.$this->Html->link('<i class="icon-plus icon-white"></i> Add',array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));
				?> 
              </div></h1></div>
              </th>
    		</tr>
    <tr >
      <td>
      
      <div class="row-fluid">
<div class="span4">

<?php  echo $this->element('paging_info'); ?>
</div>
<div class="span8"><div class=" pull-right"><?php echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array(
        'label' => false,
        'div' => false
    )));?>
 <?php echo $this->Form->text('name',array('placeholder'=>'Search By Name','class'=>'input-medium')); ?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> Search",array('class'=>'btn btn-primary','escape'=>false));?>
               &nbsp;&nbsp;
                <?php echo $this->Form->end();?></div>
                
</div>
          <table width="100%"  class="table table-bordered table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
 
   <tr style="height:30px;">
	
	<td align="left" width="20%"><?php  echo $this->Paginator->sort('name','Name',array('char'=>true));?></td>
	<td align="left" width="15%"><?php  echo $this->Paginator->sort('subject','Subject',array('char'=>true));?></td>
	<td align="left" width="15%"><?php  echo $this->Paginator->sort('action','Action',array('char'=>true));?></td>
	<td  align="left" width="10%"><?php  echo $this->Paginator->sort('modified','Modified',array('char'=>true));?></td>
	<td align="left" width="10%"><?php  echo $this->Paginator->sort('created','Created',array('char'=>true));?></td>
	<td align="center" width=""><center>Action</center></td>
  </tr>
                <?php 
              if( !empty($result) ) {
				
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
			  ?>
                           <tr style="height:30px;" class="gallerytr">
				  <td  align="left" class="">
					     <?php echo $records[$model]['name'];?>
                  </td>
				  <td  align="left" class="">
					 <?php echo $records[$model]['subject'];?>
				  </td>
				   <td  align="left" class="">
					 <?php echo $records[$model]['action'];?>
				  </td>
				  
				  <td  align="left">
					<?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['modified']));  ?>
				  </td>
                  <td  align="left">
						<?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['created']));  ?>
				  </td>
                  <td align="center"> <center>
					<?php echo $this->Html->link('<i class="icon-pencil icon-white"></i> Edit', array('plugin' => 'settings','controller' => 'emailtemplates','action' => 'edit',$records[$model]['id']),array('class'=>'btn btn-primary','onclick' => 'return InsertHTML()','escape' => false));
					echo ' '.$this->Html->link('<i class="icon-trash icon-white"></i> Delete', array('plugin' => 'settings','controller' => 'emailtemplates','action' => 'delete',$records[$model]['id']),array('class'=>'btn btn-danger','escape' => false));
					?>&nbsp;
					</center>
				  </td>
              </tr>
              <?php
					$i++;
					} ?>
					  <tr><td align="right" colspan="7" class="border_right">  <?php echo $this->Html->image('dot.gif',array('height'=>10,'width'=>'1'));?> </td></tr></table>
					  <?php echo $this->element('pagination'); ?> 
              <?php } 
			 		else { ?>
               <tr>
                <td align="center" style="text-align:center;" colspan="6" class="border_right"> No Result Found </td>
              </tr></table>
              <?php } ?>
        
      </td>
    </tr>
  </thead>
 
</table>