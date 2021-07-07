<?php include_once('lib/db.php'); ?>

<?php

$sql = "SELECT 
				p.id, p.name, p.hide, p.content, p.next_con, p.category_id, c.name AS category_name
			FROM 
				plan_name AS p 
			LEFT JOIN 
				category AS c 
			ON 
				p.category_id = c.id";
$result = mysqli_query($conn,$sql);

$table = "
	<table>
		<thead>
			<tr>
				<th scope=\"col\">계획명</th>
				<th scope=\"col\">숨기기</th>
				<th scope=\"col\">해야할것</th>
				<th scope=\"col\">다음에할것</th>
				<th scope=\"col\">대분류</th>
			</tr>
		</thead>
		<tbody>
";
while($row = mysqli_fetch_array($result)) {
	$checked = (!(int)$row['hide']) ? "숨기기" : "보이기";
	$table .= "
			<tr>
				<td>{$row['name']}</td>
				<td>
					<form action=\"update_process_hide.php\" method=\"post\">
						<input type=\"hidden\" name=\"plan_name_id\" value=\"{$row['id']}\">
						<input type=\"hidden\" name=\"hide\" value=\"{$row['hide']}\">
						<input type=\"submit\" value=\"{$checked}\">
					</form>
				</td>
				<td>{$row['content']}</td>
				<td>{$row['next_con']}</td>
				<td>{$row['category_name']}</td>
			</tr>
	";
}
$table .= "
		</tbody>
	</table>
	";

?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Plan</title>
<link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" href="/css/index.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
</head>
<body>
	<div class="wrap app">
		<header>
		</header>
		
		<main>
			<a href="#">계획 추가하기</a>
			<?=$table?>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>