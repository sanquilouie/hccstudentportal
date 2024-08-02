
<table style="width:100%;float:left;font-size:15px;background: rgba(170, 209, 163, 0.9)" class="table table-hover">
							<thead>
							  <tr >
								<th class="first">Time</th>
								<th>M</th>
								<th>W</th>
								<th>F</th>
								
							  </tr>
							</thead>
							
		<?php
				
				$query=mysqli_query($conn,"select * from time where days='mwf' order by time_start")or die(mysqli_error());
					
				while($row=mysqli_fetch_array($query)){
						$id=$row['time_id'];
						$start=date("h:i a",strtotime($row['time_start']));
						$end=date("h:i a",strtotime($row['time_end']));
		?>
							  <tr >
								<td class="first"><?php echo $start."-".$end;?></td>
								<td ><?php 
								if ($member<>"")
								{
									$query1=mysqli_query($conn,"select * from schedule natural join faculty where day='m' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($room<>"")
								{
									$query1=mysqli_query($conn,"select * from schedule natural join faculty where day='m' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($class<>"")
								{
									$query1=mysqli_query($conn,"select * from schedule natural join faculty where day='m' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
										$row1=mysqli_fetch_array($query1);
										$id1=$row1['sched_id'];
										$count=mysqli_num_rows($query1);
										$encode=$row1['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row1['remarks']<>" ")
											$displayrm= "<li>$row1[remarks]</li>";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query5=mysqli_query($conn,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
											$row5=mysqli_fetch_array($query5);
											echo '
											<ul style="background-color: '.$row5["subjcolor"].';">
												<li>'.$row1["subject_code"].'</li>
											 	<li>'.$row1['cys'].'</li>
											 	<li>'.$row1['lastname'].', '.$row1['firstname'].'</li>										
											 	<li>Room '.$row1['room'].'</li>
											 	'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td><?php 
									if ($member<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='w' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='w' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='w' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
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
											$options="none";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query5=mysqli_query($conn,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
											$row5=mysqli_fetch_array($query5);
											echo '
											<ul style="background-color: '.$row5["subjcolor"].';">
												<li>'.$row1["subject_code"].'</li>
											 	<li>'.$row1['cys'].'</li>
											 	<li>'.$row1['lastname'].', '.$row1['firstname'].'</li>										
											 	<li>Room '.$row1['room'].'</li>
											 	'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td><?php 
								if ($member<>"")
								{
									$query3=mysqli_query($conn,"select * from schedule natural join faculty where day='f' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($room<>"")
								{
									$query3=mysqli_query($conn,"select * from schedule natural join faculty where day='f' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($class<>"")
								{
									$query3=mysqli_query($conn,"select * from schedule natural join faculty where day='f' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
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
											$options="none";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query5=mysqli_query($conn,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
											$row5=mysqli_fetch_array($query5);
											echo '
											<ul style="background-color: '.$row5["subjcolor"].';">
												<li>'.$row1["subject_code"].'</li>
											 	<li>'.$row1['cys'].'</li>
											 	<li>'.$row1['lastname'].', '.$row1['firstname'].'</li>										
											 	<li>Room '.$row1['room'].'</li>
											 	'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								
							  </tr>
							
		<?php }?>					  
		</table>    
		<br/><br/><br/>
			<table style="width:100%;float:left;font-size:15px;background: rgba(170, 209, 163, 0.9)" class="table table-hover">
								<thead >
								  <tr>
									<th class="first" style="width:25%;">Time</th>
									<th>T</th>
									<th>TH</th>
									<th>S</th>
								  </tr>
								</thead>
								
			<?php
					
					$query=mysqli_query($conn,"select * from time where days='tth' order by time_start")or die(mysqli_error());
						
					while($row=mysqli_fetch_array($query)){
							$id=$row['time_id'];
							$start=date("h:i a",strtotime($row['time_start']));
							$end=date("h:i a",strtotime($row['time_end']));
			?>
								  <tr >
								<td class="first"><?php echo $start."-".$end;?></td>
								<td class="sec" >
								<?php 
								if ($member<>"")
								{
									$query1=mysqli_query($conn,"select * from schedule natural join faculty where day='t' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($room<>"")
								{
									$query1=mysqli_query($conn,"select * from schedule natural join faculty where day='t' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($class<>"")
								{
									$query1=mysqli_query($conn,"select * from schedule natural join faculty where day='t' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
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
											$options="none";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query5=mysqli_query($conn,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
											$row5=mysqli_fetch_array($query5);
											echo '
											<ul style="background-color: '.$row5["subjcolor"].';">
												<li>'.$row1["subject_code"].'</li>
											 	<li>'.$row1['cys'].'</li>
											 	<li>'.$row1['lastname'].', '.$row1['firstname'].'</li>										
											 	<li>Room '.$row1['room'].'</li>
											 	'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td class="sec"><?php 
								if ($member<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='th' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='th' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='th' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
										$row2=mysqli_fetch_array($query2);
										$count=mysqli_num_rows($query2);
										$id1=$row2['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row2['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row2['remarks']<>"")
											$displayrm1= "<li>$row2[remarks]</li>";
											
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="none";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query5=mysqli_query($conn,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
											$row5=mysqli_fetch_array($query5);
											echo '
											<ul style="background-color: '.$row5["subjcolor"].';">
												<li>'.$row1["subject_code"].'</li>
											 	<li>'.$row1['cys'].'</li>
											 	<li>'.$row1['lastname'].', '.$row1['firstname'].'</li>										
											 	<li>Room '.$row1['room'].'</li>
											 	'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								<td class="sec"><?php 
								if ($member<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='s' and schedule.facultyid='$member' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($room<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='s' and schedule.room='$room' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
								elseif ($class<>"")
								{
									$query2=mysqli_query($conn,"select * from schedule natural join faculty where day='s' and schedule.cys='$class' and time_id='$id' and settings_id='$sid'")or die(mysqli_error($conn));
								}
										$row2=mysqli_fetch_array($query2);
										$count=mysqli_num_rows($query2);
										$id1=$row2['sched_id'];
										//$count=mysqli_num_rows($query1);
										$encode=$row2['encoded_by'];
										$mid=$_SESSION['id'];
										if ($row2['remarks']<>"")
											$displayrm1= "<li>$row2[remarks]</li>";
											
										if($mid==$encode)
										{
											$options="";
										}
										else
											$options="none";
										if ($count==0)
										{
											//echo "<td></td>";
										}
										else
										{
											$query5=mysqli_query($conn,"select * from subjects where subject = '".$row1['subject_code']."'")or die(mysqli_error($con));
											$row5=mysqli_fetch_array($query5);
											echo '
											<ul style="background-color: '.$row5["subjcolor"].';">
												<li>'.$row1["subject_code"].'</li>
											 	<li>'.$row1['cys'].'</li>
											 	<li>'.$row1['lastname'].', '.$row1['firstname'].'</li>										
											 	<li>Room '.$row1['room'].'</li>
											 	'.$displayrm.'
											</ul>';
										}	
									?>
								</td>
								
							  </tr>
			
			<?php }?>					  
			</table>
			
			