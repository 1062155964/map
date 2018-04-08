<?php
		require("conn.php");
		$id = $_POST["id"];
		$flag = $_POST["flag"];
		if($flag == 'gcbj'){
			$i = 1;
			$sql = "SELECT * from map WHERE id = '$id'";
			$result =$conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$ret_data[0]["swlng"] = $row["swlng"];
					$ret_data[0]["nelng"] = $row["nelng"];
					$ret_data[0]["swlat"] = $row["swlat"];
					$ret_data[0]["nelat"] = $row["nelat"];
				}
			}
			$my_sql = "SELECT * FROM son_map WHERE faid= '$id'";
			$my_res =$conn->query($my_sql);
			if($my_res->num_rows>0){
				while($my_row = $my_res->fetch_assoc()){
					$ret_data[$i]["plng"] =$my_row["plng"];
					$ret_data[$i]["plat"] =$my_row["plat"];
					$li = explode('|', $my_row["li"]);
					$ret_data[$i]["li"] = $li[1];
					$i++;
				}
			}
		}else if($flag=='xiug'){
			$li_id = (int)$_POST["li_id"]+1;
			$map_data = $_POST["map_data"];
			$arr_length = count($map_data);
			if($arr_length>0){
				for($i=0;$i<$arr_length;$i++){
					$li = $id.'|'.$li_id;
					$str = explode(',', $map_data[$i]);
					$sql = "INSERT INTO son_map (plng,plat,faid,li) VALUES ('$str[0]','$str[1]','$id','$li');";
					$result = $conn->query($sql);
					$li_id++;
				}
				$ret_data[]='success';
			}else{
				$ret_data[]='nodata';
			}
			
		}
		$json = json_encode($ret_data);
		echo $json;
?>