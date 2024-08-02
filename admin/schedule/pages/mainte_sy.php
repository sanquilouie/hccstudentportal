
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
            overflow-y: hidden;
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
    <div class="wrapper">
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
        

          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-md-9">
                <div class="box box-warning">
                  <form method="post" id="reg-form">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="result" id="form">
                            <table id="example1" class="table table-bordered table-striped" style="margin-right:-10px">
                                <thead>
                                    <tr>
                                    <th>School Year</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>						
                                    <?php
                                        include('../dist/includes/dbcon.php');
                                        $query=mysqli_query($con,"select * from sy order by sy desc")or die(mysqli_error());
                                                
                                        while($row=mysqli_fetch_array($query)){
                                            $id=$row['sy_id'];
                                            $sy=$row['sy'];
                                    ?>
		                            <tr>
                                    <td><?php echo $sy;?></td>	
                                    <td>
                                    <a id="click" href="mainte_sy.php?id=<?php echo $id;?>&sy=<?php echo $sy;?>">
                                    <i class="glyphicon glyphicon-edit text-blue"></i></a>
                                    <a id="removeme" href="sy_del.php?id=<?php echo $id;?>">
                                    <i class="glyphicon glyphicon-remove text-red"></i></a>
                                    </td>
                                    </tr>				
                            <?php }?>					  
                            </table>  

                          </div>
                        </div><!--col end -->
                        <div class="col-md-6">		
                        </div><!--col end-->           
                      </div><!--row end-->        
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col (right) -->
            
              <div class="col-md-3">
                <div class="box box-warning">
                  <div class="box-body">
                  <!-- Date range -->
                    <div id="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="date">Add School Year</label><br>
                            <input type="text" class="form-control" name="sy" placeholder="School Year" required> 
                          </div><!-- /.form group -->
                        </div>
                      </div>	
                  
                      
                      <div class="form-group">
                        <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="save" type="submit">
                          Save
                        </button>
                        <button class="btn btn-lg btn-block" id="daterange-btn" type="reset">
                          Cancel
                        </button>
                      </div>
                    </div><!-- /.form group -->
                  </form>	
        <div class="box-body" style="" id="displayform">
                  <!-- Date range -->
                  <div id="form">
					
				  <div class="row">
					 <div class="col-md-12">
						  <form method="post" action="sy_update.php">
						  <div class="form-group">
							<label for="date">Update School Year</label><br>
								<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_REQUEST['id'];?>" placeholder="SY ID" readonly>
								<input type="text" class="form-control" id="sy" name="sy" value="<?php echo $_REQUEST['sy'];?>" placeholder="School Year" required>
						  </div><!-- /.form group -->
					</div>
				  </div>	
               
                  
                  <div class="form-group">
                    
                      <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="save" type="submit">
                        Update
                      </button>
					  
					  </form>
					  
                   </div>
                  </div><!-- /.form group --><hr>
				
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->		
          </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
	<script>
		//$(document).ready(function(){
		//$(".result").load("sy_list.php");
	//});
	</script>
	
	<script type="text/javascript">
		$("#reg-form").on('submit', function() {  
        $.post('sy_save.php', $(this).serialize(), function(data) {
            alert("Successfully added School Year!");
            location.reload();
        });
    return false;
});


		
        var clockElement = document.getElementById('clock');
  function clock() {
    var date = new Date();
      clockElement.textContent = date.toLocaleString();;
    }
    setInterval(clock, 100);
		
</script>

	<script type="text/javascript" src="autosum.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
        $("#example1").DataTable({
    "pageLength": 5
  });
  
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "pageLength": 5
  });
});
    </script>
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
    <div class="back-button">
  <a href="mainte_home.php">
    <button class="btn btn-primary btn-lg">Back</button>
  </a>
</div>
  </body>
</html>
