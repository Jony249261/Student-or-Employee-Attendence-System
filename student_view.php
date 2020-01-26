<?php
include "inc/header.php ";
include "lib/Student.php ";
 ?>
 <script type="text/javascript">
	$(document).ready(function(){
		$("form").submit(function(){
			var roll = true;
			$(':radio').each(function(){
				name = $(this).attr('name');
				if(roll && !$(':radio[name="'+ name +'"]:checked').length){
					//alert(name + " Roll MIssing!");
					$('.alert').show();
					roll = false;
				}
			});
			return roll;
		});
	});
</script>


 <?php
$stu = new Student();
//error_reporting(0);
$dt = $_GET['dt'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$attend = $_POST['attend'];
	$att_update = $stu->updateAttendence($dt,$attend);
}

 ?>
 <?php
	if(isset($att_update)){
		echo $att_update;
	}
?>
	<div class='alert alert-success text-center' style="display: none"><strong>Error!</strong>Student Roll Missing</Div>
	<div class="panel-body">

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="add.php">Add Student</a>
			<a class="btn btn-info pull-right" href="date_view.php">Back</a>
		</h2>
	</div>
	<div class="panel-body">
				<div class="well text-center h4">
			<strong>Date: </strong><?php $cur_date = date('Y-m-d'); echo $dt; ?>
		</div>
		<form action="" method="post">
			<table class="table table-striped">
				<tr>
					<th width="25%">Serial</th>
					<th width="25%">Student Name</th>
					<th width="25%">Student Roll</th>
					<th width="25%">Attendence</th>		
				</tr>

<?php
	$stu = new Student();
	$get_student = $stu->getAllData($dt);

	if($get_student){
		$i=0;
		while ($value = $get_student->fetch_assoc()) {
			
			$i++;

?>

				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $value['roll']; ?></td>
					<td>
						<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present"<?php if($value['attend'] == "present"){echo "checked";} ?>>Present
						<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent"<?php if($value['attend'] == "absent"){echo "checked";} ?>>Absent 
					</td>
				</tr>

<?php
}  }
?>
<tr>
					<td colspan="4" class="text-center">
						<input type="submit" name="Submit" value="Update" class="btn btn-success btn-block">
					</td>
				</tr>
			</table>
		</form>
	</div>
			
</div>

<?php
include "inc/footer.php ";
 ?>