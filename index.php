<?php include_once('lib/db.php'); ?>

<?php
date_default_timezone_set('Asia/Seoul');
$today = date("Y-m-d");
$recorder = 0;
if(isset($_GET['day'])){
	$recorder += $_GET['day'];
	$s = $today." ".$recorder." days";
	$timestamp = strtotime($s); 
	$today = date("Y-m-d", $timestamp);
	
}
$next = $recorder + 1;
$prev = $recorder - 1;
$year = substr( $today , 0, 4 );
$mm = substr( $today , 5, 2 );
$dd = substr( $today , 8, 2 );

$sql_plan_name = "SELECT * FROM plan_name WHERE hide=0";
$sql_doit = "
	SELECT p.id, p.name, d.yn, p.content, next_con
	FROM doit as d 
	LEFT JOIN plan_name as p 
	ON d.plan_name_id = p.id
	WHERE d.day='{$today}' AND p.hide=0
	";
	
$result_plan_name = mysqli_query($conn,$sql_plan_name);
$result_doit = mysqli_query($conn,$sql_doit);

$table = '';
$row_doit=mysqli_fetch_array($result_doit);
while($row_plan_name = mysqli_fetch_array($result_plan_name)){
	$escaped_id = htmlspecialchars($row_plan_name['id']);
	$escaped_name = htmlspecialchars($row_plan_name['name']);
	$table = $table."
		<tr>
			<th>{$escaped_name}</th>
			<td>";
	if($row_plan_name['id'] == $row_doit['id']){
		$table = $table."
			<form action=\"delete_process.php\" method=\"post\" onsubmit=\"if(!confirm('취소할껀가요?')){return false;}\">
				<input type=\"hidden\" name=\"plan_name_id\" value=\"{$escaped_id}\">
				<input type=\"hidden\" name=\"today\" value=\"{$today}\">
				<input type=\"submit\" value=\"완료\">
			</form>
			";
		$row_doit=mysqli_fetch_array($result_doit);
	} else {
		$table = $table."
		<form action=\"create_process.php\" method=\"post\">
			<input type=\"hidden\" name=\"plan_name_id\" value=\"{$escaped_id}\">
			<input type=\"hidden\" name=\"today\" value=\"{$today}\">
			<input type=\"submit\" value=\"아직안함\">
		</form>";
		}
	$table = $table."
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