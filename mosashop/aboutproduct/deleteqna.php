<!DOCTYPE html>
<?php
               $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

               $id = $_GET[no];
               $product_id = $_GET[product];

               $query = "DELETE from qna where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
               $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함
?>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    alert("삭제되었습니다.");
    location.href="../product.php?no=<?php echo $product_id;?>#qna";
    </script>
