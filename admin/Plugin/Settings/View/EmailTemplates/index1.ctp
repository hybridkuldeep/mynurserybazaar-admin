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
//<![CDATA[
	$(function(){
		$("a.btn-danger").click(function(e){
			if(confirm('Are you sure you want to delete this Bad word?')){
			$(this).parents('tr.gallerytr').slideUp('slow').remove();
			//alert($(this).parents('tr').fadeOut().remove());
				$.ajax({url:$(this).attr('href')});
			}
				e.preventDefault();
		}); 
	});
//]]>
</script>
        <table class="table table-bordered table-striped">
 		 <thead>
    		<tr  >
      		<th style="background-color: #EEEEEE;">
              <div class="row-fluid">
               <h1>Bad Words<div class="pull-right">
                 <?php 
			 echo $this->Html->link('<i class="icon-plus icon-white"></i> Add Bad Words',array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));
			?> 
              </div></h1>
                
                
                
               
                </div>
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
 <?php echo $this->Form->text('bad_word',array('placeholder'=>'Search By Bad word','class'=>'input-medium')); ?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> Search",array('class'=>'btn btn-primary','escape'=>false));?>
               &nbsp;&nbsp;
                <?php echo $this->Form->end();?></div>
                
</div>
          <table width="100%"  class="table table-bordered table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
 
   <tr style="height:30px;">
	<td width="40%" align="left" class=""><b><?php  echo $this->Paginator->sort('word','Bad word');?></b></td>
	<td width="40%" align="left" class=""><b><?php  echo $this->Paginator->sort('replacement','Replacement');?></b></td>
	<td align="center" class=""><b>Action</b></td>
  </tr>
                <?php 
              if( !empty($result) ) {
				
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
			  ?>
              <tr style="height:30px;" class="gallerytr">
                       <td  align="left"><?php echo $records[$model]['word']; ?></td>
                      <td  align="left"><?php echo $records[$model]['replacement'];  ?></td>
                    
                      <td  align="center">
					  <?php echo $this->Html->link('<i class="icon-pencil icon-white"></i> Edit', array('action' => 'edit',$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false))?>&nbsp;
					  <?php echo $this->Html->link('<i class="icon-trash icon-white"></i> Delete', array('action' => 'delete',$records[$model]['id']),array('class'=>'btn btn-danger','escape' => false))?>					 
					  </td>
              </tr>
              <?php
					$i++;
					} ?>
					  <tr><td align="right" colspan="6" class="border_right">  <?php echo $this->Html->image('dot.gif',array('height'=>10,'width'=>'1'));?> </td></tr></table>
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