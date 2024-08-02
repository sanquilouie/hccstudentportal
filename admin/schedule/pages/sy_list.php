
<table id="example2" class="table table-bordered table-striped" style="margin-right:-10px">
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
