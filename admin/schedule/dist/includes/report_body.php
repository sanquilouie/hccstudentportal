<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
	body {
  background: url(../../../../../assets/images/temp.jpg) center/cover no-repeat;
  margin: 0;
  justify-content: center;
  font-family: Verdana, sans-serif;
  overflow-x: hidden;
  overflow-y: scroll;
  animation: fadeInAnimation ease 1s;
  animation-iteration-count: 1;
  animation-fill-mode: forwards;
}
  .carousel-control-next {
    font-size: 4rem !important;
    color: black !important;
  }
  
  .carousel-control-prev {
    display: none;
  }
  
  .carousel-item table {
    margin: auto;
  }
  
  .carousel-item h5 {
    margin-top: 1rem;
    margin-bottom: 0.5rem;
  }
  
  .carousel-item p {
    margin-bottom: 1rem;
  }
  
  .carousel-item.active {
    display: flex;
    justify-content: center;
  }
  
  .carousel-control-next-icon {
  filter: invert(1);
  transform: scale(3.5);
}

</style>
<div class="container mt-5">
    <div class="row">
      <div class="col-12">
      </div>
      <div class="col-12">
        <div id="table-carousel" class="carousel carousel-dark slide" data-interval="false">
          <div class="carousel-inner">
            <div class="carousel-item active">
<table  style="width:100%;float:left;font-size:15px;" class="table table-hover" id="monWedTable">
							<thead>
							  <tr>
								<th class="first">Time</th>
								<th>M</th>
								<th>W</th>
								<th>F</th>
								
							  </tr>
							</thead>
							
		<?php
				
				$query=mysqli_query($con,"select * from time where days='mwf' order by time_start")or die(mysqli_error());
					
				while($row=mysqli_fetch_array($query)){
						$id=$row['time_id'];
						$start=date("h:i a",strtotime($row['time_start']));
						$end=date("h:i a",strtotime($row['time_end']));
		?>
							  <tr >
								<td class="first"><?php echo $start."-".$end;?></td>
								<td><?php 
								if ($member<>"")
								{
									$query1=mysqli_query($con,"select * from schedule natural join faculty where day='m' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query1=mysqli_query($con,"select * from schedule natural join faculty where day='m' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query1=mysqli_query($con,"select * from schedule natural join faculty where day='m' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
										$row1=mysqli_fetch_assoc($query1);
										$id1=$row1['sched_id'];
										$count=mysqli_num_rows($query1);
										$encode=$row1['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>" ")
											$displayrm= "<li>$row1[remarks]</li>";
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											//echo $row1['subject_code'];
										$test = "select * from subjects where subject = '".$row1['subject_code']."'";
										$query3=mysqli_query($con,$test)or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
										//echo $test;
											echo '
											<div class="show">
												<div style="background-color: '.$row3["subjcolor"].';">
													<ul>
														<li class="options" style="display:'.$options.'">
															<span id="btnedit" style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
															<span id="btndelete" class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
														</li>
													</ul>
													<ul>
														<li class="showme">
														<li>'.$row1["subject_code"].'</li>
														<li class="'.$displayc.'">'.$row1['cys'].'</li>
														<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
														<li class="'.$displayr.'">Room '.$row1['room'].'</li>
															'.$displayrm.'
													</ul>
												</div>
											</div>';
										}	
									?>
								</td>
								<td><?php 
									if ($member<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='w' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='w' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='w' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								
										$row1=mysqli_fetch_array($query2);
										$count=mysqli_num_rows($query2);
										$id1=$row1['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row1['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>"")
											$displayrm= "<li>$row1[remarks]</li>";
											
										
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query3=mysqli_query($con,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
										echo '
										<div class="show">
											<div style="background-color: '.$row3["subjcolor"].';">
												<ul>
													<li class="options" style="display:'.$options.'">
														<span style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
														<span class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
													</li>
												</ul>
												<ul>
													<li class="showme">
													<li>'.$row1["subject_code"].'</li>
													<li class="'.$displayc.'">'.$row1['cys'].'</li>
													<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
													<li class="'.$displayr.'">Room '.$row1['room'].'</li>
														'.$displayrm.'
												</ul>
											</div>
										</div>';
										}	
									?>
								</td>
								<td><?php 
								if ($member<>"")
								{
									$query3=mysqli_query($con,"select * from schedule natural join faculty where day='f' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query3=mysqli_query($con,"select * from schedule natural join faculty where day='f' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query3=mysqli_query($con,"select * from schedule natural join faculty where day='f' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
										$row1=mysqli_fetch_array($query3);
										$count=mysqli_num_rows($query3);
										$id1=$row1['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row1['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>"")
											$displayrm= "<li>$row1[remarks]</li>";
											
										else
											$displayrm="";
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query3=mysqli_query($con,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
										echo '
										<div class="show">
											<div style="background-color: '.$row3["subjcolor"].';">
												<ul>
													<li class="options" style="display:'.$options.'">
														<span style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
														<span class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
													</li>
												</ul>
												<ul>
													<li class="showme">
													<li>'.$row1["subject_code"].'</li>
													<li class="'.$displayc.'">'.$row1['cys'].'</li>
													<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
													<li class="'.$displayr.'">Room '.$row1['room'].'</li>
														'.$displayrm.'
												</ul>
											</div>
										</div>';
										}	
									?>
								</td>
								
							  </tr>
							
		<?php }?>					  
		</table>    
		</div>
            <div class="carousel-item">
			<table  style="width:100%;float:left;font-size:15px;" class="table table-hover" id="thuSatTable">
				<thead>
					<tr>
					<th class="first"  style="width:25%;">Time</th>
					<th>T</th>
					<th>TH</th>
					<th>S</th>
					<th>SU</th>
					</tr>
				</thead>
								
			<?php
					
					$query=mysqli_query($con,"select * from time where days='tth' order by time_start")or die(mysqli_error());
						
					while($row=mysqli_fetch_array($query)){
							$id=$row['time_id'];
							$start=date("h:i a",strtotime($row['time_start']));
							$end=date("h:i a",strtotime($row['time_end']));
			?>
								  <tr >
								<td class="first" ><?php echo $start."-".$end;?></td>
								<td class="sec"  style="width:25%;">
								<?php 
								if ($member<>"")
								{
									$query1=mysqli_query($con,"select * from schedule natural join faculty where day='t' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query1=mysqli_query($con,"select * from schedule natural join faculty where day='t' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query1=mysqli_query($con,"select * from schedule natural join faculty where day='t' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
										$row1=mysqli_fetch_array($query1);
										$count=mysqli_num_rows($query1);
										$id1=$row1['sched_id'];
										
										$encode=$row1['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>"")
											$displayrm= "<li>$row1[remarks]</li>";
											
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query3=mysqli_query($con,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
											echo '
											<div class="show">
											<ul>
												<li class="options" style="display:'.$options.'">
													<span style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
													<span class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
												</li></ul>
											
											<ul style="background-color: '.$row3["subjcolor"].';">
											<li class="showme">
												<li>'.$row1["subject_code"].'</li>
												<li class="'.$displayc.'">'.$row1['cys'].'</li>
												<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
												<li class="'.$displayr.'">Room '.$row1['room'].'</li>
													'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td class="sec"  style="width:25%;"><?php 
								if ($member<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='th' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='th' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='th' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
										$row1=mysqli_fetch_array($query2);
										$count=mysqli_num_rows($query2);
										$id1=$row1['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row2['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>"")
											$displayrm1= "<li>$row1[remarks]</li>";
											
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query3=mysqli_query($con,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
											echo '
											<div class="show">
											<ul>
												<li class="options" style="display:'.$options.'">
													<span style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
														<span class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
												</li></ul>
											
											<ul style="background-color: '.$row3["subjcolor"].';">
											<li class="showme">
												<li>'.$row1["subject_code"].'</li>
												<li class="'.$displayc.'">'.$row1['cys'].'</li>
												<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
												<li class="'.$displayr.'">Room '.$row1['room'].'</li>
													'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td class="sec"  style="width:25%;"><?php 
								if ($member<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='s' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='s' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='s' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
										$row1=mysqli_fetch_array($query2);
										$count=mysqli_num_rows($query2);
										$id1=$row1['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row2['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>"")
											$displayrm1= "<li>$row1[remarks]</li>";
											
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query3=mysqli_query($con,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
											echo '
											<div class="show">
											<ul>
												<li class="options" style="display:'.$options.'">
													<span style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
														<span class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
												</li></ul>
											
											<ul style="background-color: '.$row3["subjcolor"].';">
											<li class="showme">												<li>'.$row1["subject_code"].'</li>
												<li class="'.$displayc.'">'.$row1['cys'].'</li>
												<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
												<li class="'.$displayr.'">Room '.$row1['room'].'</li>
													'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td class="sec"  style="width:25%;"><?php 
								if ($member<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='u' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='u' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($con,"select * from schedule natural join faculty where day='u' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($con));
								}
										$row1=mysqli_fetch_array($query2);
										$count=mysqli_num_rows($query2);
										$id1=$row1['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row2['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>"")
											$displayrm1= "<li>$row1[remarks]</li>";
											
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query3=mysqli_query($con,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
										$row3=mysqli_fetch_array($query3);
											echo '
											<div class="show">
											<ul>
												<li class="options" style="display:'.$options.'">
													<span style="float:left;"><a href="mainte_sched_edit.php?id='.$id1.'" class="edit" title="Edit">Edit</a></span>
														<span class="action"><a href="#" id="'.$id1.'" class="delete" title="Delete">Remove</a></span>
												</li></ul>
											
											<ul style="background-color: '.$row3["subjcolor"].';">
											<li class="showme">												<li>'.$row1["subject_code"].'</li>
												<li class="'.$displayc.'">'.$row1['cys'].'</li>
												<li class="'.$displaym.'">'.$row1['lastname'].', '.$row1['firstname'].'</li>										
												<li class="'.$displayr.'">Room '.$row1['room'].'</li>
													'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
							  </tr>
			
			<?php }?>					  
			</table>
			</div>
          </div>
          

</div>
</div>
</div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			