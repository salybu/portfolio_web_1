<!DOCTYPE html>
<?php session_start(); ?>
<?php

  $conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

  // * 상품 관련된 값 받고 꺼내는 코드 * //
  $product_id = $_GET[no]; // 상품구분 id 및 수량 관련된 값 받아옴
  $amount = $_GET[amount];

  $query_pr = "SELECT * from product where no ='$product_id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
  $result = mysqli_query($conn, $query_pr); // 쿼리문과 DB 연결함수 연결함
  $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
  $price = $row[price];
  $price_t = $row[price] * $amount; // 상품id로 읽어온 가격값과 수량을 곱해서 price를 담음
  $product_img = $row[image_main];
  $name = $row[name]; //

  // * 회원정보 관련된 값 받고 꺼내는 코드 * //
  $customer_email = $_SESSION['email'];

  $query_cus = "SELECT * from member_info where email ='$customer_email'"; // 멤버 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
  $result_cus = mysqli_query($conn, $query_cus); // 쿼리문과 DB 연결함수 연결함
  $row_cus = mysqli_fetch_array($result_cus); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
  $customer_id = $row_cus[no]; // 로그인한 세션 이메일로 읽어온 멤버정보에서 멤버 고유키 no값을 가져옴
                                                                ?>

<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../common/loginbar.css">
      <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <meta charset="utf-8">
    <title>모사샵 - 상품구매</title>
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

        #register_form {
          width: 600px;
          border: 3px solid black;
          margin-top: 60px;
          margin-bottom: 50px;
          padding-top: 60px;
          padding-left: 60px;
          padding-right: 40px;
          padding-bottom: 50px;
        }

        #register {
          font-weight: bold;
          display: inline;
        }

        #register label {
          float: left;
          width: 180px;
          text-align: right;
          padding-right: 20px;
        }

    .button_base {
        margin: 0;
        border: 0;
        font-size: 18px;
    /*      position: relative;
        top: 50%;
        left: 50%;
        margin-top: -10px;
        margin-left: -40px; */
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

             #ulTable {
              /* margin-left: 100px; */
              position: relative;
               right: 45px;
               margin-top: 30px;
               line-height: 3em; /* 한줄 당 차지하는 height값 두께*/
               font-family: "맑은 고딕";
               text-align: center;
               width: 1300px;
               margin:0 auto; /* width 값을 정하고 margin: 0 auto;하면 가운데 정렬됨*/
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

             #ulTable > li > ul > li:first-child                       {width:10%;} /* 번호 열 크기*/
             #ulTable > li > ul > li:first-child +li                   {width:15%;} /* 상품이미지 열 크기*/
             #ulTable > li > ul > li:first-child +li+li                {width:25%;} /* 상품명 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li             {width:10%;} /* 판매가 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li+li          {width:20%;} /* 수량 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li+li+li       {width:10%;} /* 주문금액 열 크기 */

                   #divPaging {
                       clear: both;
                       margin: 0 auto;
                       width: 220px;
                       height: 50px;
                   }

                   #divPaging > div {
                       float: left;
                       width: 30px;
                       margin:0 auto;
                       text-align:center;
                   }

                   #tt li {
                     height: 70px;
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

                   #payment {
                    /* margin-left: 100px; */
                     padding-top: 120px;
                     line-height: 3em; /* 한줄 당 차지하는 height값 두께*/
                     font-family: "맑은 고딕";
                     text-align: center;
                     width: 700px;
                     margin:0 auto;
                   }

                   #payment > li:first-child > ul > li { /* 맨 위에 분류표시하는 줄 */
                   /*      background-color: #c9c9c9;  */
                       font-weight: bold;
                       text-align: center;
                       font-size: 20px;
                   }

                   #payment > li > ul { /* 게시판 내용 한 줄 No, 제목, 작성자.. 모든 요소가 다 들어간 한 줄 */
                       clear: both; /* float 속성을 준 후 왼쪽,오른쪽에 다른 요소들이 달라붙(?)거나
                       상위태그의 높이가 사라져 아래에 나타나야 하는 내용이 부유된 태그의 중간에 나타나는 문제 등을 해결하기 위해 사용하는 태그 clear */
                       padding: 0px auto;
                       position: relative;
                       min-width: 40px;
                   }

                   #payment > li > ul > li { /* 게시판 하나의 요소 각각 하나하나 (No)(제목)(작성자) 이런 식 */
                       float: left;
                       font-size: 35px;
                       vertical-align: baseline; /* 수직정렬 기본값 baseline */
                   }

                   #payment > li > ul > li:first-child                     {width:20%;} /* 총 상품가격 열 크기*/
                   #payment > li > ul > li:first-child +li                 {width:10%;} /* + 열 크기*/
                   #payment > li > ul > li:first-child +li+li              {width:20%;} /* 배송비 열 크기*/
                   #payment > li > ul > li:first-child +li+li+li           {width:10%;} /* = 열 크기*/
                   #payment > li > ul > li:first-child +li+li+li+li        {width:20%;} /* 총 결제금액 열 크기 */

    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>

    $( function(){

          function addComma(num) { // 1,000자리마다 콤마 찍는 메소드
              var regexp = /\B(?=(\d{3})+(?!\d))/g;
              return num.toString().replace(regexp, ',');
          }

          function unComma(str) { // 콤마 푸는 메소드
              str = String(str);
              return str.replace(/[^\d]+/g, '');
          }

          $('.deliver').change( function() {

              if( $('#original').is(':checked') ){ // 라디오버튼 기존 배송지 선택했을 때
        //        alert("original is checked ");
        $('#receiver').attr( "readonly", "true" ); // 주소 input값 수정할 수 없게 readonly 속성을 추가함
        $('#phonenum').attr( "readonly", "true" );
        $('#address_num').attr( "readonly", "true" );
        $('#address_main').attr( "readonly", "true" );
        $('#address_detail').attr( "readonly", "true" );
        $('#address_ref').attr( "readonly", "true" );

                $('#receiver').val("<?php echo $row_cus[name]; ?>");
                $('#phonenum').val("<?php echo $row_cus[phone_number]; ?>");
                $('#address_num').val("<?php echo $row_cus[address_number]; ?>");
                $('#address_main').val("<?php echo $row_cus[address_main]; ?>");
                $('#address_detail').val("<?php echo $row_cus[address_detail]; ?>");
                $('#address_ref').val("<?php echo $row_cus[address_ref]; ?>");

              } else if( $('#new').is(':checked') ) { // 라디오버튼 새로운 배송지 선택했을 때
        //        alert("new is checked ");
        $('#receiver').removeAttr("readonly"); // input값을 수정할 수 있게 readonly 속성 없애기
        $('#phonenum').removeAttr("readonly");
        $('#address_num').removeAttr("readonly");
        $('#address_main').removeAttr("readonly");
        $('#address_detail').removeAttr("readonly");
        $('#address_ref').removeAttr("readonly");

                $('#receiver').val(""); // 수령인 각 항목에 빈 값을 세팅함
                $('#phonenum').val(""); // 핸드폰번호
                $('#address_num').val("");
                $('#address_main').val("");
                $('#address_detail').val("");
                $('#address_ref').val("");

              }


          });
    });

    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
    <script>
//       $( function() {

        function pay(){
                  alert("good");
        }

        function paypay() {

          var IMP = window.IMP; // 생략가능
          IMP.init('imp93486571'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

                    IMP.request_pay({
                        pg : 'inicis',
                        // 'kakao':카카오페이, html5_inicis':이니시스(웹표준결제), 'nice':나이스페이, 'jtnet':제이티넷, 'uplus':LG유플러스, 'danal':다날, 'payco':페이코, 'syrup':시럽페이, 'paypal':페이팔
                        pay_method : 'card',
                        // 'samsung':삼성페이, 'card':신용카드, 'trans':실시간계좌이체, 'vbank':가상계좌, 'phone':휴대폰소액결제
                        merchant_uid : 'merchant_' + new Date().getTime(),
                        amount : 100  //<php echo $price+2500; ?>
                  //      name: <php echo $pr_name; ?>  다음에 다시하기
                  /*      buyer_email : 'iamport@siot.do',
                        buyer_name : '이가은',
                        buyer_tel : '010-1234-5678',
                        buyer_addr : '서울특별시 강남구 삼성동',
                        buyer_postcode : '123-456', */
                  //      m_redirect_url : 'https://www.yourdomain.com/payments/complete'
                  // 모바일 결제시, 결제가 끝나고 랜딩되는 URL을 지정 (카카오페이, 페이코, 다날의 경우는 필요없음. PC와 마찬가지로 callback함수로 결과가 떨어짐)
                    }, function(rsp) {
                        if ( rsp.success ) {
                            var msg = '결제가 완료되었습니다.';
                            msg += '고유ID : ' + rsp.imp_uid;
                            msg += '상점 거래ID : ' + rsp.merchant_uid;
                            msg += '결제 금액 : ' + rsp.paid_amount;
                            msg += '카드 승인번호 : ' + rsp.apply_num;

                        } else {
                            var msg = '결제에 실패하였습니다.';
                            msg += '에러내용 : ' + rsp.error_msg;
                        }
                        alert(msg);
                    //    location.href="./order_complete.php"
                    });
                //    return true;
          }
//       });
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
       <a href="../logout.php">로그아웃</a>
       <a href="cart.php">장바구니</a>
       <a href="orderlist.php">주문조회</a><?php
    } ?>
      </div>
    </header>

       <!--  <h1 style="width: 550px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto;">장바구니 > 주문서 작성 > 주문 완료</h1>   -->
       <div style="width: 660px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto; font-size: 30px;">
         <span style="font-size: 33px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주문서 작성</span>&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;주문 완료</div>
        <div>

<form name="form" method="post" action="order_paying_direct.php">
           <ul id ="ulTable">
               <li>   <!-- 첫 줄 li는 게시판 분류 -->
                   <ul>
                       <li>전체</li>
                       <li>&nbsp;</li>
                       <li style="text-align: left;">상품</li>
                       <li>판매가</li>
                       <li>수량</li>
                       <li>주문금액</li>
                   </ul>
               </li>

  <?php

        $connnm = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

        $iii =1; // 주문상품마다 번호 매기기 위한 변수     ?>

              <li>  <!-- 게시물이 출력될 영역 -->
                      <ul id="tt">
                        <li><?php echo $iii;?></li>  <!-- 1번, 2번, 3번... (상품갯수마다 번호를 붙임) -->
                        <li style="text-align: right;"><img src="<?php echo $product_img;?>" valign="middle" width="50px" height="50px" style="margin-top: 5px; margin-left: 10px; margin-right: 10px;"/></li>
                        <li style="text-align: left;"><?php echo $name;?></li>
                        <li><?php echo number_format($price);?></li>
                        <!-- <li class="tleft"><a href="./aboutproduct/readqna.php?no=<php echo $row_b['no'];?>" style="text-decoration: none; color: black;"><php echo $row_q['title']?></a></li> -->
                        <li>
                            <!-- <input type="number" class="quantity" value="<php echo $product_amount[$ii];?>" style="width: 35px;" readonly /> -->
                            <input name="product_amount" type="number" class="quantity" value="<?php echo $amount;?>" style="width: 35px;" readonly />
                            <input name="customer_id" type="hidden" value="<?php echo $customer_id;?>" />

                            <input name="product_id" type="hidden" value="<?php echo $product_id;?>" />
                            <input name="product_price" type="hidden" value="<?php echo $price_t;?>" />

                            <input name="order_date2" id="date" type="hidden" value="" />
                                  <script language="JavaScript">
                                      var today = new Date().toLocaleDateString();
                                      document.getElementById('date').value = today;
                                  </script>
                        </li>
                          <li class="pricereal" id="price"><?php echo number_format($price_t);?></li>
                    </ul>
              </li>

                  <div style="padding: 33px;"></div>
           </ul>  <!-- 테이블 전체 닫는 </ul> -->
           <!-- class contents 닫는 div 태그 -->

         </div>

      <div style="width: 700px; margin: 0 auto;">
         <div id="register_form" class="contents">

           <div id="register">
              <label>배송지 선택</label> <input type="radio" name="radio" style="margin-bottom: 5px;" id="original" checked=true class="deliver" />&nbsp;기존 배송지&nbsp;
                <input type="radio" name="radio" style="margin-bottom: 5px;" id="new" class="deliver" />&nbsp;새로운 배송지<br style="margin-bottom: 10px;">
              <label>수령인명</label> <input type="text" name="receiver" id="receiver" style="margin-bottom: 5px;" value="<?php echo $row_cus[name]; ?>" readonly/><br>
              <label>휴대폰 번호</label> <input type="tel" name="inputphone1" id="phonenum" style="margin-bottom: 5px;" value="<?php echo $row_cus[phone_number]; ?>" readonly/><br>

              <label style="position: relative; right: 80px;">주소</label>
            <!-- placeholder => 텍스트필드 내에 있는 짧은 도움말 (흐린색) -->
              <input type="text" style="position: relative; right: 80px; margin-bottom: 5px;" readonly
                placeholder="우편번호" name="inputaddress_number" id="address_num" value="<?php echo $row_cus[address_number]; ?>">
                    <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기" style="position: relative; right: 80px; margin-left: 5px;"><br>
            <!-- 라벨있는 부분과 똑같은 왼쪽간격 주려고 라벨 css tag 참고해서 width(100px)+margin-left(20px) 더한 120px를 왼쪽여백으로 줌 -->
            <input type="text" style="margin-left: 120px; width: 350px; margin-bottom: 5px;" readonly
              placeholder="주소" name="inputaddress_main" id="address_main" value="<?php echo $row_cus[address_main]; ?>"><br>
            <input type="text" style="margin-left: 120px; width: 170px;" readonly
            placeholder="상세주소" name="inputaddress_detail" id="address_detail" value="<?php echo $row_cus[address_detail]; ?>">
            <input type="text" style="width: 158px;" placeholder="참고항목" name="inputaddress_ref" id="address_ref" value="<?php echo $row_cus[address_ref]; ?>" readonly>

           </div>

         </div>
      </div>

         <div>
           <ul id="payment">
               <li>   <!-- 첫 줄 li -->
                   <ul>
                       <li>총 상품가격</li>
                       <li>+</li>
                       <li>배송비</li>
                       <li>=</li>
                       <li>총 결제금액</li>
                   </ul>
               </li>

               <li>   <!-- 첫 줄 li는 게시판 분류 -->
                   <ul>
                       <li class="productprice"><?php echo number_format($price_t); ?></li>
                       <li style="width: 70px; height: 50px;"> </li>
                       <li class="deliveryprice">2,500</li>
                       <li style="width: 70px; height: 50px;"> </li>
                       <li class="totalprice"><?php echo number_format($price_t+2500); ?></li>
                   </ul>
               </li>
          </ul>

           <input id="button" type="submit" class="button_base b01_simple_rollover" value="결제하기"
              style="display: block; margin:0 auto; position: relative; margin-top: 90px; right: 60px; font-size: 20px; color: black;" />

         </div>
         <div style="margin-bottom: 70px;"></div>

  </body>
</html>
