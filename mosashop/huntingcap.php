<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="common/loginbar.css">
      <link rel="stylesheet" href="common/leftmenuandcontents.css">
      <link rel="stylesheet" href="common/card.css">
    <meta charset="utf-8">
    <title>모사샵</title>
  </head>
  <body>

     <header class="login_bar">
       <a id="logo" href="main.php">mosashop</a>
       <div class="login_bar-right">
         <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
     ?> <a href="login/login.php">로그인</a>
        <a href="login/register.php">회원가입</a> <?php
     } else { // 세션 있을때 ?>
        <a><?php echo $_SESSION['name']?>님</a>
        <a href="./login/logout.php">로그아웃</a>
        <a href="./cartandorder/cart.php">장바구니</a>
        <a href="register.php">주문조회</a><?php
     } ?>
       </div>
     </header>

    <nav id="main_cap_menu" class="contents">
      <ul>
        <li><a href="ballcap.php">볼캡</a></li>
        <li><a href="huntingcap.php">헌팅캡</a></li>
        <li><a href="buckethat.php">버킷햇</a></li>
      </ul>
    </nav>

    <?php
             $conn = mysqli_connect('localhost', 'gaeun', 'testtest', 'z_mosashop');
             $sql = "SELECT * FROM product where type = '헌팅캡'";// qna 안에 있는 모든 항목들중 no 번호에 따라 내림차순으로 5개를 출력하라
             $result = mysqli_query($conn, $sql);  ?>

    <?php
             $count = 4;

    while($row = mysqli_fetch_array($result)) {
          $count++;

// section 태그는 카드 4개를 묶어서 한 줄로 보이게 하기 위해 들어갔음
// 1(4*0+1), 5(4*1+1), 9(4*2+1)번째 카드 앞에 section 태그가 들어가야 됨
          if($count %4 ==1){   ?>
             <section class="contents" id="menu_contents" style="margin-left: 70px; margin-top: 30px;">
<?php     }?>

      <a href="product.php?no=<?php echo $row['no'];?>"><article class="product_card productcontent" style="margin-left: 15px;">
        <section class="product_image">
          <img src="<?php echo $row['image_main'];?>" width="275px" height="240px">
        </section>
        <section class="product_explain">
          <h1><?php echo $row['brand'];?></h1>
          <p><?php echo $row['name'];?></p>
          <p id="price"><?php echo number_format($row['price']);?>원</p>
        </section>
      </article></a>

 <!-- 4(4*1), 8(4*2), 12(4*3)번째 카드 뒤에 section 태그가 들어가야 됨 -->
<?php  if($count %4 ==0){    ?>
                </section>
<?php  } ?><?php
    } ?>

  </body>
</html>
