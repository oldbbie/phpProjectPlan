<?php include_once('lib/db.php'); ?>

<?php
$today = date("Ymd");
$recorder = 0;
if(isset($_GET['day'])){
	$recorder += $_GET['day'];
	$today = $today+$recorder;
}
$next = $recorder + 1;
$prev = $recorder - 1;
$year = substr( $today , 0, 4 );
$mm = substr( $today , 4, 2 );
$dd = substr( $today , 6, 2 );
$sql = "
	SELECT d.id, p.name, d.yn, p.content, next_con
	FROM doit as d 
	LEFT JOIN plan_name as p 
	ON d.plan_name_id = p.id
	WHERE d.day='{$year}-{$mm}-{$dd}'
	";
$result = mysqli_query($conn,$sql);

$table = '';
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
			<a href="index.php?day=<?=$prev?>">어제</a>
			<h2><?php echo $year.'년'.$mm.'월'.$dd.'일'; ?></h2>
			<a href="index.php?day=<?=$next?>">내일</a>
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