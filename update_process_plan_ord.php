<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'len'=>mysqli_real_escape_string($conn,$_POST['len'])
	);

	for($i=1; $i<=$filtered['len']; $i=$i+1) {
		$ord = mysqli_real_escape_string($conn,$_POST['id'.$i]);
		$sql = "
			UPDATE 
				plan_name
			SET
				ord = {$ord}
			WHERE
				id = {$i}
		";
		$result = mysqli_query($conn,$sql);
		
		if($result === false){
			echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
			error_log(mysqli_error($conn));
			break;
		} 
	}
	
	if($result === true){
		header('Location: plan.php');
	}
?>