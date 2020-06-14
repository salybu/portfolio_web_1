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


            #commentTable {
              width: 970px;
              margin-top: 20px;
              line-height: 2.5em;
              font-family: "맑은 고딕";
            }

            #commentTable > tbody {
              width: 970px;
              line-height: 2.5em;
              font-family: "맑은 고딕";
            }

            tr, td {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #commentTable > tbody > tr > td { /* 게시판 하나의 요소 각각 하나하나 (No)(제목)(작성자) 이런 식 */
                float: left;
                font-size: 10pt;
                 border-top: 1px solid black;
                 /* border-bottom: 1px solid black; */
                vertical-align: baseline; /* 수직정렬 기본값 baseline */
            }

            #commentTable > tbody > tr:last-child > td { /* 게시판 하나의 요소 각각 하나하나 (No)(제목)(작성자) 이런 식 */
                  border-bottom: 1px solid black;
            }

            /* #commentTable > tbody > tr > td:first-child                     {width:10%;  text-align: center;} /* no 열 크기*/
            #commentTable > tbody > tr > td:first-child                    {width:10%;  text-align: right;} /* 작성자 열 크기*/
            #commentTable > tbody > tr > td:first-child +td                {width:50%;  text-align: left; padding-left: 7px;} /* 댓글(w.시간) 열 크기*/
            #commentTable > tbody > tr > td:first-child +td+td             {width:15%;  text-align: right;} /* 수정+삭제 열 크기*/


    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    $(document).ready(function(){
        load();
    });
    </script>
  </head>
  <body>

    <header class="login_bar">
      <span><a id="logo" href="../main.php">mosashop</a></span>
      <div class="login_bar-right">
       <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
   ?> <a href="login/login.php">로그인</a>
      <a href="login/register.php">회원가입</a> <?php
   } else { // 세션 있을때 ?>
      <a><?php echo $_SESSION['name']?>님</a>
      <a href="../logout.php">로그아웃</a>
      <a href="../cartandorder/cart.php">장바구니</a>
      <a href="../cartandorder/orderlist.php">주문조회</a><?php
   } ?>
      </div>
    </header>

           <h1 style="display: block; text-align: center; margin-top: 50px;">상품문의</h1>

           <?php
                          $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                          $id = $_GET[no];

                          $query = "SELECT * from qna where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                          $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함

                          $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           ?>

                 <div id="write_form">
                     <table>
                         <tr>
                             <td align="center" valign="middle" class="table_title">문의제목</td>
                             <td align="left" valign="middle" class="table_contents" style="padding-left: 10px;"><?php echo $row[title]?></td>
                         </tr>

                  <tr>
                              <td align="center" valign="middle" class="table_title">상품정보</td>
                              <td align="left" valign="middle" class="table_contents">
                    <?php
                            $conn = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                            $id_product = $row[product_id]; // qna 글에 저장돼있는 상품 고유id값을 따로 변수에 담음

                            $query_pr = "SELECT * from product where no ='$id_product'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                            $result_pr = mysqli_query($conn, $query_pr); // 쿼리문과 DB 연결함수 연결함

                            $row_pr = mysqli_fetch_array($result_pr); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
                     ?><img src="<?php echo $row_pr[image_main]?>" valign="middle" width="50px" height="50px" style="margin-left: 10px;"/>
                           <span id="product-name-" style="height: 50px; text-align: center;"><?php echo $row_pr[name]?></span>
                           <input name="product_id" value="<?php echo $id_product?>" hidden="hidden" />
                     </td>
                  </tr>

                   <tr>
                     <td align="center" valign="middle" class="table_title">구분</td>
                     <td align="left" valign="middle" style="padding-left: 15px;">
                     <SELECT NAME=type SIZE=1>
                     <?php if($row[type]=="배송관련"){?>
                         <OPTION VALUE="배송관련" SELECTED readonly>배송관련</OPTION>
                         <OPTION VALUE="상품관련" readonly>상품관련</OPTION>
                         <OPTION VALUE="기타" readonly>기타</OPTION>
                     <?php    } else if($row[type]=="상품관련") { ?>
                         <OPTION VALUE="배송관련" readonly>배송관련</OPTION>
                         <OPTION VALUE="상품관련" SELECTED readonly>상품관련</OPTION>
                         <OPTION VALUE="기타" readonly>기타</OPTION>
                     <?php    } else if($row[type]=="기타") { ?>
                         <OPTION VALUE="배송관련" readonly>배송관련</OPTION>
                         <OPTION VALUE="상품관련" readonly>상품관련</OPTION>
                         <OPTION VALUE="기타" SELECTED readonly>기타</OPTION>
              <?php       }  ?>
                     </SELECT>
                     </td>
                     </tr>

                     <tr>
                         <td align="center" valign="middle" class="table_title">작성자</td>
                         <td align="left" valign="middle" class="table_contents" style="padding-left: 10px;"><?php echo $row[customer_name]?></td>
                         <input name="customer_name" value="<?php echo $row[customer_name]?>" hidden="hidden"/>
                         <!-- <td align=left><input type=test name="email" value=" <=$_SESSION['email']?> " maxlength=25 readonly> input 내부에 value로 세션변수 넣으면 readonly로 지정해줘야 함-->
                     </tr>

                    <tr>
                        <td align="center" valign="middle" class="table_title">등록일자</td>
                        <td align="left" valign="middle" class="table_contents" style="padding-left: 10px;"><?php echo $row[date]?></td>
                    </tr>

                    <tr>
                       <td align="center" valign="middle" class="table_title">문의내용</td>
                       <td align="left" valign="middle" style="width:600px; height:200px;">
                       <textarea name="contents" style="width:600px; height:200px;" readonly><?php echo $row[contents]?></textarea>
                       </td>
                    </tr>
                                         <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
                    <tr>
     <?php            if($_SESSION[name]==$row[customer_name]){ // 이름말고 다른 조건 더 있어야 할 거 같은데 ... ?>
                         <td></td><td style="float: right;">
                           <a href="../product.php?no=<?php echo $id_product;?>#qna"><button>목록으로</button></a>

                            <form action="./updateqna.php" method="post" style="display: inline;">
                                 <input name="product_id" hidden="hidden" value="<?php echo $id_product;?>">
                                 <input name="customer_name" hidden="hidden" value="<?php echo $row[customer_name];?>">
                                 <input name="title" hidden="hidden" value="<?php echo $row[title];?>">
                                 <input name="contents" hidden="hidden" value="<?php echo $row[contents];?>">
                             <input type="submit" value="수정" /></form>

                          <a href="deleteqna.php?no=<?php echo $id;?>&product=<?php echo $id_product?>"><button>삭제</button></a>
                         <!-- <span align="center" valign="middle" colspan="2"><input type="submit" value="삭제" onClick="write_save();"></span> -->
                       </td>
     <?php            }  ?>
                    </tr>

                     </table>

                     <h3 style="font-family:'Malgun Gothic';">댓글목록</h3>

                    <table id="commentTable">
                          <tbody id="commadd">

                          </tbody>
                    </table>

                        <div id="dialog" hidden="true">
                        </div>

                        <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때 댓글 달 수없게 빈 값을 세팅함
                              } else { // 세션 있을때 ?>
                                 <form id="commentform"><br><b style="font-family:'Malgun Gothic';"><?php echo $_SESSION['name']?></b><span style="font-family:'Malgun Gothic';"> 님</span>&nbsp;
                                    <input hidden="true" name="writer_name" value="<?php echo $_SESSION['name']?>">
                                    <input hidden="true" name="qna_id" value="<?php echo $id?>">
                                    <input type="text" name="comment" id="commentinput" style="width: 550px;">
                                    &nbsp;<input type="button" value="댓글달기" id="comment"/>
                                 </form><?php
                              } ?>


                    <script>
                    $( function(){

                      $('#comment').click(function(){
                                  $.ajax({

                                     url: "../acommentqna/comment_ok.php",
                                     type: "post",
                                  //   dataType: "json", // url의 결과값으로 JSON 자료형을 받아옴
                                     data: $("#commentform").serialize(), // id="commentform"인 form을

                                   }).done(function(data) {
                                       $("#commentinput").val(""); // 댓글입력창 비우기
                                         load();
                                   });
                      });
                    });

                    function delete_comment(trindex){

                      $.ajax({
                        url: "../acommentqna/comment_del.php",
                        type: "post",
                        data: { index : trindex },
                      }).done(function(data) { // db에서 삭제에 성공한 후,
                        load();
                      });
                    }

                    function load (){
                      $("#commadd").empty();

                      $.ajax({

                        url: "../acommentqna/comment_load_db.php",
                        type: "get",
                      //  dataType: "json", // url의 결과값으로 JSON 자료형을 받아옴
                      //  data: $("#commentform").serialize(), // id="commentform"인 form을
                        data: { id : <?php echo $id;?>
                              }
                      }).done(function(data) {
                          $("#commentinput").val(""); // 댓글입력창 비우기
                          $("#commadd").append(data);

                      });
                    }
                    </script>
                    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                    <script>
                    function update_comment(a){

                      var jbString = a;
                      var jbSplit = jbString.split('@');

                      var updcomm = prompt(''+jbSplit[2]+'님', jbSplit[1]); // 댓글쓴이, 댓글내용으로 입력창을 만듬

                        if( updcomm != ""){ // 입력창에 값이 있으면

                            $.ajax({
                              url: "../acommentqna/comment_upd2.php",
                              type: "post",
                              data: { index : jbSplit[0],
                                      content : updcomm },
                            }).done( function(data) { // db에서 삭제에 성공한 후,
                            load();
                            });

                        } else { // 입력값이 없는 경우
                          return false;
                        }
                    }
                    </script>
                 </div>

  </body>
</html>
