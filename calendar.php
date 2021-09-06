<?php include_once('lib/db.php'); ?>

<?php
	$sql = "SELECT * FROM plan_name";
	
	$result = mysqli_query($conn,$sql);

	$plan_list = "";
 	if($result->num_rows == 0) {
	 	$plan_list = "<a class=\"link\" href=\"create_plan.php\">목표를 만들어주세요.</a>";
 	} else {
		$plan_list .= "<select name=\"plan\">";
		$row = mysqli_fetch_array($result);
		$first_plan_id = $row['id'];
		$plan_list .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
		while($row = mysqli_fetch_array($result)){
			$plan_list .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
		}
		$plan_list .= "</select>";
	}
?>

<?php
	date_default_timezone_set('Asia/Seoul');
	
	$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
	$month = isset($_GET['month']) ? $_GET['month'] : date('m');
	$plan = isset($_GET['plan']) ? $_GET['plan'] : $first_plan_id;
	
	$title = "<h2>".$year."년 ".$month."월</h2>";
	
	$provMonthLink = "";
	if ($month == 1) {
		$provMonthLink .= "
			<a 
				href=\"/calendar.php/
					?year=".($year-1)."
					&month=12
					&plan=".$plan."
			\">이전달</a>
		";
	} else {
		$provMonthLink .= "
			<a 
				href=\"/calendar.php/
					?year=".$year."
					&month=".($month-1)."
					&plan=".$plan."
			\">이전달</a>
		";
	}
	
	$nextMonthLink = "";
	if ($month == 12) {
		$next_month_yy = $year+1;
		$next_month_mm = 1;
	} else {
		$next_month_yy = $year;
		$next_month_mm = $month+1;
	}
	$nextMonthLink .= "
		<a 
			href=\"/calendar.php/
				?year=".$next_month_yy."
				&month=".$next_month_mm."
				&plan=".$plan."
		\">다음달</a>
	";
	
	$date = $year."-".$month."-01"; // 이번달 1일
	$time = strtotime($date); // 현재 날짜의 타임스탬프
	$start_week = date('w', $time); // 1. 시작 요일
	$total_day = date('t', $time); // 2. 현재 달의 총 날짜

	$sql = "
		SELECT * FROM doit
		WHERE plan_name_id = ".$plan." AND day>='".$date."'AND day<'".$next_month_yy."-".$next_month_mm."-01' ORDER BY day
	";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	
	$tbody = "";
	$tbody .= "<tbody>";
	$day=1-$start_week;
	for($i=1; $i<=5; $i++){
		$tbody .= "</tr>";
		for($j=1; $j<=7; $j++){
			if($day<=0) {
				$tbody .= "<td></td>";
			} else {
				if($day==(int)substr($row['day'], -2, 2 )) {
					$tbody .= "<td>성공</td>";
					$row = mysqli_fetch_array($result);
				} else {
					$tbody .= "<td>{$day}</td>";
				}
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
			<form action="/calendar.php/" method="GET">
				<input type="hidden" name="year" value="<?=$year?>">
				<input type="hidden" name="month" value="<?=$month?>">
				<?=$plan_list?>
				<input type="submit" value="이동">
			</form>
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