<?php 
	pr($Email_constant); die;
	$opt	=	"";
	foreach($Email_constant as $email)
	{
		$opt.="<option value='".$email."'>".$email."</option>";
	}		
	echo $opt;
?>