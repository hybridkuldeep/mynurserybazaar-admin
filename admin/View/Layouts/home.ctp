
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <?php echo $this->Html->charset(); ?>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <title><?php echo Configure::read('Site.title'); //$cakeDescription ?>:<?php echo $title_for_layout; ?></title>
    <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('bootstrap.min.css','bootstrap-responsive.min.css','plugins/icheck/all.css','style.css','themes.css'));
		echo $this->Html->script(array('jquery.js','plugins/nicescroll/jquery.nicescroll.min.js','plugins/validation/jquery.validate.min.js','plugins/validation/additional-methods.min.js','plugins/icheck/jquery.icheck.min.js','bootstrap.min.js','eakroko.js'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo WEBSITE_URL ; ?>img/logo1.png" />
<!--[if lte IE 9]>
		<script src="<?php echo WEBSITE_URL; ?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
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
  <style type="text/css">

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
<body  class='login'>
	<div class="wrapper">
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
