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
    <title>모사샵 - 상품리뷰</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
      font-size: 40px;
      padding-left: 30px;
    }

    .starR {
      background: url('http://miuu227.godohosting.com/images/icon/ico_review.png') no-repeat right 0;
      background-size: auto 100%;
      width: 30px;
      height: 30px;
      display: inline-block;
      text-indent: -9999px;
      cursor: pointer;
    }

    .starR.on { background-position:0 0; }

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
      <a id="logo" href="../main.php">mosashop</a>
      <div class="login_bar-right">
        <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
        ?> <a href="login/login.php">로그인</a>
        <a href="login/register.php">회원가입</a> <?php
        } else { // 세션 있을때 ?>
        <a><?php echo $_SESSION['name']?>님</a>
        <a href="../login/logout.php">로그아웃</a>
        <a href="../cartandorder/cart.php">장바구니</a>
        <a href="../cartandorder/order_list.php">주문조회</a><?php
        } ?>
      </div>
    </header>

           <h1 style="display: block; text-align: center; margin-top: 50px;">상품리뷰</h1>

           <?php
                          $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                          $id = $_GET[no];

                    //      $page = $_GET[page];
                      //    $list = $_GET[list];

                          $query = "SELECT * from review where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                          $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함

                          $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           ?>

                 <div id="write_form" style="padding-bottom: 30px;">

                     <table>
                         <tr>
                             <td align="center" valign="middle" class="table_title">리뷰제목</td>
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

                  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
                  <script>

                  $( function(){

                    var n = <?php echo $row[rate];?>; // DB에 저장된 별점을 가져와서 javascript 변수로 저장함

                                for( var i = 0; i < n; i++ ){ // DB에서 받아온 별점값까지의 별 span태그까지 반복문을 적용함
                                      $('.starRev span:eq('+i+')').addClass('on'); // DB에서 받아온 별점값(ex:1,3..등)만큼의 span 태그 값에 class="on"을 추가함
                                }

                    var str = ""; // 빈 string 문자열을 가진 변수를 만듬

                    $('#delete').click(function(){
                          var idx = <?php echo $id; ?>

                      $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                        url: "review_delok.php",
                        type: "get",
                        data: { id: idx },
                      }).done(function() {
                            location.href="../product.php?no=<?php echo $id_product;?>#review"
                      });
                    });

                  });

                  function getAllList(){
                    var review_id = <?php echo $id;?>; // 리뷰 글 식별번호값을 javascript 변수로 저장함


                    $.getJSON("./comment_list.php?id="+review_id, function(data){
                  //    console.log(data);
                        alert("success");
                    });
                  }

                  </script>

                   <tr>
                     <td align="center" valign="middle" class="table_title" id="ssstar">별점</td>
                     <td align="left" valign="middle" style="padding-left: 15px;">
                       <div class="starRev"><input name="starrate" value="" hidden="hidden"/>
                         <span class="starR on">별1</span>
                         <span class="starR">별2</span>
                         <span class="starR">별3</span>
                         <span class="starR">별4</span>
                         <span class="starR">별5</span>
                       </div>
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
                       <td align="center" valign="middle" class="table_title">리뷰내용</td>
                       <td align="left" valign="middle" style="width:600px; height:200px;">
                       <textarea name="contents" style="width:600px; height:200px;" readonly><?php echo $row[contents]?></textarea>
                       </td>
                    </tr>

<?php      if( $row[image] == "" ){ ?>  <!-- 첨부한 이미지 파일이 없을 때  -->
<?php      } else {  ?>  <!-- DB에 첨부한 이미지 파일이 존재할 때 -->
                    <tr>
                       <td align="center" valign="middle" class="table_title">리뷰사진</td>
                       <td align="left" valign="middle" style="width:600px; height:200px;">
                          <img src="<?php echo $row[image]?>" width="300px" align="left">
                       </td>
                    </tr>
<?php      } ?>
                                         <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
                    <tr>
     <?php            if($_SESSION['name']==$row[customer_name]){ // 이름말고 다른 조건 더 있어야 할 거 같은데 ... ?>
                         <td></td><td style="float: right;">
                           <a href="../product.php?no=<?php echo $id_product;?>#review"><button>목록으로</button></a>

                           <form action="./updatereview.php" method="get" style="display: inline;">
                                 <input name="review_id" hidden="hidden" value="<?php echo $id;?>">
                             <input type="submit" value="수정" /></form>

                             <input type="button" id="delete" value="삭제"/>
                        <!-- <a href="deleteqna.php?no=<php echo $id;?>&product=<php echo $id_product?>"><button>삭제</button></a> -->
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
                                    <input hidden="true" name="review_id" value="<?php echo $id?>">
                                      <input hidden="true" name="writer_id" value="0">
                                    <input type="text" name="comment" id="commentinput" style="width: 550px;">
                                    &nbsp;<input type="button" value="댓글달기" id="comment"/>
                                 </form><?php
                              } ?>


                    <script>
                    $( function(){

                      $('#comment').click(function(){
                                  $.ajax({

                                     url: "comment_ok.php",
                                     type: "post",
                                  //   dataType: "json", // url의 결과값으로 JSON 자료형을 받아옴
                                     data: $("#commentform").serialize(), // id="commentform"인 form을

                                   }).done(function(data) {
                                     console.log("load2");
                                     console.log(data);
                                       $("#commentinput").val(""); // 댓글입력창 비우기
                                         load();
                                   });
                      });
                    });

                    function delete_comment(trindex){

                      $.ajax({
                        url: "comment_del.php",
                        type: "post",
                        data: { index : trindex },
                      }).done(function(data) { // db에서 삭제에 성공한 후,
                        load();
                      });
                    }

                    function load (){
                      console.log("load1");
                      $("#commadd").empty();

                      $.ajax({

                        url: "comment_load_db.php",
                        type: "get",
                      //  dataType: "json", // url의 결과값으로 JSON 자료형을 받아옴
                      //  data: $("#commentform").serialize(), // id="commentform"인 form을
                        data: { id : <?php echo $id;?>
                              }
                      }).done(function(data) {
                        console.log("load2");
                        console.log(data);
                          $("#commentinput").val(""); // 댓글입력창 비우기
                          console.log(data);
                          $("#commadd").append(data);
                      });
                    }
                    </script>
                    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                    <script>
                    function update_comment(a){

                      console.log(a);

                      var jbString = a;
                      var jbSplit = jbString.split('@');

                      var updcomm = prompt(''+jbSplit[2]+'님', jbSplit[1]); // 댓글쓴이, 댓글내용으로 입력창을 만듬

                        if( updcomm != ""){ // 입력창에 값이 있으면

                            $.ajax({
                              url: "comment_upd2.php",
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
