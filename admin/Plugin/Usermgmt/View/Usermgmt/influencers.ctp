<div class="box box-color box-bordered">
   <div class="box-content nopadding">
      <script type="text/javascript">
         $(document).ready(function() {
          $('#dTbl').dataTable({});
         
         } );
         
      </script>
	  <style>
	  #dTbl_filter{
	  margin-top: 21px;
	  }
	  </style>
	  
      <table class="table table-hover table-nomargin dataTable table-bordered display" id="dTbl">
         <thead>
           <tr>
			<th style="background-color: #EEEEEE;" colspan="6">
				<div class="row-fluid"><h1><?php echo __("Influencers",true); ?><div class="pull-right">
                 <?php 
				 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>".__('Back to Customer',true),array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'customer'),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				</div></h1></div>
			</th>
			</tr>
            <tr class='thefilter'>
               <th><?php echo __('Sr no.'); ?></th>
              <th><?php echo __(' Customer name'); ?></th>
			    <th><?php echo __(' Profile visits'); ?></th>
				<th><?php echo __('Calendar shared'); ?></th>
               <th><?php echo __('Comments on calandars'); ?></th>
			     <th><?php echo __('Event shared'); ?></th>
            </tr>
         </thead>
         <tbody>
            <?php 
               if( !empty($data) ) {$model="users";
               	$i =  1; 	
               	foreach( $data as $records ) { 
               //	pr($records);
               	?>
            <tr id="driver_row_<?php echo $records[$model]['id']; ?>" >
               <td><?php echo $i; ?></td>
               <td class='hidden-1024'><?php echo $this->Html->link($records[$model]['full_name'],array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'detail_customer',$records[$model]['id']));?></td>
               <td><?php echo "-"; ?></td>
			  
               <td class='hidden-1024'><?php echo $records[0]['cal_share_count']; ?></td>
			   <td><?php echo "-"; ?></td>
			    <td class='hidden-1024'><?php echo $records[0]['share_count']; ?></td>
            </tr>
            <?php $i++; } }  ?>	
         </tbody>
      
      </table>
   </div>
</div>