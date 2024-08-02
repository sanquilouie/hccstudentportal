
<table class="table table-bordered table-striped" style="margin-right:-10px">
							<thead>
							  <tr>
								<th>Course</th>
								<th>Year</th>
								<th>Section</th>
								<th>Action</th>
								
								
							  </tr>
							</thead>
							
		<?php
				include('../dist/includes/dbcon.php');
				$query=mysqli_query($con,"select * from cys order by course desc")or die(mysqli_error());
					
					while($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$course=$row['course'];
						$year=$row['year'];
						$section=$row['section'];
		?>
							  <tr>
								<td><?php echo $course;?></td>
								<td><?php echo $year;?></td>
								<td><?php echo $section;?></td>
								 
								<td>
								<a id="removeme" href="cys_del.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete this Section?');">
								<i class="glyphicon glyphicon-remove text-red"></i></a>
								</td>
				
							  </tr>

							
<?php }?>					  
</table>  
