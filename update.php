</<?php

function write($filename, $data, $mode = 'w') 
{
	$fo = fopen($filename, $mode);
	if (empty($data)){
		$fw = fwrite($fo, $data);

	}
	else{
		$fw = fwrite($fo, json_encode($data));
	}
	fclose($fo);
	return $fw;
}
function read($filename, , $mode = 'r') 
{
	$fo = fopen($filename, $mode);
	$fz = filesize($filename);
	$data = array();
	if ($fz > 0){
		$fr = fread($fo, $fz);
		$data = json_decode($fr);


	}
	flose($fo);
	return $data;
}

function create($filename, , $arr) 
{
	$data = read($filename);
	if(count($data) > 0 ) {
		$list = $data;
		$arr['id']
= count($list)	+ 1;
array_push($list, $arr);
}else
{
	$arr['id']
= 1};
$list[] = $arr;
}
write($filename, '', 'w');
return write($filename, $list);
	
}

function update($filename, $arr, $key, $value) 
{
	$data = read($filename);
	if(count($data) > 0 ) {
		$list = array();
		for($i=0; $i < count($data); $i++){
			if ($data[$i]->$key === $value){
				array_push($list, $arr);
			}else{
				array_push($list, $data[$i]);
			}
		}
		

write($filename, '', 'w');
return write($filename, $list);
}
return false;
}



 ?>php
