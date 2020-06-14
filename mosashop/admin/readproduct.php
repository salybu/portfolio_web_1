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

    #logo {
      font-family: 'Permanent Marker', cursive;
    /*    font-family: Lobster;  */
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
        <a href="productlist.php">상품목록</a>
        <a href="qnalist.php">Q&A관리</a>
        <a href="reviewlist.php">리뷰관리</a>
        <a href="orderlist.php">주문관리</a>
      </div>
    </header>

<?php
    $conn = mysqli_connect('localhost', 'gaeun', 'testtest', 'z_mosashop'); // mysqli_connect()는 php에서 mysql을 연결해주는 함수

    $id = $_GET[no];

    $query = "SELECT * from product where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
    $result = mysqli_query($conn, $query); // 쿼리문과 DB 연결함수 연결함
    $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
?>

    <form name="writeform" method="post" action="./productsave.php" style="margin:0px;" enctype='multipart/form-data' >
      <div id="write_form">
          <table>
              <tr>
                  <td align="center" valign="middle" class="table_title">상품이름</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo $row[name];?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">메인이미지</td>
                  <td align="left" valign="middle" class="table_contents">
                  	<img id="img" src="<?php echo $row[image_main];?>" width="100px" align="left">
                </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">브랜드</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo $row[brand];?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">품번</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo $row[number];?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">사이즈</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo $row[size];?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">소재</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo $row[material];?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">세탁방법</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo $row[washing];?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">분류</td>
                  <td align="left" valign="middle" style="padding-left: 15px;">
                    <SELECT NAME="product_type" SIZE=1 READONLY >
                      <?php if($row[type]=="볼캡"){?>
                          <OPTION VALUE="볼캡" SELECTED>볼캡</OPTION>
                          <OPTION VALUE="헌팅캡">헌팅캡</OPTION>
                          <OPTION VALUE="버킷햇">버킷햇</OPTION>
                   <?php    } else if($row[type]=="헌팅캡") { ?>
                          <OPTION VALUE="볼캡">볼캡</OPTION>
                          <OPTION VALUE="헌팅캡" SELECTED>헌팅캡</OPTION>
                          <OPTION VALUE="버킷햇">버킷햇</OPTION>
                   <?php    } else if($row[type]=="버킷햇") { ?>
                          <OPTION VALUE="볼캡">볼캡</OPTION>
                          <OPTION VALUE="헌팅캡">헌팅캡</OPTION>
                          <OPTION VALUE="버킷햇" SELECTED>버킷햇</OPTION>
                        <?php   }  ?>
                    </SELECT>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품금액</td>
                  <td align="left" valign="middle" class="table_contents">&nbsp;&nbsp;<?php echo number_format($row[price]);?></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품 상세정보<br>(글)</td>
                  <td align="left" valign="middle" style="width:600px; height:200px;">
                  <textarea name="product_detail_text" style="width:600px;height:200px;" readonly><?php echo $row[detail_text];?></textarea>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title" style="padding-top: 5px; padding-bottom: 5px;">상품 상세정보<br>(이미지)</td>
                  <td align="left" valign="middle" class="table_contents">
                    <?php $filename = explode(',', $row[image_detail]); // 상세이미지는 경로들이 ,로 연결된 string으로 저장돼있으므로 , 기준으로 잘라줌 ?>
                    <img src="<?php echo $filename[0];?>" width="150px" style="display: inline;">
                    <img src="<?php echo $filename[1];?>" width="150px" style="display: inline;">
                    <img src="<?php echo $filename[2];?>" width="150px" style="display: inline;">
                    <img src="<?php echo $filename[3];?>" width="150px" style="display: inline;">
                    <img src="<?php echo $filename[4];?>" width="150px" style="display: inline;">
                    <img src="<?php echo $filename[5];?>" width="150px" style="display: inline;">
                    <img src="<?php echo $filename[6];?>" width="150px" style="display: inline;">
                  </td>
              </tr>

          </table>
          <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
          <script>
          $( function(){
            $('#delete').click(function(){
                  var idx = <?php echo $id; ?>

              $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                url: "product_delok.php",
                type: "get",
                data: { id: idx },
              }).done(function() {
                    location.href="./list_product.php"
              });
            });
          });
          </script>
          <!-- <button style="float: right; margin-bottom: 10px;">삭제</button> -->
          <input type="button" id="delete" value="삭제" style="float: right; margin-bottom: 10px;"/>
          <button style="float: right; margin-bottom: 10px; text-decoration: none;"><a href="./updateproduct.php?no=<?php echo $id;?>">수정</a></button>
      </div>
    </form>

  </body>
</html>
