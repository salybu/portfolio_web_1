<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../common/loginbar.css">
    <meta charset="utf-8">
    <title>모사샵</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
  /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    /* 한 가로선상에서 정렬하려면 class로 묶어서 정렬함 */
    .contents {
      float: left; /* 상단바 아래에서 화면에 들어갈 메뉴바랑 컨텐츠 내용을 묶어줌 */
      padding: 20px;
      margin-left: 590px;
      margin-top: 30px;
    }

    </style>
  </head>

  <body>

    <header class="login_bar">
      <span><a id="logo" href="../main.php">mosashop</a></span>
      <div class="login_bar-right">
        <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
    ?> <a href="login.php">로그인</a>
       <a href="register.php">회원가입</a> <?php
    } else { // 세션 있을때 ?>
       <a><?php echo $_SESSION['name']?>님</a>
       <a href="register.php">장바구니</a>
       <a href="register.php">주문조회</a><?php
    } ?>
      </div>
    </header>

<?php
               $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

               $email = $_POST[inputmail];
               $pw = $_POST[inputpw];
               // $pw=md5($_POST[inputpw]);
               $name = $_POST[inputname];
               $phonenum = $_POST[inputphonenum];
               $addr_num = $_POST[inputaddress_number];
               $addr_main = $_POST[inputaddress_main];
               $addr_det = $_POST[inputaddress_detail];
               $addr_ref = $_POST[inputaddress_ref];

/*              echo $email; echo $pw; */

               //입력받은 데이터를 DB에 저장
               $query = "INSERT INTO member_info (email, pw, name, phone_number, address_number, address_main, address_detail, address_ref)
                VALUES ('$email', '$pw', '$name', '$phonenum', '$addr_num', '$addr_main', '$addr_det', '$addr_ref')";

              mysqli_query($connect, $query);
              //
              // echo "mysqli 에러";
              // echo mysqli_error($connect); // 에러가 뭔지 찍어보기


               //저장이 됬다면 (result = true) 가입 완료
               if(mysqli_connect_errno()) {
                 ?>   <h1 style=" margin-left: 700px; margin-top: 300px;">회원가입에 실패했습니다.</h1>
       <?php   } else{
       ?>
                      <h1 style=" margin-left: 700px; margin-top: 300px;">회원가입을 완료했습니다!</h1>
       <?php   }
               mysqli_close($connect);
       ?>

  </body>
</html>
