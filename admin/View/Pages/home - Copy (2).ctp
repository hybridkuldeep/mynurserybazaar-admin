<?php
	echo $this->Html->script(array('plugins/flot/jquery.flot.min.js','plugins/flot/jquery.flot.bar.order.min.js','plugins/flot/jquery.flot.pie.min.js','plugins/flot/jquery.flot.resize.min.js'));
 ?>	
<?php 
$year_revenue_keys	=	array_keys($year_revenue);
$weekly_revenue_keys	=	array_keys($weekly_revenue);


end($year_revenue);
$sly = prev($year_revenue);
$ly = end($year_revenue);
$year_increment	=	$ly-$sly;

end($month_revenue);
$sly = prev($month_revenue);
$ly = end($month_revenue);
$monthly_increment	=	$ly-$sly;
end($weekly_revenue);
$sly = prev($weekly_revenue);
$ly = end($weekly_revenue);
$weekly_increment	=	$ly-$sly;

 ?>
<script>
$year_increment	=	<?php echo $year_increment; ?>;
$monthly_increment	=	<?php echo $monthly_increment; ?>;
$weekly_increment	=	<?php echo $weekly_increment; ?>;
var  gmonthNames = ["<?php echo __('Jan'); ?>", "<?php echo __('Feb'); ?>", "<?php echo __('Mar'); ?>", "<?php echo __('Apr'); ?>", "<?php echo __('May'); ?>", "<?php echo __('Jun'); ?>", "<?php echo __('Jul'); ?>", "<?php echo __('Aug'); ?>", "<?php echo __('Sep'); ?>", "<?php echo __('Oct'); ?>", "<?php echo __('Nov'); ?>", "<?php echo __('Dec'); ?>"];
var data = [ <?php if(!empty($year_revenue)){ foreach($year_revenue as $y=>$revenue){ ?>[<?php echo mktime(0,0,0,1,1,$y).'000'; ?>, <?php echo $revenue; ?>]<?php if($y!=date('Y')){ echo ',';} } } ?>];

var mdata = [ <?php if(!empty($month_revenue)){ foreach($month_revenue as $m=>$revenue){ ?>[<?php echo mktime(0,0,0,$m,1,date('Y')).'000'; ?>, <?php echo $revenue; ?>]<?php if($m!=date('m')){ echo ',';} } } ?>];

var wdata = [ <?php if(!empty($weekly_revenue)){ foreach($weekly_revenue as $w=>$revenue){ ?>[<?php echo $w.'000'; ?>, <?php echo $revenue; ?>]<?php if($w<=time()){ echo ',';} } } ?>];

xaxis_options	=	{
							min: (new Date(<?php echo $year_revenue_keys[0]; ?>, 0, 0)).getTime(),
							max: (new Date(<?php echo max($year_revenue_keys); ?>, <?php echo date('n'); ?>, <?php  echo date('j'); ?>)).getTime(),
							mode: "time",
							tickSize: false,/* 
							tickSize: [12, "month"], */
							/* monthNames: ["<?php echo __('Jan'); ?>", "<?php echo __('Feb'); ?>", "<?php echo __('Mar'); ?>", "<?php echo __('Apr'); ?>", "<?php echo __('May'); ?>", "<?php echo __('Jun'); ?>", "<?php echo __('Jul'); ?>", "<?php echo __('Aug'); ?>", "<?php echo __('Sep'); ?>", "<?php echo __('Oct'); ?>", "<?php echo __('Nov'); ?>", "<?php echo __('Dec'); ?>"], */
							monthNames: false,
						};

						
 
						
 wxaxis_options	=	{
							min: (new Date(<?php echo date('Y',$weekly_revenue_keys[0]); ?>, <?php echo date('m',$weekly_revenue_keys[0]); ?>, <?php echo date('d',$weekly_revenue_keys[0]); ?>)).getTime(),
							max: (new Date(<?php echo date('Y'); ?>, <?php echo date('n')-1; ?>, <?php  echo date('j')-1; ?>)).getTime(),
							mode: "time",
							tickSize: [1, "month"],
							 monthNames: gmonthNames
						};
						
 mxaxis_options	=	{
							min: (new Date(<?php echo date('Y'); ?>, 0, 0)).getTime(),
							max: (new Date(<?php echo date('Y'); ?>, <?php echo date('n')-1; ?>, <?php echo date('j')-1; ?>)).getTime(),
							mode: "time",
							tickSize: [1, "month"],
							monthNames: gmonthNames
						};
						
 
$(document).ready(function(){

  /* var table = $('#example').DataTable({
    "bSortClasses": false
  }); */



console.log(data);
/* var data = [
			[1262304000000, 3300], [1264982400000, 2200], [1267401600000, 3600], [1270080000000, 5200], [1272672000000, 4500], [1275350400000, 3900], [1277942400000, 3600], [1280620800000, 4600], [1283299200000, 5300], [1285891200000, 7100], [1288569600000, 7800], [1291241700000, 8195]];
 */

						
			console.log(data);
// alert(lenght.data);

	$.plot($("#flot-audience"), [{ 
		label: "<?php echo __('Revenue'); ?>", 
		data: data,
		color: "#3a8ce5"
	}], {
		xaxis:  xaxis_options,
		series: {
			lines: {
				show: true, 
				fill: true
			},
			points: {
				show: true,
			}
		},
		grid: { hoverable: true, clickable: true },
		legend: {
			show: false
		}
	});

	$("#flot-audience").bind("plothover", function (event, pos, item) {
		if (item) {
			if (previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;

				$("#tooltip").remove();
				var y = item.datapoint[1].toFixed();

				showTooltip(item.pageX, item.pageY,
				            item.series.label + " = " + y);
			}
		}
		else {
			$("#tooltip").remove();
			previousPoint = null;            
		}
	});
});

function changeChart(type){
	
	if(type==2){
		console.log(mxaxis_options);
		console.log(mdata);
		
		$.plot($("#flot-audience"), [{ 
		label: "<?php echo __('Revenue'); ?>", 
		data: mdata,
		color: "#3a8ce5"
		}], {
			xaxis:  mxaxis_options,
			series: {
				lines: {
					show: true, 
					fill: true
				},
				points: {
					show: true,
				}
			},
			grid: { hoverable: true, clickable: true },
			legend: {
				show: false
			}
		});
		if($monthly_increment<0){
			$('#last_difference').html($monthly_increment+'<i class="icon-circle-arrow-down"></i>');
		}else{
			$('#last_difference').html($monthly_increment+'<i class="icon-circle-arrow-up"></i>');
		}
		
	
	}else if(type==3){
		
		$.plot($("#flot-audience"), [{ 
		label: "<?php echo __('Revenue'); ?>", 
		data: wdata,
		color: "#3a8ce5"
		}], {
			xaxis:  wxaxis_options,
			series: {
				lines: {
					show: true, 
					fill: true
				},
				points: {
					show: true,
				}
			},
			grid: { hoverable: true, clickable: true },
			legend: {
				show: false
			}
		});
		
		if($weekly_increment<0){
			$('#last_difference').html($weekly_increment+'<i class="icon-circle-arrow-down"></i>');
		}else{
			$('#last_difference').html($weekly_increment+'<i class="icon-circle-arrow-up"></i>');
		}
		
	}else if(type==1){
	
	$.plot($("#flot-audience"), [{ 
		label: "<?php echo __('Revenue'); ?>", 
		data: data,
		color: "#3a8ce5"
	}], {
		xaxis:  xaxis_options,
		series: {
			lines: {
				show: true, 
				fill: true
			},
			points: {
				show: true,
			}
		},
		grid: { hoverable: true, clickable: true },
		legend: {
			show: false
		}
	});
	
	if($year_increment<0){
			$('#last_difference').html($year_increment+'<i class="icon-circle-arrow-down"></i>');
		}else{
			$('#last_difference').html($year_increment+'<i class="icon-circle-arrow-up"></i>');
		}
	}
}
</script>
<div class="row-fluid">
<div class="span6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-bar-chart"></i>
									<?php echo __('Platform revenue'); ?>
								</h3>
								<div class="actions">
									
									<!--<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> -->
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<div class="statistic-big">
									<div class="top">
										<div class="left">
											<div class="input-medium">
												<select name="category" class='chosen-select' data-nosearch="true" onchange="javascript:changeChart($(this).val());">
													<option value="1"><?php echo __('Yearly'); ?></option>
													<option value="2"><?php echo __('Monthly'); ?></option>
													<option value="3"><?php echo __('Weekly'); ?></option>
												</select>
											</div>
										</div>
										<div class="right">
									<span id="last_difference"><?php echo ($year_increment<0)?($year_increment.'<i class="icon-circle-arrow-down"></i>'):($year_increment.'<i class="icon-circle-arrow-up"></i>'); ?></span> 
										</div>
									</div>
									<div class="bottom">
										<div class="flot medium" id="flot-audience"></div>
									</div><!--
									<div class="bottom">
										<ul class="stats-overview">
											<li>
												<span class="name">
													Visits
												</span>
												<span class="value">
													11,251
												</span>
											</li>
											<li>
												<span class="name">
													Pages / Visit
												</span>
												<span class="value">
													8.31
												</span>
											</li>
											<li>
												<span class="name">
													Avg. Duration
												</span>
												<span class="value">
													00:06:41
												</span>
											</li>
											<li>
												<span class="name">
													% New Visits
												</span>
												<span class="value">
													67,35%
												</span>
											</li>
										</ul>
									</div> -->
								</div>
							</div>
						</div>
					</div>


<div class="span6">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					<?php echo __('Last 10 Transaction'); ?>
				</h3>
				<div class="actions">
					<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
					<thead>
						<tr>
							<th><?php echo __('Username'); ?></th>
							<th><?php echo __('Order Id'); ?></th>
							<th class='hidden-1024'><?php echo __('Total Price'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
	if( !empty($trans) ) {
		$i =  1; 	
		foreach( $trans as $key=>$records ) { 
		//pr($records);
		?>
		<tr class="gallerytr">
			<td  align="left" >
				<?php echo $records['Transaction']['username'];?>
			</td>
			<td  align="left">
			<?php echo $records['Transaction']['order_id'];?>
			</td>
		
			<td  align="left">
			<?php echo $records['Transaction']['total_price'];?>
			</td>
		
		</tr>
      <?php
			$i++;
			} ?>
		<?php 
		} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div>
<div class="row-fluid">
<div class="span6">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					<?php echo __('Most Favourite Meal Plan'); ?>
				</h3>
				<div class="actions">
					<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
					<thead>
						<tr>
							<th><?php echo __('Image'); ?></th>
							<th><?php echo __('Meal Plan'); ?></th>
							<th><?php echo __('Food Type'); ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
	if( !empty($mealplandata) ) {
		$i =  1; 	
		foreach( $mealplandata as $key=>$records ) { 
		//pr($records);
		?>
		<tr class="gallerytr">
		
			<td  align="left" >
				<?php 
				$file_path    	= STORE_IMAGE_STORE_PATH;
				$file_name    	= $records['Mealplan']['image'];
				$image_title   	= ucfirst($records['Mealplan']['name_'.$lang]);
				$this->Image->image_link($file_path,$file_name,30,30,400,400,array('alt'=>$image_title,'title'=>$image_title),array('class'=>'colorbox-image','rel'=>"group-1"));
			?>
			</td>
			<td  align="left" >
				<?php echo $records['Mealplan']['name_'.$lang];?>
			</td>
			<td  align="left">
			<?php echo $records['Mealplan']['foodtype'];?>
			</td>
		</tr>
      <?php
			$i++;
			} ?>
		<?php 
		} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
<div class="span6">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					<?php echo __('Last 10 Subscription'); ?>
				</h3>
				<div class="actions">
					<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
					<thead>
						<tr>
							<th><?php echo __('Username'); ?></th>
							<th><?php echo __('Supermarkets'); ?></th>
							<th><?php echo __('MealPlan'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
	if( !empty($subscriptionadata) ) {
		$i =  1; 	
		foreach( $subscriptionadata as $key=>$records ) { 
		//pr($records);
		?>
		<tr class="gallerytr">
			<td  align="left" >
			<?php echo $records['Subscription']['username'];?>
			</td>
			<td  align="left">
			<?php echo $records['Subscription']['supermarket'];?>
			</td>
			<td  align="left">
			<?php echo $records['Subscription']['mealplan'];?>
			</td>
			
		
		</tr>
      <?php
			$i++;
			} ?>
		<?php 
		} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<div class="row-fluid">
					<div class="span12">
					
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									<?php echo __('Last 10 Customers',true); ?>
									</h3>
									<div class="actions">
				
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
									<div class="pull-right">
										<?php 
										//echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
										?> 
										<?php 
										 // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));	
										 // echo '&nbsp;';
										 // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));	
									?> 
									  </div>
								
							</div>
							<div class="box-content nopadding">
			
<table width="100%"  class="table table-hover table-nomargin dataTable table-bordered" align="center" border="0" cellspacing="0" cellpadding="0">
<thead>
		<tr>
			
			<th class='hidden-480'><?php echo __('User Photo'); ?></th>
			<th><?php echo __('Username'); ?></th>
			<th><?php echo __('Email'); ?></th>
			<th class='hidden-1024'><?php echo __('Created'); ?></th>
		</tr>
	</thead>
   <tbody >
	<?php 
	if( !empty($cuserdata) ) {
		$i =  1; 	
		foreach( $cuserdata as $key=>$records ) { 
		//pr($records);
		?>
		<tr class="gallerytr">
		<td  align="left" >
			<?php 
				if(isset($records['User']['user_image_folder'])) {
				$file_path    = USER_IMAGE_STORE_PATH.$records['User']['user_image_folder'].DS ;
				$file_name    = $records['User']['user_image'];
				$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',30,30,base64_encode($file_path),$file_name),true);
					$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
				if(is_file($file_path . $file_name)) {
					$images = $this->Html->image($image_url,array('alt' => $records['User']['first_name'],'title' => $records['User']['first_name']));
				?>
				<a class='colorbox-image' rel="group-1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records['User']['first_name']); ?>'>
				<?php echo $images; ?>
				</a>
				<?php					
				}else {
					echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
				}  
				}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					}	
			?>
			</td>
			
			<td  align="left" >
				<?php echo $records['User']['username']; ?>
			</td>
			<td  align="left" ><a href='mailto:<?php echo $records['User']['email'];?>'>
				<?php echo $records['User']['email'];?> </a>
			</td>
			
			<td  align="left">
				<?php echo date(Configure::read('date_format.basic'),strtotime($records['User']['created']));  ?>
			</td>
			
		
		</tr>
      <?php
			$i++;
			} ?>
		<?php 
		} ?>
		</tbody>
	</table>
								
			</div>
		</div>
	</div>
</div>