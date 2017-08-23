<?php  echo $this->Html->script(array("jquery.geocomplete")); ?>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCpXTkCgemDGGIit8Pz897vhpSc19WirPQ "></script>
 
<?php 
	echo $this->Html->css(array('validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));

 ?>
 
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#CalendarFeaturedForm").validationEngine();
	});
</script>
<?php 
echo $this->Form->create($model, array('url' => array('plugin' => 'calendar','controller' => 'calendars', 'action' => 'featured')));
?>
<input type="hidden" name="data[Calendar][calendar_id]" value="<?php echo $id; ?>" / >
<table class="table table-bordered table-striped">
 <thead>
   <tr>
     <th style="background-color: #EEEEEE;">
		<div class="row-fluid">
				<!--heading-->
               <h1><?php echo __('Premium Services'); ?>
					<div class="pull-right">
                     <?php 
						echo $this->Html->link("<i class='fa fa-arrow-left'></i>&nbspBack To Calendar", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
					</div>
			  </h1>
        </div>
	</th>
  </tr>
  <tr>
    <td>
      <div class="row" style="padding:7px 33px;float:left;width:50%;">
										
								<div class="form-group <?php echo ($this->Form->error('title1'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Headline 1</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.title1', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".title1",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('desc1'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Descripton 1</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.desc1', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->textarea($model.".desc1",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('title2'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Headline 2</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.title2', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".title2",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('desc2'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Descripton 2</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.desc2', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->textarea($model.".desc2",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('title3'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Headline 3</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.title3', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".title3",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('desc3'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Descripton 3</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.desc3', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->textarea($model.".desc3",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('title4'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Headline 4</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.title4', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".title4",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('desc4'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Descripton 4</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.desc4', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->textarea($model.".desc4",array('class'=>'form-control  validate[required]'));  ?>
								</div>
								
								<div class="form-group <?php echo ($this->Form->error('startdate'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Start Date</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.startdate', array('wrap' => false) ); ?></label>
									 <?php echo $this->Form->text($model.".startdate",array('value'=>$this->Time->format( date("Y/m/d"),'%m/%d/%Y',"CST"),'class'=>'form-control  validate[required]',"readonly"));  ?>
                                    
								</div>
								
								
								<div class="form-group <?php echo ($this->Form->error('day_type'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">Type</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.day_type', array('wrap' => false) ); ?></label>
                                           <?php echo $this->Form->select($model.'.day_type',array('1'=>'Day','2'=>'Week','3'=>'Month'), array('class'=>"form-control",'empty' => false)); ?>
								</div>
								
								<?php 
								$a = array();
									for($i = 1; $i <= 30 ; $i++ ){
										$a[$i] = $i;
									}

								?>
								<div class="form-group <?php echo ($this->Form->error('no_of_days'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">No</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.no_of_days', array('wrap' => false) ); ?></label>
                                           <?php echo $this->Form->select($model.'.no_of_days',$a, array('class'=>"form-control",'empty' => false)); ?>
								</div>
								
								<div class="form-group <?php echo ($this->Form->error('expired'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Expired Date</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.expired', array('wrap' => false) ); $stop_date = date('Y-m-d H:i:s');
								 $da =  date("Y/m/d",strtotime($stop_date . ' +1 day'));
									?></label>
                                     <?php echo $this->Form->text($model.".expired",array('value'=>$this->Time->format( $da,'%m/%d/%Y',"CST"),'class'=>'form-control  validate[required]','readonly'));  ?>
								</div>
								
		
	<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->submit( __('Add',true),array('class'=>'btn btn-primary btn-size','div'=>false));?>
			<?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "index"), array("class" => "btn btn-info ", "escape" => false) ); 
			?>
		</div>
	</div>
   
   </div>
		<?php echo $this->Form->end(); ?>
	<!--add form end-->
  </td>
 </tr>
</thead>
</table>
<script>
      $(function(){
	  
	  $("#CalendarDayType, #CalendarStartdate, #CalendarNoOfDays").on("change",function(){
		CalendarDayType = $("#CalendarDayType").val();
		CalendarNoOfDays = $("#CalendarNoOfDays").val();
		day = 1;
		if(CalendarDayType == 1){
			day = CalendarNoOfDays
		}else if(CalendarDayType == 2){
			day = CalendarNoOfDays *7
		}else{
			day = CalendarNoOfDays *30
		}
		//alert(day)
		
		var dmy = $("#CalendarStartdate").val().split("/");        // "24/06/2011" should be pulled from $("#DatePicker").val() instead
var joindate = new Date(
    parseInt(dmy[2], 10),
    parseInt(dmy[0], 10) - 1,
    parseInt(dmy[1], 10)
);
//alert(joindate);                          // Fri Jun 24 2011 00:00:00 GMT+0500 (West Asia Standard Time) 
joindate.setDate(joindate.getDate() + parseInt(day)); // substitute 1 with actual number of days to add
//alert(joindate);                          // Sat Jun 25 2011 00:00:00 GMT+0500 (West Asia Standard Time)
/* alert(
    ("0" + joindate.getDate()).slice(-2) + "/" +
    ("0" + (joindate.getMonth() + 1)).slice(-2) + "/" +
    joindate.getFullYear()
); */
	$("#CalendarExpired").val(
	("0" + (joindate.getMonth() + 1)).slice(-2) + "/" +
	("0" + joindate.getDate()).slice(-2) + "/" +
    
    joindate.getFullYear())
	  })
	  
	  
	   var dateFormat = "mm/dd/yy",
      from = $( "#CalendarStartdate" )
        .datepicker({
			dateFormat:dateFormat,
          defaultDate: "+0d",
          changeMonth: true,
          changeYear: true,
		  minDate:"+0d",
          numberOfMonths: 1
        })
		//LOCATION
       
		
        
      });
    </script>