<script>
$(document).ready(function(e) {
    $('.btn-login').hover(
	 function () {
     $('.page-icon img').addClass('kkkt');
  },
  function () {
    $('.page-icon img').removeClass('kkkt');
  }
	
	
	
	
		
   );	
		
});

</script>
<style>

.page-icon {
width: 100px;
height: 100px;
-webkit-border-radius: 100px;
-moz-border-radius: 100px;
border-radius: 100px;
background: #12181f;
text-align: center;
margin: -60px auto 0;
top: -65px;
position: relative;
}
.page-icon img {
vertical-align: middle;
-moz-transition: all .5s ease-in-out;
-webkit-transition: all .5s ease-in-out;
-o-transition: all .5s ease-in-out;
-ms-transition: all .5s ease-in-out;
transition: all .5s ease-in-out;
opacity: .6;
width: 48px;
height: 48px;
margin: 25px 0 0;
}
.page-icon img:hover,.kkkt {transform: rotate(405deg);}
.login-logo {
text-align: center;
padding: 15px 0 10px;
margin-top: -50px;
}
.login-logo img {
border: 0;
display: inline-block;
}
img {
vertical-align: middle;
}
.login-body hr {
width: 70%;
border-top: 1px solid rgba(0,0,0,0.13);
border-bottom: 1px solid rgba(255,255,255,0.15);
margin: 10px auto 20px;
}
#test #UserUsername{
background: #FFF url(../images/user_small.png) no-repeat 95% center;
-webkit-transition: all 0 ease;
-moz-transition: all 0 ease;
-ms-transition: all 0 ease;
-o-transition: all 0 ease;
transition: all 0 ease;
}
#test #UserPassword {
background: #FFF url(../images/key_small.png) no-repeat 95% center;
-webkit-transition: all 0 ease;
-moz-transition: all 0 ease;
-ms-transition: all 0 ease;
-o-transition: all 0 ease;
transition: all 0 ease;
}
#test input[type=text],input[type=password] {
display: block;
width: 81%;
background: #fefefe;
border: 0;
color: #6c6c6c;
border-radius: 2px;
margin: 0 auto 15px;
padding: 8px;
}
.submit .btn-login:hover {
border: 1px solid #FFF;
opacity: .8;
}
.submit .btn-login {
width: 120px;
display: block;
border: 1px solid rgba(0,0,0,0);
color: #FFF;
text-transform: uppercase;
background: #12181f;
-webkit-transition: all .5s ease-in-out;
-moz-transition: all .5s ease-in-out;
-o-transition: all .5s ease-in-out;
transition: all .5s ease-in-out;
margin: 20px auto;
float:none !important;
padding: 7px 3px 7px;
}
</style>

<h1>
	<?php //echo $this->Html->link($this->Html->image('logo1.png',array('class'=>'retina-ready')),array('controller'=>'/'),array('escape'=>false)); ?>
</h1>
	
<p> <?php 
			if(isset($_SESSION['failed'])){
				?>
				
				<div class="row-fluid margin-top alert-message">
					<div class="span12">
						<div class="alert alert-info">
						<a class="close" href="javascript:void(0)">×</a>
							<?php echo $_SESSION['failed'];?>
						</div>
					</div>
				</div>
				<?php
				unset($_SESSION['failed']);
			}	
 echo $this->Session->flash(); ?>
		
</p>

		<div class="login-body">
        <!--<div class="page-icon animated bounceInDown">
                        <img src="../images/user-icon.png" alt="Key icon">
                    </div>-->
		<div class="login-logo">
                        <a href="#?login-theme-3">
                            <img src="../images/login-logo.png" alt="Company Logo">
                        </a>
                        <div class="logo_text" style="margin-top:-40px;"><h2><?php echo Configure::read('Site.title');?></h2></div>
                    </div>
        <hr>
			<!--<h2><?php //echo __('SIGN IN'); ?></h2>-->
			<?php
				echo $this->Form->create($model, array(
										'action' => 'login',
										'class' => 'form-validate','id'=>'test'));
			?>
				<div class="control-group">
					<div class="text controls">
						<?php echo $this->Form->text('username',array('class'=>'input-block-level','placeholder'=>__('Username'),'data-rule-required'=>true,'data-rule-text'=>true)); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="text controls">
						<?php echo $this->Form->password('password',array('class'=>'input-block-level','placeholder'=>__('Password'),'data-rule-required'=>true)); ?>
					</div>
				</div>
				<div class="submit">
				<?php 	/* <div class="remember">
						<?php echo $this->Form->checkbox('remember_me',array('class'=>'icheck-me','data-skin'=>'square','data-color'=>'blue','id'=>'remember')); ?>
						<label for="remember"><?php echo __('Remember me'); ?></label>
					</div> */
				?>
					<input type="submit" value="<?php echo __('Sign me in'); ?>" class='btn-login'>
				</div>
			<?php echo $this->form->end(); ?>
			<div class="forget">
			<?php 	/* <a href="<?php echo $this->Html->url(array('plugin'=>false,'controller'=>'users','action'=>'forgot_password'),true); ?>"><span><?php echo __('Forgot password').'?'; ?></span></a> */ ?>
			</div>
		</div>