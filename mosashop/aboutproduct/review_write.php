<!DOCTYPE html>
<?php session_start();

               $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

               $id = $_GET[no];

               $query = "SELECT * from product where no ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
               $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함

               $row = mysqli_fetch_array($result); // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함
?>
<html lang="en" dir="ltr">
  <head>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../common/loginbar.css">
        <link rel="stylesheet" href="../common/qna.css">
    <meta charset="utf-8">
    <title>모사샵 - 리뷰작성</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
      font-size: 40px;
      padding-left: 30px;
    }

    .starR{
      background: url('http://miuu227.godohosting.com/images/icon/ico_review.png') no-repeat right 0;
      background-size: auto 100%;
      width: 30px;
      height: 30px;
      display: inline-block;
      text-indent: -9999px;
      cursor: pointer;
    }
    .starR.on{background-position:0 0;}

    .img_wrap {
      width: 300px;
      margin-top: 10px;
    }

    .img_wrap img {
      max-width: 100%;
    }

    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    $( function(){
          $('.starRev').children('input').val("1"); // 별을 아무것도 클릭하지 않았을 때 별점 1로 세팅함

          $('.starRev span').click(function(){
            $(this).parent().children('span').removeClass('on'); // (본 태그의 부모태그: <div class="starRev">)의 자식태그 중 <span>태그의 class="on"을 전부 삭제함
            $(this).addClass('on').prevAll('span').addClass('on'); // 본 태그에 class="on"을 추가하고, 본 태그 이전의 모든 <span>태그에 class="on"을 추가함

            var n = $('.starRev span').index(this) +1; // 클릭한 별이 몇번째 별인지 index를 가져와서 알아옴

            // 별점 값을 넘기기 위해 hidden input 태그를 만듬
            $(this).parent().children('input').val(n); // 본 태그의 자식태그로 만든 input starrate에 별점 점수를 value값으로 세팅함

            // (본 태그의 부모태그: <div class="starRev">)의 자식태그 중 <span>태그,의 자식태그 중 <input> 태그의
            // 밸류값을 value=""로 전부 초기화함
  
            return false;
          });

          $('#review').click(function(){

            var form = $('form')[0]; // 폼객체를 불러와서
            var formData = new FormData(form); //FormData parameter에 담아줌

            $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
              url: "review_save.php",
              type: "post",
            //  data: $("#thisform").serialize(),
              data: formData,
              processData: false,
              contentType: false,
            }).done(function(data) {
              //    alert(data);
                    location.href="../product.php?no=<?php echo $id;?>#review"
            });
          });

          $('#textcont').onKeyUp(function(){
            alert("success");
          });

                // Byte 수 체크제한
            function fnChkByte(obj) {
                var maxByte = 600;
                var str = obj.value; // 넣은 객체(textarea)의 value값
                var str_len = str.length; // 넣은 객체(textarea)의 value값의 길이

                var rbyte = 0; // 총 byte 수 구하기 위해 초기값 0으로 세팅함
                var rlen = 0; // 총 길이
                var one_char = "";
                var str2 = "";

                for(var i=0; i<str_len; i++){ // textarea value의 총 길이까지 모든 문자개수만큼 반복문

                    one_char = str.charAt(i); // charAt(index) index로 주어진 값에 해당하는 문자를 리턴함
                        if(escape(one_char).length > 4) { // index 해당문자의 유니코드로 치환한 문자열의 길이가 4보다 클때

                          // escape() 알파벳 A~Z,a~z,1~0,일부 특수문자(@*-_+./)를 제외하고 모두 유니코드형식으로 인코딩하는 함수.
                          // 웹에서 데이터를 전송할 때 특정문자들이 특수한 기능으로 사용되는데 문자열 중 특수기호(&)를 제대로 인식하지 않아 문제가 생길 수 있으므로 이런 문제를 회피하기 위해 특수한 문자열을 치환해줌 &->%26
                          // 따라서 시스템에서 본 문자를 의도대로 해석할 수 있게 되고 이러한 처리를 escaping이라고 함
                          // 문자열값을 유니코드로 변환함 => 반환값: 인코딩된 문자열
                            rbyte += 2; // 한글 2Byte 추가
                        } else {
                            rbyte++;  // 영문 등 나머지 1Byte 추가
                        }

                        if(rbyte <= maxByte) { // 총 바이트 수가 최대 바이트 수보다 작거나 같으면
                            rlen = i+1; // return할 문자열 갯수는 i+1 (index는 0부터 시작하므로 index로 들어갈 수 있는 가장 큰 수는 (문자열.legnth-1)이므로)
                        }
                 }

                 if(rbyte > maxByte) {
                    // alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
                    alert("메세지는 최대 " + maxByte + "byte를 초과할 수 없습니다.")
                    str2 = str.substr(0,rlen);                                  //문자열 자르기
                    obj.value = str2;
                    fnChkByte(obj, maxByte);
                 } else {
                  //  document.getElementById('byteInfo').innerText = rbyte;
                    document.getElementById('byteInfo').text(rbyte);
                 }
            }
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
  </head>
  <body>

    <header class="login_bar">
      <span><a id="logo" href="main.php">mosashop</a></span>
      <div class="login_bar-right">
       <a><?php echo $_SESSION['name']?>님</a>
       <a href="../cartandorder/cart.php">장바구니</a>
       <a href="register.php">주문조회</a>
      </div>
    </header>

           <h1 style="display: block; text-align: center; margin-top: 50px;">상품리뷰</h1>

    <form id="thisform" style="margin:0px;">
      <div id="write_form">
          <table>
              <tr>
                  <td align="center" valign="middle" class="table_title">리뷰제목</td>
                  <td align="left" valign="middle" class="table_contents"><input type="text" name="title"></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">상품정보</td>
                  <td align="left" valign="middle" class="table_contents">
                    <img src="<?php echo $row[image_main]?>" valign="middle" width="50px" height="50px" style="margin-left: 10px;"/>
                    <span id="product-name-" style="height: 50px; text-align: center;"><?php echo $row[name]?></span>
                    <input name="product_id" value="<?php echo $id?>" hidden="hidden" />
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">별점</td>
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
                  <td align="left" valign="middle" class="table_contents" style="padding-left: 15px;"><?php echo $_SESSION['name']?></td>
                  <input name="customer_name" value="<?php echo $_SESSION['name']?>" hidden="hidden"/>
                  <!-- <td align=left><input type=test name="email" value=" <=$_SESSION['email']?> " maxlength=25 readonly> input 내부에 value로 세션변수 넣으면 readonly로 지정해줘야 함-->
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">등록일자</td>
                  <td align="left" valign="middle" class="table_contents">
                    <input type="text" id="date" name="date" readonly/>
                    <script language="JavaScript">
                //    var today = new Date( )
                //    document.write(today.getYear( ), "년 " , today.getMonth( )+1 , "월 " , today.getDate( ) , "일")
                      var today = new Date().toLocaleDateString();
                      document.getElementById('date').value = today;
                    </script></td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">리뷰내용</td>
                  <td align="left" valign="middle" style="width:600px; height:200px;">
                    <!-- <span id="byteInfo">0</span>/600bytes -->
                  <textarea name="contents" id="textcont" style="width:600px; height:200px;" cols="16"></textarea>
                  </td>
              </tr>

              <tr>
                  <td align="center" valign="middle" class="table_title">사진첨부</td>
                  <td align="left" valign="middle" >
                  	<input type='file' name='imagee' id="input_img" />
                    <div>
                        <div class="img_wrap">
                            <img id="img" />
                        </div>
                    </div>
                  </td>
              </tr>

              <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
              <tr>
                  <td align="center" valign="middle" colspan="2"><input type="button" id="review" value="리뷰작성" /></td>
              </tr>
          </table>
      </div>
    </form>

  </body>
</html>
