<?php

$connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

$id = $_POST[index];

$query = "DELETE FROM comment_qna WHERE no = '$id'";
$result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함. 업데이트 완료하는 코드

?>
