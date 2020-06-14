<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../common/loginbar.css">
    <meta charset="utf-8">
    <title>모사샵 - 관리자</title>
    <style>

    #logo { /* 쇼핑몰 로고 스타일 */
      font-family: 'Permanent Marker', cursive;
      font-size: 40px;
      padding-left: 30px;
    }

    #write_form {
      /* display: block; 요소들은 중앙정렬할 때 margin: 0 auto; 이용, 이 때 정렬하려는 요소의 넓이를 반드시 지정하고 margin: 0 auto 써야 함
         인라인요소들은 text-align 속성 이용
                    p {
                      width: 100px;
                      margin: 0 auto;
                    }*/
      display: block;
      width: 750px;
      border: 3px solid black;
      padding: 50px;
      padding-left: 100px;
      padding-right: 100px;
      margin:0 auto;
      margin-top: 30px;
      margin-bottom: 40px;
    }

    .table_title {
      width: 140px;
      height: 40px;
      background-color: black;
      color:  white;
    }

    .table_contents {
      width: 600px;
      height: 40px;
    }

    .table_contents input {
      width: 590px;
      margin-left: 5px;
    }

    </style>
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

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>

    $( function(){


      $('#update').click(function(){

              var form = $('form')[0]; // 폼객체를 불러와서
              var formData = new FormData(form); // FormData parameter에 담아줌

        $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
          url: "product_save.php",
          type: "post",
          data: formData,
          processData: false,
          contentType: false,
        }).done(function(data) {
              alert(data);
                location.href="./list_product.php"
        });
      });

    });

    </script>

    <form name="writeform" method="post" style="margin:0px;" enctype='multipart/form-data' >
      <div id="write_form">
          <table>
              <tr>
                  <td align="center" valign="middle" class="table_title">상품이름</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_name"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">메인이미지</td>
                  <td align="left" valign="middle" class="table_contents">
                  	<input type='file' name='product_image'>
                </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">브랜드</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_brand"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">품번</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_number"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">사이즈</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_size"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">소재</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_material"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">세탁방법</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_washing"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">분류</td>
                  <td align="left" valign="middle" style="padding-left: 15px;">
                    <SELECT NAME="product_type" SIZE=1>
                            <OPTION VALUE="볼캡">볼캡</OPTION>
                            <OPTION VALUE="헌팅캡">헌팅캡</OPTION>
                            <OPTION VALUE="버킷햇">버킷햇</OPTION>
                    </SELECT>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품금액</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_price"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품 상세정보<br>(글)</td>
                  <td align="left" valign="middle" style="width:600px;height:200px;">
                  <textarea name="product_detail_text" style="width:600px;height:200px;"></textarea>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title" style="padding-top: 5px; padding-bottom: 5px;">상품 상세정보<br>(이미지)</td>
                  <td align="left" valign="middle" class="table_contents">
                    <input type='file' name='upload[]' id='upload' multiple='multiple'></td>
              </tr>

          </table>

          <!-- <input type="button" id="update" value="등록" style="float: right; margin-bottom: 10px;"/> -->
          <button type='submit' id="update" style="float: right; margin-bottom: 10px;">등록</button>
      </div>
    </form>

  </body>
</html>
