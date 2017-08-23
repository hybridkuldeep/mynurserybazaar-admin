<div class="box box-color box-bordered">
   <div class="box-content nopadding">
      <script type="text/javascript">
         $(document).ready(function() {
          $('#dTbl').dataTable({});
         
         } );
         
      </script>
      <table class="table table-hover table-nomargin dataTable table-bordered display" id="dTbl">
         <thead>
           <tr>
			<th style="background-color: #EEEEEE;" colspan="2">
				<div class="row-fluid"><h1><?php echo __("Calandars User follows",true); ?><div class="pull-right">
                 <?php 
				 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>".__('Back to Customer',true),array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'detail_customer',$this->request->params["pass"][0]),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				</div></h1></div>
			</th>
			</tr>
            <tr class='thefilter'>
               <th><?php echo __('Sr no.'); ?></th>
               <th><?php echo __('Calandar name'); ?></th>
            </tr>
         </thead>
         <tbody>
            <?php 
               if( !empty($data) ) {$model="Follower";
               	$i =  1; 	
               	foreach( $data as $records ) { 
               	
               	?>
            <tr id="driver_row_<?php echo $records[$model]['id']; ?>" >
               <td><?php echo $i; ?></td>
               <td class='hidden-1024'><?php echo $records[$model]['title']; ?></td>
            </tr>
            <?php $i++; } }  ?>	
         </tbody>
      
      </table>
   </div>
</div>