
<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th style="background-color: #EEEEEE;">
				<div class="row-fluid"><h1><?php echo __("Customer Detail",true); ?><div class="pull-right">
                 <?php 
				 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>".__('Back to Customer',true),array('action'=> 'customer'),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				</div></h1></div>
			</th>
		</tr>
		<tr>
			<td>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __(' Name',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['full_name'];?>
						</div>
					</div>
				</div>
				
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Location',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['address'];?>
						</div>
					</div>
				</div>
			   <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Email',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['email'];?>
						</div>
					</div>
				</div>

				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Facebook Id',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['fbid']== "" ? "Not a Facebook user" : $result[$model]['fbid'];?>
						</div>
					</div>
				</div>
				
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<label style="float:left;width:180px;">Last Login</label>
						<div class="input" style="margin-left:150px;" >	<?php echo "-";?></div>
					</div>
				</div>
			  <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<label style="float:left;width:180px;">Login Time</label>
						<div class="input" style="margin-left:150px;" >	<?php echo "-";?></div>
					</div>
				</div>
			  <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<label style="float:left;width:180px;">Profile Views</label>
						<div class="input" style="margin-left:150px;" >	<?php echo "-";?></div>
					</div>
				</div>
			  <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<label style="float:left;width:180px;">Messages</label>
						<div class="input" style="margin-left:150px;" > <?php echo $this->Html->link("0",array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'message_index',$this->request->params["pass"][0]),array('escape'=>false));	?> </div>
					</div>
				</div>
			  <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<label style="float:left;width:180px;">Comments</label>
						<div class="input" style="margin-left:150px;" >	
						 <?php echo $this->Html->link("0",array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'comment_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
			  
			  
			  
			  
			   <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __(' Calendars Followed',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
		
							 <?php echo $this->Html->link($Follower,array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'followed_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Calendars Shared on Follow My cal',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
						 <?php echo $this->Html->link($Share,array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'calendar_share_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
							
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Event Shared on Follow My cal',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
						 <?php echo $this->Html->link($eShare,array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'event_share_follow_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
							
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Events Liked',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							 <?php echo $this->Html->link($Like,array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'liked_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Events Shared',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $this->Html->link($CalendarEvent1[0][0]["count"],array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'event_share_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Events Shared on My cal',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
								<?php echo $this->Html->link($CalendarEvent3[0][0]["count"],array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'event_share__on_mycal_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
			   
			   <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Events added to My cal',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $this->Html->link($CalendarEvent2[0][0]["count"],array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'event_share__mycal_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
			   
			   <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Events Flagged',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							 <?php echo $this->Html->link($Flag,array('plugin'=>"usermgmt","controller"=>"usermgmt",'action'=> 'flag_index',$this->request->params["pass"][0]),array('escape'=>false));	?> 
						</div>
					</div>
				</div>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Status',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php if(!empty($result[$model]['status']))echo $result[$model]['status']==1?"Active":"Deactove";?>
						</div>
					</div>
				</div>
			
			  
			     
				
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.created', __(' Created',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['created'];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.modified', __(' Modified',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php if($result[$model]['created']==$result[$model]['modified'])echo "No Modification ";else echo $result[$model]['modified'];?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
		<td>
		<div id="chartContainer" style="height: 400px; width: 100%;"></div>
		<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "Basic User Chart"
				},
				data: [{
					type: "column",
					dataPoints: [
						{ y: <?php echo $Calendar; ?>, label: "Calendar" },
						{ y: <?php echo $feature_calendars+$local_calendars; ?>, label: "Premium calendar" },
						{ y: <?php echo $Public_Calendar; ?>, label: "Public calendar" },
						{ y: <?php echo $Private_Calendar; ?>, label: "Private calendar" },
						{ y: <?php echo $Event; ?>, label: "Event" },
						{ y: <?php echo $Flag; ?>, label: "Event flaged" },
						{ y: <?php echo $Like; ?>, label: "Event liked" },
						{ y: <?php echo isset($Payment[0]["tamount"]) ? $Payment[0]["tamount"] : 0 ; ?>, label: "Payment" }
						
					]
				}]
			});
			chart.render();
		}
	</script>
		</td>
		</tr>
		
	</thead> 
</table>