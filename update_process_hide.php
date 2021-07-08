<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'plan_name_id'=>mysqli_real_escape_string($conn,$_POST['plan_name_id']),
		'hide'=>mysqli_real_escape_string($conn,$_POST['hide'])
	);
	
	$hide = ((int)$filtered['hide']) ? 0 : 1;

	$sql = "
	UPDATE 
		plan_name
	SET
		hide = {$hide}
	WHERE
		id = {$filtered['plan_name_id']}
	";
	
	$result = mysqli_query($conn,$sql);

	if($result === false){
		echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
		error_log(mysqli_error($conn));
	} else {
		header('Location: plan.php');
	}
?>