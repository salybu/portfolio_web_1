<!DOCTYPE html>
<?php session_start(); ?>
<?php
  $conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

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
      <link rel="stylesheet" href="../common/table.css">
      <link rel="stylesheet" href="../common/inputnumber.css">
      <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <meta charset="utf-8">
    <title>모사샵 - 주문조회</title>
    <style>

    /* 한 가로선상에서 정렬하려면 class로 묶어서 정렬함 */
    .contents {
      float: left; /* 상단바 아래에서 화면에 들어갈 메뉴바랑 컨텐츠 내용을 묶어줌 */
      padding: 20px;
      margin-top: 30px;
    }

    #logo {
      font-family: 'Permanent Marker', cursive;
  /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
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

             #ulTable > li > ul > li:first-child                       {width:10%;} /* 주문번호 열 크기*/
             #ulTable > li > ul > li:first-child +li                   {width:15%;} /* 상품이미지 열 크기*/
             #ulTable > li > ul > li:first-child +li+li                {width:25%;} /* 상품명 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li             {width:10%;} /* 수량 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li+li          {width:15%;} /* 주문금액 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li+li+li       {width:15%;} /* 주문처리상태 열 크기 */

                   #tt li {
                     padding-top: 5px;
                     height: 100px;
                   }
    </style>
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
       <div style="width: 230px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto; font-size: 30px;">
         <span style="font-size: 33px; font-weight: bold;">주문내역 조회</span></div>
        <div>

<form name="form" method="post">
           <ul id ="ulTable">
               <li>   <!-- 첫 줄 li는 게시판 분류 -->
                   <ul>
                       <li>주문번호</li>
                       <li>&nbsp;</li>
                       <li style="text-align: left;">상품</li>
                       <li>수량</li>
                       <li>주문금액</li>
                       <li>주문처리상태</li>
                   </ul>
               </li>

  <?php
        $connn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

        $querys = "SELECT * from orderorder where customer_id = '$customer_id'";
        $resultd = mysqli_query($connn, $querys);
        $ordernum = null; // 주문번호 체크하기 위해 빈값을 우선 넣어둠

        while( $row_d = mysqli_fetch_array($resultd) ) {          ?>

              <li>  <!-- 게시물이 출력될 영역 -->
                      <ul id="tt">
                        <li><div style="padding-top: 10px; line-height: 20px;"><?php echo $row_d[ordernumber];?>
                            <input hidden="true" class="orderid" value="<?php echo $row_d[ordernumber];?>"/>
                                <!-- <php   if ($ordernumb == $row_d[ordernumber]){ // 이전 행에 표기한 상품주문번호가 현재 행의 상품주문번호와 같으면 -->
                                              <!-- echo " "; // 빈칸으로 표시되도록 함 -->
                                <!-- } else { echo $row_d[ordernumber]; }  $ordernumb = $row_d[ordernumber]; ?> -->
                        </li>

                        <?php
                              $product_id = $row_d[product_id];
                              $querypr = "SELECT * from product where no = '$product_id'";
                              $resultpr = mysqli_query($connn, $querypr);
                              $row_pr = mysqli_fetch_array($resultpr)
                        ?>

                        <li style="text-align: right;"><img src="<?php echo $row_pr[image_main];?>" valign="middle" width="50px" height="50px" style="margin-top: 5px; margin-left: 10px; margin-right: 10px;"/></li>
                        <li style="text-align: left;"><?php echo $row_pr[name];?></li>

                        <li><input hidden="true" class="productid" value="<?php echo $product_id;?>"/>
                          <input type="number" class="quantity" value="<?php echo $row_d[product_amount];?>" style="width: 35px;" readonly /></li>
                          <li class="pricereal" ><?php echo number_format($row_d[product_price]);?></li>
                          <li><div style="padding-top: 5px; line-height: 35px;"><span class="status"><?php if($row_d[status] == "결제완료"){ echo '배송대기'; } else { echo $row_d[status]; } ?></span>
                            <!-- db에 저장된 상품의 주문처리상태가 결제완료인 경우, 관리자 페이지에서는 배송대기로 표기하고, 버튼은 배송처리로 표시함 -->
                              <br><input type="button" class="deliver"
                                      value="<?php if($row_d[status] == "결제완료"){ echo "배송처리"; } else if($row_d[status] == "배송중"){ echo "수령확인";
                                                                                    } else if($row_d[status] == "배송완료"){ echo "수령완료"; }?>"
                                            <?php if($row_d[status] == "결제완료"){ echo 'hidden="true"'; } else if($row_d[status] == "배송완료"){ echo 'disabled="true"';} else { echo ""; } ?> /></div>
                            <!-- 배송처리 상태일 때는 버튼이 안보임(hidden="true" 값을 세팅함), 배송중인 상태일 때는 배송을 받았을 수도 있으니까 처리할 수 있도록 수령확인 버튼이 보임 -->
                          </li>
                    </ul>
              </li>
<?php   }          ?>
 <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
 <script>
  $( function(){


    $('.deliver').click( function(e) {
      e.preventDefault();

          var n = $('.deliver').index(this); // index() 함수는 선택요소에서 인자의 index번째 번호를 반환함,
          // index()는 오로지 숫자만 반환함. 몇번째 숫자에 당신이 찾고자 하는 요소가 있다고. index는 0부터 시작함
          // index() => 몇번째 '숫자'를 반환 => eq(index)는 몇번째 요소를 선택함

          var ordernum = $('.orderid:eq('+n+')').val(); // 선택한 상품의 order 식별번호 값을 가져옴 (선택한 상품의 DB 주문처리상태를 바꿔야하니까)
          //    mydata = "orderid="+ordernum;
          //    alert(ordernum);

                 $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                   url: "ajaxprdfinish.php",
                   type: "post",
                   data: { orderid: ordernum },
                 }).done(function() {

                   $('.status:eq('+n+')').text('배송완료'); // eq함수는 선택요소의 index번째 요소를 선택함
                   // 해당항목의 주문처리상태를 배송대기 -> 배송완료으로 바꿈
                   $('.deliver:eq('+n+')').val('수령완료');
                   $('.deliver:eq('+n+')').attr('disabled', true);

                 });

                 var productnum = $('.productid:eq('+n+')').val();

                 var c = confirm("상품리뷰를 작성하시겠습니까?");
                       if(c == true) // 확인을 선택했을 때
                           location.href="../aboutproduct/review_write.php?no="+productnum;
                       else if(c == false) // 취소를 선택했을 때
                          return false;

    });
  });

 </script>
                  <div style="padding: 33px;"></div>
           </ul>  <!-- 테이블 전체 닫는 </ul> -->
          </div> <!-- class contents 닫는 div 태그 -->
         <div style="margin-bottom: 70px;"></div>
</form>

  </body>
</html>
