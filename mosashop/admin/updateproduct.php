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

    <form name="writeform" method="post" style="margin:0px;" enctype='multipart/form-data' >
      <div id="write_form">
                  <input hidden="true" type="text" name="product_id" value="<?php echo $id;?>">

          <table>
              <tr>
                  <td align="center" valign="middle" class="table_title">상품이름</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_name" value="<?php echo $row[name];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">메인이미지</td>
                  <td align="left" valign="middle" class="table_contents">
                  	<input type='file' name='imagee' id="input_img">
                    <!-- <img id="img" src="< echo $row[image_main]?>" width="300px" align="left"> -->
                      <img id="img" src="" width="300px" align="left">
                    <input type="text" name="imageori" value="<?php echo $row[image_main];?>" hidden="true"/> <!-- 사진을 변경하지 않은 경우, 바꿀 사진을 선택하지 않은 경우 기존 파일경로를 그대로 저장하기 위해 받아옴 -->
                </td>
              </tr>
              <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
              <script>
              $( function(){
                $('#update').click(function(){

                        var form = $('form')[0]; // 폼객체를 불러와서
                        var formData = new FormData(form); //FormData parameter에 담아줌

                  $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                    url: "product_updok.php",
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

              var sel_file;

              $(document).ready(function() {
                  $("#input_img").on("change", handleImgFileSelect);
              });

              $(document).ready(function() {
                  $("#upload").on("change", handleImgFileSelect2);
                  $("#img1").attr("src", "");
                  $("#img2").attr("src", "");
                  $("#img3").attr("src", "");
                  $("#img4").attr("src", "");
                  $("#img5").attr("src", "");
                  $("#img6").attr("src", "");
              });

              function handleImgFileSelect(e) {
                  var files = e.target.files; // e.target은 이벤트가 일어난 대상, 즉 input 자신을 가리킴. e.target.files는 input에 어떤 파일을 올렸는지를 가리킴
                  var filesArr = Array.prototype.slice.call(files);

                  filesArr.forEach( function(f) {
                    if(!f.type.match("image.*")){
                      alert("확장자는 이미지 확장자만 가능합니다");
                      return;
                    }

                    sel_file = f;

                    var reader = new FileReader(); // files객체에 파일에 대한 정보는 있으나, 파일 데이터 자체는 없음.
                    // 파일 데이터 자체를 읽기 위해서는 fileReader API를 사용해야 함. new FileReader()로 파일리더 객체를 만들어준 후 사용하면 됨
                    reader.onload = function(e) {
                        $("#img").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(f);
                  });
              }

              function handleImgFileSelect2(e) {
                  var files = e.target.files; // e.target은 이벤트가 일어난 대상, 즉 input 자신을 가리킴. e.target.files는 input에 어떤 파일을 올렸는지를 가리킴
                  var filesArr = Array.prototype.slice.call(files);

                  filesArr.forEach( function(f) {
                    if(!f.type.match("image.*")){
                      alert("확장자는 이미지 확장자만 가능합니다");
                      return;
                    }

                    sel_file = f;

                    var reader = new FileReader(); // files객체에 파일에 대한 정보는 있으나, 파일 데이터 자체는 없음.
                    // 파일 데이터 자체를 읽기 위해서는 fileReader API를 사용해야 함. new FileReader()로 파일리더 객체를 만들어준 후 사용하면 됨
                    reader.onload = function(e) {
                        $("#img1").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(f);
                  });
              }

              </script>

              <tr>
                  <td align="center" valign="middle" class="table_title">브랜드</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_brand" value="<?php echo $row[brand];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">품번</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_number" value="<?php echo $row[number];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">사이즈</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_size" value="<?php echo $row[size];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">소재</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_material" value="<?php echo $row[material];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">세탁방법</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_washing" value="<?php echo $row[washing];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">분류</td>
                  <td align="left" valign="middle" style="padding-left: 15px;">
                    <SELECT NAME="product_type" SIZE=1>
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
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="product_price" value="<?php echo $row[price];?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품 상세정보<br>(글)</td>
                  <td align="left" valign="middle" style="width:600px;height:200px;">
                  <textarea name="product_detail_text" style="width:600px;height:200px;" value="<?php echo $row[detail_text];?>"></textarea>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title" style="padding-top: 5px; padding-bottom: 5px;">상품 상세정보<br>(이미지)</td>
                  <td align="left" valign="middle" class="table_contents">
                    <input type='file' name='upload[]' id='upload' multiple='multiple'>
                      <?php $filename = explode(',', $row[image_detail]); // 상세이미지는 경로들이 ,로 연결된 string으로 저장돼있으므로 , 기준으로 잘라줌 ?>
                      <img id="img1" src="" width="150px" style="display: inline;">
                      <img id="img2" src="" width="150px" style="display: inline;">
                      <img id="img3" src="" width="150px" style="display: inline;">
                      <img id="img4" src="" width="150px" style="display: inline;">
                      <img id="img5" src="" width="150px" style="display: inline;">
                      <img id="img6" src="" width="150px" style="display: inline;">
                    <input hidden="true" type="text" name="image_detail" value="<?php echo $row[image_detail];?>">
                  </td>
              </tr>

          </table>

          <input type="button" id="update" value="수정" style="float: right; margin-bottom: 10px;"/>
          <!-- <button type='submit' style="float: right; margin-bottom: 10px;">수정</button> -->
      </div>
    </form>

  </body>
</html>
