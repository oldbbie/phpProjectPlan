<?php include_once('lib/db.php'); ?>

<?php
	$filtered = array(
		'id'=>mysqli_real_escape_string($conn,$_GET['id'])
	);
	
	$sql = "SELECT * FROM category";
	
	$result = mysqli_query($conn,$sql);

	$list = "";
	while($row = mysqli_fetch_array($result)){
		$list .= "<tr>";
		if($row['id'] == $filtered['id']) {
			$list .= "<th class=\"select\">".$row['name']."</th>";
		} else {
			$list .= "<th>".$row['name']."</th>";
		}
		$list .= "<td><a href=\"update_category.php?id={$row['id']}\">수정</a></td>";
		$list .= "	<td>
							<form action=\"delete_process_category.php\" method=\"post\" onsubmit=\"if(!confirm('취소할껀가요?')){return false;}\">
								<input type=\"hidden\" name=\"id\" value=\"{$row['id']}\">
								<input type=\"submit\" value=\"삭제\">
							</form>
						</td>";
		$list .= "</tr>";
	}
	$list .= "";
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Plan</title>
<link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" href="/css/create_category.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
</head>
<body>
	<div class="wrap app">
		<header>
			<h1><a href="/">홈</a></h1>
			<a href="/plan.php">뒤로</a>
		</header>
		
		<main>
		<?php
			$sql = "SELECT * FROM category WHERE id=".$filtered['id'];
	
			$result = mysqli_query($conn,$sql);

			$row = mysqli_fetch_array($result)
		?>
			<form action="create_process_category.php" method="post">
				<p>
					<input type="hidden" name="id" placeholder="대분류명" value="<?=$row['id']?>">
				</p>
				<p>
					<input type="text" name="name" placeholder="대분류명" value="<?=$row['name']?>">
				</p>
				<p>
					<input type="submit" value="대분류만들기">
				</p>
			</form>
			<article class="list_category">
				<h3>현재 대분류</h3>
				<table>
				<?=$list?>
				</table>
			</article>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>