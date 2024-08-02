
<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Settings | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
	<script src="../dist/js/jquery.min.js"></script>
	
 </head>
 <style>
        body {
            background: url(../dist/img/temp.jpg) center/cover no-repeat;
            margin: 0;
            justify-content: center;
            font-family: Verdana, sans-serif;
            overflow-x: hidden;
            overflow-y: scroll;
            animation: fadeInAnimation ease 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
		body, html {
			height: 100%;
			margin: 0;
			padding: 0;
		}
		
		.navbar {
			margin-bottom: 0;
		}
		#clock {
            font: small-caps lighter 30px/150% "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
			color: black;
			font-weight: bold;
			position: absolute;
			top: 0;
			right: 0;
			padding: 10px;
		}
        #user {
            color: #2596be;
			font-size: 25px;
			font-weight: bold;
			position: absolute;
			top: 15px;
			left: 30px;;
			padding: 10px;
		}
		.navbar {
			background-color: transparent !important;
			border: none;
		}
		.back-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
  }
  .content-wrapper{
    margin-top: 50px;
    
  }
	</style>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body>
  <nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
                <a class="navbar-brand fw-bold" id="user" href=""> <?php echo  $_SESSION['username']; ?> </a>
			</div>
			<a class="nav-link link-light" style="bottom:5%;" >
                <span class="fw-bold fs-4" id="clock"></span>
            </a>
		</div>
	</nav>
    <div class="wrapper ">
      <div class="content-wrapper">
        <div class="container" >
          <section class="content">
            <div class="row">
	      <div class="col-md-9">
              <div class="box box-warning">
              	<!--<div style="text-align: center">
              		<h4>Print Class Schedule
              		<a href="#searcht" data-target="#searcht" data-toggle="modal" class="dropdown-toggle btn btn-primary">
                     
                      Teacher				
                    </a>
                   <a href="#searchclass" data-target="#searchclass" data-toggle="modal" class="dropdown-toggle btn btn-success">
                     
                      Class				
                    </a>
                  
                   <a href="#searchroom" data-target="#searchroom" data-toggle="modal" class="dropdown-toggle btn btn-warning">
                     
                      Room				
                    </a>
                    </h4>
                </div> -->
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
				include('../dist/includes/dbcon.php');
				$sched_id=$_REQUEST['id'];
				$query1=mysqli_query($con,"select * from schedule where sched_id='$sched_id'")or die(mysqli_error());
						$row1=mysqli_fetch_array($query1);	
							$time_id=$row1['time_id'];	
							$day=$row1['day'];	
							//$day=$row1['day'];	

				$query=mysqli_query($con,"select * from time where days='mwf' order by time_start")or die(mysqli_error());
				
				while($row=mysqli_fetch_array($query)){
						$id=$row['time_id'];
						$start=date("h:i a",strtotime($row['time_start']));
						$end=date("h:i a",strtotime($row['time_end']));

					
		?>
							  <tr >
								<td><?php echo $start."-".$end;?></td>
								<td><input type="checkbox" name="m[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
								<?php if(($id==$time_id) and ($day=='m')) echo "checked"; ?>>
								</td>
								<td><input type="checkbox" name="w[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
								<?php if(($id==$time_id) and ($day=='w')) echo "checked"; ?>></td>
								<td><input type="checkbox" name="f[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
								<?php if(($id==$time_id) and ($day=='f')) echo "checked"; ?>></td>
								
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
									<th>S</th>
									<th>SU</th>
								  </tr>
								</thead>
								
			<?php
					include('../dist/includes/dbcon.php');
					$query=mysqli_query($con,"select * from time where days='tth' order by time_start")or die(mysqli_error());
						
					while($row=mysqli_fetch_array($query)){
							$id=$row['time_id'];
							$start=date("h:i a",strtotime($row['time_start']));
							$end=date("h:i a",strtotime($row['time_end']));
			?>
								  <tr >
									<td><?php echo $start."-".$end;?></td>
									<td><input type="checkbox" name="t[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
									<?php if(($id==$time_id) and ($day=='t')) echo "checked"; ?>></td>
									<td><input type="checkbox" name="th[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
									<?php if(($id==$time_id) and ($day=='th')) echo "checked"; ?>></td>
									<td><input type="checkbox" name="s[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
									<?php if(($id==$time_id) and ($day=='s')) echo "checked"; ?>></td>
									<td><input type="checkbox" name="u[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"
									<?php if(($id==$time_id) and ($day=='u')) echo "checked"; ?>></td>
									
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
                <?php
                $query=mysqli_query($con,"select * from schedule natural join faculty where facultyid='$sched_id'")or die(mysqli_error());
                $row=mysqli_fetch_array($query);
                ?>
                <div class="box-body">
                  <div id="form">
					<input type="hidden" name="id" value="<?php echo $sched_id;?>">
				  <div class="row">
					 <div class="col-md-12">
						  <div class="form-group">
							<label for="date">Teacher</label>
								<select class="form-control select2" name="teacher" required>
									<?php
									$query3=mysqli_query($con, "SELECT f.facultyid,firstname,lastname,subject_code,cys,room FROM faculty f left join schedule s on f.facultyid = s.facultyid where sched_id='$sched_id'")or die(mysqli_error($con));
									$row3=mysqli_fetch_assoc($query3)
									?>
								<option selected value="<?php echo $row3['facultyid'];?>"><?php echo $row3['lastname'].", ".$row3['firstname'];?></option>
								  <?php 
									$query2=mysqli_query($con,"select * from faculty order by lastname")or die(mysqli_error($con));
									  while($row2=mysqli_fetch_array($query2)){
								  ?>
										<option value="<?php echo $row2['facultyid'];?>"><?php echo $row2['lastname'].", ".$row2['firstname'];?></option>
								  <?php }
									
								  ?>
								</select>
							
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Subject</label>
							
								<select class="form-control select2" name="subject" required>
								<option selected value="<?php echo $row3['subject_code'];?>"><?php echo $row3['subject_code'];?></option>
								  <?php 
									$query2=mysqli_query($con,"select * from subjects order by subject")or die(mysqli_error($con));
									 while($row2=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row2['subject'];?></option>
								  <?php }
									
								  ?>
								</select>
							
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Course, Yr & Section</label>
							<select class="form-control select2" name="cys" required>
							<option selected value="<?php echo $row3['cys'];?>"><?php echo $row3['cys'];?></option>
								  <?php 
									$query2=mysqli_query($con,"select * from students")or die(mysqli_error($con));
									 while($row2=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row2['course'] . $row2['year'] . $row2['section'];?></option>
								  <?php }
									
								  ?>
								</select>	
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Room</label>
							<select class="form-control select2" name="room" required>
							<option selected value="<?php echo $row3['room'];?>"><?php echo $row3['room'];?></option>
								  <?php 
									$query2=mysqli_query($con,"select * from room order by room")or die(mysqli_error($con));
									  while($row2=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row2['room'];?></option>
								  <?php }
									
								  ?>
								</select>	
						  
					</div>
					
					

				</div>	
               
                  
                  <div class="form-group">
                    
                      <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="save" type="submit">
                        Save
                      </button>
					  <button class="btn btn-lg btn-block" id="daterange-btn" type="reset" onclick="window.location.href='mainte_print.php'">
                       Cancel
                      </button>
					  
					  
                   </div>
                  </div><!-- /.form group --><hr>
				</form>	<button class="uncheck btn btn-lg btn-block btn-success">Uncheck All</button>
                      
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

<?php
include 'home_updateModal.php';
?>
	<script type="text/javascript">
	
	
	
	function handleSelectChange(event) {
		event.preventDefault();
		var value = document.getElementById("cys").options[document.getElementById("cys").selectedIndex ].value;
		
		var cysArr = value.split(',');

		document.getElementById('hiddenID').value = cysArr[1];
		document.getElementById('update_course').value = cysArr[2];
		document.getElementById('update_year').value= cysArr[3];
		document.getElementById('update_section').value = cysArr[4];

	}

	$(document).ready(function(){

//$(".result").load("cys_list.php");


});


		$(document).on('submit', '#reg-form', function()
		 {  
		  $.post('submit.php', $(this).serialize(), function(data)
		  {

		   $(".result").html(data);  
		   $('#largeModal').modal('show');
		   $("#form1")[0].reset();
		  // $("#check").reset();
		 
		  });
		  
		  return false;
		  
		
		})

        var clockElement = document.getElementById('clock');
  function clock() {
    var date = new Date();
      clockElement.textContent = date.toLocaleString();;
    }
    setInterval(clock, 100);
</script>
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
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
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

    <div class="back-button">
  <a href="../index.php">
    <button class="btn btn-primary btn-lg">Back</button>
  </a>
</div>
  </body>
</html>
