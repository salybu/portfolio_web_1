<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="common/loginbar.css">
      <link rel="stylesheet" href="common/leftmenuandcontents.css">
      <link rel="stylesheet" href="common/card.css">
    <meta charset="utf-8">
    <title>모사샵</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
    /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    #main_image {
        margin-top: 30px;
    }

    </style>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
      $(document).ready(function(){
            <!-- 모자 메뉴 html 파일 끌어다 씀 -->
         $("#menu").load("menu.html")
      });
  </script>
  </head>
  <body>

     <header class="login_bar">
       <span><a id="logo" href="main.php">mosashop</a></span>
       <div class="login_bar-right">

         <?php
                        $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                        if(isset($_POST[inputmail]) && !empty($_POST[inputmail])) { // 로그인 페이지에서 로그인했을 때

                          $email=$_POST[inputmail];
                          $pw=$_POST[inputpw];

                          $query = "SELECT * from member_info where email='$email' and pw='$pw'"; // 입력받은 데이터를 DB에서 꺼내옴
                          $result = mysqli_query($connect, $query);
                          $row = mysqli_fetch_array($result);

                          session_start();

                              if($email == "admin@naver.com" && $pw == "Local1234^^;"){ ?>
                                <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
                                <script>
                                      location.href="./admin/list_product.php";
                                </script>
<?php                          } else if($email == $row['email'] && $pw == $row['pw']){ // id와 pw가 맞다면 login하고 위에 로그인바에도 적용되게 함
                                       $_SESSION['email']=$row['email'];
                                       $_SESSION['name']= $row['name'];   ?>
                                 <a href="./login/update_myinfo.php"><?php echo $_SESSION['name']?>님</a>
                                 <a href="./login/logout.php">로그아웃</a>
                                 <a href="./cartandorder/cart.php">장바구니</a>
                                 <a href="./cartandorder/order_list.php">주문조회</a><?php

                               } else { // 로그인 실패했을 때 ?>
                                 <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
                                 <script>
                                      alert("비밀번호가 틀렸습니다. 다시 로그인해주세요");
                                      history.back();
                                 </script>
                                  <a href="./login/login.php">로그인</a>
                                  <a href="./login/register.php">회원가입</a> <?php
                               }

                        } else { // 그 외 다른 페이지에서 넘어왔을 때
                            session_start();
                              if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
                                  ?> <a href="./login/login.php">로그인</a>
                                  <a href="./login/register.php">회원가입</a> <?php

                              } else { // 세션 있을때 ?>
                                <a><?php echo $_SESSION['name']?>님</a>
                                <a href="./login/logout.php">로그아웃</a>
                                <a href="./cartandorder/cart.php">장바구니</a>
                                <a href="./cartandorder/order_list.php">주문조회</a><?php
                              } // 로그인페이지에서 넘어온 거 전부 마무리
                        }       ?>
       </div>
     </header>


    <nav id="main_cap_menu" class="contents">
      <ul>
        <li><a href="ballcap.php">볼캡</a></li>
        <li><a href="huntingcap.php">헌팅캡</a></li>
        <li><a href="buckethat.php">버킷햇</a></li>
      </ul>
    </nav>

    <section class="contents">
      <img src="picture/1591668047.jpg" height="400px" width="700px" id="main_image">
    </section>


 <section class="contents" id="menu_contents">
<?php
            $conn = mysqli_connect('localhost', 'gaeun', 'testtest', 'z_mosashop');
            $sql = "SELECT * FROM product where type = '볼캡' Order by no DESC Limit 0, 2"; // 볼캡 안에 있는 모든 항목들 중 no에 따라 최근순, 내림차순으로 2개를 출력하라
            $result = mysqli_query($conn, $sql);

       while($row = mysqli_fetch_array($result)) {            ?>

          <a href="product.php?no=<?php echo $row['no'];?>"><article class="product_card productcontent" style="margin-left: 25px;">
            <section class="product_image">
              <img src="<?php echo $row['image_main'];?>" width="275px" height="240px">
            </section>
            <section class="product_explain">
              <h1><?php echo $row['brand'];?></h1>
              <p><?php echo $row['name'];?></p>
              <p id="price"><?php echo number_format($row['price']);?>원</p>
            </section>
          </article></a>
<?php  } ?>

<?php
         $sqlh = "SELECT * FROM product where type = '헌팅캡' Order by no ASC Limit 0, 1"; // 볼캡 안에 있는 모든 항목들 중 no에 따라 최근순, 내림차순으로 2개를 출력하라
         $resulth = mysqli_query($conn, $sqlh);

    while($rowh = mysqli_fetch_array($resulth)) {            ?>

       <a href="product.php?no=<?php echo $rowh['no'];?>"><article class="product_card productcontent" style="margin-left: 25px;">
         <section class="product_image">
           <img src="<?php echo $rowh['image_main'];?>" width="275px" height="240px">
         </section>
         <section class="product_explain">
           <h1><?php echo $rowh['brand'];?></h1>
           <p><?php echo $rowh['name'];?></p>
           <p id="price"><?php echo number_format($rowh['price']);?>원</p>
         </section>
       </article></a>
<?php  } ?>

<?php
         $sqlb = "SELECT * FROM product where type = '버킷햇' Order by no DESC Limit 0, 1"; // 볼캡 안에 있는 모든 항목들 중 no에 따라 최근순, 내림차순으로 2개를 출력하라
         $resultb = mysqli_query($conn, $sqlb);

    while($rowb = mysqli_fetch_array($resultb)) {            ?>

       <a href="product.php?no=<?php echo $rowb['no'];?>"><article class="product_card productcontent" style="margin-left: 25px;">
         <section class="product_image">
           <img src="<?php echo $rowb['image_main'];?>" width="275px" height="240px">
         </section>
         <section class="product_explain">
           <h1><?php echo $rowb['brand'];?></h1>
           <p><?php echo $rowb['name'];?></p>
           <p id="price"><?php echo number_format($rowb['price']);?>원</p>
         </section>
       </article></a>
<?php  } ?>

    </section>

  </body>
</html>
