<script type="text/javascript">
$(function(){
	$("a.btn-danger").click(function(e){
		if(confirm('Are you sure you want to delete this setting?')){
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
      		<th style="background-color: #EEEEEE;">
              <div class="row-fluid">
               <h1>App Settings<div class="pull-right">
                 <?php 
			 echo $this->Html->link('<i class="icon-plus icon-white"></i> Add New Setting',array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));
			?> 
              </div></h1>
                </div>
              </th>
    		</tr>
    <tr>
      <td>    
      <div class="row-fluid">
<div class="span4">

<?php  echo $this->element('paging_info'); ?>
</div>
<div class="span8">
	<div class=" pull-right">
		<?php echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array(
						'label' => false,
						'div' => false
					)));?>
 <?php echo $this->Form->text('title',array('placeholder'=>'Search By Title','class'=>'input-medium')); ?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> Search",array('class'=>'btn btn-primary','escape'=>false));?>
               &nbsp;&nbsp;
                <?php echo $this->Form->end();?></div>
                
</div>
          <table width="100%"  class="table table-bordered table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
 
   <tr style="height:30px;">
	<td width="8%" align="left" class="padleft_15px">
		<b><?php  echo $this->Paginator->sort('id','ID');?></b> 
	</td>
	<td width="20%" align="left" class="">
		<b><?php  echo $this->Paginator->sort('title','Title');?></b>
	</td>
	<td width="20%" align="left" class="">
		<b><?php  echo $this->Paginator->sort('key','Key');?></b>
	</td>
	<td width="20%" align="left" class="">
		<b><?php  echo $this->Paginator->sort('value','Value');?></b>
	</td>
	<td align="center" class=""><center><b>Action</b></center></td>
  </tr>
                <?php 
              if( !empty($result) ) {
				
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
					$key = $records['Setting']['key'];
					$keyE = explode('.', $key);
					$keyPrefix = $keyE['0'];
					if (isset($keyE['1'])) {
						$keyTitle = '.' . $keyE['1'];
					} else {
						$keyTitle = '';
					}
			  ?>
              <tr style="height:30px;" class="gallerytr">

                      <td  align="left" class="padleft_15px"><?php echo $records[$model]['id']; ?></td>
                       <td  align="left"><?php echo $records[$model]['title']; ?></td>
                      <td  align="left"><?php echo $this->Html->link($keyPrefix, array('controller' => 'settings', 'action' => 'index', 'p' => $keyPrefix)) . $keyTitle;   ?></td>
                      <td  align="left"><?php echo $this->Text->truncate($records['Setting']['value'], 20) ; ?></td>
                     
                      <td  align="center"><center>
					  <?php echo $this->Html->link('<i class="icon-pencil icon-white"></i> Edit', array('action' => 'edit',$records[$model]['id']),array('class'=>'btn btn-primary','escape' => false))?>&nbsp;
					  
					  <?php echo $this->Html->link('<i class="icon-trash icon-white"></i> Delete', array('action' => 'delete',$records[$model]['id']),array('class'=>'btn btn-danger','escape' => false))?>
					 </center>
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