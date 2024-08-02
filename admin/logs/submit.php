
<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
} 



if($_POST)
{

	$member = $_POST['teacher'];
	$subject = $_POST['subject'];
	$room = $_POST['room'];
	$cys = $_POST['cys'];
	$remarks = $_POST['remarks'];
	
	$m = $_POST['m'];
	$w = $_POST['w'];
	$f = $_POST['f'];
	$t = $_POST['t'];
	$th = $_POST['th'];
	
	$set_id=$_SESSION['settings'];
	$program=$_SESSION['id'];
					
	//monday sched
	foreach ($m as $daym){
		//check conflict for member
		$query_member=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='m'")or die(mysqli_error($conn));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>monday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='m'")or die(mysqli_error($conn));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>monday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='m'")or die(mysqli_error($conn));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc ['cys'] ;
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>monday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>					
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($conn,"select * from faculty where facultyid='$member'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($conn,"select * from time where time_id='$daym'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($conn,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by) 
				VALUES('$daym','m','$member','$subject','$cys','$room','$remarks','$set_id','$program')")or die(mysqli_error());
				
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
		$query_member=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='w'")or die(mysqli_error($conn));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>wednesday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='w'")or die(mysqli_error($conn));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>wednesday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='w'")or die(mysqli_error($conn));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>wednesday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>					
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($conn,"select * from faculty where facultyid='$member'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($conn,"select * from time where time_id='$daym'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($conn,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by) 
				VALUES('$daym','w','$member','$subject','$cys','$room','$remarks','$set_id','$program')")or die(mysqli_error());
				
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
		$query_member=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='f'")or die(mysqli_error($conn));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>friday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='f'")or die(mysqli_error($conn));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>friday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='f'")or die(mysqli_error($conn));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>friday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>					
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($conn,"select * from faculty where facultyid='$member'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($conn,"select * from time where time_id='$daym'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($conn,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by) 
				VALUES('$daym','f','$member','$subject','$cys','$room','$remarks','$set_id','$program')")or die(mysqli_error());
				
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
		$query_member=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='t'")or die(mysqli_error($conn));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>tuesday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='t'")or die(mysqli_error($conn));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>tuesday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='t'")or die(mysqli_error($conn));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>tuesday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>					
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($conn,"select * from faculty where facultyid='$member'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($conn,"select * from time where time_id='$daym'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($conn,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by) 
				VALUES('$daym','t','$member','$subject','$cys','$room','$remarks','$set_id','$program')")or die(mysqli_error($conn));
				
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
		$query_member=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where facultyid='$member' and schedule.time_id='$daym' and day='th'")or die(mysqli_error($conn));
			$row=mysqli_fetch_array($query_member);
			$count_t=$row['count'];
			$time1=date("h:i a",strtotime($row['time_start']))."-".date("h:i a",strtotime($row['time_end']));
			$member1=$row['lastname'].", ".$row['firstname'];
			
			$error_t="<span class='text-danger'>
			<table width='100%'>
				<tr>	
					<td>thursday</td>
					<td>$time1</td> 
					<td>$member1</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
		
		//check conflict for room
		$query_room=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where room='$room' and schedule.time_id='$daym' and day='th'")or die(mysqli_error($conn));
			$rowr=mysqli_fetch_array($query_room);
			$count_r=$rowr['count'];
			$timer=date("h:i a",strtotime($rowr['time_start']))."-".date("h:i a",strtotime($rowr['time_end']));
			$roomr=$rowr['room'];
			
			$error_r="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>thursday</td>
					<td>$timer</td> 
					<td>Room $roomr</td>
					<td class='text-danger'><b>Not Available</b></td>					
				</tr>
				</span>
			</table>";
			//check conflict for class
		$query_class=mysqli_query($conn,"select *,COUNT(*) as count from schedule 
		natural join faculty natural join time where cys='$cys' and schedule.time_id='$daym' and day='th'")or die(mysqli_error($conn));
			$rowc=mysqli_fetch_array($query_class);
			$count_c=$rowc['count'];
			$cysc=$rowc['cys'];
			$timec=date("h:i a",strtotime($rowc['time_start']))."-".date("h:i a",strtotime($rowc['time_end']));
			
			$error_c="<span class='text-danger'>
			<table width='100%'>
				<tr>
					<td>thursday</td>
					<td>$timec</td> 
					<td>$cysc</td>
					<td class='text-danger'><b>Not Available</b>	</td>					
				</tr>
			</table></span>";	
		
				
		$queryt=mysqli_query($conn,"select * from faculty where facultyid='$member'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($queryt);
				$membert=$rowt['lastname'].", ".$rowt['firstname'];
			
		$querytime=mysqli_query($conn,"select * from time where time_id='$daym'")or die(mysqli_error($conn));
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i a",strtotime($rowt['time_start']))."-".date("h:i a",strtotime($rowt['time_end']));	
		
		
		if (($count_t==0) and ($count_r==0) and ($count_c==0))
		{
			mysqli_query($conn,"INSERT INTO schedule(time_id,day,facultyid,subject_code,cys,room,remarks,settings_id,encoded_by) 
				VALUES('$daym','th','$member','$subject','$cys','$room','$remarks','$set_id','$program')")or die(mysqli_error());
				
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
		
}					  
	
?>