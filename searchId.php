<?php
	if(isset($_REQUEST['table'])){
		extract($_REQUEST);
		$sql="";
		if($table=="publisher"){
			$sql="select pub_id from publisher where pub_id='$id'";
		}
		else if($table=="author")
		{
			$sql="select aut_id from author where aut_id='$id'";
		}
		else if($table=="book")
		{
			$sql="select accn from book where accn='$id'";
		}
		else if($table=="student")
		{
			$sql="select usn from student where usn='$id'";
		}
		include("connectdb.php");
		$result=$con->query($sql);
		echo $result->num_rows;
		$con->close();
	}
?>