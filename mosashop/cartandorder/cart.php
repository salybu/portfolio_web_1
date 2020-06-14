<!DOCTYPE html>
<?php session_start(); ?>
<?php
         $conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

         if(isset($_GET[no]) && !empty($_GET[no])){ // 상품페이지에서 장바구니에 상품을 담아 왔을 때

           // * 상품 관련된 값 받고 꺼내는 코드 * //
           $product_id = $_GET[no]; // 상품구분 id 및 수량 관련된 값 받아옴
           $amount = $_GET[amount];

           $query_pr = "SELECT * from product where no ='$product_id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
           $result = mysqli_query($conn, $query_pr); // 쿼리문과 DB 연결함수 연결함
           $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           $price = $row[price];
           $price_t = $row[price] * $amount; // 상품id로 읽어온 가격값과 수량을 곱해서 price를 담음
           $product_img = $row[image_main];
           $name = $row[name]; // =>

           // * 회원정보 관련된 값 받고 꺼내는 코드 * //
           $customer_email = $_SESSION['email'];

           $query_cus = "SELECT * from member_info where email ='$customer_email'"; // 멤버 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
           $result_cus = mysqli_query($conn, $query_cus); // 쿼리문과 DB 연결함수 연결함
           $row_cus = mysqli_fetch_array($result_cus); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           $customer_id = $row_cus[no]; // 로그인한 세션 이메일로 읽어온 멤버정보에서 멤버 고유키 no값을 가져옴

           $sql = "INSERT INTO basket (customer_id, amount, total_price, product_id, product_img, product_name, product_price)
                    values ('$customer_id', '$amount', '$price_t', '$product_id', '$product_img', '$name', '$price')"; // qna 안에 있는 모든 항목들중 no 번호에 따라 내림차순으로 5개를 출력하라
           $result_tt = mysqli_query($conn, $sql);

           $sqll = "SELECT * FROM basket where customer_id = '$customer_id'"; //
           $result_b = mysqli_query($conn, $sqll);
    //       $row_b = mysqli_fetch_array($result_b); // 읽어온 아이템을 row 변수에 전부 담아서 항목별로 가져올 수 있게 함

         } else {

           // * 회원정보 관련된 값 받고 꺼내는 코드 * //
           $customer_email = $_SESSION[email];

           $query_cus = "SELECT * from member_info where email ='$customer_email'"; // 멤버 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
           $result_cus = mysqli_query($conn, $query_cus); // 쿼리문과 DB 연결함수 연결함
           $row_cus = mysqli_fetch_array($result_cus); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           $customer_id = $row_cus[no]; // 로그인한 세션 이메일로 읽어온 멤버정보에서 멤버 고유키 no값을 가져옴

           $sqll = "SELECT * FROM basket where customer_id = '$customer_id'"; // qna 안에 있는 모든 항목들중 no 번호에 따라 내림차순으로 5개를 출력하라
           $result_b = mysqli_query($conn, $sqll);
    //       $row_b = mysqli_fetch_array($result_b); // 읽어온 아이템을 row 변수에 전부 담아서 항목별로 가져올 수 있게 함

         }

/*             $sql2 = "SELECT count(*) FROM qna";
         $result_q2 = mysqli_query($conn, $sql2);   */
 ?>

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
               margin-top: 30px;
               line-height: 3em; /* 한줄 당 차지하는 height값 두께*/
               font-family: "맑은 고딕";
               text-align: center;
               width: 1300px;
               margin:0 auto;
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

             #ulTable > li > ul > li:first-child                        {width:10%;} /* 선택 열 크기*/
             #ulTable > li > ul > li:first-child +li                    {width:15%;} /* 상품이미지 열 크기*/
             #ulTable > li > ul > li:first-child +li+li                 {width:25%;} /* 상품명 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li              {width:10%;} /* 판매가 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li+li           {width:20%;} /* 수량 열 크기*/
             #ulTable > li > ul > li:first-child +li+li+li+li+li        {width:10%;} /* 주문금액 열 크기 */

                   #divPaging {
                       clear: both;
                       margin: 0 auto;
                       width: 220px;
                       height: 50px;
                   }

                   #divPaging > div {
                       float:left;
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
              $('.add').click ( function (e) {
                e.preventDefault();
                    var n = $('.add').index(this); // index() 함수는 선택요소에서 인자의 index번째 번호를 반환함,
                    // index()는 오로지 숫자만 반환함. 몇번째 숫자에 당신이 찾고자 하는 요소가 있다고. index는 0부터 시작함
                    // index() => 몇번째 '숫자'를 반환 => eq(index)는 몇번째 요소를 선택함

                    var num = $('.quantity:eq('+n+')').val(); // eq함수는 선택요소의 index번째 요소를 선택함
                    // index로 받아온 순서값을 eq에 넣고 그 num값을 받아옴
                    $('.quantity:eq('+n+')').val(num*1+1); // 받아온 num값에 1을 더함
                    num = num*1+1;

                    var numnum = parseInt(num, 10); // num값을 10진수 int값으로 변환해 변수에 저장

                    var price_origin = $('.pricereal_hid:eq('+n+')').text();
                    var price_or = parseInt(price_origin, 10);

                    $('.pricereal:eq('+n+')').text(addComma(numnum * price_or));
                    $('.productam:eq('+n+')').val(numnum); // 변경된 (수량값) 반영해서 넘기려고 hidden input에 똑같이 세팅해줌
                    $('.productpr:eq('+n+')').val(numnum * price_or); // 선택주문하기에서 (수량 * 상품가격값) 바로 넘기려고 hidden input에 똑같이 세팅해줌


                    var nnn = document.getElementsByName('checkb[]').length; // 전체 체크박스 태그개수를 구해옴
                    var productprice = 0; // 총 상품금액의 숫자값을 0으로 세팅함
                    var amountarray = ""; // 선택된 상품의 수량을 string array로 담으려함("xx,xx,xx")

                    // 체크박스 체크돼있을 때 총 가격에도 반영되게 하려고 반복문을 돌려서 체크돼있는 상품만 전체가격 계산에 포함함
                    if( $('.checkb:eq('+n+')').is(':checked') ){

                            for( var i = 0; i < nnn ; i++) { //
                            //        alert("checkbox checked yes for sentence");
                            //        $('.productprice').text(addComma(numnum * price_or));

                                  if( $('.checkb:eq('+i+')').is(':checked') ){ // 반복문도는데 체크박스 체크돼 있는 애들만 총 가격에 포함되도록 함
                                    var price1 = $('.pricereal:eq('+i+')').text();
                                    var price2 = unComma(price1); // 1,000자리 콤마 풀기
                                    var price = parseInt(price2, 10);

                                    productprice += price; // 체크박스가 체크돼있으면 체크된 상품의 금액을 총 상품금액에 더함
                                  }
                            }
                        $('.productprice').text(addComma(productprice));
                        $('.deliveryprice').text(addComma(2500));
                        $('.totalprice').text(addComma(productprice+2500));
                    }
              });

              $('.sub').click( function(e){
                 e.preventDefault(); // 버튼 누를때 스크립트 보내면서 페이지 넘어가지 않고 숫자만 변하게 해줌 (더 알아보기)
                    var n = $('.sub').index(this); // index() 함수는 선택요소에서 인자의 index번째 번호를 반환함,
                    // index()는 오로지 숫자만 반환함. 몇번째 숫자에 당신이 찾고자 하는 요소가 있다고. index는 0부터 시작함
                    // index() => 몇번째 '숫자'를 반환 => eq(index)는 몇번째 요소를 선택함

                    var num = $('.quantity:eq('+n+')').val(); // eq함수는 선택요소의 index번째 요소를 선택함
                    // index로 받아온 순서값을 eq에 넣고 그 num값을 받아옴

                    $('.quantity:eq('+n+')').val(num*1-1); // 받아온 num값에 1을 더함
                    num = num*1-1;

                  //  num = $('.quantity:eq('+n+')').val(num*1-1); // 받아온 num값에 1을 더함
                    var numnum = parseInt(num, 10);

                    var price_origin = $('.pricereal_hid:eq('+n+')').text();
                    var price_or = parseInt(price_origin, 10);

                    $('.pricereal:eq('+n+')').text(addComma(numnum * price_or));
                    $('.productam:eq('+n+')').val(numnum); // 변경된 (수량값) 반영해서 넘기려고 hidden input에 똑같이 세팅해줌
                    $('.productpr:eq('+n+')').val(numnum * price_or); // 선택주문하기에서 (수량 * 상품가격값) 바로 넘기려고 hidden input에 똑같이 세팅해줌


                    var nnn = document.getElementsByName('checkb[]').length; // 전체 체크박스 태그개수를 구해옴
                    var productprice = 0; // 총 상품금액의 숫자값을 0으로 세팅함

                    // 체크박스 체크돼있을 때 총 가격에도 반영되게 하려고
                    if( $('.checkb:eq('+n+')').is(':checked') ){

                            for( var i = 0; i < nnn ; i++) { //
                            //        alert("checkbox checked yes for sentence");
                            //        $('.productprice').text(addComma(numnum * price_or));

                                  if( $('.checkb:eq('+i+')').is(':checked') ){ // 반복문도는데 체크박스 체크돼 있는 애들만 총 가격에 포함되도록 함
                                    var price1 = $('.pricereal:eq('+i+')').text(); //
                                    var price2 = unComma(price1); // 1,000자리 콤마 풀기
                                    var price = parseInt(price2, 10);

                                    productprice += price;
                                  }
                            }
                        $('.productprice').text(addComma(productprice));
                        $('.deliveryprice').text(addComma(2500));
                        $('.totalprice').text(addComma(productprice+2500));
                    }
                });


              $('.checkall').click( function(){
                /*  e.preventDefault(); // 체크박스에서는 e 이벤트객체랑 preventDefault 함수 쓰면 안됨. 동작안함
                      this.ischecked();      $('.checkb').ischecked(); */

                      $('.checkb').prop('checked', this.checked); /*  .prop()은 지정한 선택자를 가진 첫번째 요소의 속성값을 가져오거나 속성값을 추가함
                      HTML 입장에서의 속성(attribute)이 아니라 Javascript 입장에서의 속성(property)이라는 점
                                 .prop(propertyName) 속성값을 가져옴
                                 .prop(propertyName, value) 속성값을 추가함 */  //       alert("");

                   //   var xx = document.getElementsById('price').length;
                   //   var nnn = $('#checkb').length;     //   alert("#checkb_length"+nnn);
                   //   var nnn = $('#price').length;

                      var nnn = document.getElementsByName('checkb[]').length; // id는 한페이지 내에 중복되면 안됨. id값은 유일해야 함. 그래서 length 써도 길이가 안나옴.
                      // getElementBtId()는 1개만 가져옴. getElementsBtName() 복수로 해서 갯수 가져와야 됨
                      var prprice = 0; // 어차피 전체선택 전체 상품가격을 더하는 거니까 초기값을 0으로 세팅
                    //  alert(nnn);
                     for( var x = 0; x < nnn ; x++) { // 반복문으로 모든 체크박스를 체크하고, i번째 체크박스가 체크돼있을 때 아래조건을 줌

                            var deliverpr = 2500; // 체크박스 체크돼있을 때만 배송비 들어가게 하기 위해, 대신 1번만 들어가야 함. 그래서 매번 초기화되도록 세팅함

                               if($('.checkb:eq('+x+')').is(':checked')){   // i번째 체크박스가 체크되어있으면
                             /*    var price1 = $('.pricereal').text();
                                 var price2 = unComma(price1); // 1,000자리 콤마 풀기
                                 var price = parseInt(price2, 10); */

                            //     alert("check");
                                 var price1 = $('.pricereal:eq('+x+')').text();
                                 var price2 = unComma(price1); // 1,000자리 콤마 풀기
                                 var price = parseInt(price2, 10);

                              //   var price = parseInt(unComma($('.pricereal:eq('+i+')').text()), 10);    //    alert("price"+price+" typeofprice"+typeof(price));
                                 var num = $('.quantity:eq('+x+')').val();
                                 var numnum = parseInt(num, 10);
                                 $('.productam:eq('+x+')').val(numnum); // 수량조절하지 않고 전체 체크박스 키 눌렀을 때도 수량값을 hidden input에 똑같이 세팅해줌
                                 $('.productpr:eq('+x+')').val(price); // 수량조절하지 않고 전체 체크박스 키 눌렀을 때도 hidden input값에 개별제품 수량별 가격이 세팅되도록 함

                             //    prprice = parseInt(prprice + price); // 총 상품금액 = 총 상품금액에서 가져온 값 + 체크박스 체크된 상품금액
                             //    prprice = 1*parseInt(prprice) -0 + 1*parseInt(price);

                              //   prprice += parseInt(price);  //  alert("prprice"+prprice+" typeofprprice"+typeof(prprice));
                                  prprice = prprice + price;




                               } else {
                                 var deliverpr = parseInt(0);
                               }
                     }

                     $('.productprice').text(addComma(prprice));
                     $('.deliveryprice').text(addComma(deliverpr));
                     $('.totalprice').text(addComma(prprice+deliverpr));

                     $('.totalpricee').val(prprice+deliverpr); // 선택주문으로 넘길 때 같은 값 넘기려고(hidden input값 만듬) 위의 코드랑 매번 똑같이 세팅함
        //          alert("prprice"+prprice);
              });

              $('.checkb').click( function(){
                            //      e.preventDefault();
                                var n = $('.checkb').index(this); // 체크박스의 index 번호를 변수에 담음
                          //    if($('.checkb:eq('+n+')').checked){ // 체크박스가 해제되었을 때
                          //          alert("is checked");

                var price1 = $('.pricereal:eq('+n+')').text();
                var price2 = unComma(price1); // 1,000자리 콤마 풀기
                var price = parseInt(price2, 10);

                var productprice = $('.productprice').text(); // 총 상품금액의 숫자값을 가져오기
                var prprice1 = unComma(productprice); // 1,000자리 콤마 풀기
                var prprice = parseInt(prprice1, 10);

            if($('.checkb:eq('+n+')').is(':checked')){ // 체크박스 해제 => 체크박스 체크했을 때

              prprice = prprice + price; // 총 상품금액 = 총 상품금액에서 가져온 값 + 체크박스 체크된 상품금액
            //  alert("prprice after"+prprice);
              $('.productpr:eq('+n+')').val(price); // 수량조절하지 않고 체크박스 체크했을 때도 hidden input값에 개별제품 수량별 가격이 세팅되도록 함
              var deliverpr = 2500;

            } else { // 체크박스 체크 => 체크박스 해제했을 때

              var productprice = $('.productprice').text(); // 총 상품금액의 숫자값을 가져오기
              var prprice1 = unComma(productprice); // 1,000자리 콤마 풀기
              var prprice = parseInt(prprice1, 10);
               prprice = prprice - price; // 총 상품금액 = 총 상품금액에서 가져온 값 - 체크박스 체크된 상품금액

               var deliverpr = 0;

            /*         if($('.checkb').is(':unchecked')){
                        var deliverpr = 0;
                      } else {
                        var deliverpr = 2500;
                      }   */

                      // 체크박스에 체크된 게 1개라도 있으면 배송비 2500원 세팅되게 하기
                      var nnn = document.getElementsByName('checkb[]').length; // 전체 체크박스 태그개수를 구해옴
                      var checksum = 0; // 체크박스 내 체크된 개수 체크하기 위한 sum값

                      for( var i = 0; i < nnn ; i++) { // 전체 체크박스 개수만큼 반복문 돌리면서 조건검사
                          if($('.checkb:eq('+i+')').is(':checked')){ // 체크된 거 1개라도 있으면
                            checksum += 1; // checksum에 체크된 개수를 담음
                          } else { // 체크된 게 없으면 배송비=0으로 세팅
                          }
                      }

                      // 앞서 세팅한 checksum 값이 1이상이면 배송비 2500원 세팅, 아니면 배송비 0원 세팅

                      // + 전체 갯수만큼 체크하면 전체체크박스에 체크표시 되게 함
                /*      if(checksum = (nnn-1)){ 체크를 해제했을 때 인식되니까 전체 체크박스-1개만큼 체크돼있을 때 동작하도록 함
                        alert("전체갯수만큼 체크돼있ㅇ므");
                        $('.checkall').prop('checked', this.checked); // 전체 체크박스 세팅
                      }else   */

                      if(checksum >0){
                          var deliverpr = parseInt(2500);
                      } else {
                          var deliverpr = parseInt(0);
                      }
            }

               $('.productprice').text(addComma(prprice));
               $('.deliveryprice').text(addComma(deliverpr));

               $('.totalprice').text(addComma(prprice+deliverpr));
               $('.totalpricee').val(prprice+deliverpr); // 선택주문으로 넘길 때 같은 값 넘기려고(hidden input값 만듬) 위의 코드랑 매번 똑같이 세팅함
          });

          $('.checkb').change( function() { // 개별 체크박스를 전체 체크박스 개수만큼 체크하면 전체 체크버튼도 체크되도록 함

            var nnn = document.getElementsByName('checkb[]').length; // 전체 체크박스 태그개수를 구해옴
            // + 전체 갯수만큼 체크하면 전체체크박스에 체크표시 되게 함
                if( $("input[name='checkb[]']:checked").length == nnn ){ // 체크된 체크박스 태그갯수가 전체 체크박스갯수와 같을 때
                            $("#checkall").prop("checked", this.checked);
                } else { // 아닌 경우
                            $("#checkall").prop("checked", false);
                }
          });

          function addComma(num) { // 1,000자리마다 콤마 찍는 메소드
              var regexp = /\B(?=(\d{3})+(?!\d))/g;
              return num.toString().replace(regexp, ',');
          }

          function unComma(str) { // 콤마 푸는 메소드
              str = String(str);
              return str.replace(/[^\d]+/g, '');
          }

          $('form').submit( function(){
        //      alert("submit ing");

              if (typeof(document.forms[0].elements['checkb[]'].length) == 'undefined') { // 체크박스 태그 1개일 때
                  if (document.forms[0].elements['checkb[]'].checked==false) {
                  //    var amount = $('.quantity').val(); // 수량 변경한 값이 amount에 반영되게
                  //    $('.product_amount[]').val(amount);

                      document.forms[0].elements['product_id[]'].disabled=true;
                      document.forms[0].elements['product_amount[]'].disabled=true;
                      document.forms[0].elements['product_price2[]'].disabled=true;
                  }
              } else { // 체크박스 태그 여러 개일 때
                  for (i=0; i<document.forms[0].elements['checkb[]'].length; i++) {
                      if (document.forms[0].elements['checkb[]'][i].checked==false) {
                //        var amount = $('.quantity:eq('+i+')').val(); // 수량 변경한 값이 amount에 반영되게
                        // $('.product_amount[]['+i+']').val(amount);
                //          f.elements['product_amount[]'][i].value = amount;

                          document.forms[0].elements['product_id[]'][i].disabled=true;
                          document.forms[0].elements['product_amount[]'][i].disabled=true;
                          document.forms[0].elements['product_price2[]'][i].disabled=true;
                      }
                  }
              }
              return true;
          });
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
       <a href="../logout.php">로그아웃</a>
       <a href="cart.php">장바구니</a>
       <a href="order_list.php">주문조회</a><?php
    } ?>
      </div>
    </header>

       <!--  <h1 style="width: 550px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto;">장바구니 > 주문서 작성 > 주문 완료</h1>   -->
       <div style="width: 620px; padding-top: 50px; padding-bottom: 50px; margin: 0 auto; font-size: 30px;">
         <span style="font-size: 33px; font-weight: bold;">장바구니</span>&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;주문서 작성&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;주문 완료</div>

         <div>

<!-- <form name="form" action="cartdelete.php" method="post"> -->
<form name="form" method="post" onsubmit="submit()">
           <ul id ="ulTable">
               <li>   <!-- 첫 줄 li는 게시판 분류 -->
                   <ul>
                       <li><input class="checkall" id="checkall" type="checkbox"></li>
                       <li>&nbsp;</li>
                       <li style="text-align: left;">상품</li>
                       <li>판매가</li>
                       <li>수량</li>
                       <li>주문금액</li>
                   </ul>
               </li>

  <?php  while($row_b = mysqli_fetch_array($result_b)) {   ?>
               <li>  <!-- 게시물이 출력될 영역 -->
                       <ul id="tt">
                         <li><input type="checkbox" id="checkb" class="checkb" name="checkb[]" value="<?php echo $row_b[no]?>">
                           <!-- 선택상품 주문하기할 때 넘기기 위해 input으로 hidden값 만들어둠 -->
                           <input name="product_id[]" value="<?php echo $row_b[product_id];?>" type="hidden"/>
                           <input name="product_amount[]" class="productam" value="<?php echo $row_b[amount];?>" type="hidden"/>
                           <input name="product_price2[]" class="productpr" value="<?php echo $row_b[amount];?>" type="hidden"/>
                         </li>
                         <li style="text-align: right;"><img src="<?php echo $row_b[product_img]?>" valign="middle" width="50px" height="50px" style="margin-top: 5px; margin-left: 10px; margin-right: 10px;"/></li>
                         <li style="text-align: left;"><?php echo $row_b[product_name];?></li>
                         <li><?php echo number_format($row_b[product_price]);?><span class="pricereal_hid" hidden="hidden"><?php echo $row_b[product_price];?></span></li>
                         <!-- <li class="tleft"><a href="./aboutproduct/readqna.php?no=<php echo $row_b['no'];?>" style="text-decoration: none; color: black;"><php echo $row_q['title']?></a></li> -->
                         <li>

                          <button class="sub">-</button>
                           <!-- onchange="change_price()" -->
                              <input type="number" class="quantity" value="<?php echo $row_b[amount];?>" min="1" max="5" style="width: 35px;" readonly/>
                           <button class="add">+</button>

                         </li>
                         <li class="pricereal" id="price"><?php echo number_format($row_b[total_price]);?></li>
                     </ul>
               </li>
  <?php } ?>

                   <div style="padding: 33px;"></div>

                   <div style="margin-top: 15px; float: left; position: relative; left: 60px;">
                     <!-- <button id="button" class="button_base b01_simple_rollover" style="margin-right: 10px;">선택상품 삭제</button> -->

    <!-- <input type="submit" value="update" onclick="javascript: form.action='/manage/update';"/> -->
    <!-- <input type="submit" value="delete" onclick="javascript: form.action='/manage/delete';"/> -->
                    <input name="prid" id="prid" value="" hidden="hidden"/>
                    <input name="customer_id" value="<?php echo $customer_id;?>" hidden="hidden"/>
                    <input name="order_date" id="date" value="" hidden="hidden">
                              <script language="JavaScript">
                                var today = new Date().toLocaleDateString();
                                document.getElementById('date').value = today;
                              </script>
                    <input name="status" value="결제대기" hidden="hidden"/>
                    <input name="totalprice" value="" class="totalpricee" hidden="hidden"/>
                    <input name="productamount" value="" class="pramount" hidden="hidden"/>

                     <input type="submit" class="button_base b01_simple_rollover" style="margin-right: 10px;"
                                                  value="선택상품 삭제" onclick="javascript: form.action='cartdelete.php';"/>
                     <!-- <input type="submit" class="button_base b01_simple_rollover" style="margin-right: 10px;" -->
                                                  <!-- value="전체상품 삭제" onclick="javascript: $('.checkall').click() form.action='cartdeleteall.php';"/> -->

                    <!-- <button id="button" class="button_base b01_simple_rollover" style="margin-right: 10px;" onclick="deleteall()">전체상품 삭제</button> -->
                   </div>

           </ul>  <!-- 테이블 전체 닫는 </ul> -->

           <!-- class contents 닫는 div 태그 -->

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
                       <li class="productprice">0</li>
                       <li style="width: 70px; height: 50px;"> </li>
                       <li class="deliveryprice">0</li>
                       <li style="width: 70px; height: 50px;"> </li>
                       <li class="totalprice">0</li>
                   </ul>
               </li>
          </ul>

           <!-- <button id="button" class="button_base b01_simple_rollover" -->
              <!-- style="display: block; margin:0 auto; position: relative; margin-top: 90px; right: 60px; font-size: 20px; color: black;">선택상품 주문하기</button> -->

            <input type="submit" class="button_base b01_simple_rollover"
                      style="display: block; margin:0 auto; position: relative; margin-top: 90px; right: 60px; font-size: 20px; color: black;"
                      value="선택상품 주문하기" onclick="javascript: form.action='order_form.php?no=<?php echo $row_b[no];?>';"/>

         </div>
         <div style="margin-bottom: 70px;"></div>
    </form>

  </body>
</html>
