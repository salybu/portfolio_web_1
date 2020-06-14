<?php

$connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

$content = $_POST[comment];
$writer_name = $_POST[writer_name];
$writer_id = $_POST[writer_id];
$review_id = $_POST[review_id];
// date ?

$times = strtotime("-3 hours");
$date1 = date("Y-m-d h:i:s", $times);  // 초 -> 년-월-일 시:분:초  변환
$date = $date1;


$query = "INSERT INTO comment_review (review_id, writer_name, writer_id, content, date)
          VALUES ('$review_id', '$writer_name', '$writer_id', '$content', '$date')";
$result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함 업데이트 완료하는 코드

if($result){
  echo "success";
} else {
  echo "fail";
}
?>
