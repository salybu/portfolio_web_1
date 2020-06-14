<!DOCTYPE html>
<?php session_start();

$connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");
$id = $_GET[no];

?>
<html lang="en" dir="ltr">
  <head>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../common/loginbar.css">
        <link rel="stylesheet" href="../common/qna.css">
    <meta charset="utf-8">
    <title>모사샵 - 상품문의</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
      font-size: 40px;
      padding-left: 30px;
    }

    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    $( function(){
      $('#qna').click(function(){
        var form = $('form')[0]; // 폼객체를 불러와서
        var formData = new FormData(form); //FormData parameter에 담아줌

        $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
          url: "qna_save.php",
          type: "post",
        //  data: $("#thisform").serialize(),
          data: formData,
          processData: false,
          contentType: false,
        }).done(function() {
                location.href="../product.php?no=<?php echo $id;?>#qna"
        });
      });
    });
    </script>
  </head>
  <body>

    <header class="login_bar">
      <span id="logo">mosashop</span>
      <div class="login_bar-right">
       <a><?php echo $_SESSION['name']?>님</a>
       <a href="register.php">장바구니</a>
       <a href="register.php">주문조회</a>
      </div>
    </header>

           <h1 style="display: block; text-align: center; margin-top: 50px;">상품문의</h1>

    <form name="writeform" method="post" action="./saveqna.php" style="margin:0px;">
      <div id="write_form">
          <table>
              <tr>
                  <td align="center" valign="middle" class="table_title">문의제목</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="title"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품정보</td>
                  <td align="left" valign="middle" class="table_contents">
                    <?php

                                   $query = "SELECT * from product where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                                   $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함

                                   $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
                    ?><img src="<?php echo $row[image_main]?>" valign="middle" width="50px" height="50px" style="margin-left: 10px;"/>
                    <span id="product-name-" style="height: 50px; text-align: center;"><?php echo $row[name]?></span>
                    <input name="product_id" value="<?php echo $id?>" hidden="hidden" />
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">구분</td>
                  <td align="left" valign="middle" style="padding-left: 15px;">
                    <SELECT NAME=type SIZE=1>
                            <OPTION VALUE="배송관련">배송관련</OPTION>
                            <OPTION VALUE="상품관련">상품관련</OPTION>
                            <OPTION VALUE="기타" SELECTED>기타</OPTION>
                        </SELECT>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">작성자</td>
                  <td align="left" valign="middle" class="table_contents" style="padding-left: 15px;"><?php echo $_SESSION['name']?></td>
                  <input name="customer_name" value="<?php echo $_SESSION['name']?>" hidden="hidden"/>
                  <!-- <td align=left><input type=test name="email" value=" <=$_SESSION['email']?> " maxlength=25 readonly> input 내부에 value로 세션변수 넣으면 readonly로 지정해줘야 함-->
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">등록일자</td>
                  <td align="left" valign="middle" class="table_contents">
                    <input type="text" id="date" name="date" readonly/>
                    <script language="JavaScript">
                      var today = new Date().toLocaleDateString();
                      document.getElementById('date').value = today;
//                      document.write(today)
                    </script></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">문의내용</td>
                  <td align="left" valign="middle" style="width:600px; height:200px;">
                  <textarea name="contents" style="width:600px; height:200px;"></textarea>
                  </td>
              </tr>

              <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
              <tr>
                  <td align="center" valign="middle" colspan="2">
                    <input type="button" id="qna" value="문의작성" />
                  </td>
              </tr>
          </table>
      </div>
    </form>

  </body>
</html>
