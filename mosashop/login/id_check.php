<?php
	$connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

	$uid = $_GET["userid"];

	$sql = "SELECT * from member_info where email='$uid'"; // 멤버정보가 있는 테이블에 중복된 이메일값 있는지 확인
	$result = mysqli_query($connect, $sql); // 쿼리정보랑 위에서 연결한 db 연결
	$row = mysqli_fetch_array($result); // 결과값을 row에 담아옴 다시 공부하기

	if($row['email'] != $uid) { ?>
	   <div style='font-family:"malgun gothic"';>
       <?php echo $uid; ?>는 사용가능한 이메일입니다.</div> <?php
  }else{  ?>
	   <div style='font-family:"malgun gothic"; color:red;'>
       <?php echo $uid; ?>는 중복된 이메일입니다.<div> <?php
	} ?>
  <br><button value="닫기" onclick="window.close()">닫기</button>
<script>
</script>
