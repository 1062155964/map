<?php
	require("conn.php");
	$id = $_POST["id"];
	$id_str = explode('|', $id);
	$root = dirname(__FILE__);
	$del_sql = "DELETE FROM son_map WHERE li='$id'";
	$del_res = $conn->query($del_sql);
	
	$sql = "SELECT picture FROM map_picture WHERE pictureid = '$id_str[1]' AND faid = '$id_str[0]'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$path = $root.'/upload'.$row["picture"];
			if(file_exists($path)==true){
				@unlink($path);
			}else{
				
			}
		}
	}
	
	$picdel_sql = "DELETE FROM map_picture WHERE pictureid = '$id_str[1]' AND faid = '$id_str[0]'";
	$pic_res =$conn->query($picdel_sql);
	
	$ret_data[0] = $id_str[0];
	$json= json_encode($ret_data);
	echo $json;
?>