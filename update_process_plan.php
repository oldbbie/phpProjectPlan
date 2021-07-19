<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'id'=>mysqli_real_escape_string($conn,$_POST['id']),
		'name'=>mysqli_real_escape_string($conn,$_POST['name']),
		'content'=>mysqli_real_escape_string($conn,$_POST['content']),
		'next_con'=>mysqli_real_escape_string($conn,$_POST['next_con']),
		'category_id'=>mysqli_real_escape_string($conn,$_POST['category_id'])
	);
	
	$sql = "
	UPDATE 
		plan_name
	SET
		name = '{$filtered['name']}',
		content = '{$filtered['content']}',
		next_con = '{$filtered['next_con']}',
		category_id = {$filtered['category_id']}
	WHERE
		id = {$filtered['id']}
	";

	$result = mysqli_query($conn,$sql);

	if($result === false){
		echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
		error_log(mysqli_error($conn));
	} else {
		header('Location: plan.php');
	}
?>