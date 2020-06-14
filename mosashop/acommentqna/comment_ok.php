<?php

$connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

$content = $_POST[comment];
$writer_name = $_POST[writer_name];
$writer_id = $_POST[writer_id];
$qna_id = $_POST[qna_id];

// $times = mktime(); - datetime.timedelta(hours=1);  // 현재 서버의 시간을 timestamp 값으로 가져옴
$times = strtotime("-3 hours");
$date1 = date("Y-m-d h:i:s", $times);  // 초 -> 년-월-일 시:분:초  변환
$date = $date1;
// date ?

$query = "INSERT INTO comment_qna (qna_id, writer_name, writer_id, content, date)
            VALUES ('$qna_id', '$writer_name', '$writer_id', '$content', '$date')";
$result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함 업데이트 완료하는 코드

echo "mysqli 에러";
echo mysqli_error($connect); // 에러가 뭔지 찍어보기

?>
