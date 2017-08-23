<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      
<?php // echo $this->Html->css(array("bootstrap.min","font-awesome.min","ionicons.min","AdminLTE","jquery-ui"));
		// echo $this->Html->script(array("jquery.min","jquery-ui.min","bootstrap","bootstrap.min","AdminLTE/app"));
 ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		      
<?php 
echo $this->Html->script(array("jquery.min","jquery-ui.min","bootstrap.min","plugins/sparkline/jquery.sparkline.min","plugins/jvectormap/jquery-jvectormap-1.2.2.min","plugins/jvectormap/jquery-jvectormap-world-mill-en","plugins/fullcalendar/fullcalendar.min","plugins/jqueryKnob/jquery.knob","plugins/daterangepicker/daterangepicker.js","plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min","plugins/iCheck/icheck.min","AdminLTE/app","AdminLTE/demo","plugins/datatables/jquery.dataTables","plugins/datatables/dataTables.bootstrap","canvasjs.min"));
echo $this->Html->css(array("bootstrap.min","font-awesome.min","ionicons.min","morris/morris","jvectormap/jquery-jvectormap-1.2.2","fullcalendar/fullcalendar","daterangepicker/daterangepicker-bs3","bootstrap-wysihtml5/bootstrap3-wysihtml5.min","AdminLTE","jquery-ui","datatables/dataTables.bootstrap"));
?>
	
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
      <?php echo $this->element('header'); ?>
	  <div class="wrapper row-offcanvas row-offcanvas-left">
           <?php echo $this->element('menu'); ?>
            <!-- Left side column. contains the logo and sidebar -->
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
						<?php echo $this->Session->Flash(); ?>
						<?php echo $this->fetch('content'); ?>
				</section><!-- /.content -->
            </aside><!-- /.right-side -->
			<?php //echo $this->element('sql_dump'); ?>
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
   
        <!-- AdminLTE App -->
      

    </body>
	<script type="text/javascript">
	// <![CDATA[
	$(function(){
		//$("#CountryStatus,.lstfld60,#StateCountryId,#StateStatus,#CityCountryId").chosen();
		$(".close").on('click',function(){
			$(".alert-message").fadeOut();
			
		});
	});
	//]]>
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
</html>