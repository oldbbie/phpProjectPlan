<?php include_once('lib/db.php'); ?>

<?php
$sql = "SELECT * FROM plan_name";
$result = mysqli_query($conn,$sql);
$list = '';
while($row = mysqli_fetch_array($result)){
	$escaped_id = htmlspecialchars($row['id']);
	$escaped_name = htmlspecialchars($row['name']);
	$table = $table."
		<tr>
			<th>{$escaped_name}</th>
			<td>
				<form action=\"doit_process.php\" method=\"post\">
					<input type=\"hidden\" value=\"{$escaped_id}\">
					<input type=\"submit\" value=\"아직안함\">
				</form>
			</td>
		</tr>";
}

?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Plan</title>
<!--<link rel="stylesheet" href="/css/common.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
</head>
<body>
	<div class="wrap app">
		<header>
			<a href="#">어제</a>
			<h2>2021년06년26년</h2>
			<a href="#">내일</a>
		</header>
		
		<main>
			<table>
				<?=$table?>
			</table>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>