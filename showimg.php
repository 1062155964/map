<?php
	require("conn.php");
	$id = $_POST["id"];
	$flag = $_POST["flag"];
	$ret_data  ="";
	
	if($flag=='show'){
		$i = 0;
//		$root = dirname(__FILE__); 
		$id_str = explode('|', $id);
		$sql = "SELECT * FROM map_picture WHERE faid = '$id_str[0]' and pictureid = '$id_str[1]'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$ret_data[$i]["id"] = $row["id"];
				$ret_data[$i]["path"] = $row["picture"];
				$ret_data[$i]["remark"] = $row["remark"];
				$i++;
			}
		}
	}else if($flag =='update'){
		$img = $_POST['img'];
//		$upload = substr($img,1); 
		$upload_img = substr($img,23);  //清除base64前面一段，才能正常转化为图片
		$tmp = base64_decode($upload_img);
		
		$sql = "SELECT picture FROM map_picture WHERE id = '$id'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$picture = $row["picture"];			//获取当前图片的名字
			}
		}
		$path = dirname(__FILE__).'/upload/'.$picture; //获得服务器路径
		if(file_exists($path) == true){
			@unlink($path);
		}else{
			
		}
		//将图片文件写入服务器
		file_put_contents($path,$tmp);
	}else if($flag =='del'){
		$sql = "SELECT picture FROM map_picture WHERE id = '$id'";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$picture = $row["picture"];			//获取当前图片的名字
			}
		}
		$path = dirname(__FILE__).'/upload/'.$picture; //获得服务器路径
		if(file_exists($path) == true){
			@unlink($path);
		}else{
			
		}
		$my_sql = "DELETE FROM map_picture WHERE id='$id'";
		$my_res = $conn->query($my_sql);
		
	}
//	$ret_data[]= $root;
	$json = json_encode($ret_data);
	echo $json;
?>