<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'interval_day'=>mysqli_real_escape_string($conn,$_POST['interval_day']),
		'today'=>mysqli_real_escape_string($conn,$_POST['today']),
		'plan_name_id'=>mysqli_real_escape_string($conn,$_POST['plan_name_id'])
	);

	$sql = "
		DELETE
			FROM doit
			WHERE
				plan_name_id = {$filtered['plan_name_id']}
			AND
				day = '{$filtered['today']}'
	";
	
	$result = mysqli_query($conn,$sql);

	if($result === false){
		echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
		error_log(mysqli_error($conn));
	} else {
		header("Location: index.php?day={$filtered['interval_day']}");
	}
?>