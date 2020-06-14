<?php
               $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

               $no = $_GET[no];

               $title = $_POST[title];
               $type = $_POST[type];
               $contents = $_POST[contents];

               $query = "UPDATE qna set title = '$title', type = '$type', contents = '$contents' where no = '$no'";
               $resultss = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함 업데이트 완료하는 코드

               $sql = "SELECT * from qna where no = '$no'"; // 본 페이지에 정보 담기위해 수정한 qna 글 가져옴
               $result = mysqli_query($connect, $sql);
?>

<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
alert("수정되었습니다.");
location.href="./qna_read.php?no=<?php echo $no?>";
//     history.back();
</script>
