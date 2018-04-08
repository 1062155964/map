<?php
	require("conn.php");
	$data = '';
	$sql = "select id from map ORDER BY id ASC";
	$result =$conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$data[] =$row["id"];
		}
	}
	$json = json_encode($data);
	echo $json;
?>