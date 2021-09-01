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