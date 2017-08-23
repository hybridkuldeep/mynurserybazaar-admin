<?php  echo $this->Html->script(array("jquery.geocomplete")); ?>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCpXTkCgemDGGIit8Pz897vhpSc19WirPQ "></script>
 
<?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5','validationEngine.jquery'));
	echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5','jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#UsermgmtEditCustomerForm").validationEngine();
			value		=	$('#UsermgmtType').val();
			if(value == 'Individual'){
				$('#company_name_div').hide();
			}else if(value == 'Company') {
				$('#company_name_div').show();
			}else{
				$('#company_name_div').hide();
			}
		
		
		$('#UsermgmtType').on('change',function(){
		
			value		=	$(this).val();
			if(value == 'Individual'){
				$('#company_name_div').hide();
			}else if(value == 'Company') {
				$('#company_name_div').show();
			}else{
				$('#company_name_div').hide();
			}
		})
		
		$("#single_1").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
		
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Edit User'); ?>
            <div class="pull-right">
               <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __('Back To User',true)."", array("action" => "employee"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt','controller' => 'usermgmt', 'action' => 'edit_customer',$id),'enctype' => 'multipart/form-data')); 
				echo $this->Form->hidden('id');
		  ?>
	   <div class="row" style="padding:7px 33px;float:left;width:50%;">
										
								<div class="form-group <?php echo ($this->Form->error('full_name'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Name</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.full_name', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".full_name",array('class'=>'form-control validate[required]'));  ?>
								</div>
						<?php		/* <div class="form-group <?php echo ($this->Form->error('language'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Language</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.language', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->select($model.'.language', array('1' => 'French', '0' => 'English'), array('class'=>'form-control  validate[required]','empty' => false)); ?>
								</div> */
							?>
								
						 <div class="form-group <?php echo ($this->Form->error('email'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Email</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.email', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".email",array('class'=>'form-control  validate[required,custom[email]]]', 'readonly' ));  ?>
								</div> 
						<?php		/*		<div class="form-group <?php echo ($this->Form->error('gender'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">gender</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.gender', array('wrap' => false) ); ?></label>
                                     <?php  echo $this->Form->input($model.'.gender', array(
								 'div' => false,
								 'label' => false,
								 "separator"=>"&nbsp &nbsp &nbsp",
								 'type' => 'radio',
								 'legend' => false,
								 'options' => array("1"=>"Male","2"=>"Female"),
								 "class"=>"form-control"
								));       
					//$this->Form->radio($model.'.gender',array("1"=>"Male","2"=>"Female"), array("class"=>"validate[required]", "label"=>false,'separator'=>"<span>")); ?>
								</div>
								*/
						?>
								<div class="form-group <?php echo ($this->Form->error('phone'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Phone</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.phone', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".phone",array('class'=>'form-control  validate[custom[integer],minSize[10],maxSize[15]]'));  ?>
								</div>
							
								
		
							
									<div class="form-group <?php echo ($this->Form->error('address'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Address</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.address', array('wrap' => false) ); ?></label>
                                     <?php echo $this->Form->text($model.".address",array('class'=>'form-control  validate[]',"id"=>"geocomplete"));  ?>
									 <input type="hidden" name="data[Usermgmt][lat]" id="lat" value="">
									<input type="hidden" name="data[Usermgmt][lng]" id="lng" value="">
								</div>
								
							
								<div class="form-group <?php echo ($this->Form->error('status'))? 'has-error':'';?>">
											<label for="exampleInputEmail1">Status</label>
                                            <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.status', array('wrap' => false) ); ?></label>
                                           <?php echo $this->Form->select($model.'.status',array('1'=>'Active','0'=>'Inactive'), array('class'=>"form-control",'empty' => false)); ?>
								</div>
							 <div class="form-group <?php echo ($this->Form->error('image'))? 'has-error':'';?>">
									<label for="exampleInputEmail1">Image</label>
                                    <label class="control-label" for="inputError"><?php echo $this->Form->error($model.'.image', array('wrap' => false) ); ?></label>
                                    <?php echo $this->Form->file($model.".image",array('class'=>' validate[checkFileType[jpg|jpeg|png|gif]]'));  ?>
								</div>
								<div class="form-group <?php echo ($this->Form->error('image'))? 'has-error':'';?>">
									
							<?php 
					$file_path    = USER_IMAGE_STORE_PATH ;
					$file_name    = $this->request->data[$model]['image'];
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
						$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
					if(is_file($file_path . $file_name)) {
						echo $images = $this->Html->image($image_url);
					?>
					
					<?php					
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					} 
				?>
							
					
			</div>	
		  
		  
       
			
				
				<div>&nbsp;</div>
	<div class="clearfx">
	<!---add form action -->
		<div class="input" style="margin-left:150px;">
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?> <?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "customer"), array("class" => "btn", "escape" => false) ); 
			?>
		</div>
	</div>	
		
      </div>
  
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>
<script>
      $(function(){
	  
		//LOCATION
        $("#geocomplete").geocomplete()
          .bind("geocode:result", function(event, result){
			$("#lat").val(result.geometry.location.lat())
			$("#lng").val(result.geometry.location.lng())
            console.log(result.geometry.location.lng());
            console.log(result.geometry.location.lat());
          })
          .bind("geocode:error", function(event, status){
           // $.log("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
           // $.log("Multiple: " + results.length + " results found");
          });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
        
        
        $("#examples a").click(function(){
          $("#geocomplete").val($(this).text()).trigger("geocode");
          return false;
        });
		
        
      });
    </script>