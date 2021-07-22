<?php include_once('lib/db.php'); ?>

<?php
	$sql_plan = "SELECT * FROM plan_name WHERE id=".mysqli_real_escape_string($conn,$_GET['id']);
	
	$result_plan = mysqli_query($conn,$sql_plan);
	$row_plan = mysqli_fetch_array($result_plan);
	
	
	$sql = "SELECT * FROM category";
	$result = mysqli_query($conn,$sql);

	$option = "";
	while($row = mysqli_fetch_array($result)){
		$option_chk = "";
		if($row_plan['category_id'] == $row['id']) { $option_chk = " selected"; }
		$option .= "<option value=\"{$row['id']}\"{$option_chk}>{$row['name']}</option>";
	}
	

	
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Plan</title>
<link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" href="/css/create_plan.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
</head>
<body>
	<div class="wrap app">
		<header>
			<h1><a href="/">홈</a></h1>
			<a href="/plan.php">뒤로</a>
		</header>
		
		<main>
			<form action="update_process_plan.php" method="post">
				<p>
					<input type="hidden" name="id" value="<?=$row_plan['id']?>">
				</p>
				<p>
					<input type="text" name="name" value="<?=$row_plan['name']?>" placeholder="계획명">
				</p>
				<p>
					<textarea name="content" placeholder="이번 목표"><?=$row_plan['content']?></textarea>
				</p>
				<p>
					<textarea name="next_con" placeholder="다음 목표 예정"><?=$row_plan['next_con']?></textarea>
				</p>
				<p>
					<select name="category_id">
						<?=$option?>
					</select>
				</p>
				<p>
					<input type="submit" value="계획수정하기">
				</p>
			</form>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>