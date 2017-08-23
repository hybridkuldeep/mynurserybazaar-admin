<?php 
echo $this->Html->script(array('plugins/flot/jquery.flot.min.js','plugins/flot/jquery.flot.bar.order.min.js','plugins/flot/jquery.flot.pie.min.js','plugins/flot/jquery.flot.resize.min.js', 'highcharts.js', 'modules/exporting.js'));
?>

<style type="text/css">
.dataTables_filter {
	display:none;	
}
.widget, .middleNav, .sItem, .statsDetailed {
	box-shadow: 0 1px 0 #fff;
	-moz-box-shadow: 0 1px 0 #fff;
	-webkit-box-shadow: 0 1px 0 #fff;
}
.widget {
	background: #f9f9f9;
	border: 1px solid #C5CBD1;
	clear: both;
	margin-top: 20px;
}
.chartWrapper {
	overflow: hidden;
}
.admin_menu {
	width: 960px !important;
	float: left;
}
.admin_menu ul {
	width: 960px;
}
.admin_menu ul li {
	float: left;
	<?php if($uid==1){?>padding: 0px 7px 0px 20px; <?php }else{?>padding: 0px 30px 0px 20px; <?php }?>
	width: 110px;
	display: inline-block;
}
.dash_active_mid {
	float: left;
	width: 88px;
	height: 106px;
	background: #fff;
	text-align: center;
	margin: 10px 0;
	border-radius: 10px;
	padding: 0 10px;
	border: 1px solid #C5CBD1;
}
.dash_active_mid:hover {
	border: 1px solid #c5c5c5;	
}
.dash_act_img {
	margin: 0 auto;
	width: auto;
	text-align: center;
	padding-top: 15px;
	height: 50px;
}
.admin_menu div.dash_active_mid a {
	float: left;
	clear: both;
	font: bold 12px/12px arial;
	color: #4C4C4C;
	text-align: center;
	width: 85px;
	margin: 0px;
	padding: 0px;
}
.admin_menu ul li img {
	text-align: center;
}
.admin_menu ul li img:hover {
	-ms-transform: rotate(360deg); /* IE 9 */
    -webkit-transform: rotate(360deg); /* Chrome, Safari, Opera */
    transform: rotate(360deg);	
}
.dash_act_img img {
	-webkit-transition: -webkit-transform 0.5s ease-in-out;
	-moz-transition: -moz-transform 0.5s ease-in-out;
	-o-transition: -o-transform 0.5s ease-in-out;
	transition: transform 0.5s ease-in-out;
}
.admin_menu div.dash_active_mid a {
	float: left;
	clear: both;
	font: bold 12px/12px arial;
	color: #4C4C4C;
	text-align: center;
	width: 85px;
	margin: 0px;
	padding: 0px;
}
</style>
<div  >
<!-- dashboard boxes-->

<!--end  dashboard boxes-->


<?php /*?><!--<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Drivers Chart'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <div id="driverschart" style="width: 100%; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  </div>
</div>--><?php */?>

<?php /*?><!--<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Transaction Chart'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <div id="transactionchart" style="width: 100%; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  </div>
</div>--><?php */?>

<?php /*?><!--<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Company Account Balance'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <div id="companyaccount" style="width: 100%; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  </div>
</div>--><?php */?>
<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Latest Users'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
          <thead>
            <tr>
               <th><?php echo __('S.No.'); ?></th>
              <th><?php echo __('Name'); ?></th>
              <th><?php echo __('Created'); ?></th>
              <th><?php echo __('Email'); ?></th>
            </tr>
          </thead>
        <tbody>
        <?php
			$i=1;
			//pr($users);
			foreach($users as $user) {
		?>
            <tr class="gallerytr">
                <td  align="left" ><?php echo $i; ?></td>
                <td  align="left"><?php echo $user['users']['username']; ?></td>
                <td  align="left"><?php echo $user['users']['created']; ?></td>
                <td  align="left"><?php echo $user['users']['email']; ?></td>
              
        	</tr>
        <?php
			$i++;
			}
		?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php /*?><!--<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Recent New Customer\'s'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
          <thead>
            <tr>
              <th><?php echo __('S.No.'); ?></th>
              <th><?php echo __('Name'); ?></th>              
              <th><?php echo __('Join'); ?></th>
            </tr>
          </thead>
        <tbody>
        <?php
			$i=1;
			//pr($Customers);
			foreach($Customers as $Customer) {
		?>
            <tr class="gallerytr">
                <td  align="left" ><?php echo $i; ?></td>
                <td  align="left"><?php echo $Customer['professional_categories']['name']; ?></td>
                <td  align="left"><?php echo date('F,j Y', strtotime($Customer['professional_categories']['created'])); ?></td>
        	</tr>
        <?php
			$i++;
			}
		?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>--><?php */?>
<?php /*?><!--<div class="row-fluid">
  <div class="span6">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Today Free Taxies'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
          <thead>
            <tr>
              <th><?php echo __('S.No.'); ?></th>
              <th><?php echo __('Plate No'); ?></th>
              <th><?php echo __('Register No'); ?></th>
              <th><?php echo __('Break System'); ?></th>
            </tr>
          </thead>
        <tbody>
        <?php
			$i=1;
			foreach($allTaxis as $Taxi) {
				//pr($Taxi);
		?>
            <tr class="gallerytr">
                <td  align="left" ><?php echo $i; ?></td>
                <td  align="left"><?php echo $Taxi['Taxi']['plate_no']; ?></td>
                <td  align="left"><?php echo $Taxi['Taxi']['register_no']; ?></td>
                <td  align="left"><?php echo $Taxi['Taxi']['break_system']; ?></td>
        	</tr>
        <?php
			$i++;
			}
		?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="span6">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Latest Updates'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
          <thead>
            <tr>
              <th><?php echo __('S.No.'); ?></th>
              <th><?php echo __('Latest'); ?></th>
              <th><?php echo __('Total'); ?></th>
            </tr>
          </thead>
        <tbody>
            <tr class="gallerytr">
                <td  align="left" >1.</td>
                <td  align="left">Total Companies</td>
                <td  align="left"><?php echo $cntCompanies; ?></td>
        	</tr>
            <tr class="gallerytr">
                <td  align="left" >2.</td>
                <td  align="left">Total Passengers</td>
                <td  align="left"><?php echo $cntCustomers; ?></td>
        	</tr>
            <tr class="gallerytr">
                <td  align="left" >3.</td>
                <td  align="left">Total Drivers</td>
                <td  align="left"><?php echo $cntDrivers; ?></td>
        	</tr>
            <tr class="gallerytr">
                <td  align="left" >4.</td>
                <td  align="left">Total Taxies</td>
                <td  align="left"><?php echo $cntTaxis; ?></td>
        	</tr>                        			
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>--><?php */?>
<?php /*?><!--<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered">
      <div class="box-title">
        <h3> <i class="icon-table"></i> <?php echo __('Today Unassigned Taxies'); ?> </h3>
        <div class="actions"> <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a> </div>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
          <thead>
            <tr>
              <th><?php echo __('S.No.'); ?></th>
              <th><?php echo __('Driver Name'); ?></th>
              <th><?php echo __('Company Name'); ?></th>
              <th><?php echo __('Register No'); ?></th>
              <th><?php echo __('Permit No'); ?></th>
               <th><?php echo __('Join'); ?></th>
            </tr>
          </thead>
        <tbody>
        <?php
			$i=1;
			foreach($Assigns as $Assign) {
				//pr($Taxi);
		?>
            <tr class="gallerytr">
                <td  align="left" ><?php echo $i; ?></td>
                <td  align="left"><?php echo $Assign['Driver']['firstname'].' '.$Assign['Driver']['lastname']; ?></td>
                <td  align="left"><?php echo $Assign['Company']['name']; ?></td>
                <td  align="left"><?php echo $Assign['Taxi']['register_no']; ?></td>
                <td  align="left"><?php echo $Assign['Taxi']['permit_no']; ?></td>
                <td  align="left"><?php echo date('F,j Y', strtotime($Assign['Assigns']['created'])); ?></td>
        	</tr>
        <?php
			$i++;
			}
		?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>--><?php */?>


</div>