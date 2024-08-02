<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
} 


?>



<!DOCTYPE html>
<?php include("../header.php");?>
<html>
<body>
    <title></title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
	<script src="../dist/js/jquery.min.js"></script>
	<script>
		$(document).on('submit', '#reg-form', function()
		 {  
		  $.post('submit.php', $(this).serialize(), function(data)
		  {
		   $(".result").html(data);  
		   $("#form1")[0].reset();
		  // $("#check").reset();

		  });
		  
		  return false;
		  
		
		})
</script>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-yellow layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
        

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-9">
              <div class="box box-warning">
              	<div style="text-align: center">
              		<h4>Print Schedule
              		
                   <a href='#searchclass' data-target="#searchclass" data-toggle="modal" class="dropdown btn btn-success">
                     
                      Class	Schedule			
                    </a>
                  
                   <a href="room_sched.php" data-target="#searchroom" data-toggle="modal" class="dropdown btn btn-warning">
                     
                      Room Schedule			
                    </a>
                    </h4>
                </div> 
               <form method="post" id="reg-form">
                <div class="box-body">
				<div class="row">
					<div class="col-md-6">
							<table class="table table-bordered table-striped" style="margin-right:-10px">
							<thead>
							  <tr>
								<th>Time</th>
								<th>M</th>
								<th>W</th>
								<th>F</th>
								
							  </tr>
							</thead>
							
		<?php
				include 'config.php';
				$query=mysqli_query($conn,"select * from time where days='mwf' order by time_start")or die(mysqli_error());
					
				while($row=mysqli_fetch_array($query)){
						$id=$row['time_id'];
						$start=date("h:i a",strtotime($row['time_start']));
						$end=date("h:i a",strtotime($row['time_end']));
		?>
							  <tr >
								<td><?php echo $start."-".$end;?></td>
								<td><input type="checkbox" id="check" name="m[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
								<td><input type="checkbox" id="check" name="w[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
								<td><input type="checkbox" id="check" name="f[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
								
							  </tr>
							
		<?php }?>					  
		</table>    
		</div><!--col end -->
		<div class="col-md-6">
			<table class="table table-bordered table-striped">
								<thead>
								  <tr>
									<th>Time</th>
									<th>T</th>
									<th>TH</th>
									
								  </tr>
								</thead>
								
			<?php
					include('config.php');
					$query=mysqli_query($conn,"select * from time where days='tth' order by time_start")or die(mysqli_error());
						
					while($row=mysqli_fetch_array($query)){
							$id=$row['time_id'];
							$start=date("h:i a",strtotime($row['time_start']));
							$end=date("h:i a",strtotime($row['time_end']));
			?>
								  <tr >
									<td><?php echo $start."-".$end;?></td>
									<td><input type="checkbox" name="t[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
									<td><input type="checkbox" name="th[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
									
								  </tr>
								
			<?php }?>					  
			</table>  
			<div class="result" id="form">
					  </div>			
         </div><!--col end-->           
        </div><!--row end-->        
					
			
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            <div class="col-md-3">
              <div class="box box-warning">
               
                <div class="box-body">
                  <!-- Date range -->
                  <div id="form1">
					
				  <div class="row">
					 <div class="col-md-12">
						  <div class="form-group">
							<label for="date">Teacher</label>
							
								<select class="form-control select2" name="teacher" required>
								  <?php 
									$query2=mysqli_query($conn,"select * from faculty where role='Faculty' order by lastname")or die(mysqli_error($conn));
									  while($row=mysqli_fetch_array($query2)){
								  ?>
										<option value="<?php echo $row['facultyid'];?>"><?php echo $row['lastname'].", ".$row['firstname'];?></option>
								  <?php }
									
								  ?>
								</select>
							
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Subject</label>
							
								<select class="form-control select2" name="subject" required>
								  <?php 
									$query2=mysqli_query($conn,"select * from subjects order by subjectid")or die(mysqli_error($conn));
									 while($row=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row['subject'];?></option>
								  <?php }
									
								  ?>
								</select>
							
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Course, Yr & Section</label>
							<select class="form-control select2" name="cys" required>
								  <?php 
									$query2=mysqli_query($conn,"select * from students ")or die(mysqli_error($conn));
									 while($row=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row['course'] . $row['year'] . $row['section'];?></option>
								  <?php }
									
								  ?>
								</select>	
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Room</label>
							<select class="form-control select2" name="room" required>
								  <?php 
									$query2=mysqli_query($conn,"select * from room order by room")or die(mysqli_error($conn));
									  while($row=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row['room'];?></option>
								  <?php }
									
								  ?>
								</select>	
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Remarks</label><br>
								<textarea name="remarks" cols="30" placeholder="enclose remarks with parenthesis()"></textarea>
								
						  </div><!-- /.form group -->
					</div>
					
					

				</div>	
               
                  
                  <div class="form-group">
                    
                      <button class="btn btn-lg btn-primary" id="daterange-btn" name="save" type="submit">
                        Save
                      </button>
					  <button class="uncheck btn btn-lg btn-success" type="reset">Uncheck All</button>
					  
					  
                   </div>
                  </div><!-- /.form group --><hr>
				</form>	
                      
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../footer.php');?>
    </div><!-- ./wrapper -->
	
 

<script>
$(".uncheck").click(function () {
			$('input:checkbox').removeAttr('checked');
});
</script>
	
	<script type="text/javascript" src="autosum.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
  
     <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
       
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
