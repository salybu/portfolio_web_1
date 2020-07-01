<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="common/loginbar.css">
      <link rel="stylesheet" href="common/leftmenuandcontents.css">
      <link rel="stylesheet" href="common/inputnumber.css">
      <link rel="stylesheet" href="common/table.css">
    <meta charset="utf-8">
    <title>모사샵</title>
    <style>
    
    #image_info { /* 제품이미지 왼쪽에 크게 배열함 */
      float: left;
  /*    display: block;  인라인 속성, float는 left해야 됨 */
      padding-right: 40px;
      border-right: 1px solid black;
    }

    #product_info {
      display: block; /* 제품이미지 오른쪽에 상품정보를 정렬 */
    /*  float: left;   display: block 써도 float 조건이 써있으면 먹히지 않았음 */
      /* padding-left: 20px; /* 상품정보 쓰여지기 전에 여백을 줌 */
    }

    #product_info_cont {
      display: block;
    }

    #product_info_cont ul {
      list-style-type: none;
      padding: 0; /* ul은 여백이 생겨 딱 붙지 않으니까 padding, margin 다 0을 세팅함 */
      margin: 0;
      /* margin-left: 10px; */
    }

    #product_info_cont li {
      padding-bottom: 15px;
    }

    #blank{
      padding-top: 5px;
    }

    #price {
      padding-top: 20px;
      font-size: 20px;
    }

    #button {
      font-weight: normal;
      position: relative;
      left: 90px;
      top: 27px;
    }

    #button_right {
      position: relative;
      left: -50px;
      top: 25px;
    }

    .cont li {
      padding-top: 4px;
    }

    .button_base {
        margin: 0;
        border: 0;
        font-size: 18px;
        width: 220px;
        height: 50px;
        text-align: center;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-user-select: none;
        cursor: default;
    }

      .button_base :hover {
          cursor: pointer;
      }

      /* ### ### ### 01 */
      .b01_simple_rollover {
          color: #000000;
          border: #000000 solid 1px;
          padding: 10px;
          background-color: #ffffff;
      }

      .b01_simple_rollover :hover {
          color: #ffffff;
          background-color: #000000;
      }

      .left {
        margin-left: 50px;
      }

      .middle_menu {
        display: block;
        float: left;
        /* position: fixed;  스크롤을 내려도 계속 그자리에 있어야 하니까 어디 기준으로 할 건지 잘 생각해보기 ^^ */
        width: 1450px;
        color: white;
        background-color: black;
        text-align: center;
        padding: 20px 22px;
        text-decoration: none;
        font-size: 17px;
        margin-top: 20px;
      }

      @supports (position: sticky) or (position: -webkit-sticky) {
        .sticky {
            position: -webkit-sticky;
            position: sticky;
            top: -690px;
      /*      position: fixed;
            top: 10px;  */
        }
      }

      .middle_menu a {
        padding-left: 15px;
        padding-right: 15px;
        color: white;
        text-decoration: none;
      }

      .middle_menu a:hover {
        text-style: bold;
      }

      #main_content {
          width: 1500px;
          margin-left: 50px;
          margin-top: 30px;
      }

      /* 한 가로선상에서 정렬하려면 class로 묶어서 정렬함 */
      .contents {
    /*      float: left;  상단바 아래에서 화면에 들어갈 메뉴바랑 컨텐츠 내용을 묶어줌 */
          padding: 20px;
          margin-left: 20px;
      }

      .tleft {
          text-align : left;
      }

      .set {
        margin-left: 170px;
      }

      #button_ques {
        margin-left: 1140px;
        width: 70px;
      }

      .b01_simple_rollover2 {
          color: #ffffff;
          border: #000000 solid 1px;
          padding: 20px;
          background-color: #000000;
      }

    </style>
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script>

          $( function() {

            $('#sub').click( function(e) { // e는 event 객체를 가리키는 argument
              e.preventDefault(); // 현재 이벤트의 기본 동작을 중단함. 정의한 이벤트 외 브라우저의 별도의 행동을 중단하기 위해 사용됨
                  let stat = $('#quantity').val();
                  let num = parseInt(stat, 10);
                  num--;
                              if(num <= 0){
                                alert('더이상 줄일 수 없습니다.');
                                num = 1;
                              }
                  $('#quantity').val(num);

                  let price_origin = $('#pricereal_hid').text();
                  $('#pricereal').text(addComma(num * price_origin));
            });

            $('#add').click( function(e) {
              e.preventDefault();
                  let stat = $('#quantity').val();
                  let num = parseInt(stat, 10);
                  num++;
                                if(num > 5){
                                  alert('더이상 늘릴 수 없습니다.');
                                  num=5;
                                }
                  $('#quantity').val(num);

                  let price_origin = $('#pricereal_hid').text();
                  $('#pricereal').text(addComma(num * price_origin));
            });

            function addComma(num) { // 1,000자리마다 콤마 찍는 메소드
              let regexp = /\B(?=(\d{3})+(?!\d))/g;
              return num.toString().replace(regexp, ',');
            }
          });

      </script>
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
                 <a href="./cartandorder/orderlist.php">주문조회</a><?php
              } ?>
      </div>
    </header>

   <nav id="main_cap_menu" class="contents" style="margin-bottom: 400px;">
     <ul>
       <li><a href="ballcap.php">볼캡</a></li>
       <li><a href="huntingcap.php">헌팅캡</a></li>
       <li><a href="buckethat.php">버킷햇</a></li>
     </ul>
   </nav>

   <section id="main_content" class="contents">

     <?php
                    $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                    $id = $_GET[no];

                    $query = "SELECT * from product where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                    $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함

                    $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함

                    $pageNumr = ($_GET['pager']) ? $_GET['pager'] : 1;     // page : default - 1  // (리뷰)현재 표시할 페이지의 번호
                    $listr = ($_GET['listr']) ? $_GET['listr'] : 5;  // page : default - 5 // (리뷰)한 페이지 당 보여줄 글의 갯수

                    $pageNumq = ($_GET['pageq']) ? $_GET['pageq'] : 1;     // page : default - 1  // (Q&A)현재 표시할 페이지의 번호
                    $listq = ($_GET['listq']) ? $_GET['listq'] : 5;  // page : default - 5 // (Q&A)한 페이지 당 보여줄 글의 갯수
     ?>

    <!-- 상품 이미지  -->
     <article id="image_info">
       <img src="<?php echo $row[image_main]?>" width="700px" height="600px" align="left">
     </article>

      <!-- 상품 기본정보들.. (상품 이미지 오른쪽) -->
      <div class="contents">
     <article id="product_info">
       <h1><?php echo $row[name]?></h1>
     </article>

     <!-- 상품 기본정보 이름 -->
     <article id="product_info_cont" class="contents" style="font-weight: bold;">
       <ul>
         <li>브랜드</li>
         <li>품번</li>
         <li>사이즈</li>
         <li>소재</li>
         <li>세탁방법</li>
         <br><br>
         <li id="blank">수량</li>
         <li id="price">총 상품금액</li>
       </ul>
       <!-- <a href="./cartandorder/cart.php?<php echo $row[no]>&<php echo 수량>"><div type="submit" id="button" class="button_base b01_simple_rollover">장바구니</div></a> -->
     </article>

     <!-- 상품 기본정보 내용 -->
     <article id="product_info_cont" class="contents" style="margin-left: 120px;">
       <ul class="cont">
         <li><?php if(empty($row[brand])){ // is_null, empty가 반환하는 T,F값도 차이가 있음. ""값 있을때 is_null은 F, empty는 T 반환. https://stackoverflow.com/questions/8236354/php-is-null-or-empty
                     echo "&nbsp;&nbsp;";
                   } else {
                     echo $row[brand];
                   } ?></li>
         <li><?php if(empty($row[number])){
                     echo "&nbsp;&nbsp;";
                   } else {
                     echo $row[number];
                   } ?></li>
         <li><?php if(empty($row[size])){
                     echo "&nbsp;&nbsp;";
                   } else {
                     echo $row[size];
                   } ?></li>
         <li><?php if(empty($row[material])){
                     echo "&nbsp;-&nbsp;";
                   } else {
                     echo $row[material];
                   } ?></li>
         <li><?php if(empty($row[washing])){
                     echo "&nbsp;-&nbsp;";
                   } else {
                     echo $row[washing];
                   } ?></li>
         <br><br>
           <li>
             <!-- 구매수량 버튼으로 조절가능 (최소 1, 최대 5까지) -->
             <button id="sub">-</button>
             <!-- onchange="change_price()" -->
                <input type="number" id="quantity" value="1" min="1" max="5" style="width: 40px;" readonly/>
             <button id="add">+</button>
           </li>

           <li id="price" type="number"><span id="pricereal"><?php echo number_format($row[price]);?></span>
           <span id="pricereal_hid" hidden=hidden><?php echo $row[price]?></span>원</li>
       </ul>
        <!-- <input type="submit" id="button_right" class="button_base b01_simple_rollover" value="구매하기"/> -->
     </article>

     <article id="product_info">
       <button id="button" class="button_base b01_simple_rollover" onclick="cart()">장바구니
           <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
             <script>
                 function cart(){

                   <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ ?> // 세션 없을때
                             alert("로그인 후에 이용하세요");
                   <?php } else {?>

                   let stat = $('#quantity').val();
                   let num = parseInt(stat, 10);

                     let c = confirm("장바구니에 담으시겠습니까?");
                           if(c == true) //
                           /*    $.ajax({
                                 url: "./cartandorder/cart.php",
                                 type: "post",
                                 data: $("form").serialize(),
                               }); */
                               location.href="./cartandorder/cart.php?no=<?php echo $row[no]?>&amount="+num;
                           else if(c == false) //
                           //  document.write("취소함");
                             return false;
                   <?php } ?>
                 }
             </script>
       </button>

       <button id="button" class="button_base b01_simple_rollover" onclick="buynow()" style="">바로구매
           <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
             <script>
                 function buynow(){

                   <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ ?> // 세션 없을때
                             alert("로그인 후에 이용하세요");
                   <?php } else {?>

                   var stat = $('#quantity').val(); // 상품 수량
                   var num = parseInt(stat, 10);

                     var c = confirm("바로 구매하시겠습니까?");
                           if(c == true) //
                           /*    $.ajax({
                                 url: "./cartandorder/cart.php",
                                 type: "post",
                                 data: $("form").serialize(),
                               }); */
                               location.href="./cartandorder/order_form_direct.php?no=<?php echo $row[no]?>&amount="+num; // 상품번호, 수량을 넘김
                           else if(c == false) //
                           //  document.write("취소함");
                             return false;
                   <?php } ?>
                 }
             </script>
       </button>
     </article>

   </div>
   </section>

<div class="set">

    <div class="middle_menu" id="detailinfo">
        <a href="#detailinfo" style="font-weight: bold;">상품정보</a>
        <a href="#qna">Q&A</a>
        <a href="#review">구매후기</a>
    </div>


  <div style="margin-top: 40px; margin-left: 10px;">
   <?php
      $filename = explode(',', $row[image_detail]); // 연결돼 있는 이름을 ',' 기준으로 자름
      ?>
      <img src="<?php echo $filename[0];?>" width="1000px">
      <img src="<?php echo $filename[1];?>" width="1000px">
      <img src="<?php echo $filename[2];?>" width="1000px">
      <img src="<?php echo $filename[3];?>" width="1000px">
      <img src="<?php echo $filename[4];?>" width="1000px">
      <img src="<?php echo $filename[5];?>" width="1000px">
      <img src="<?php echo $filename[6];?>" width="1000px">
      <img src="<?php echo $filename[7];?>" width="1000px">
      <img src="<?php echo $filename[8];?>" width="1000px">
      <img src="<?php echo $filename[9];?>" width="1000px">
      <img src="<?php echo $filename[10];?>" width="1000px">
  </div>

   <div class="sticky">
     <div class="middle_menu" id="qna">
         <a href="#detailinfo">상품정보</a>
         <a href="#qna" style="font-weight: bold;">Q&A</a>
         <a href="#review">구매후기</a>
     </div>
   </div>

   <div class="contents">
     <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
           } else {?>

            <div style="margin-top: 20px;">
                <div id="button_ques" class="b01_simple_rollover2">
                  <a href="aboutproduct/qna_write.php?no=<?php echo $row[no];?>" style="text-decoration: none; color: white; ">문의하기</a></div>
            </div>
    <?php } ?>

    <?php
   $startq = ($pageNumq-1) * $listq; // 페이징의 페이지에 따라 DB에서 데이터를 꺼내올 시작점

             $conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');
             $sqlq = "SELECT * from qna where product_id = '$id' order by no DESC limit $startq, $listq";
             // order by 컬럼명 ASC/ DESC : SELECT문으로 검색된 데이터를 오름차순(asc)이나 내림차순(desc)으로 정렬시킴
            // Limit 시작점, 갯수: 시작점번째부터 갯수개를 출력하라
             $result_q = mysqli_query($conn, $sqlq);
             $rowq = mysqli_num_rows($result_q);

             $countq= 1; ?>

     <ul id ="ulTable">
         <li>   <!-- 첫 줄 li는 게시판 분류 -->
             <ul>
                 <li>No</li>
                 <li>구분</li>
                 <li>제목</li>
                 <li>작성자</li>
                 <li>등록일자</li>
             </ul>
         </li>

<?php
              if( $rowq == 0){
                echo '<div style="padding-top: 70px; padding-bottom: 10px; font-size: 20px;">등록된 글이 없습니다</div>
                <li><ul><li></li><li></li><li></li><li></li><li></li></ul></li>';
              } else {

                      while($row_q = mysqli_fetch_array($result_q)) { ?>
                       <li>  <!-- 게시물이 출력될 영역 -->
                           <ul>
                               <li><?php echo $startq + $countq++;?></li>
                               <li><?php echo $row_q['type']?></li>
                               <li class="tleft">
                                 <a href="./aboutproduct/qna_read.php?no=<?php echo $row_q['no'];?>" style="text-decoration: none; color: black;"><?php echo $row_q['title']?></a></li>
                               <li><?php echo $row_q['customer_name']?></li>
                               <li><?php echo $row_q['date']?></li>
                           </ul>
                       </li>
<?php                }
              }?>
             <div style="padding: 33px;"></div>
     </ul>  <!-- 테이블 전체 닫는 </ul> -->


     <div id="divPaging">
       <?php
               //    $pageNum = 1;
               //    $list = 5;

                   $b_pageNumq_list = 5; // 블럭에 나타낼 페이지 번호 갯수
                   $blockq = ceil($pageNumq/$b_pageNumq_list); // 현재 리스트의 블럭 구하기, ceil():소수점을 모두 올려주는 함수

                   $b_start_pageq = ( ($blockq - 1) * $b_pageNumq_list ) + 1; // 현재 블럭에서 시작페이지 번호
                   $b_end_pageq = $b_start_pageq + $b_pageNumq_list - 1; // 현재 블럭에서 마지막 페이지 번호

                   $sqlzq = "SELECT * FROM qna where product_id = '$id' order by no DESC"; // mysqli_query([연결객체], [쿼리])는 mysqli_connect를 통해 연결된 객체를 이용해 mysql 쿼리를 실행시키는 함수
                   $resultzq = mysqli_query($conn, $sqlzq); // 위의 쿼리를 mysql DB에 연결함
                   $total_rowsq = mysqli_num_rows($resultzq); // mysqli_num_rows(): 쿼리문 연결해온 결과의 총 행 갯수를 구하는 함수

                 $total_pageq =  ceil($total_rowsq/$listq); // 총 페이지 수 = 총 행 갯수/ 한 페이지당 나타낼 글의 갯수

                 if ($b_end_pageq > $total_pageq) // 앞서 구한 끝페이지 번호가 총 페이지수보다 크면 (목록 페이지번호는 있어도 글이 없을 수 있으므로)
                     $b_end_pageq = $total_pageq; // 끝페이지 번호를 총 페이지수와 같게 세팅함

                 if($total_rowsq == 0 ){ // 글이 하나도 없으면
                   // 아무것도 출력하지 않음
                 } else if ($pageNumq <= 1){ // 페이지번호가 1이거나 1보다 작을 때 ?>
                     <div><font size=3><b> << </b></font></div>  <!-- 맨 앞 페이지에 해당하므로 링크 안걸어줘도 됨 -->
           <?php }  else { // 그 외의 경우에는 ?>
                     <div><font size=3><a href="product.php?no=<?php echo $id;?>&pageq=1&listq=<?php echo $listq;?>#qna"> << </a></font></div> <!-- 맨 앞 페이지로 이동하는 링크 걸어줌 -->
           <?php }

                 if($blockq <=1){ // 블록이 1보다 같거나 작을 때는 ?>
                     <font> </font> <!-- 이전블록이 없으니까 아무 표시 안해줘도 됨 -->
           <?php }  else { ?>
                     <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pageq=<?php echo $b_start_pageq-1;?>&listq=<?php echo $listq;?>#qna"> < </a></font></div>
           <?php }

                 for($j = $b_start_pageq; $j <=$b_end_pageq; $j++) { // 시작페이지에서 끝 페이지까지 반복문
                     if($pageNumq == $j) { // 본 페이지에 해당하는 페이지에서는 ?>
                           <div><font size=3><b><?php echo $j; ?></b></font></div> <!-- 링크 안 걸어줘도 됨 -->
             <?php   } else { // 그 외의 경우, 이동할 수 있게 링크 걸어줘야 됨 ?>
                           <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pageq=<?php echo $j;?>&listq=<?php echo $listq;?>#qna"> <?php echo $j;?></a></font></div>
             <?php   }
                 }

                 $total_blockq = ceil($total_pageq/$b_pageNumq_list); // 총 블록 수 = (총 페이지 수 / 블록에 나타낼 페이지 번호갯수) 올림으로 표시함

                 if($blockq >= $total_blockq){ // 블록이 총 블록수보다 크거나 같다면 ?>
                       <font></font> <!-- 아무 표시도 하지 않음 -->
           <?php } else { // 그 외의 경우 ?>
                       <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pageq=<?php echo $b_end_pageq+1;?>&listq=<?php echo $listq;?>#qna"> > </a></font></div> <!-- 다음 블록으로 넘어갈 수 있게 링크 걸음 -->
           <?php }

                 if($total_rowsq == 0){ // 글이 하나도 없으면
                   // 아무것도 출력하지 않음
                 } else if($pageNumq >= $total_pageq){ // 페이지 수가 총 페이지수보다 크거나 같다면 ?>
                       <div><font size=3><b> >> </b></font></div> <!-- 마지막 페이지로 가는 링크 걸어주지 않음 -->
           <?php } else {?>
                       <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pageq=<?php echo $total_pageq;?>&listq=<?php echo $listq;?>#qna"> >> </a></font></div>
           <?php }?>
     </div>
     <!-- class contents 닫는 div 태그 -->
   </div>

   <div class="sticky">
     <div class="middle_menu" id="review">
         <a href="#detailinfo">상품정보</a>
         <a href="#qna">Q&A</a>
         <a href="#review" style="font-weight: bold;">구매후기</a>
     </div>
   </div>

  <div class="contents">

    <?php //if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
          //} else

          $email = $_SESSION['email']; // 세션 이메일 값을 변수에 담음

          $sqle = "SELECT * from member_info where email = '$email'"; // 이메일 값이 일치하는 해당 회원의 DB 정보를 가져오는 쿼리문 작성
          $resulte = mysqli_query($conn, $sqle);
          $rowe = mysqli_fetch_array($resulte);

          $customer_id = $rowe[no]; // 식별번호를 변수에 담음

          $sqlxxo = "SELECT * from orderorder where product_id = '$id' and customer_id = '$customer_id'";
          // order by 컬럼명 ASC/ DESC : SELECT문으로 검색된 데이터를 오름차순(asc)이나 내림차순(desc)으로 정렬시킴
          // Limit 시작점, 갯수: 시작점번째부터 갯수개를 출력하라
          $resultxxo = mysqli_query($conn, $sqlxxo);
          $rowxxo = mysqli_num_rows($resultxxo);

          if($rowxxo != 0){?>

           <div style="margin-top: 20px;">
               <div id="button_ques" class="b01_simple_rollover2">
                 <a href="aboutproduct/review_write.php?no=<?php echo $row[no];?>" style="text-decoration: none; color: white;">리뷰쓰기</a></div>
           </div>

   <?php } ?>

   <?php

   $startp = ($pageNumr-1) * $listr; // 페이징의 페이지에 따라 DB에서 데이터를 꺼내올 시작점

            $conxn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');
            $sqlx = "SELECT * from review where product_id = '$id' order by no DESC limit $startp, $listr"; // order by 컬럼명 ASC/ DESC : SELECT문으로 검색된 데이터를 오름차순(asc)이나 내림차순(desc)으로 정렬시킴
            // Limit 시작점, 갯수: 시작점번째부터 갯수개를 출력하라
            $result_x = mysqli_query($conxn, $sqlx);
            $rowr = mysqli_num_rows($result_x);

            $count= 1; ?>

     <ul id ="ulTable2">
         <li>   <!-- 첫 줄 li는 게시판 분류 -->
             <ul>
                 <li>No</li>
                 <li>별점</li>
                 <li>제목</li>
                 <li>작성자</li>
                 <li>등록일자</li>
             </ul>
         </li>

<?php        if( $rowr == 0){
                echo '<div style="padding-top: 70px; padding-bottom: 10px; font-size: 20px;">등록된 글이 없습니다</div>
                <li><ul><li></li><li></li><li></li><li></li><li></li></ul></li>';
              } else {

                    while($row_x = mysqli_fetch_array($result_x)) { ?>
                  <li>  <!-- 게시물이 출력될 영역 -->
                    <ul>
                        <li><?php echo $startp + $count++; ?></li>
                        <li><?php
                            if($row_x[rate]==1){
                                  echo "★☆☆☆☆";
                            } else if($row_x[rate]==2){
                                  echo "★★☆☆☆";
                            } else if($row_x[rate]==3){
                                  echo "★★★☆☆";
                            } else if($row_x[rate]==4){
                                  echo "★★★★☆";
                            } else if($row_x[rate]==5){
                                  echo "★★★★★";
                            }
                        ?></li>
                        <li class="tleft">
                          <a href="./aboutproduct/review_read.php?no=<?php echo $row_x[no];?>" style="text-decoration: none; color: black;"><?php echo $row_x[title]?></a></li>
                        <li><?php echo $row_x[customer_name]?></li>
                        <li><?php echo $row_x[date]?></li>
                    </ul>
                  </li>
<?php              }
            } ?>

             <div style="padding: 33px;"></div>
     </ul>  <!-- 테이블 전체 닫는 </ul> -->

     <div id="divPaging" style="padding-left: 180px;">

<?php
        //    $pageNum = 1;
        //    $list = 5;

            $b_pageNumr_list = 5; // 블럭에 나타낼 페이지 번호 갯수
            $blockr = ceil($pageNumr/$b_pageNumr_list); // 현재 리스트의 블럭 구하기, ceil():소수점을 모두 올려주는 함수

            $b_start_pager = ( ($blockr - 1) * $b_pageNumr_list ) + 1; // 현재 블럭에서 시작페이지 번호
            $b_end_pager = $b_start_pager + $b_pageNumr_list - 1; // 현재 블럭에서 마지막 페이지 번호

            $connxn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop'); // mysqli_connect()는 php에서 mysql을 연결해주는 함수
            $sqlzx = "SELECT * FROM review where product_id = '$id' order by no DESC"; // mysqli_query([연결객체], [쿼리])는 mysqli_connect를 통해 연결된 객체를 이용해 mysql 쿼리를 실행시키는 함수
            $resultzx = mysqli_query($connxn, $sqlzx); // 위의 쿼리를 mysql DB에 연결함
            $total_rowsr = mysqli_num_rows($resultzx); // mysqli_num_rows(): 쿼리문 연결해온 결과의 총 행 갯수를 구하는 함수
    //        echo $total_rows;

          $total_pager =  ceil($total_rowsr/$listr); // 총 페이지 수 = 총 행 갯수/ 한 페이지당 나타낼 글의 갯수

          if ($b_end_pager > $total_pager) // 앞서 구한 끝페이지 번호가 총 페이지수보다 크면 (목록 페이지번호는 있어도 글이 없을 수 있으므로)
              $b_end_pager = $total_pager; // 끝페이지 번호를 총 페이지수와 같게 세팅함

          if($total_rowsr == 0 ){ // 글이 하나도 없으면
            // 아무것도 출력하지 않음
          } else if ($pageNumr <= 1){ // 페이지번호가 1이거나 1보다 작을 때 ?>
              <div><font size=3><b> << </b></font></div>  <!-- 맨 앞 페이지에 해당하므로 링크 안걸어줘도 됨 -->
    <?php }  else { // 그 외의 경우에는 ?>
              <div><font size=3><a href="product.php?no=<?php echo $id;?>&pager=1&listr=<?php echo $listr;?>#review"> << </a></font></div> <!-- 맨 앞 페이지로 이동하는 링크 걸어줌 -->
    <?php }

          if($blockr <=1){ // 블록이 1보다 같거나 작을 때는 ?>
              <font> </font> <!-- 이전블록이 없으니까 아무 표시 안해줘도 됨 -->
    <?php }  else { ?>
              <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pager=<?php echo $b_start_pager-1;?>&listr=<?php echo $listr;?>#review"> < </a></font></div>
    <?php }

          for($j = $b_start_pager; $j <=$b_end_pager; $j++) { // 시작페이지에서 끝 페이지까지 반복문
              if($pageNumr == $j) { // 본 페이지에 해당하는 페이지에서는 ?>
                    <div><font size=3><b><?php echo $j; ?></b></font></div> <!-- 링크 안 걸어줘도 됨 -->
      <?php   } else { // 그 외의 경우, 이동할 수 있게 링크 걸어줘야 됨 ?>
                    <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pager=<?php echo $j;?>&listr=<?php echo $listr;?>#review"> <?php echo $j;?></a></font></div>
      <?php   }
          }

          $total_blockr = ceil($total_pager/$b_pageNumr_list); // 총 블록 수 = (총 페이지 수 / 블록에 나타낼 페이지 번호갯수) 올림으로 표시함

          if($blockr >= $total_blockr){ // 블록이 총 블록수보다 크거나 같다면 ?>
                <font></font> <!-- 아무 표시도 하지 않음 -->
    <?php } else { // 그 외의 경우 ?>
                <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pager=<?php echo $b_end_pager+1;?>&listr=<?php echo $listr;?>#review"> > </a></font></div> <!-- 다음 블록으로 넘어갈 수 있게 링크 걸음 -->
    <?php }

          if($total_rowsr == 0){ // 글이 하나도 없으면
            // 아무것도 출력하지 않음
          } else if($pageNumr >= $total_pager){ // 페이지 수가 총 페이지수보다 크거나 같다면 ?>
                <div><font size=3><b> >> </b></font></div> <!-- 마지막 페이지로 가는 링크 걸어주지 않음 -->
    <?php } else {?>
                <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pager=<?php echo $total_pager;?>&listr=<?php echo $listr;?>#review"> >> </a></font></div>
    <?php }?>

     </div>
   </div>

 </div>

  </body>
</html>
