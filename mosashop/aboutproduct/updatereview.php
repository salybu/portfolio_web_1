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
    <title>모사샵 - 상품리뷰 수정</title>
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

    </style>
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

           <h1 style="display: block; text-align: center; margin-top: 50px;">상품리뷰</h1>

           <?php
                          $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                          $id = $_GET[review_id];

                          $query = "SELECT * from review where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
                          $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함

                          $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
           ?>

                 <div id="write_form" style="padding-bottom: 30px;">

                   <form id="thisform">
                     <table>
                         <tr>
                              <input type="text" name="id" value="<?php echo $id;?>" hidden="true"/>
                             <td align="center" valign="middle" class="table_title">리뷰제목</td>
                             <td align="left" valign="middle" class="table_contents" style="padding-left: 10px;">
                               <input type="text" name="title" value="<?php echo $row[title]?>"></td>
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


                    $('.starRev').children('input').val("<?php echo $row[rate];?>"); // 별을 아무것도 클릭하지 않았을 때 별점 1로 세팅함

                    $('.starRev span').click(function(){
                      $(this).parent().children('span').removeClass('on'); // (본 태그의 부모태그: <div class="starRev">)의 자식태그 중 <span>태그의 class="on"을 전부 삭제함
                      $(this).addClass('on').prevAll('span').addClass('on'); // 본 태그에 class="on"을 추가하고, 본 태그 이전의 모든 <span>태그에 class="on"을 추가함

                      var n = $('.starRev span').index(this) +1; // 클릭한 별이 몇번째 별인지 index를 가져와서 알아옴

                      // 별점 값을 넘기기 위해 hidden input 태그를 만듬
                      $(this).parent().children('input').val(n); // 본 태그의 자식태그로 만든 input starrate에 별점 점수를 value값으로 세팅함

                      return false;
                    });


                    $('#update').click(function(){

                            var form = $('form')[0]; // 폼객체를 불러와서
                            var formData = new FormData(form); //FormData parameter에 담아줌

                      $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
                        url: "review_updok.php",
                        type: "post",
                        data: formData,
                        processData: false,
                        contentType: false,
                      }).done(function(data) {
                            alert(data);
                              location.href="./review_read.php?no=<?php echo $id;?>"
                      });
                    });

                  });

                  var sel_file;

                  $(document).ready(function() {
                      $("#input_img").on("change", handleImgFileSelect);
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
                       <textarea name="contents" style="width:600px; height:200px;" ><?php echo $row[contents]?></textarea>
                       </td>
                    </tr>

<?php      if( $row[image] == "" ){ ?>  <!-- 첨부한 이미지 파일이 없을 때  -->
<?php      } else {  ?>  <!-- DB에 첨부한 이미지 파일이 존재할 때 -->
                    <tr>
                       <td align="center" valign="middle" class="table_title">리뷰사진</td>
                       <td align="left" valign="middle" style="width:600px; height:200px;">
                         <div><input type='file' name='imagee' id="input_img" /></div>
                          <img id="img" src="<?php echo $row[image]?>" width="300px" align="left">
                          <input type="text" name="imageori" value="<?php echo $row[image];?>" hidden="true"/> <!-- 사진을 변경하지 않은 경우, 바꿀 사진을 선택하지 않은 경우 기존 파일경로를 그대로 저장하기 위해 받아옴 -->
                       </td>
                    </tr>
<?php      } ?>
                                         <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
                    <tr>
     <?php            if($_SESSION['name']==$row[customer_name]){ // 이름말고 다른 조건 더 있어야 할 거 같은데 ... ?>
                         <td></td><td style="float: right;">
                           <!-- <a href="../product.php?no=<php echo $id_product;?>#qna"><button>목록으로</button></a> -->
                           <input type="button" id="update" value="수정" />

                          <!-- <a href="deleteqna.php?no=<php echo $id;?>&product=<php echo $id_product?>"><button>삭제</button></a> -->
                          <!-- <span align="center" valign="middle" colspan="2"><input type="submit" value="삭제" onClick="write_save();"></span> -->
                       </td>
<?php            }  ?>
                    </tr>

                     </table>
                  </form>
               </div>
  </body>
</html>
