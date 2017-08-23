<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $pageHeading; ?></h1>
						
					</div>
					<div class="pull-right">
						<ul class="stats">
							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big"><?php echo date('F',time()) ?> <?php echo date('d',time()) ?>, <?php echo date('Y',time()) ?></span>
									<span><?php echo date('l',time()) ?>, <?php echo date('h',time()) ?>:<?php echo date('i',time()) ?></span>
								</div>
							</li>
						</ul>
					</div>
					<div><?php echo $this->Session->flash(); ?></div>
				</div>
			<?php echo $this->element('breadcrumb'); ?>