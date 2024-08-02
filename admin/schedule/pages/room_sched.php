<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;?>
<?php error_reporting(0);?>
<!DOCTYPE hmtl>
<html>
<head>
<link rel="stylesheet" href="../dist/css/print.css" media="print">
<script src="../dist/js/jquery.min.js"></script>

</head>
<body>
<?php 
include('../dist/includes/dbcon.php');
 ?>
  <script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function() {
			
		
			
			});

      $(function() {
$(".delete").on('click',function(){
  console.log('ssacs')
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?" + info))
{
 $.ajax({
   type: "POST",
   url: "class_sched_del.php",
   data: info,
   success: function(){
 }
});
  $(this).parents(".show").animate({ backgroundColor: "#003" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});
}); 
			</script>
 <script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function() {
			
		window.print()
			
			)};
			</script>
 
 <div class="wrapper_print">
 <?php 
 if (isset($_POST['search']))

$room=$_POST['room'];
$sid=$_SESSION['settings'];

$settings=mysqli_query($con,"select * from settings where settings_id='$sid'")or die(mysqli_error($con));
	$rows=mysqli_fetch_array($settings);

	include('../dist/includes/report_header.php');
  echo '<br><button onclick="printSchedule()">Print Schedule</button>';
	include('../dist/includes/report_body.php');
	include('../dist/includes/report_footer.php');
?> 

 
  </body>

  </html>

  <script>
	function printSchedule() {
	  var monWedTable = document.getElementById("monWedTable").cloneNode(true);
	  var thuSatTable = document.getElementById("thuSatTable").cloneNode(true);

	  // Set display none for elements with class "action" and "edit"
	  var actionElements = monWedTable.querySelectorAll('.action');
	  var editElements = monWedTable.querySelectorAll('.edit');
	  for (var i = 0; i < actionElements.length; i++) {
	    actionElements[i].style.display = "none";
	  }
	  for (var i = 0; i < editElements.length; i++) {
	    editElements[i].style.display = "none";
	  }

	  actionElements = thuSatTable.querySelectorAll('.action');
	  editElements = thuSatTable.querySelectorAll('.edit');
	  for (var i = 0; i < actionElements.length; i++) {
	    actionElements[i].style.display = "none";
	  }
	  for (var i = 0; i < editElements.length; i++) {
	    editElements[i].style.display = "none";
	  }

	  var newWin = window.open('', 'Print-Window');
	  newWin.document.open();
	  newWin.document.write('<html><head><style>table, td, th {border: 1px solid black; border-collapse: collapse;} td, th {padding: 5px;}</style></head><body>');
	  newWin.document.write('<h1>Room Schedule</h1>');

	  // Add the custom HTML code at the top of the table
	  newWin.document.write('<div>');
	  newWin.document.write('<span style="margin-right: 5px"><?php echo $text;?>: </span>');
	  newWin.document.write('<span style="color: blue; margin-right: 15px"><?php echo $value;?></span>');
	  newWin.document.write('<span style="margin-right: 5px;">School Year:</span>');
	  newWin.document.write('<span style="color: blue; margin-right: 15px"><?php echo $rows['sy']; ?></span>');
	  newWin.document.write('<span style="margin-right: 5px">Semester: </span>');
	  newWin.document.write('<span style="color: blue; margin-right: 15px"><?php echo $rows['sem']; ?></span>');
	  newWin.document.write('</div>');

	  newWin.document.write(monWedTable.outerHTML);

	  // Add a page break before the thuSatTable
	  newWin.document.write('<div style="page-break-before: always;"></div>');

	  newWin.document.write('<h1>Thursday-Sunday Schedule</h1>');
	  newWin.document.write(thuSatTable.outerHTML);
	  newWin.document.write('</body></html>');
	  newWin.document.close();

	  setTimeout(function() {
	    newWin.print();
	    newWin.close();
	  }, 100);
	}
</script>