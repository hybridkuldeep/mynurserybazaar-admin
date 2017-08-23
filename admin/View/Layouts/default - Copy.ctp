<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <?php echo $this->Html->charset(); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <title><?php echo Configure::read('Site.title'); //$cakeDescription ?>:<?php echo $title_for_layout; ?></title>
     <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('bootstrap.min.css','bootstrap-responsive.min.css','plugins/jquery-ui/smoothness/jquery-ui.css','plugins/jquery-ui/smoothness/jquery.ui.theme.css','plugins/pageguide/pageguide.css','plugins/fullcalendar/fullcalendar.css','plugins/fullcalendar/fullcalendar.print.css','plugins/chosen/chosen.css','plugins/select2/select2.css','plugins/icheck/all.css','style.css','themes.css','plugins/datatable/TableTools.css','plugins/colorbox/colorbox.css','plugins/gritter/jquery.gritter.css','plugins/chosen/chosen.css','plugins/timepicker/bootstrap-timepicker.min','custom.css'));
		
		echo $this->Html->script(array('jquery.js'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
<!--[if lte IE 9]>
		<script src="<?php echo WEBSITE_URL ; ?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
<style type="text/css">
	body {
		padding-top: 0px;
		padding-bottom: 40px;
	}

	.alert-message.danger, .alert-message.danger:hover, .alert-message.error, .alert-message.error:hover, .alert-message.success, .alert-message.success:hover, .alert-message.info, .alert-message.info:hover {
		color: #FFFFFF;
	}
	.alert-message .close {
		font-family: Arial,sans-serif;
		line-height: 18px;
	}
	.alert-message.danger, .alert-message.error {
		background-color: #C43C35;
		background-image: -moz-linear-gradient(center top , #EE5F5B, #C43C35);
		background-repeat: repeat-x;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		padding:7px 2px 2px 16px;
	}
	.alert-message.success {
		background-color: #57A957;
		background-image: -moz-linear-gradient(center top , #62C462, #57A957);
		background-repeat: repeat-x;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
	}
	.alert-message.info {
		background-color: #339BB9;
		background-image: -moz-linear-gradient(center top , #5BC0DE, #339BB9);
		background-repeat: repeat-x;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
	}
</style>
	
	<link rel="shortcut icon" href="<?php echo $this->webroot;?>img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot;?>img/apple-touch-icon-precomposed.png" />
	
   
	<script type="text/javascript">
	// <![CDATA[
	$(function(){
		$(".close").live('click',function(){
			$(".alert-message").fadeOut();
			
			
		});
	});
	//]]>
	</script>
  <noscript>
    <meta http-equiv="refresh" content="0;URL=<?php echo WEBSITE_ADMIN_URL;?>noscript">
</noscript>  
    </head>
	
<body data-layout="fixed">

<div id="navigation">
		<?php echo $this->element('navigation'); ?>
</div>
<div>
	<p class="container-fluid"> <?php 
if(isset($_SESSION['failed'])){
	?>
	<div class="alert-message error">
	<a class="close" href="javascript::void(0)">×</a>
	<p><?php echo $_SESSION['failed'];?></p>
	</div>
	<?php
	unset($_SESSION['failed']);
}	
 ?></p>
</div>

<div class="container" id="content">	
<?php echo $this->element('dashboard_left'); ?>
<div id="main">
	<div class="container-fluid">
		<?php echo $this->element('page_header_title'); ?>
		<?php echo $this->fetch('content'); ?>
	</div>

	<?php //echo (isset($breadcrumb) ) ? $this->element('breadcrumb',$breadcrumb): ''; ?>

	<?php //echo $this->fetch('content'); ?>
	<?php 
		$footers = $this->requestAction('users/footer');
	?>
     
</div>

	
</div>
 <footer>
			<p><?php  echo $footers['copyright_text']['Setting']['value']; ?></p>
	  
	  </footer>
<?php echo $this->element('sql_dump'); ?>
<?php 
echo $this->Html->script(array('jquery.js','jquery-ui','plugins/nicescroll/jquery.nicescroll.min.js','plugins/jquery-ui/jquery.ui.core.min.js','plugins/jquery-ui/jquery.ui.widget.min.js','plugins/jquery-ui/jquery.ui.mouse.min.js','plugins/jquery-ui/jquery.ui.draggable.min.js','plugins/jquery-ui/jquery.ui.resizable.min.js','plugins/jquery-ui/jquery.ui.sortable.min.js','plugins/touch-punch/jquery.touch-punch.min.js','plugins/slimscroll/jquery.slimscroll.min.js','bootstrap.min.js','application.min.js','plugins/datatable/jquery.dataTables.min.js','plugins/datatable/TableTools.min.js','plugins/datatable/ColReorderWithResize.js','plugins/datatable/ColVis.min.js','plugins/datatable/jquery.dataTables.columnFilter.js','plugins/datatable/jquery.dataTables.grouping.js','plugins/icheck/jquery.icheck.min.js','demonstration.min.js','plugins/chosen/chosen.jquery.min.js','plugins/bootbox/jquery.bootbox.js','plugins/jquery-ui/jquery.ui.datepicker.min.js',"plugins/timepicker/bootstrap-timepicker.min.js",'plugins/form/jquery.form.min','plugins/validation/jquery.validate.min','plugins/validation/additional-methods.min','plugins/imagesLoaded/jquery.imagesloaded.min','plugins/colorbox/jquery.colorbox-min','plugins/masonry/jquery.masonry.min','plugins/imagesLoaded/jquery.imagesloaded.min','plugins/gritter/jquery.gritter.min','eakroko.min.js'));


?>

		
<script>
$(function(){
		$.datepicker.setDefaults({dateFormat: 'dd-mm-yy',yearRange: '-100:+100'});
		
		$("select[id$=District]").live('change',function(){
			$.ajax({
				'url':"<?php echo $this->Html->url(array('plugin'=>false,'controller'=>'pages','action'=>'get_county'));?>/"+$(this).val(),
				'type':'post',
				'dataType':'json',
				'success':function(county_list){
					options	="<option value=''><?php echo __('Select County');?></option>";
					$.each(county_list, function(value,name){
						options+="<option value='"+value+"'>"+name+"</options>";
					});
					$("select[id$=County]").html(options);
				}
			});
			
		});
		

});
</script>
</body>
</html>
