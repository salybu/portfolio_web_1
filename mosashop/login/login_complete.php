<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/loginbar.css">
    <meta charset="utf-8">
    <title>모사샵</title>
    <style>

    /* 한 가로선상에서 정렬하려면 class로 묶어서 정렬함 */
    .contents {
      float: left; /* 상단바 아래에서 화면에 들어갈 메뉴바랑 컨텐츠 내용을 묶어줌 */
      padding: 20px;
      margin-left: 590px;
      margin-top: 30px;
    }

    #logo {
      font-family: 'Permanent Marker', cursive;
  /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    #logo a {
        text-decoration: none;
    }

    </style>
  </head>

  <body>

    <header class="login_bar">
      <a id="logo" href="../main.php">mosashop</a>
      <div class="login_bar-right">

    <?php
                   $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                     $email=$_POST[inputmail];
                     $pw=$_POST[inputpw];

                     $query = "SELECT * from member_info where email='$email' and pw='$pw'"; // 입력받은 데이터를 DB에서 꺼내옴
                     $result = mysqli_query($connect, $query);
                     $row = mysqli_fetch_array($result);


                         if($email == $row['email'] && $pw == $row['pw']){ // id와 pw가 맞다면 login하고 위에 로그인바에도 적용되게 함
                                  $_SESSION['email']=$row['email'];
                                  $_SESSION['name']= $row['name'];   ?>
                            <a><?php echo $_SESSION['name']?>님</a>
                            <a href="register.php">장바구니</a>
                            <a href="register.php">주문조회</a><?php

                          } else { // 로그인 실패했을 때 ?>
                             <a href="login.php">로그인</a>
                             <a href="register.php">회원가입</a> <?php
                          } ?>
      </div>
    </header>

    <?php    if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){  ?>
                    <h1 style="margin-top: 300px; display: block; text-align: center;">로그인 실패했습니다.</h1>
    <?php    }else{ // id 또는 pw가 다르다면 login 폼으로 ?>
                    <h1 style="margin-top: 300px; display: block; text-align: center;">로그인 성공했습니다.</h1>
    <?php    }

                  mysqli_close($connect); ?>
  </body>
</html>
