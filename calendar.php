<?php include_once('lib/db.php'); ?>

<?php
	date_default_timezone_set('Asia/Seoul');
	
	$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
	$month = isset($_GET['month']) ? $_GET['month'] : date('m');
	
	$title = "<h2>".$year."년 ".$month."월</h2>";
	
	$provMonthLink = "";
	if ($month == 1) {
		$provMonthLink .= "<a href=\"/calendar.php/?year=".($year-1)."&month=12\">이전달</a>";
	} else {
		$provMonthLink .= "<a href=\"/calendar.php/?year=".$year."&month=".($month-1)."\">이전달</a>";
	}
	
	$nextMonthLink = "";
	if ($month == 12) {
		$nextMonthLink .= "<a href=\"/calendar.php/?year=".($year+1)."&month=1\">다음달</a>";
	} else {
		$nextMonthLink .= "<a href=\"/calendar.php/?year=".$year."&month=".($month+1)."\">다음달</a>";
	}
	
	$date = $year."-".$month."-01"; // 이번달 1일
	$time = strtotime($date); // 현재 날짜의 타임스탬프
	$start_week = date('w', $time); // 1. 시작 요일
	$total_day = date('t', $time); // 2. 현재 달의 총 날짜

	$tbody = "";
	$tbody .= "<tbody>";
	$day=1-$start_week;
	for($i=1; $i<=5; $i++){
		$tbody .= "</tr>";
		for($j=1; $j<=7; $j++){
			if($day<=0) {
				$tbody .= "<td></td>";
			} else {
				$tbody .= "<td>{$day}</td>";
			}
			$day++;
			if($day>$total_day){
				break;
			}
		}
		$tbody .= "</tr>";
	}
	$tbody .= "</tbody>";
?>

<?php include_once('category_list.php'); ?>

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
			<h1><a href="/">홈</a></h1>
			<nav>
			<?=$title?>
			<?=$provMonthLink?>
			<?=$nextMonthLink?>
			<?=$category_list?>
			</nav>
		</header>
		
		<main>
			<table>
				<thead>
					<tr>
						<th>일</th>
						<th>월</th>
						<th>화</th>
						<th>수</th>
						<th>목</th>
						<th>금</th>
						<th>토</th>
					</tr>
				</thead>
				<?=$tbody?>
			</table>
		</main>
		
		<footer>
		</footer>
	</div>
</body>
</html>