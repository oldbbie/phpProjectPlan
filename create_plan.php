<?php include_once('lib/db.php'); ?>

<?php
	$sql = "SELECT * FROM category";
	
	$result = mysqli_query($conn,$sql);

	$category_list = "";
 	if($result->num_rows == 0) {
	 	$category_list = "<a class=\"link\" href=\"create_category.php\">대분류를 추가해주세요.</a>";
 	} else {
		$category_list .= "<select name=\"category_id\">";
		while($row = mysqli_fetch_array($result)){
			$category_list .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
		}
		$category_list .= "</select>";
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
			<form action="create_process_plan.php" method="post">
				<p>
					<?=$category_list?>
				</p>
				<p>
					<input type="text" name="name" placeholder="계획명">
				</p>
				<p>
					<textarea name="content" placeholder="이번 목표"></textarea>
				</p>
				<p>
					<textarea name="next_con" placeholder="다음 목표 예정"></textarea>
				</p>
				<p>
					<input type="submit" value="계획만들기">
				</p>
			</form>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>