<!DOCTYPE html>
<?php  session_start();
      $_SESSION['email'] = "admin@naver.com";
      $_SESSION['name'] = "관리자"; ?>
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
      <span id="logo">mosashop</span>
      <div class="login_bar-right">
        <a>관리자님</a>
        <a href="../login/logout.php">로그아웃</a>
       <a href="list_product.php">상품목록</a>
       <a href="list_qna.php">Q&A관리</a>
       <a href="list_review.php">리뷰관리</a>
       <a href="list_order.php">주문관리</a>
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
                  /*
                  $(document).ready(function(){
                		getAllList();
                	}); */

                  $( function(){

                    var n = <?php echo $row[rate];?>; // DB에 저장된 별점을 가져와서 javascript 변수로 저장함

                                for( var i = 0; i < n; i++ ){ // DB에서 받아온 별점값까지의 별 span태그까지 반복문을 적용함
                                      $('.starRev span:eq('+i+')').addClass('on'); // DB에서 받아온 별점값(ex:1,3..등)만큼의 span 태그 값에 class="on"을 추가함
                                }

                    var str = ""; // 빈 string 문자열을 가진 변수를 만듬

/*                  	function getAllList(){
                      alert("hi");
                  		var review_id = <?php echo $id;?>; // 리뷰 글 식별번호값을 javascript 변수로 저장함

                  		$.getJSON("comment_list.php?id="+review_id, function(data){
                  			console.log(data);

                  			$(data).each(function(){
                  				console.log(data);

                  				str += "writer : "+this.writer+"<br> title : " +
                  					this.comment_title + "<br> content : " +
                  					this.comment_content + "<br>";

                            str += "<li>
                                      <ul>
                                        <li><b>"+this.writer_name+"</b></li>
                                        <li>"+this.content+"("+this.date+")</li>
                                        <li>"+수정+삭제+"</li>
                                      </ul>
                                    </li>";
                  			});

                  			$("#replies").html(str);
                  		});
                  	}  */

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

      /*             $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                      url: "comment_list.php",
                      type: "get",
                      data: {id : review_id},
                    }).done(function(data) {18"
                        alert("success");
                    });  */

        /*            $.get('comment_list.php?review_id='+review_id, function(data){
                            alert("success");
                    });  */


                    $.getJSON("./comment_list.php?id="+review_id, function(data){
                  //    console.log(data);
                        alert("success");

          /*            $(data).each(function(){
                        console.log(data);

                        str += "writer : "+this.writer+"<br> title : " +
                          this.comment_title + "<br> content : " +
                          this.comment_content + "<br>";

                          str += "<li>
                                    <ul>
                                      <li><b>"+this.writer_name+"</b></li>
                                      <li>"+this.content+"("+this.date+")</li>
                                      <li>"+수정+삭제+"</li>
                                    </ul>
                                  </li>";
                      });

                      $("#replies").html(str); */
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
                                    <input hidden="true" name="writer_id" value="8">
                                    <input hidden="true" name="review_id" value="<?php echo $id?>">
                                    <input type="text" name="comment" id="commentinput" style="width: 550px;">
                                    &nbsp;<input type="button" value="댓글달기" id="comment"/>
                                 </form><?php
                              } ?>


                    <script>
                    $( function(){

                      $('#comment').click(function(){
                                  $.ajax({

                                     url: "../aboutproduct/comment_ok.php",
                                     type: "post",
                                  //   dataType: "json", // url의 결과값으로 JSON 자료형을 받아옴
                                     data: $("#commentform").serialize(), // id="commentform"인 form을

                                   }).done(function(data) {
                                     // console.log("load2");
                                     // console.log(data);
                                       $("#commentinput").val(""); // 댓글입력창 비우기
                                         load();
                                   });
                      });

                    //   $(document).on("click","button[name=del]",function(){ // 삭제 버튼
                    //
                    //       var n = $('button[name=del]').index(this);  // 본 태그가 가리키는 button이 몇번째 태그인지 숫자를 가져옴 (맨 첫줄에 빈 tr 하나를 만들었으므로 index +1 해줘야함
                    //         // (Jquery에서 after로 붙게 하려고 빈 tr 만든 것))
                    //         alert(n);
                    //
                    //       var trindex = $('.comid:eq('+n+')').val(); // n번째 값에 해당하는 태그의 index값을 변수 index에 담음
                    // //        var trindex = $(this).parent().value;
                    // //     var trindex = $(this).parent().parent().children('input[name="comid"]').value; // 본 태그의 부모,부모태그(<tr></tr>)의 자식태그 중 input태그 value값으로 넣어둔 댓글의 index값을 변수 trindex에 담음
                    //       alert(trindex);
                    //
                    //       var trHtml = $(this).parent().parent(); // 본 태그의 부모(<td></td>)의 부모(<tr></tr>) 태그 전체를 가리킴. 본 페이지에서 지울 때 사용함. 정작 본 페이지에서 없앨 땐
                    //       // parent() 태그를 사용했군
                    //
                    //             $.ajax({
                    //               url: "comment_del.php",
                    //               type: "post",
                    //               data: { index : trindex },
                    //             }).done(function(data) { // db에서 삭제에 성공한 후,
                    //               //    trHtml.remove(); // 화면의 tr 태그도 삭제함
                    //                 trHtml.attr("hidden", true); // 화면에서 숨기기 (index에 영향을 주니까 숨기기만 함, 어차피 페이지 리로드하면 안보임)
                    //             });
                    //   });



                    });

                    function delete_comment(trindex){

                      $.ajax({
                        url: "../aboutproduct/comment_del.php",
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

                        url: "../aboutproduct/comment_load_db.php",
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


                          /*    ' <div class="dialog" hidden="true">'+ // json 형태로 받아온 data의 이름 + data의 키값(data.no)
                              '   <input name="comid_dial" hidden="true" class="dialogid" value="'+data.no+'"/>'+
                              '   <b>"'+data.writer_name+'"</b>님<br style="margin-bottom: 5px;">'+
                              '   <input type="text" value="'+data.content+'" />'+
                              '</div>'; */

                      //    var trHtml = $( "tr[name=trStaff]:last" ); // last를 사용하여 trStaff라는 명을 가진 마지막 태그 호출
                      //    trHtml.after(addcommm); // 마지막 trStaff명 뒤에 붙인다.

                            // var tag = $('#commadd');
                            // tag.append(addcommm); // tbody id="commadd" 태그 가장 뒤에 위의 addcommm 변수값을 붙임
                        //    tag.text("");
                        //    tag.append(data);
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

                      // var n = $('button[name=upd]').index(this); // alert(n);
                      // var comname = $('.comname:eq('+n+')').text();
                      // var comcont = $('.comcont:eq('+n+')').text();

                      var updcomm = prompt(''+jbSplit[2]+'님', jbSplit[1]); // 댓글쓴이, 댓글내용으로 입력창을 만듬
                      // alert(updcomm); // 입력창을 띄움

                        if( updcomm != ""){ // 입력창에 값이 있으면
                        //  $('.comcont:eq('+n+')').text(updcomm);
                      //  $(this).parent().children(".chil").children(".comcont").text(updcomm);

                            $.ajax({
                              url: "../aboutproduct/comment_upd2.php",
                              type: "post",
                              data: { index : jbSplit[0],
                                      content : updcomm },
                            }).done( function(data) { // db에서 삭제에 성공한 후,
                              //    trHtml.remove(); // 화면의 tr 태그도 삭제함
                              //  trHtml.attr("hidden", true); // 화면에서 숨기기 (index에 영향을 주니까 숨기기만 함, 어차피 페이지 리로드하면 안보임)
                              //   $('.comtime:eq('+n+')').text(data.date);
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
<?php session_destroy(); ?>
