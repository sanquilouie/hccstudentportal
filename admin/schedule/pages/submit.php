
 <?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
error_reporting(0);
if($_POST)
{
include('../dist/includes/dbcon.php');

	$member = $_POST['teacher'];
	$subject = $_POST['subject'];
	$room = $_POST['room'];
	$options = $_POST['options'];
	$tempcys = substr($_POST['cys'], 0, strpos($_POST['cys'], ','));
	$cys = $tempcys;
	$remarks = $_POST['remarks'];
	
	$m = $_POST['m'];
	$w = $_POST['w'];
	$f = $_POST['f'];
	$t = $_POST['t'];
	$th = $_POST['th'];
	$s = $_POST['s'];
	$u = $_POST['u'];
	
	$set_id=$_SESSION['settings'];
	$program=$_SESSION['id'];
			
	//monday sched
	foreach ($m as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='m'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>monday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Faculty Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='m' and room not like 'TBA'")or die(mysqli_error($con));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>monday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Room Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='m'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc ['cys'] ;
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>monday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Class Not Available</b>	</td>	
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','m','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error());
				
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>monday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}
	//------------------------------------------------
	//wednesday sched
	foreach ($w as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='w'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			$subjectCode = $row['subject_code'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>wednesday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='w' and room not like 'TBA'")or die(mysqli_error($con));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>wednesday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='w'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>wednesday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>	
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','w','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error());
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>wednesday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}
	
	//-------------------------------------------------------------
	//friday sched
	foreach ($f as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='f'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>friday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>		
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='f' and room not like 'TBA'")or die(mysqli_error($con));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>friday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='f'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>friday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>	
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','f','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error());
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>friday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}
	//------------------------------------------------
	//tuesday sched
	foreach ($t as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='t'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>tuesday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='t' and room not like 'TBA'")or die(mysqli_error($con));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>tuesday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='t'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>tuesday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>	
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','t','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error($con));
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>tuesday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}
	
	//--------------------------------------------------
	//thursday sched
	foreach ($th as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='th'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>thursday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='th' and room not like 'TBA'")or die(mysqli_error($con));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>thursday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>		
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='th'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>thursday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>	
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','th','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error());
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>thursday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}

	//--------------------------------------------------
	//Saturday sched
	foreach ($s as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='s'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>saturday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='s' and room not like 'TBA'")or die(mysqli_error($con));
		
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>saturday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='s'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>saturday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','s','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error());
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>saturday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}

	//sunday sched
	foreach ($u as $daym){
		//check conflict for member
		$query_member=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='u'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			$subjectCode = $row['subject_code'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>sunday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Faculty Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='u' and room not like 'TBA'")or die(mysqli_error($con));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			$subjectCode = $row['subject_code'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>sunday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Room Not Available</b></td>	
					<td>$subjectCode</td>
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($con,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='u'")or die(mysqli_error($con));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc ['cys'] ;
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			$subjectCode = $row['subject_code'];
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>sunday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Class Not Available</b>	</td>	
					<td>$subjectCode</td>
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($con,"select * from faculty where facultyid='$member'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($con,"select * from time where time_id='$daym'")or die(mysqli_error($con));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($con,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by,classtype) 
				VALUES('$daym','u','$member','$subject','$cys','$room','$remarks','$set_id','$program','$options')")or die(mysqli_error());
				
				
			echo "<span class='text-success'>
			<table width='100%'>
				<tr>
					<td>sunday</td>
					<td>$timet</td> 
					
					<td>Success</td>					
				</tr>
			</table></span><br>";	
		}
					
		else if ($count_t>0) echo $error_t."<br>";
		else if ($count_r>0) echo $error_r."<br>";
		else {echo $error_c."<br>";}	
		
		//echo "</table>";
	}
		
}					  
	
?>