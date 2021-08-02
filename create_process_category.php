<?php
	include_once('lib/db.php');
	
	$filtered = array(
		'name'=>mysqli_real_escape_string($conn,$_POST['name'])
	);

	$sql = "
	INSERT INTO category
	(name,hide) 
	VALUES(
		'{$filtered['name']}',
		0
	)
	";

	$result = mysqli_query($conn,$sql);

	if($result === false){
		echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
		error_log(mysqli_error($conn));
	} else {
		header('Location: create_category.php');
	}
?>