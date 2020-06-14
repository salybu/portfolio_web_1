<!DOCTYPE html>
<?php session_start(); ?>
<?php
  $conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');
  $ordernumber = $_GET['no'];
?>
 <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
 <script>
 </script>

<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../common/loginbar.css">
      <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <meta charset="utf-8">
    <title>모사샵 - 장바구니</title>
    <style>

    /* 한 가로선상에서 정렬하려면 class로 묶어서 정렬함 */
    .contents {
      float: left; /* 상단바 아래에서 화면에 들어갈 메뉴바랑 컨텐츠 내용을 묶어줌 */
      padding: 20px;
      margin-top: 30px;
    }

    #sp {
      display: inline;
    }

    #logo {
      font-family: 'Permanent Marker', cursive;
  /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>

    $( function(){
    });

    </script>
  </head>

  <body>

    <header class="login_bar">
      <a id="logo" href="../main.php">mosashop</a>
      <div class="login_bar-right">
<?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
    ?> <a href="../login/login.php">로그인</a>
       <a href="../login/register.php">회원가입</a> <?php
    } else { // 세션 있을때 ?>
       <a><?php echo $_SESSION['name']?>님</a>
       <a href="../login/logout.php">로그아웃</a>
       <a href="cart.php">장바구니</a>
       <a href="order_list.php">주문조회</a><?php
    } ?>
      </div>
    </header>

       <!--  <h1 style="width: 550px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto;">장바구니 > 주문서 작성 > 주문 완료</h1>   -->
       <div style="width: 660px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto; font-size: 30px;">
         장바구니&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;주문서 작성&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 33px; font-weight: bold;">주문 완료</span></div>
        <div>

                      <div style="padding-top: 50px; width: 550px; margin:0 auto; font-size: 22px; font-family:'Malgun Gothic'; text-align: center;">고객님의 주문이 완료되었습니다!<br>
                      주문번호: <?php echo $ordernumber; ?><br>
                      주문내역은 주문조회 메뉴에서 확인할 수 있습니다!<br></div>

  </body>
</html>
