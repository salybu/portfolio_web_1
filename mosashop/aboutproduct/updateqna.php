<!DOCTYPE html>
<?php session_start(); ?>
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
    <script>
    // 5.입력필드 검사함수
    function write_save() {
          // 6.form 을 f 에 지정
          var f = document.bWriteForm;

          // 7.입력폼 검사writereview.php?no=18
          if(f.b_title.value == ""){
              alert("글제목을 입력해 주세요.");
              return false;
          }

          if(f.b_contents.value == ""){
              alert("글내용을 입력해 주세요.");
              return false;
          }

          // 8.검사가 성공이면 form 을 submit 한다
          f.submit();
    }

    </script>
  </head>
  <body>

    <header class="login_bar">
      <span><a id="logo" href="main.php">mosashop</a></span>
      <div class="login_bar-right">
       <a><?php echo $_SESSION['name']?>님</a>
       <a href="register.php">장바구니</a>
       <a href="register.php">주문조회</a>
      </div>
    </header>

           <h1 style="display: block; text-align: center; margin-top: 50px;">상품문의</h1>

           <?php
                          $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                          $title = $_POST[title];
                          $product_id = $_POST[product_id];
                          $customer_name = $_POST[customer_name];
                          $contents = $_POST[contents];

                          $query = "SELECT * from qna where title = '$title'
                                    AND product_id = '$product_id' AND customer_name = '$customer_name'
                                    AND contents = '$contents'"; // 넘어온 값들을 가지고 일치하는 qna 글을 꺼냄
                          $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함
                          $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           ?>

      <form method="post" action="./update_ok.php?no=<?php echo $row[no]?>" style="margin:0px;">
      <div id="write_form">
          <table>
              <tr>
                  <td align="center" valign="middle" class="table_title">문의제목</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="title" value="<?php echo $row[title]?>"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품정보</td>
                  <td align="left" valign="middle" class="table_contents">
                    <?php
                                   $id_pr = $row[product_id];

                                   $query_pr = "SELECT * from product where no ='$id_pr'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                                   $result_pr = mysqli_query($connect, $query_pr); // 쿼리문과 DB 연결함수 연결함

                                   $row_pr = mysqli_fetch_array($result_pr); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
                    ?><img src="<?php echo $row_pr[image_main]?>" valign="middle" width="50px" height="50px" style="margin-left: 10px;"/>
                    <span id="product-name-" style="height: 50px; text-align: center;"><?php echo $row_pr[name]?></span>
                    <!-- <input name="product_id" value="<php echo $id_pr?>" hidden="hidden" /> 수정이니까 없어도 됨 -->
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">구분</td>
                  <td align="left" valign="middle" style="padding-left: 15px;">
                    <SELECT NAME=type SIZE=1>
                      <?php if($row[type]=="배송관련"){?>
                          <OPTION VALUE="배송관련" SELECTED>배송관련</OPTION>
                          <OPTION VALUE="상품관련">상품관련</OPTION>
                          <OPTION VALUE="기타">기타</OPTION>
                      <?php    } else if($row[type]=="상품관련") { ?>
                          <OPTION VALUE="배송관련">배송관련</OPTION>
                          <OPTION VALUE="상품관련" SELECTED>상품관련</OPTION>
                          <OPTION VALUE="기타">기타</OPTION>
                      <?php    } else if($row[type]=="기타") { ?>
                          <OPTION VALUE="배송관련">배송관련</OPTION>
                          <OPTION VALUE="상품관련">상품관련</OPTION>
                          <OPTION VALUE="기타" SELECTED>기타</OPTION>
                        <?php   }  ?>
                      </SELECT>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">작성자</td>
                  <td align="left" valign="middle" class="table_contents" style="padding-left: 15px;"><?php echo $row[customer_name]?></td>
                  <!-- <input name="customer_name" value="<php echo $row[customer_name]?>" hidden="hidden"/> 수정 페이지니까 없어도 됨 -->
                  <!-- <td align=left><input type=test name="email" value=" <=$_SESSION['email']?> " maxlength=25 readonly> input 내부에 value로 세션변수 넣으면 readonly로 지정해줘야 함-->
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">등록일자</td>
                  <td align="left" valign="middle" class="table_contents">
                     <input type="text" id="date" name="date" value="<?php echo $row[date];?>" readonly/>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">문의내용</td>
                  <td align="left" valign="middle" style="width:600px; height:200px;">
                  <textarea name="contents" style="width:600px; height:200px;"><?php echo $row[contents];?></textarea>
                  </td>
              </tr>

              <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
              <tr>
                  <td align="center" valign="middle" colspan="2">
                        <input type="submit" value="수정" /></form>
                    <!-- <a href="deleteqna.php?no=<php echo $row[no];?>&product=<php echo $id_pr?>"><button>삭제</button></a> -->
                  </td>
              </tr>
          </table>
      </div>

  </body>
</html>
