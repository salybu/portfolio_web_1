<?php
    session_start();
    session_destroy();
 ?>
 <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
 <script>
 alert("로그아웃되었습니다.");
  location.href="../main.php";
 // history.back();
 </script>
