<?php
	session_Start();
	$user_id = session_Id();
	$ref_name = $_POST['ref'];
	if(isset($_POST['tar'])){
		$tar_name = $_POST['tar'];
	}
	
	$flag = 0;
	$tar_arr = array();
	$state_f = fopen("../session/$user_id/cur_state","r");
	while($line = fgets($state_f)){
		$line = trim($line);
		if(empty($line)){continue;}
		if(preg_match('/^Tar_names/',$line)){
			$arr = preg_split("/\s+/",$line);
			if($arr[1] == $ref_name){
				$arr2 = preg_split("/,/",$arr[2]);
				foreach ($arr2 as $i => $tar){
					array_push($tar_arr,$tar);
				}				
			}
		}
	}
	fclose($state_f);

	foreach ($tar_arr as $i => $spc_name){
		if($spc_name == $ref_name){continue;}
		if($spc_name == $tar_name){
			echo "<option id=\"$spc_name\" value=\"$spc_name\" selected>".$spc_name."</option>";
		}
		else{
			echo "<option id=\"$spc_name\" value=\"$spc_name\">".$spc_name."</option>";
		}
	}
?>
