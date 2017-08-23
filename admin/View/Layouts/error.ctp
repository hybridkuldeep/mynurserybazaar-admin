<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!--><!--<![endif]-->
<html>
<head>
<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo Configure::read('Site.title'); ?></title>
 		<meta name="keywords" content="<?php echo Configure::read('Meta.keyword'); ?>" />
		<meta name="description" content="<?php echo Configure::read('Meta.description'); ?>">
</head>

<body>
<div style='text-align:center; padding-top:100px'>
		<?php echo $this->Html->image('notfound.jpg',array('alt'=>Configure::read('Site.title'))); ?>
</div>	
</body>
</html>