<?php
	require("conn.php");
	$img = $_POST["img"];
	$sjc = $_POST["img_sjc"];
	$id =  $_POST["id"];
	$x = $_POST["x"];
//	$url = $_POST["server"];
	
	if($img==null||$sjc==null||$id==null||$x==null){
		$ret_data[]=0;
	}else{
		$id_str = explode('|', $id);
		for($i=0;$i<$x;$i++){
//			$upload = substr($img[$i],1); 
			$upload_img = substr($img[$i], 23);  //清除base64前面一段，才能正常转化为图片
			$tmp = base64_decode($upload_img);
			$path = dirname(__FILE__); //获得服务器路径
			$file_name = $sjc[$i].".jpg";
			$fp = $path."/upload/".$file_name; //确定图片位置和名称
			$sql = "INSERT INTO map_picture (pictureid,faid,picture) VALUES ('$id_str[1]','$id_str[0]','$file_name')";
			$result = $conn->query($sql);
//			将图片文件写入服务器
			file_put_contents($fp, $tmp);
		}
		$ret_data[]=$path;
	}
	
	
	$json = json_encode($ret_data);
	echo $json;
?>