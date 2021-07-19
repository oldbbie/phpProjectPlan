<?php include_once('lib/db.php'); ?>

<?php
	$sql = "SELECT * FROM category";
	
	$result = mysqli_query($conn,$sql);

	$option = "";
	while($row = mysqli_fetch_array($result)){
		
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
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>