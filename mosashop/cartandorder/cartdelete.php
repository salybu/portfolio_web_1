<?php

$conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

  $no = $_POST['checkb']; // name = "checkb[]"인 체크박스의 value값(테이블 basket 식별자 no)을 받아옴
          // name = "checkb[]" 이므로 어레이형태로 받게 됨. $no[0], $no[1], $no[2], $no[3] ..
//  echo count($no);

  for($i = 0; $i < count($no) ; $i++){
    echo "basket no array";
    echo $no[$i];

    $query = "DELETE from basket where no='$no[$i]'";
    $result= mysqli_query($conn, $query);
  }

 ?>
 <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
 <script>
 alert("선택한 상품이 장바구니에서 삭제되었습니다.");
  location.href="cart.php";
 // history.back();
 </script>
