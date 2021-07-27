<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'id'=>mysqli_real_escape_string($conn,$_POST['id'])
	);
	
	$sql = "
		DELETE d
		FROM doit AS d
		JOIN plan_name AS p
		ON d.plan_name_id = p.id 
		WHERE p.category_id = {$filtered['id']}
	";
	
	$result = mysqli_query($conn,$sql);
	
	$sql = "
		DELETE
		FROM plan_name
		WHERE category_id = {$filtered['id']}
	";

	$result = mysqli_query($conn,$sql);

	$sql = "
		DELETE
		FROM category
		WHERE id = {$filtered['id']}
	";
	
	$result = mysqli_query($conn,$sql);

	if($result === false){
		echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
		error_log(mysqli_error($conn));
	} else {
		header('Location: plan.php');
	}
?>