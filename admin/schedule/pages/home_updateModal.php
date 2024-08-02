<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<b><h3 class="modal-title" id="myModalLabel">Modify Course, Yr & Section</h4></b>
		</div>
		<div class="modal-body">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#add"><b>Add</b></a></li>
			<li><a data-toggle="tab" href="#update"><b>Update</b></a></li>
			<li><a data-toggle="tab" href="#delete"><b>Delete</b></a></li>
			</ul>

			<div class="tab-content">
			<div id="add" class="tab-pane fade in active">
			    
			<form method="post" action="cys_save.php">
					<div id="form">
						<div class="row">
							<div class="col-md-12">
							<div class="form-group">
								<label>Course</label>
								<!--<button class="btn btn-sm btn-danger pull-right" onclick="addCourse()" hidden>Delete</button>-->
								<button class="btn btn-md btn-primary pull-right" onclick="addCourse()" style="padding-left:15px;padding-right:15px;">Add Course</button>
								<br>
								<select id="add_course" name="add_course" class="pre_enroll_form form-control" required="">
								    <option value="" selected="">Grade/Course/Program You're applying for.</option>
								    <?php 
									$query2=mysqli_query($con,"select * from courses")or die(mysqli_error($con));
									 while($row=mysqli_fetch_array($query2)){
								  ?>
								  
										<option value="<?php echo $row['abbrev'];?>">
										    <?php echo $row['course'];?></option>
								  <?php 
								  
								}	
								  ?>
									<!--<option value="" selected="">Grade/Course/Program You're applying for.</option>
									<option value="BEED">Bachelor of Elementary Education</option>
									<option value="BSEDE">Bachelor of Secondary Education Major in English</option>
									<option value="BSEDM">Bachelor of Secondary Education Major in Mathematics</option>
									<option value="BSA">Bachelor of Science in Accountancy</option>
									<option value="BSAIS">Bachelor of Science in Accounting, Information System</option>
									<option value="BSBAFM">Bachelor of Science in Business Administration Major in Financial Management</option>
									<option value="BSBAMM">Bachelor of Science in Business Administration Major in Marketing Management</option>
									<option value="BSCS">Bachelor of Science in Computer Science</option>
									<option value="BSCRIM">Bachelor of Science in Criminology</option>
									<option value="BSHM">Bachelor of Science in Hospitality Management</option>-->
                				</select> 
								<label>Year</label><br>
								<select id="add_year" name="add_year" class="pre_enroll_form form-control" required="">
									<option value="" selected="" hidden="">Select the year you're in this academic year.</option>
									<option value="1">First Year College (1st Yr.)</option>
									<option value="2">Second Year College (2nd Yr.)</option>
									<option value="3">Third Year College (3rd Yr.)</option>
									<option value="4">Fourth Year College (4th Yr.)</option>
                  				</select>  
								<label>Section</label><br>
								<input type="text" class="form-control" name="add_section" placeholder="Section" required> 
							</div><!-- /.form group -->
							</div>
						</div>	
						<div class="form-group">
							<button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="save" type="submit">
							Save
							</button>
						</div>
					</div><!-- /.form group -->	
</form>
			</div>
			<div id="update" class="tab-pane fade">
			<form method="post" action="cys_update.php">
				<input type="text" id="hiddenID" name="hiddenID" hidden> 
													
						
							<div id="form">
								<div class="row">
									<div class="col-md-12">
									<div class="form-group">
										<label>Course</label><br>
										<select id="update_course" name="update_course" class="pre_enroll_form form-control" required>
									
									<option value="BEED">Bachelor of Elementary Education</option>
									<option value="BSEDE">Bachelor of Secondary Education Major in English</option>
									<option value="BSEDM">Bachelor of Secondary Education Major in Mathematics</option>
									<option value="BSA">Bachelor of Science in Accountancy</option>
									<option value="BSAIS">Bachelor of Science in Accounting, Information System</option>
									<option value="BSBAFM">Bachelor of Science in Business Administration Major in Financial Management</option>
									<option value="BSBAMM">Bachelor of Science in Business Administration Major in Marketing Management</option>
									<option value="BSCS">Bachelor of Science in Computer Science</option>
									<option value="BSCRIM">Bachelor of Science in Criminology</option>
									<option value="BSHM">Bachelor of Science in Hospitality Management</option>
                				</select> 
										<label>Year</label><br>
										<select id="update_year" name="update_year" class="pre_enroll_form form-control" required>
									
									<option value="1">First Year College (1st Yr.)</option>
									<option value="2">Second Year College (2nd Yr.)</option>
									<option value="3">Third Year College (3rd Yr.)</option>
									<option value="4">Fourth Year College (4th Yr.)</option>
                  				</select>  
										<label>Section</label><br>
										<select class="form-control" id="update_section" name="update_section" required>
											<?php 
												$query2=mysqli_query($con,"select distinct(section) as sect from cys")or die(mysqli_error($con));
												while($row=mysqli_fetch_array($query2)){
											?>
													<option><?php echo $row['sect'];?></option>
											<?php }
												
											?>
										</select>	
									</div><!-- /.form group -->
									</div>
								</div>	
								<div class="form-group">
									<button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="save" type="submit">
									Update
									</button>
								</div>
								</div><!-- /.form group -->
				</form>
			</div>
			<div id="delete" class="tab-pane fade">
				<div class="result" id="form"></div>
			</div>
			</div>
												</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
	</div>
	
	<script>
function addCourse() {
  let text;
  let abbrev = prompt("Please enter Degree Abbrev.:");
  let degree = prompt("Please enter Degree Name.:");
  if (abbrev == null || abbrev == "" || degree == null || degree == "") {
    alert ("Error, Please Try Again.");
  } else {
    $.ajax({
               type  : 'POST',
                url  : 'home_addCourse.php',
                data : {abbrev:abbrev, degree:degree},
                success: function (data) {
                alert("Succesfully Added a Course!");
                document.location='mainte_sched.php'
                }
            });
  }
}
</script>