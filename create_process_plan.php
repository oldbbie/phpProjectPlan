<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'name'=>mysqli_real_escape_string($conn,$_POST['name']),
		'content'=>mysqli_real_escape_string($conn,$_POST['content']),
		'next_con'=>mysqli_real_escape_string($conn,$_POST['next_con']),
		'category_id'=>mysqli_real_escape_string($conn,$_POST['category_id'])
	);

	$sql = "
	INSERT INTO plan_name
	(name,content,next_con,hide,category_id) 
	VALUES(
		'{$filtered['name']}',
		'{$filtered['content']}',
		'{$filtered['next_con']}',
		0,
		{$filtered['category_id']}
	)
	";

	$result = mysqli_query($conn,$sql);

	if($result === false){
		echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
		error_log(mysqli_error($conn));
	} else {
		header('Location: plan.php');
	}
?>