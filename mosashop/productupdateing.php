<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="common/loginbar.css">
      <link rel="stylesheet" href="common/leftmenuandcontents.css">

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

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        appearance: none; /* appearance 속성: 운영체제, 브라우저에 기본적으로 설정돼있는 테마를 기반으로 요소를 표현함. 네이티브로 지원되는 모양을 해제하거나 추가할 때 이 속성을 이용함
         예를 들어, iOS의 폼 요소들에 부여돼있는 둥근 테두리값이나 그림자효과를 제거할 때 사용할 수 있음
         Webkit 계열 브라우저의 'type="search"' 필드의 둥근 테두리값이나 reset 효과를 나타내는 버튼을 삭제하는 데 사용할 수 있음
         select 필드 기본 화살표 모양을 삭제하거나 대체할 수 있음 */
        -webkit-appearance: none; /* Safari와 Chrome에서 */
        -moz-appearance: none; /* firefox 에서 */
        margin: 0;
    }

    input[type="number"]{ /* 내부 버튼 삭제한 뒤에, input number 필드의 외형을 text field로 바꿔줘야 함 */
      -moz-appearance: textfield;
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

      #logo {
        font-family: 'Permanent Marker', cursive;
    /*    font-family: Lobster;  */
        font-size: 40px;
        padding-left: 30px;
      }

      .tleft {
          text-align : left;
      }

      .set {
        margin-left: 170px;
      }

      #ulTable {
        margin-left: 100px;
        margin-top: 30px;
        line-height: 3em;
        font-family: "맑은 고딕";
        text-align: center;
      }

      #ulTable > li {
        width: 1300px;
        margin-left: 50px;
        margin-top: 10px;
        line-height: 3em;
        font-family: "맑은 고딕";
        text-align: center;
      }

      #ulTable > li:first-child > ul > li { /* 맨 위에 분류표시하는 줄 */
      /*      background-color: #c9c9c9;  */
          border-top: 2px solid black;
          border-bottom: 2px solid black;
          font-weight: bold;
          text-align: center;
      }

      ul, li {
          list-style: none;
          padding: 0;
          margin: 0;
      }

      #ulTable > li > ul { /* 게시판 내용 한 줄 No, 제목, 작성자.. 모든 요소가 다 들어간 한 줄 */
          clear: both; /* float 속성을 준 후 왼쪽,오른쪽에 다른 요소들이 달라붙(?)거나
          상위태그의 높이가 사라져 아래에 나타나야 하는 내용이 부유된 태그의 중간에 나타나는 문제 등을 해결하기 위해 사용하는 태그 clear */
          padding: 0px auto;
          position: relative;
          min-width: 40px;
      }

      #ulTable > li > ul > li { /* 게시판 하나의 요소 각각 하나하나 (No)(제목)(작성자) 이런 식 */
          float: left;
          font-size: 10pt;
          border-bottom: 1px solid black;
          vertical-align: baseline; /* 수직정렬 기본값 baseline */
      }

      #ulTable > li > ul > li:first-child                     {width:7%;} /*No 열 크기*/
    /*  #ulTable > li > ul > li:first-child +li                 {width:10%;} 답변여부 열 크기*/
      #ulTable > li > ul > li:first-child +li              {width:10%;} /*구분 열 크기*/
      #ulTable > li > ul > li:first-child +li+li           {width:40%;} /*제목 열 크기*/
      #ulTable > li > ul > li:first-child +li+li+li        {width:15%;} /*작성자 열 크기*/
      #ulTable > li > ul > li:first-child +li+li+li+li     {width:15%;} /*등록일자 열 크기*/
  /*    #ulTable > li > ul > li:first-child +li+li+li+li+li+li  {width:13%;} 조회수 열 크기 */

      #divPaging {
          clear: both;
          margin: 0 auto;
          width: 400px;
          height: 50px;
      }

      #divPaging > div {
          float: left;
          width: 40px;
          margin:0 auto;
          text-align: center;
      }

      #divPaging > div > font > a {
        text-decoration: none;
        color: black;
      }

      #button_ques {
        margin-left: 1140px;
        padding-left: 30px;
        padding-right: 30px;
        width: 60px;
      }

      .b01_simple_rollover2 {
          color: #ffffff;
          border: #000000 solid 1px;
          padding: 10px;
          background-color: #000000;
      }

      #ulTable2 {
        margin-left: 100px;
        margin-top: 30px;
        line-height: 3em;
        font-family: "맑은 고딕";
        text-align: center;
      }

      #ulTable2 > li {
        width: 1150px;
        margin-left: 50px;
        margin-top: 10px;
        line-height: 3em;
        font-family: "맑은 고딕";
        text-align: center;
      }

      #ulTable2 > li:first-child > ul > li { /* 맨 위에 분류표시하는 줄 */
      /*      background-color: #c9c9c9;  */
          border-top: 2px solid black;
          border-bottom: 2px solid black;
          font-weight: bold;
          text-align: center;
      }

      #ulTable2 > li > ul { /* 게시판 내용 한 줄 No, 제목, 작성자.. 모든 요소가 다 들어간 한 줄 */
          clear: both; /* float 속성을 준 후 왼쪽,오른쪽에 다른 요소들이 달라붙(?)거나
          상위태그의 높이가 사라져 아래에 나타나야 하는 내용이 부유된 태그의 중간에 나타나는 문제 등을 해결하기 위해 사용하는 태그 clear */
          padding: 0px auto;
          position: relative;
          min-width: 40px;
      }

      #ulTable2 > li > ul > li { /* 게시판 하나의 요소 각각 하나하나 (No)(제목)(작성자) 이런 식 */
          float: left;
          font-size: 10pt;
          border-bottom: 1px solid black;
          vertical-align: baseline; /* 수직정렬 기본값 baseline */
      }

      #ulTable2 > li > ul > li:first-child                         {width:10%;} /* No 열 크기*/
      #ulTable2 > li > ul > li:first-child +li                     {width:20%;} /* 별점 열 크기*/
      #ulTable2 > li > ul > li:first-child +li+li                  {width:40%;} /* 제목 열 크기*/
      #ulTable2 > li > ul > li:first-child +li+li+li               {width:15%;} /* 작성자 열 크기*/
      #ulTable2 > li > ul > li:first-child +li+li+li+li            {width:15%;} /* 등록일자 열 크기*/

    </style>
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script>

          $( function() {

            $('#sub').click( function(e) { // e는 event 객체를 가리키는 argument
              e.preventDefault(); // 현재 이벤트의 기본 동작을 중단함. 정의한 이벤트 외 브라우저의 별도의 행동을 중단하기 위해 사용됨
                  var stat = $('#quantity').val();
                  var num = parseInt(stat, 10);
                  num--;
                              if(num <= 0){
                                alert('더이상 줄일 수 없습니다.');
                                num = 1;
                              }
                  $('#quantity').val(num);

                  var price_origin = $('#pricereal_hid').text();
                  $('#pricereal').text(addComma(num * price_origin));
            });

            $('#add').click( function(e) {
              e.preventDefault();
                  var stat = $('#quantity').val();
                  var num = parseInt(stat, 10);
                  num++;
                                if(num > 5){
                                  alert('더이상 늘릴 수 없습니다.');
                                  num=5;
                                }
                  $('#quantity').val(num);

                  var price_origin = $('#pricereal_hid').text();
                  $('#pricereal').text(addComma(num * price_origin));
            });

            function addComma(num) { // 1,000자리마다 콤마 찍는 메소드
              var regexp = /\B(?=(\d{3})+(?!\d))/g;
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
                 <a href="main_logout.php">로그아웃</a>
                 <a href="./cartandorder/cart.php">장바구니</a>
                 <a href="register.php">주문조회</a><?php
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


                    $pageNum = ($_GET['page']) ? $_GET['page'] : 1;     // page : default - 1  // 현재 표시할 페이지의 번호
                    $list = ($_GET['list']) ? $_GET['list'] : 5;  // page : default - 5 // 한 페이지 당 보여줄 글의 갯수
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




          <button id="button" class="button_base b01_simple_rollover" onclick="cart()">장바구니
              <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
                <script>
                    function cart(){

                      <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ ?> // 세션 없을때
                                alert("로그인 후에 이용하세요");
                      <?php } else {?>

                      var stat = $('#quantity').val();
                      var num = parseInt(stat, 10);

                        var c = confirm("장바구니에 담으시겠습니까?");
                              if(c == true) //
                              /*    $.ajax({
                                    url: "./cartandorder/cart.php",
                              			type: "post",
                              			data: $("form").serialize(),
                                  }); */
                                  location.href="./cartandorder/cart.php?no=<?php echo $row[no]?>&amount="+num;
                              else if(c == false) //
                                  document.write("취소함");
                      <?php } ?>
                    }
                </script>
          </button>







     </article>

     <!-- 상품 기본정보 내용 -->
     <article id="product_info_cont" class="contents" style="margin-left: 120px;">
       <ul class="cont">
         <li><?php if(empty($row[brand])){ // is_null, empty가 반환하는 T,F값도 차이가 있음. ""값 있을때 is_null은 F, empty는 T 반환. https://stackoverflow.com/questions/8236354/php-is-null-or-empty
                     echo "&nbsp;-&nbsp;";
                   } else {
                     echo $row[brand];
                   } ?></li>
         <li><?php if(empty($row[number])){
                     echo "&nbsp;-&nbsp;";
                   } else {
                     echo $row[number];
                   } ?></li>
         <li><?php if(empty($row[size])){
                     echo "&nbsp;-&nbsp;";
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



        <input type="submit" id="button_right" class="button_base b01_simple_rollover" value="구매하기"/>






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
      $filename = explode(',', $row[image_detail]);
      ?>
      <img src="<?php echo $filename[0];?>" width="1000px">
      <img src="<?php echo $filename[1];?>" width="1000px">
      <img src="<?php echo $filename[2];?>" width="1000px">
      <img src="<?php echo $filename[3];?>" width="1000px">
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
              <a href="aboutproduct/writeqna.php?no=<?php echo $row[no];?>" style="text-decoration: none;">
                <div id="button_ques" class="b01_simple_rollover2">문의하기</div></a>
            </div>

    <?php } ?>

    <?php
             $conn = mysqli_connect( 'localhost', 'ggn', 'Local1234^^;', 'z_mosashop');
        //     $sql = "SELECT * FROM qna order by no desc LIMIT 0,5"; // qna 안에 있는 모든 항목들중 no 번호에 따라 내림차순으로 5개를 출력하라
             $sql = "SELECT * from qna where product_id = '$id'";
             $result_q = mysqli_query($conn, $sql);

             $count= 1; ?>

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

    <?php        while($row_q = mysqli_fetch_array($result_q)) { ?>
         <li>  <!-- 게시물이 출력될 영역 -->
             <ul>
                 <li><?php echo $count++;?></li>
                 <li><?php echo $row_q['type']?></li>
                 <li>
                   <a href="./aboutproduct/readqna.php?no=<?php echo $row_q['no'];?>" style="text-decoration: none; color: black;"><?php echo $row_q['title']?></a></li>
                 <li><?php echo $row_q['customer_name']?></li>
                 <li><?php echo $row_q['date']?></li>
             </ul>
         </li>
    <?php } ?>
             <div style="padding: 33px;"></div>
     </ul>  <!-- 테이블 전체 닫는 </ul> -->


     <div id="divPaging">
         <div>◀</div>
         <div><b>1</b></div>
         <div>2</div>
         <div>3</div>
         <div>4</div>
         <div>5</div>
         <div>▶</div>
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

    <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
          } else {?>

           <div style="margin-top: 20px;">
             <a href="aboutproduct/writereview.php?no=<?php echo $row[no];?>" style="text-decoration: none;">
               <div id="button_ques" class="b01_simple_rollover2">리뷰쓰기</div></a>
           </div>

   <?php } ?>

   <?php

   $startp = ($pageNum-1) * $list; // 페이징의 페이지에 따라 DB에서 데이터를 꺼내올 시작점


            $conxn = mysqli_connect( 'localhost', 'ggn', 'Local1234^^;', 'z_mosashop');
            $sqlx = "SELECT * from review where product_id = '$id' order by no DESC limit $startp, $list"; // order by 컬럼명 ASC/ DESC : SELECT문으로 검색된 데이터를 오름차순(asc)이나 내림차순(desc)으로 정렬시킴
            // Limit 시작점, 갯수: 시작점번째부터 갯수개를 출력하라
            $result_x = mysqli_query($conxn, $sqlx);

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

         <?php        while($row_x = mysqli_fetch_array($result_x)) { ?>
              <li>  <!-- 게시물이 출력될 영역 -->
                  <ul>
                      <li><?php
                          echo $startp + $count++;
                        //   echo $count++;
                          ?></li>
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
                        <a href="./aboutproduct/readreview.php?no=<?php echo $row_x[no];?>" style="text-decoration: none; color: black;"><?php echo $row_x[title]?></a></li>
                      <li><?php echo $row_x[customer_name]?></li>
                      <li><?php echo $row_x[date]?></li>
                  </ul>
              </li>
         <?php } ?>

             <div style="padding: 33px;"></div>
     </ul>  <!-- 테이블 전체 닫는 </ul> -->

     <div id="divPaging" style="padding-left: 180px;">

<?php
        //    $pageNum = 1;
        //    $list = 5;

            $b_pageNum_list = 5; // 블럭에 나타낼 페이지 번호 갯수
            $block = ceil($pageNum/$b_pageNum_list); // 현재 리스트의 블럭 구하기, ceil():소수점을 모두 올려주는 함수

            $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; // 현재 블럭에서 시작페이지 번호
            $b_end_page = $b_start_page + $b_pageNum_list - 1; // 현재 블럭에서 마지막 페이지 번호

            $connxn = mysqli_connect( 'localhost', 'ggn', 'Local1234^^;', 'z_mosashop'); // mysqli_connect()는 php에서 mysql을 연결해주는 함수
            $sqlzx = "SELECT * FROM review where product_id = '$id' order by no DESC"; // mysqli_query([연결객체], [쿼리])는 mysqli_connect를 통해 연결된 객체를 이용해 mysql 쿼리를 실행시키는 함수
            $resultzx = mysqli_query($connxn, $sqlzx); // 위의 쿼리를 mysql DB에 연결함
            $total_rows = mysqli_num_rows($resultzx); // mysqli_num_rows(): 쿼리문 연결해온 결과의 총 행 갯수를 구하는 함수

          $total_page =  ceil($total_rows/$list); // 총 페이지 수 = 총 행 갯수/ 한 페이지당 나타낼 글의 갯수
    //      echo $total_page;

          if ($b_end_page > $total_page) // 앞서 구한 끝페이지 번호가 총 페이지수보다 크면 (목록 페이지번호는 있어도 글이 없을 수 있으므로)
              $b_end_page = $total_page; // 끝페이지 번호를 총 페이지수와 같게 세팅함


          if($pageNum <= 1){ // 페이지번호가 1이거나 1보다 작을 때 ?>
          <div><font size=3><b> << </b></font></div>  <!-- 맨 앞 페이지에 해당하므로 링크 안걸어줘도 됨 -->
          <?php }  else { // 그 외의 경우에는 ?>
          <div><font size=3><a href="product.php?no=<?php echo $id;?>&page=&list=<?php echo $list;?>#review"> << </a></font></div> <!-- 맨 앞 페이지로 이동하는 링크 걸어줌 -->
          <?php }

          if($block <=1){ // 블록이 1보다 같거나 작을 때는?>
          <font> </font>
          <?php }  else {?>
          <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $b_start_page-1;?>&list=<?php echo $list;?>#review"> < </a></font></div>
          <?php }

          for($j = $b_start_page; $j <=$b_end_page; $j++) {
          if($pageNum == $j) {?>
          <div><font size=3><b><?php echo $j; ?></b></font></div>
          <?php   } else { ?>
          <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $j;?>&list=<?php echo $list;?>#review"> <?php echo $j;?></a></font></div>
          <?php   }
          }


          $total_block = ceil($total_page/$b_pageNum_list);

          if($block >= $total_block){?>
          <font></font>
          <?php } else {?>
          <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $b_end_page+1;?>&list=<?php echo $list;?>#review"> > </a></font></div>
          <?php }


          if($pageNum >= $total_page){ ?>
          <div><font size=3><b> >> </b></font></div>
          <?php } else {?>
          <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $total_page;?>&list=<?php echo $list;?>#review"> >> </a></font></div>
          <?php }?>
         <!-- <div>▶</div> -->

     </div>
   </div>
 </div>

  </body>
</html>
