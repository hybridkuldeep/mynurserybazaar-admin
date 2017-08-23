<!DOCTYPE html>
<html>
    <head>
	  <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array("bootstrap.min","font-awesome.min","ionicons.min","morris/morris","jvectormap/jquery-jvectormap-1.2.2","fullcalendar/fullcalendar","daterangepicker/daterangepicker-bs3","bootstrap-wysihtml5/bootstrap3-wysihtml5.min","AdminLTE","datatables/dataTables.bootstrap"));
		
	?>
	
        <meta charset="UTF-8">
        <title>MyNurseryBazaar | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- font Awesome -->
       
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php echo $this->element('header'); ?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
		<?php echo $this->element('menu'); ?>            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
						    <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $user; ?>
                                    </h3>
                                    <p>
                                        Nursery
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                
									<?php echo $this->Html->link('More info<i class="fa fa-arrow-circle-right"></i>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'employee'),array("class"=>"small-box-footer",'escape'=>false ));?>
                                     
									
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $user3; ?>
                                    </h3>
                                    <p>
                                        User
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                
									<?php echo $this->Html->link('More info<i class="fa fa-arrow-circle-right"></i>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'customer'),array("class"=>"small-box-footer",'escape'=>false ));?>
                                     
									
                            </div>
                        </div>
                        <!-- ./col -->
                     	<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $fb_user; ?>
                                    </h3>
                                    <p>
                                        Facebook User
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
							<?php echo $this->Html->link('More info<i class="fa fa-arrow-circle-right"></i>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'customer'),array("class"=>"small-box-footer",'escape'=>false ));?>
                               
                            </div>
                        </div>
						
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $nfb_user; ?>
                                    </h3>
                                    <p>
                                        Direct User
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
							<?php echo $this->Html->link('More info<i class="fa fa-arrow-circle-right"></i>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'customer'),array("class"=>"small-box-footer",'escape'=>false ));?>
                               
                            </div>
                        </div>

						
						
                       </div><!-- /.row -->


                </section><!-- /.content -->
				
				   <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
						    <div class="col-lg-12 col-xs-12">
							
							<div id="top_x_div" style="height: 400px; width: 100%;"></div>
							
							  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		 google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
		['MyNursery', 'Percentage'],

         [ "Nurseray", <?php echo $user; ?> ],
         [  "User" ,<?php echo $user3; ?>],
						[  "Facebook user",<?php echo $fb_user; ?> ],
						[  "Direct user" ,<?php echo $nfb_user; ?>]
						
						
						
        ]);

        var options = {
          
          legend: { position: 'none' },
          chart: {
            title: "MyNurseryBazaar's Chart"
            },
         
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };

		
	</script>
							</div>
							</div>
							</section>
				
				<section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
					<div class="col-lg-12 col-xs-12"><h1>User Location</h1></div></div>
                    <div class="row">
						    <div class="col-lg-12 col-xs-12">
							<div id="map" style="height: 400px; width: 100%;"></div>
							
							
	 <script>
		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 2,
				center: {lat: 0, lng: 0}
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
		var infoWin = new google.maps.InfoWindow();
        var markers = locations.map(function(location, i) {
          //return new google.maps.Marker({
            //position: location,
            //label: labels[i % labels.length]
          //});
			var marker = new google.maps.Marker({
				position: location
			  });
			  google.maps.event.addListener(marker, 'click', function(evt) {
				infoWin.setContent(" "+location.full_name+" ");
				infoWin.open(map, marker);
			  })
			  return marker;
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      var locations = [
	  <?php foreach($umap as $k=>$v){ ?>{lat: <?php echo $v["lat"]; ?>, lng: <?php echo $v["lng"]; ?>, full_name: '<?php echo str_replace('"','',preg_replace('/[^A-Za-z0-9\- ]/', '',$v['full_name'])).'</br>'.str_replace('"','',preg_replace('/[^A-Za-z0-9\- ]/', '',$v['address'])).'</br>'.($v['fbid']=="" ? "Direct user":"FB user");  ?>'}<?php echo $k != (count($umap)-1) ? "," : ""; } ?>
		
        ]
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBAhUnb4-h0oOH4wnZ6xj3tDqSpolfy-X0 &callback=initMap"></script>
	 					</div>
							</div>
							</section>
				
				
				
					   <div class="row" style="width:50%;float:left;">
                        <!-- Left col -->
                        <section class="col-xs-12 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                      
                                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-cloud"></i>

                                    <h3 class="box-title">New Nursery</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                     <div class="box-body table-responsive">
                                    <table id="washroom" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Register</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($page_data as $data){ ?>
										   <tr>
                                                <td><?php echo $data["User"]["full_name"]; ?></td>
                                                <td><?php echo $data["User"]["email"]; ?></td>
                                                <td><?php echo $data["User"]["phone"]; ?></td>
                                                <td><?php echo $this->Time->format( 'm/d/Y h:i A', $data["User"]["created"],null,"CST"); ?></td>
                                            </tr>
										<?php } ?>
										</tbody>
										<tfoot>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Register</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                      
                             </div><!-- /.row - inside box -->
						</div><!-- /.row (main row) -->
                    <div class="row"  style="width:50%;float:right;">
                        <!-- Left col -->
                        <section class="col-xs-12 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                      
                                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-cloud"></i>

                                    <h3 class="box-title">New User</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                     <div class="box-body table-responsive">
                                    <table id="user" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Register</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($user_data as $data){ ?>
										   <tr>
                                                <td><?php echo $data["User"]["full_name"]; ?></td>
                                                <td><?php echo $data["User"]["email"]; ?></td>
                                                <td><?php echo $data["User"]["phone"]; ?></td>
                                                <td><?php echo $this->Time->format( 'm/d/Y h:i A', $data["User"]["created"],null,"CST"); ?></td>
                                            </tr>
										<?php } ?>
										</tbody>
										<tfoot>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Register</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                  
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                      
                                          </div><!-- /.row - inside box -->
                                </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
      
        <!-- jQuery UI 1.10.3 -->
       
        
       
<?php echo $this->Html->script(array("jquery.min","jquery-ui-1.10.3.min","bootstrap.min","//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min","plugins/morris/morris.min","plugins/sparkline/jquery.sparkline.min","plugins/jvectormap/jquery-jvectormap-1.2.2.min","plugins/jvectormap/jquery-jvectormap-world-mill-en","plugins/fullcalendar/fullcalendar.min","plugins/jqueryKnob/jquery.knob","plugins/daterangepicker/daterangepicker.js","plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min","plugins/iCheck/icheck.min","AdminLTE/app","AdminLTE/demo","plugins/datatables/jquery.dataTables","plugins/datatables/dataTables.bootstrap","canvasjs.min"));?>
 <script type="text/javascript">
           $(document).ready(function(){
              // var fd = $("#user").dataTable();
				fd.order([4, 'desc']).draw();
                $('#washroom').dataTable({
                   
                });
            });
</script>
	<script type="text/javascript">
jQuery(document).ready(function(){
$('#update_modified').on('click', function() {
$.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => false,'controller' => 'users','action' => 'update_modified')); ?>",
					success: function(r){
						$("#report_count").html("");
					}
                    
                });
}); 
}); 
  
</script>

    </body>
</html>