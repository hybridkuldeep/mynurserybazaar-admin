<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>
     
<?php
	
		echo $this->Html->css(array("bootstrap.min","font-awesome.min","AdminLTE"));
		
	?>
	
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
			
           <?php
				echo $this->Form->create($model, array(
										'action' => 'login'
										));
			?>
                <div class="body bg-gray">
				 <div class="form-group">
				<?php 
	
		if($this->Session->check('error')){
				?>
				
				<div class="row-fluid margin-top alert-message">
					<div class="span12">
						<div class="alert alert-info">
						<a class="close" href="javascript:void(0)">×</a>
							<?php echo $this->Session->read("error");?>
						</div>
					</div>
				</div>
				<?php
				unset($_SESSION['error']);
			}	
?>
 </div>
                    <div class="form-group">
						<?php echo $this->Form->text('email',array('class'=>'form-control input-block-level','placeholder'=>__('Email'),'data-rule-required'=>true,'data-rule-text'=>true)); ?>

                    </div>
                    <div class="form-group">
												<?php echo $this->Form->password('password',array('class'=>'form-control input-block-level','placeholder'=>__('Password'),'data-rule-required'=>true)); ?>

                    </div>          
                   
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    
                </div>
            </form>

        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>        

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
</html>