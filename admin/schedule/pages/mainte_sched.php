
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
    background: url(../dist/img/temp.jpg) center/cover no-repeat fixed;
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
        <div class="container">
          <section class="content">
            <div class="row">
	      <div class="col-md-9">
              <div class="box box-warning">
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
											$query=mysqli_query($con,"select * from time where days='mwf' order by time_start")or die(mysqli_error());
												
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
									<td><input type="checkbox" name="t[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
									<td><input type="checkbox" name="th[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
									<td><input type="checkbox" name="s[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
									<td><input type="checkbox" name="u[]" value="<?php echo $id;?>" style="width: 20px; height: 20px;"></td>
								  </tr>
								
									<?php }?>					  
								</table>  
         					</div><!--col end-->           
        				</div><!--row end-->        
                	</div><!-- /.box-body -->
              	</div><!-- /.box -->
            </div><!-- /.col (right) -->
<a href="#" class="" id="sentMessage" data-toggle="modal" data-target="#largeModal"></a>
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <b><h3 class="modal-title" id="myModalLabel">Result</h4></b>
          </div>
          <div class="modal-body">
		  <div class="result" id="form"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.href='mainte_sched.php'">Close</button>
          </div>
        </div>
      </div>
    </div>
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
								<option value="" selected></option>
								  <?php 
									$query2=mysqli_query($con,"select * from faculty where role='Faculty' OR role='Scheduler' order by lastname")or die(mysqli_error($con));
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
								<option value="" selected></option>
								  <?php 
									$query2=mysqli_query($con,"select * from subjects order by subjectid")or die(mysqli_error($con));
									 while($row=mysqli_fetch_array($query2)){
								  ?>					  	
										<option><?php echo $row['subject'];?></option>
								  <?php }
									
								  ?>
								</select>
							
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Course, Yr & Section</label> 
							<a href="#" class="btn btn-sm btn-primary" id="sentMessage" data-toggle="modal" class="modifyModal" data-target="#modifyModal" onClick="handleSelectChange(event)">Modify</a>
								
							<select class="form-control select2" id="cys" name="cys" required>
							<option value="" selected></option>
								  <?php 
									$query2=mysqli_query($con,"select * from cys")or die(mysqli_error($con));
									 while($row=mysqli_fetch_array($query2)){
								  ?>
								  		
										<option value="<?php echo $row['course'] . $row['year'] . $row['section'] .','.$row['id'] . ',' . $row['course'] .','. $row['year'] .','. $row['section']?>">
										    <?php echo $row['course'] . $row['year'] . $row['section'];?></option>
								  <?php 
								  
								}	
								  ?>
								</select>	
								
						  </div>
						  <div class="form-group">
							<label for="date">Room</label>
							<select class="form-control select2" name="room" required>
							<option value="" selected></option>
								  <?php 
									$query2=mysqli_query($con,"select * from room order by room")or die(mysqli_error($con));
									  while($row=mysqli_fetch_array($query2)){
								  ?>
								  
										<option><?php echo $row['room'];?></option>
								  <?php }
									
								  ?>
							</select>	
						  </div>

						  <div class="form-group">
							<label for="class">Class Mode</label><br>
								<label class="btn btn-default">
									<input type="radio" name="options" id="ftf-option" value="FTF" required> FTF
								</label>
								<label class="btn btn-default">
									<input type="radio" name="options" id="online-option" value="Online" required> Online
								</label>
							</div>
						  <div class="form-group">
							<label for="date" hidden>Remarks</label><br>
								<textarea name="remarks" cols="30" placeholder="enclose remarks with parenthesis()" hidden></textarea>
								
						  </div><!-- /.form group -->
					</div>
					
					

				</div>	
               
                  
                  <div class="form-group">
                    
                      <button class="btn btn-lg btn-primary" id="daterange-btn" name="save" type="submit">
                        Save
                      </button>
					  <button class="uncheck btn btn-lg btn-success" type="reset">Reset</button>
					  
					  
                   </div>
				   <div class="form-group">
				   <label><h3><b>Update<b></h3></label><br>
					  <button class="btn btn-md btn-warning" type="button" data-toggle="modal" data-target="#searcht">Teacher</button>
					  <button class="btn btn-md btn-success" type="button" data-toggle="modal" data-target="#searchclass">Class</button>
					  <button class="btn btn-md btn-primary" type="button" data-toggle="modal" data-target="#searchroom">Room</button>
					  
					  
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
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
<!-- Print for Faculty -->
<div id="searcht" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Search Faculty Schedule</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="faculty_sched.php" target="_blank">
				<div class="form-group">
					<label class="control-label col-lg-2" for="name">Faculty</label>
					<div class="col-lg-10">
						<select class="select2" name="faculty" style="width:90%!important" required>
							<?php 
								$query2=mysqli_query($con,"select * from faculty order by lastname")or die(mysqli_error($con));
									while($row=mysqli_fetch_array($query2)){
								?>
									<option value="<?php echo $row['facultyid'];?>"><?php echo $row['lastname'].", ".$row['firstname'];?></option>
								<?php }
								
							?>
						</select>
					</div>
				</div> 
				
				
              </div><hr>
              <div class="modal-footer">
				<button type="submit" name="search" class="btn btn-primary">Display Schedule</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>


<!-- Print for Class -->
<div id="searchclass" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Search Class Schedule</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="class_sched.php" target="_blank">
                
				<div class="form-group">
					<label class="control-label col-lg-2" for="name">Class</label>
					<div class="col-lg-10">
					<select class="select2" name="class" style="width:90%!important" required>
								  <?php 
								  
									$query2=mysqli_query($con,"select * from cys")or die(mysqli_error($con));
									  while($row=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row['course'] . $row['year'] . $row['section'];?></option>
								  <?php }
									
								  ?>
								</select>
					</div>
				</div> 
				
				
              </div><hr>
              <div class="modal-footer">
				<button type="submit" name="search" class="btn btn-primary">Display Schedule</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal--> 
 

 <!-- Print for Room -->
 <div id="searchroom" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Search Room Schedule</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="room_sched.php" target="_blank">
                
				<div class="form-group">
					<label class="control-label col-lg-2" for="name">Room</label>
					<div class="col-lg-10">
					<select class="select2" name="room" style="width:90%!important" required>
								  <?php 
								  
									$query2=mysqli_query($con,"select * from room order by room")or die(mysqli_error($con));
									  while($row=mysqli_fetch_array($query2)){
								  ?>
										<option><?php echo $row['room'];?></option>
								  <?php }
									
								  ?>
								</select>
					</div>
				</div> 
				
				
              </div><hr>
              <div class="modal-footer">
				<button type="submit" name="search" class="btn btn-primary">Display Schedule</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal--> 

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
		$(".result").load("cys_list.php");
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
	// Loop through all Select2 elements on the page
$('select').each(function() {
  var $select = $(this);
  
  // Check if the element is a Select2 element
  if ($select.hasClass('select2-hidden-accessible')) {
    // Reset the Select2 element's value
    $select.val([]).trigger('change.select2');
  }
});

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
