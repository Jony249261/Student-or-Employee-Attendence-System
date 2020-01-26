<?php
include "inc/header.php ";
include "lib/Student.php ";
 ?>
  <?php
$stu = new Student();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$roll = $_POST['roll'];
	$insertdata = $stu->insertStudent($name,$roll);
}
?>
<?php
	if(isset($insertdata)){
		echo $insertdata;
	}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="add.php">Add Student</a>
			<a class="btn btn-info pull-right" href="index.php">Back</a>
		</h2>
	</div>
	<div class="panel-body">
		<form action="" method="post">
			<div class="form-group">
				<label for="name">Student Name</label>
				<input class="form-control" type="text" name="name" id="name" >
			</div>

			<div class="form-group">
				<label for="roll">Student Roll</label>
				<input class="form-control" type="text" name="roll" id="roll" >

				<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success btn-block" value="Submit" >
			</div>
			</div>
		</form>
	</div>
			
</div>

<?php
include "inc/footer.php ";
 ?>