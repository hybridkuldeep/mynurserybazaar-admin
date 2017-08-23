<?php
class ImageHelper extends AppHelper{
	
	var $helpers = array('Html');
	function image($file_path,$file_name,$image_width,$image_height,$image_para){
		
		
		$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',$image_width,$image_height,base64_encode($file_path),$file_name),true);
			
		if(is_file($file_path . $file_name)) {
			echo $this->Html->image($image_url,$image_para);				
		}else {
			echo $this->Html->image('no_image.jpg',array('width'=>$image_width.'px','height'=>$image_height.'px'));
		} 
	}	
	function image_link($file_path,$file_name,$image_width,$image_height,$bigimage_width,$bigimage_height,$image_para,$link_para){
		
		
		$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',$image_width,$image_height,base64_encode($file_path),$file_name),true);
		
		$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',$bigimage_width,$bigimage_height,base64_encode($file_path),$file_name),true);
		
		if(is_file($file_path . $file_name)) {
			$images	= $this->Html->image($image_url,$image_para);	
			echo $this->Html->link($images,$big_image_url,array_merge($link_para,array('escape'=>false)));
		}else {
			echo $this->Html->image('no_image.jpg',array('width'=>$image_width.'px','height'=>$image_height.'px'));
		} 
	}	
}
?>