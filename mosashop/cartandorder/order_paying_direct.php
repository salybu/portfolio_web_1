<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
          <title>결제</title>
          <meta charset="utf-8">

          <?php
                        $con = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

                              $customer_id = $_POST['customer_id']; // 회원 고유번호 받아옴
                              $order_date = $_POST['order_date2'];   //  echo "status ";

                              $product_i = $_POST['product_id']; // 여러 개 상품id값이 넘어오므로 배열로 넘어옴 꺼낼때 반복문으로 꺼내야 함
                              $product_amount = $_POST['product_amount']; // 여러 개 상품수량값을 받아옴
                              $product_price = $_POST['product_price']; // 계산과정 생략하기 위해 (여러개 상품수량*상품가격 = 총가격 값)을 여러개 넘김. 배열로 넘어옴 꺼낼때 반복문으로 꺼내야 함

                              $receivername = $_POST['receiver'];  // 수령인 이름
                              $phonenumber = $_POST['inputphone1'];
                              $address_num = $_POST['inputaddress_number'];
                              $address_main = $_POST['inputaddress_main'];
                              $address_det = $_POST['inputaddress_detail'];
                              $address_ref = $_POST['inputaddress_ref'];
                              $ordernumber = time().mt_rand(1, 10000); // 주문번호 (한번에 함께 주문한 상품들은 주문번호가 같음) 현재시간+1~10,000사이의 난수

                                // echo "   ordernumber  "; echo  $ordernumber ;

                                      $querysave = "INSERT INTO orderorder (ordernumber, customer_id, product_id, product_amount, product_price, order_date, status,
                                                     receiver, phonenumber, address_number, address_main, address_detail, address_refer)
                                                    values ('$ordernumber', '$customer_id', '$product_i', '$product_amount', '$product_price', '$order_date', '결제완료',
                                                     '$receivername', '$phonenumber', '$address_num', '$address_main', '$address_det', '$address_ref')";

                                      mysqli_query($con, $querysave);

                                      // echo "mysqli 에러";
                                      // echo mysqli_error($con); // 에러가 뭔지 찍어보기
                        ?>


          <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
          <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
          <script>

            var IMP = window.IMP; // 생략가능
            IMP.init('imp93486571'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

            IMP.request_pay({
                pg : 'inicis',
                // 'kakao':카카오페이, html5_inicis':이니시스(웹표준결제), 'nice':나이스페이, 'jtnet':제이티넷, 'uplus':LG유플러스, 'danal':다날, 'payco':페이코, 'syrup':시럽페이, 'paypal':페이팔
                pay_method : 'card',
                // 'samsung':삼성페이, 'card':신용카드, 'trans':실시간계좌이체, 'vbank':가상계좌, 'phone':휴대폰소액결제
                merchant_uid : 'merchant_' + new Date().getTime(),
                name : '주문명:결제테스트',
                amount : 100,
          /*      buyer_email : 'iamport@siot.do',
                buyer_name : '이가은',
                buyer_tel : '010-1234-5678',
                buyer_addr : '서울특별시 강남구 삼성동',
                buyer_postcode : '123-456',
                m_redirect_url : 'https://www.yourdomain.com/payments/complete'  */
                // 모바일 결제시, 결제가 끝나고 랜딩되는 URL을 지정 (카카오페이, 페이코, 다날의 경우는 필요없음. PC와 마찬가지로 callback함수로 결과가 떨어짐)
            }, function(rsp) {
                if ( rsp.success ) {
                    var msg = '결제가 완료되었습니다.';

        /*            msg += '고유ID : ' + rsp.imp_uid;
                    msg += '상점 거래ID : ' + rsp.merchant_uid;
                    msg += '결제 금액 : ' + rsp.paid_amount;
                    msg += '카드 승인번호 : ' + rsp.apply_num;    */

                   location.href="./order_complete.php?no=<?php echo $ordernumber;?>"

                } else {
                    var msg = '결제에 실패하였습니다.';
                    msg += '에러내용 : ' + rsp.error_msg;
                    location.href="./cart.php"
                }


            });

            /* 결제결과를 검증함. 결제창에서 결제가 완료되면 IMP.request_pay(param, callback) 실행 후 callback함수가 호출(PC)되거나 m_redirect_url로 이동(모바일)하게 됨
            결제정보 위변조 가능성에 대비해 실제 결제된 정보를 imp_uid(아임포트 거래고유번호) 또는 merchant_uid(가맹점에서 전달한 주문고유번호)를 활용해 가맹점의 서버단에서 REST API로 조회 후 검증할 수 있음
            REST API로 조회된 결제정보의 status == 'paid'여부를 체크하고 amount가 가맹점에서 계산한 {실제 주문금액}과 일치하는지 최종검증이 필요함 */
         </script>


  </head>
  <body>
  </body>
</html>
