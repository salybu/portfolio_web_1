<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../common/loginbar.css">
        <link rel="stylesheet" href="../common/inputnumber.css">
        <link rel="stylesheet" href="../common/table.css">
    <meta charset="utf-8">
    <title>모사샵 - 관리자</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
    /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    #ulTable {
      margin-left: 50px;
      margin-top: 30px;
      line-height: 3em;
      font-family: "맑은 고딕";
      text-align: center;
    }

    #ulTable > li {
      width: 1800px;
    }

    #ulTable > li > ul > li:first-child                     {width:10%;} /* 주문번호 열 크기*/
    #ulTable > li > ul > li:first-child +li                 {width:7%;} /* 이미지 열 크기*/
    #ulTable > li > ul > li:first-child +li+li              {width:15%;} /* 상품 열 크기*/
    #ulTable > li > ul > li:first-child +li+li+li           {width:15%;} /* 수량 열 크기*/
    #ulTable > li > ul > li:first-child +li+li+li+li        {width:30%;} /* 배송지정보 열 크기*/
    #ulTable > li > ul > li:first-child +li+li+li+li+li     {width:10%;} /* 주문처리상태 열 크기*/

    #tt li {
      height: 120px;
    }

    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>

    $( function(){
              $('.deliver').click ( function(e) {
                e.preventDefault();

                var n = $('.deliver').index(this); // index() 함수는 선택요소에서 인자의 index번째 번호를 반환함,
                var ordernum = $('.orderid:eq('+n+')').val(); // 선택한 상품의 order 식별번호 값을 가져옴 (선택한 상품의 DB 주문처리상태를 바꿔야하니까)

                $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                  url: "ajaxproductchange.php",
                  type: "post",
                //  data: $("form").serialize(),
                //  data: mydata,
                  data: { orderid: ordernum }
                }).done(function() {

                  $('.status:eq('+n+')').text('배송중'); // eq함수는 선택요소의 index번째 요소를 선택함
                  // 해당항목의 주문처리상태를 배송준비 -> 배송중으로 바꿈
                  $('.deliver:eq('+n+')').val('처리완료');
                  $('.deliver:eq('+n+')').attr('disabled', true);
                });

              });
      });

    </script>
  </head>
  <body>

    <header class="login_bar">
      <span id="logo">mosashop</span>
      <div class="login_bar-right">
        <a>관리자님</a>
        <a href="../main.php">로그아웃</a>
       <a href="list_product.php">상품목록</a>
       <a href="list_qna.php">Q&A관리</a>
       <a href="list_review.php">리뷰관리</a>
       <a href="list_order.php">주문관리</a>
      </div>
    </header>

<form>
    <ul id ="ulTable">
        <li>   <!-- 첫 줄 li는 게시판 분류 -->
            <ul>
                      <li>주문번호</li>
                      <li>&nbsp;</li>
                      <li style="text-align: left;">상품</li>
                      <li>수량</li>
                      <li>배송관련정보</li>
                      <li>주문처리상태</li>
            </ul>
        </li>

        <?php
              $connn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

              $querys = "SELECT * from orderorder";
              $resultd = mysqli_query($connn, $querys);

              while( $row_d = mysqli_fetch_array($resultd) ) {          ?>

                    <li>  <!-- 게시물이 출력될 영역 -->
                            <ul id="tt">
                              <li><div style="padding-top: 10px; line-height: 20px;"><?php echo $row_d[ordernumber];?> <!-- 주문번호, 주문한 날짜를 출력함 -->
                                <input hidden="true" name="orderid" class="orderid" value="<?php echo $row_d[ordernumber];?>"></input></div></li>
                      <?php
                                    $product_id = $row_d[product_id];
                                    $querypr = "SELECT * from product where no = '$product_id'";
                                    $resultpr = mysqli_query($connn, $querypr);
                                    $row_pr = mysqli_fetch_array($resultpr)                      ?>

                              <li style="text-align: right;"><div style="padding-top: 10px;"><img src="<?php echo $row_pr[image_main];?>" valign="middle" width="50px" height="50px" style="margin-top: 5px; margin-left: 10px; margin-right: 10px;"/></div></li>
                              <li style="text-align: left;"><?php echo $row_pr[name];?></li>

                              <li><input type="number" class="quantity" value="<?php echo $row_d[product_amount];?>" style="width: 35px;" readonly /></li>
                                <li style="text-align: left;"><div style="padding-top: 5px; line-height: 25px;">
                                  수령인: <?php echo $row_d[receiver];?><br>
                                  휴대폰번호: <?php echo $row_d[phonenumber];?><br>
                                  배송지: (<?php echo $row_d[address_number];?>)&nbsp;<?php echo $row_d[address_main];?>&nbsp;<?php echo $row_d[address_detail];?>&nbsp;<?php echo $row_d[address_ref];?>
                                </div></li>
                                <li><span class="status"><?php if($row_d[status] == "결제완료"){ echo "배송대기";} else if($row_d[status] == "배송중"){ echo "배송중";} else if($row_d[status] == "배송완료"){ echo "배송완료";} ?></span>
                                  <!-- db에 저장된 상품의 주문처리상태가 결제완료인 경우, 관리자 페이지에서는 배송대기로 표기하고, 버튼은 배송처리로 표시함 -->
                                    <br><input type="button" class="deliver" value="<?php if($row_d[status] == "결제완료"){ echo "배송처리"; } else if($row_d[status] == "배송중"){ echo "처리완료"; } else if($row_d[status] == "배송완료"){ echo "처리완료"; }?>"
                                                  <?php if($row_d[status] == "배송중"){ echo 'disabled="true"'; } else if($row_d[status] == "배송완료"){ echo 'disabled="true"'; } else { echo ""; } ?> />
                                </li>
                          </ul>
                    </li>

      <?php   }          ?>

            <div style="padding: 33px;"></div>
    </ul>  <!-- 테이블 전체 닫는 </ul> -->
</form>
        <div id="divPaging">
        </div>

  </body>
</html>
