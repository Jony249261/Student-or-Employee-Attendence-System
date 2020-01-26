<?php
include_once ('Database.php');
?>

<?php

class Student
{
	private $db;
	public function __construct()
	{
		$this->db = new Database();
	}
	public function getStudent()
	{
		$query = "SELECT * FROM tbl_student";
		 $result = $this->db->select($query);
		 return $result;
	}
	public function insertStudent($name,$roll){
			$name = mysqli_real_escape_string($this->db->link, $name);
			$roll = mysqli_real_escape_string($this->db->link, $roll);
			if(empty($name) || empty($roll)){
				$msg = "<div class='alert  alert-danger text-center'><strong>Error!</strong>Field Must not be empty ! </div>";
				return $msg;
			}else{
				$stu_query = "INSERT INTO tbl_student(name,roll) VALUES('$name','$roll')";
				$stu_insert = $this->db->insert($stu_query);

				$att_query = "INSERT INTO tbl_attendence(roll) VALUES('$roll')";
				$stu_insert = $this->db->insert($att_query);
				if($stu_insert){
					$msg = "<div class='alert alert-success text-center'><strong>Success!</strong>Student data inserted Successfully</Div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger text-center'><strong>Error!</strong>Student data inserted doesn't Successfully</Div>";
					return $msg;
				}
			}


	}
	public function insertAttendence($cur_date,$attend = array()){
		$query = "SELECT DISTINCT att_time FROM tbl_attendence";
		$getdata = $this->db->select($query);
		while ($result = $getdata->fetch_assoc()) {
			$db_date = $result['att_time'];
			if($cur_date == $db_date){
				$msg = "<div class='alert alert-danger text-center'><strong>Error ! </strong>Attendence already taken Today!</div>";
				return $msg;
			}
		}

		foreach ($attend as $atn_key => $atn_value) {
			if($atn_value == "present"){
				$stu_query = "INSERT INTO tbl_attendence(roll,attend,att_time) VALUES('$atn_key','present',now())";
				$data_insert = $this->db->insert($stu_query);
			}elseif ($atn_value == "absent") {
				$stu_query = "INSERT INTO tbl_attendence(roll,attend,att_time) VALUES('$atn_key','absent',now())";
				$data_insert = $this->db->insert($stu_query);
			}
		}

		if($data_insert){
					$msg = "<div class='alert alert-success text-center'><strong>Success!</strong>Attendence data inserted Successfully</Div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger text-center'><strong>Error!</strong> data inserted doesn't Successfully</Div>";
					return $msg;
				}

	}

	public function getDatelist(){
		$query = "SELECT DISTINCT att_time FROM tbl_attendence";
		$result = $this->db->select($query);
		return $result;
	}


	public function getAllData($dt)
	{
		$query = "SELECT tbl_student.name,tbl_attendence.*
		FROM tbl_student
		INNER JOIN tbl_attendence
		ON tbl_student.roll = tbl_attendence.roll
		WHERE att_time = '$dt'";
		$result = $this->db->select($query);
		return $result;
	}


	public function updateAttendence($dt,$attend)
	{
		foreach ($attend as $atn_key => $atn_value) {
			if($atn_value == "present"){
				$query = "Update tbl_attendence
				SET attend='present' WHERE roll = '".$atn_key."' AND att_time = '".$dt."'
				";
				$data_update = $this->db->update($query);


			}elseif ($atn_value == "absent") {
				$query = "Update tbl_attendence
				SET attend='absent' WHERE roll = '".$atn_key."' AND att_time = '".$dt."'
				";
				$data_update = $this->db->update($query);
				
			}
		}

		if($data_update){
					$msg = "<div class='alert alert-success text-center'><strong>Success!</strong>Attendence data Update Successfully</Div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger text-center'><strong>Error!</strong> data Update doesn't Successfully</Div>";
					return $msg;
				}
	}





}

?>