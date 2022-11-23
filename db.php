<?php

session_start();


$conn = mysqli_connect("localhost","root","","curling");


if($conn->connect_error)
{
  die("Error on conecting with DB");
}



function getList($table,$where)
{
	global $conn;
	$list = [];

	$query = "SELECT * FROM $table";

	if(!empty($where))
	{
		$query = "SELECT * FROM $table WHERE $where";
	}

	$result = $conn->query($query);
	if ($result->num_rows > 0) {
	  
	  while($row = $result->fetch_assoc()) {
	    $list[]= $row;
	  }
	}

	return $list;
}

function updateData($id, $inset_arr,$table)
{
	global $conn;

	$query = "UPDATE $table SET $inset_arr WHERE id  = $id";
	$result = $conn->query($query);
	header("Location:user.php?isTrue=1");
}

function insertData($table,$colums,$values)
{
	global $conn;

	$query = "INSERT INTO $table($colums)VALUES($values)";
	$result = $conn->query($query);
}

function deleteData($table,$where)
{
	global $conn;
	$result = $conn->query("DELETE FROM $table WHERE $where");
}


function add_news_data($obj)
{

		$colums = "title,description,date,pic,created_at,updated_at";
		$title =$obj['title'];
		$description = $obj['desc'];
		$date = $obj['date'];
		$pic = $obj['pic'];
		$created_at = date("Y-m-d H:i:s");
		$updated_at = null;

		$values = "'$title','$description','$date','$pic','$created_at','$updated_at'";



		$data_exist = getList("news","title='$title'");

		if(!empty($data_exist))
		{
			$updated_at = date("Y-m-d H:i:s");

			$updated_values = "title='$title',description='$description',date='$date',pic='$pic',updated_at='$updated_at'";
			updateData($data_exist[0]["id"],$updated_values,"news");
		}	
		else
		{
			insertData("news",$colums,$values);
		}
}	

?>