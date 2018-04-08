<?php
	require("conn.php");
	$map_demo = $_POST['map_data'];
	$ret_data = array();
	if($map_demo[0]==0||$map_demo[1]==0){
		$id = 0;
	}else{
		$sw = explode(',',$map_demo[0]);
		$ne = explode(',', $map_demo[1]);
		$sql = "insert into map (swlng,swlat,nelng,nelat) values ('$sw[0]','$sw[1]','$ne[0]','$ne[1]')";
		$result = $conn->query($sql);
	
		$mysql = "SELECT id from map WHERE swlng = '$sw[0]' and nelng ='$ne[0]' and swlat='$sw[1]'and nelat = '$ne[1]'";
		$result_1 = $conn->query($mysql);
		if($result_1->num_rows>0){
			while($row =$result_1->fetch_assoc()){
				$id = $row["id"];
			}
		}
	}
		
	$ret_data[0]= $id;
//	$ret_data[] = $sw[0];
//	$ret_data[] = $sw[1];
	
	$json =json_encode($ret_data);
	echo $json;
	$conn->close();
?>