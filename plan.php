<?php include_once('lib/db.php'); ?>

<?php

$sql = "SELECT 
				p.id, p.name, p.hide, p.content, p.next_con, p.category_id, c.name AS category_name
			FROM 
				plan_name AS p 
			LEFT JOIN 
				category AS c 
			ON 
				p.category_id = c.id
			ORDER BY
				ord IS NULL,
				ord ASC
				";
$result = mysqli_query($conn,$sql);

$table = "";
$order = "";
 if($result->num_rows == 0) {
	 $table = "
	 	<p>
			<span>계획을 추가해주세요. </span>
			<a href=\"create_plan.php\">계획 추가하러가기</a>
		<p>";
 } else {
	$table = "
		<table>
			<thead>
				<tr>
					<th scope=\"col\">계획명</th>
					<th scope=\"col\">숨기기</th>
					<th scope=\"col\">해야할것</th>
					<th scope=\"col\">다음에할것</th>
					<th scope=\"col\">대분류</th>
					<th scope=\"col\">수정</th>
					<th scope=\"col\">삭제</th>
					<th scope=\"col\">순서</th>
				</tr>
			</thead>
			<tbody>
	";
	$order = "
		<form class=\"update_ord\" action=\"update_process_plan_ord.php\" method=\"post\">
			<input type=\"hidden\" name=\"len\" value=\"{$result->num_rows}\">
	";
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
		$checked = (!(int)$row['hide']) ? "숨기기" : "보이기";
		$table .= "
				<tr>
					<td>{$row['name']}</td>
					<td>
						<form action=\"update_process_hide.php\" method=\"post\">
							<input type=\"hidden\" name=\"plan_name_id\" value=\"{$row['id']}\">
							<input type=\"hidden\" id=\"hide\" name=\"hide\" value=\"{$row['hide']}\">
							<input type=\"submit\" value=\"{$checked}\">
						</form>
					</td>
					<td>{$row['content']}</td>
					<td>{$row['next_con']}</td>
					<td>{$row['category_name']}</td>
					<td><a href=\"update_plan.php?id={$row['id']}\">계획 수정하기</a></td>
					<td>
						<form action=\"delete_process_plan.php\" method=\"post\" onsubmit=\"if(!confirm('취소할껀가요?')){return false;}\">
							<input type=\"hidden\" name=\"id\" value=\"{$row['id']}\">
							<input type=\"submit\" value=\"삭제\">
						</form>
					</td>
					<td>
						<button type=\"button\" onclick=\"changeOrderHome(this)\">맨위로</button>
						<button type=\"button\" onclick=\"changeOrder(this,'up')\">위로</button>
						<button type=\"button\" onclick=\"changeOrder(this,'down')\">아래로</button>
						<button type=\"button\" onclick=\"changeOrderEnd(this)\">맨아래로</button>
					</td>
				</tr>
		";
		$order.="<input type=\"hidden\" name=\"id{$row['id']}\" value=\"{$i}\">";
		$i++;
	}
	$table .= "
			</tbody>
		</table>
		";
	$order.="
			<button type=\"submit\">순서적용하기</button>
		</form>
	";
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
<link rel="stylesheet" href="/css/plan.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script>
	function changeOrder(nodeGps,way){
		var tbody=document.querySelector('tbody');
		var thistr=nodeGps.parentNode.parentNode;
		var tr=document.querySelectorAll('tbody tr');
		
		var ord_input = document.querySelectorAll(".update_ord input");
		
		for(var i=0; i<tr.length; i++){
			if(thistr === tr[i]) {
				var replaceNode = (way=='up') ? tr[i-1] : tr[i+1];	
				var i_way = (way=='up') ? i : i+2;	
				var cln = thistr.cloneNode(true);
				tbody.replaceChild(cln,replaceNode);
				tbody.replaceChild(replaceNode,tr[i]);
				
				temp = ord_input[i+1].name;
				ord_input[i+1].name = ord_input[i_way].name;
				ord_input[i_way].name = temp;
			
				break;
			}
		}
	}
	
	function changeOrderHome(nodeGps) {
		alert('준비중');
	}
	
	function changeOrderEnd(nodeGps) {
		var tbody=document.querySelector('tbody');
		var thistr=nodeGps.parentNode.parentNode;
		var tr=document.querySelectorAll('tbody tr');
		tbody.appendChild(thistr);
		
		var ord_input = document.querySelectorAll(".update_ord input");
		j=1;
		for(var i=0; i<tr.length; i++){
			if(thistr === tr[i]) {
				ord_input[i+1].name = 'id'+tr.length;
			} else {
				ord_input[i+1].name = 'id'+j;
				j++;
			}
		}
	}
	
</script>
</head>
<body>
	<div class="wrap app">
		<header>
			<h1><a href="/">홈</a></h1>
		</header>
		
		<main>
			<div class="create">
				<a href="create_plan.php">계획 추가하기</a>
				<a href="create_category.php">대분류 추가하기</a>
			</div>
			<?=$table?>
			<?=$order?>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>