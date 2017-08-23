<?php 
	$paginator	=	$this->Paginator;
	if ( !isset($queryString) )
		$queryString = '';
	
	$options = array('class'=>'p_numbers','separator'=> '');
	
	//echo $paginator->numbers(array('modulus' => '3', 'class'=>'paging', 'separator'=>'&nbsp;', 'queryString' => $queryString));
?>

<script type="text/javascript">
// <![CDATA[
/*$(function() {
	
	$( ".first_disabled, #p_first" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-start"
			}
		}).click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		});
		
		$( "#p_prev, .prev_disabled" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-prev"
			}
		}).click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		});
		
			$( "#p_next, .next_disabled" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-next"
			}
		}).click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		});
		
		$( "#p_last" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-end"
			}
			}).click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		});
		
		$(".p_numbers").button().click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		});

	
		$("span.current").button().click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		});
		$("span.current").addClass("ui-state-active").click(function(){
			if(typeof(this.href) !='undefined'){
				return loadContent(this.href);
			}
		}); 
		
		
		});
	*/	
	
//]]>	
</script>
<?php
$pages	=	$paginator->counter(array('format' => '%pages%')); 
$current_page	=	$paginator->counter(array('format' => '%page%')); 
if($pages>1){
 ?>
<div class="pagination pagination-right dataTables_paginate paging_bootstrap"  ><ul class="pagination">
<?php 
	echo $paginator->first(__('First', true), array('id'=> 'p_first','tag'=>'li'), null, array('class'=>''));
if($current_page != 1)	echo $paginator->prev(__("&larr; Previous", true), array('id'=> 'p_prev','tag'=>'li','escape'=>false), null, array('class'=>'previous p_numbers','escape'=>false));
	echo $paginator->numbers($options,array('tag'=>'li','class'=>'active'));
if($current_page != $pages)	echo $paginator->next(__("Next &rarr;", true), array('id'=> 'p_next','tag'=>'li','escape'=>false), null, array('class'=>'current','escape'=>false));
	echo $paginator->last(__('Last', true), array('id'=> 'p_last','tag'=>'li'), null, array('class'=>''));
?></ul>
</div>
<?php 
}
?>