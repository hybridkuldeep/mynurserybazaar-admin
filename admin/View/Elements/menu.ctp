 <?php 
 $controller	=	$this->params["controller"];
 $action	=	$this->params["action"];
//pr($this->params);
 ?>
 <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
					
                         <?php echo $images = $this->Html->image("../uploads/setting/".$admin_avatar['Setting']['value'],array("class"=>"img-circle"));?>   
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo authComponent::user('full_name'); ?></p>

                           
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li <?php if($controller == "users")echo "class='active'"; ?>>
							<?php echo $this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>',   array('plugin'=>false,'controller' => 'users', 'action' => 'layout'),array('escape'=>false ));?>
                        </li>
						<li <?php if($controller == "categories")echo "class='active'"; ?>>
									<?php echo $this->Html->link('<i class="fa fa-wrench"></i> <span>Categories</span>',   array('plugin'=>'category','controller' => 'categories', 'action' => 'index',0),array('escape'=>false ));?>
						</li>
							
                        <li <?php if($controller == "usermgmt" && $action == "customer")echo "class='active'"; ?>>
							<?php echo $this->Html->link('<i class="fa fa-user"></i> <span>Nurseray Management</span>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'employee'),array('escape'=>false ));?>
                          
                        </li>
						<li <?php if($controller == "usermgmt" && $action == "customer")echo "class='active'"; ?>>
							<?php echo $this->Html->link('<i class="fa fa-user"></i> <span>User Management</span>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'customer'),array('escape'=>false ));?>
                          
                        </li>
						 
						<li <?php if($controller == "usermgmt"  && $action == "broadcast")echo "class='active'"; ?>>
							<?php echo $this->Html->link('<i class="fa fa-user"></i> <span>Broadcast</span>',   array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'broadcast'),array('escape'=>false ));?>
                          
                        </li>
						   
						     
						     
							  <li <?php if($controller == "contacts")echo "class='active'"; ?>>
									<?php echo $this->Html->link('<i class="fa fa-wrench"></i> <span>Contact Us</span>',   array('plugin'=>'contact','controller' => 'contacts', 'action' => 'index'),array('escape'=>false ));?>
						</li>
						
                             <li <?php if($controller == "pages")echo "class='active'"; ?>>
									<?php echo $this->Html->link('<i class="fa fa-wrench"></i> <span>Pages</span>',   array('plugin'=>'page','controller' => 'pages', 'action' => 'index'),array('escape'=>false ));?>
						</li> 
						                                
                            <li <?php if($controller == "email")echo "class='active'"; ?>>
									<?php echo $this->Html->link('<i class="fa fa-wrench"></i> <span>Email</span>',   array('plugin'=>'email','controller' => 'email_templates', 'action' => 'index'),array('escape'=>false ));?>
						</li>


						      <li <?php if($controller == "settings" && isset($this->params["pass"][0]) && $this->params["pass"][0]=="Site")echo "class='active'"; ?>>
									<?php echo $this->Html->link('<i class="fa fa-wrench"></i> <span>Setting</span>',   array('plugin'=>'settings','controller' => 'settings', 'action' => 'prefix',"Site"),array('escape'=>false ));?>
						</li>
							
                     </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
			