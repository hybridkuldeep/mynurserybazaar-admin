		
  <header class="header">
			<?php echo $this->Html->link('MyNurseryBazaar',   array('plugin'=>false,'controller' => 'users', 'action' => 'layout'),array("class"=>"logo",'escape'=>false ));?>
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                      
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo authComponent::user('username'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
									
															<?php echo $images = $this->Html->image("../uploads/setting/".$admin_avatar['Setting']['value'],array("class"=>"img-circle"));?>
                                    
                                    <p>
                                        <?php echo authComponent::user('username'); ?>  - Admin
                                        <small><?php echo authComponent::user('email'); ?> </small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
										<?php echo $this->Html->link('User',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'customer'),array('escape'=>false ));?>
                                        
                                    </div>
                                  <div class="col-xs-4 text-center">
										<?php echo $this->Html->link('Page',   array('plugin'=>'page','controller' => 'pages', 'action' => 'index'),array('escape'=>false ));?>
                          
                                    </div>
                                   <?php  /*  <div class="col-xs-4 text-center">
                                        <?php echo $this->Html->link('Comment',   array('plugin'=>'comment','controller' => 'comments', 'action' => 'index'),array('escape'=>false ));?>
						
                                    </div> */ ?>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
										<?php echo $this->Html->link('Profile',   array('plugin'=>false,'controller' => 'users', 'action' => 'myaccount'),array('escape'=>false ,"class"=>"btn btn-default btn-flat"));?>
                                       
                                    </div>
                                    <div class="pull-right">
										<?php echo $this->Html->link('Sign out',   array('plugin'=>false,'controller' => 'users', 'action' => 'logout'),array('escape'=>false ,"class"=>"btn btn-default btn-flat"));?>
                                      
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
     