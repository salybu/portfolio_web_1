<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../common/loginbar.css">
      <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <meta charset="utf-8">
    <title>모사샵 - 회원가입</title>
    <style>

    /* 한 가로선상에서 정렬하려면 class로 묶어서 정렬함 */
    .contents {
      float: left; /* 상단바 아래에서 화면에 들어갈 메뉴바랑 컨텐츠 내용을 묶어줌 */
      padding: 20px;
      margin-left: 510px;
      margin-top: 30px;
    }

    #register_form {
      width: 600px;
      border: 3px solid black;
      padding-top: 60px;
      padding-left: 60px;
      padding-right: 40px;
      padding-bottom: 50px;
    }

    #register {
      font-weight: bold;
      display: inline;
    }

    #register label {
      float: left;
      width: 130px;
      text-align: right;
      padding-right: 20px;
    }

    #register .alert {
      position: relative;
      text-align: center;
      font-family: "돋움";
      font-size: 10px;
      color: red;
      right: 25px;
      margin-bottom: 10px;
    }

    #sp {
      display: inline;
    }

    #logo {
      font-family: 'Permanent Marker', cursive;
  /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    /*SUNFLOWER BUTTON STYLES*/
    .btn.btn-sunflower{background-color: #f2c500; border-color: #f2c500;
    	-webkit-box-shadow: 0 3px 0 #b19001; box-shadow: 0 3px 0 #b19001;}
    .btn.btn-sunflower:hover{background-color:#e3ba02;}
    .btn.btn-sunflower:active{top: 3px; outline: none; -webkit-box-shadow: none; box-shadow: none;}

    /******************** GENERIC BUTTON STYLES ********************/
    .btn {font-size: 18px; white-space:nowrap; width:80%; padding:.8em 1.5em;
        font-family: Open Sans, Helvetica,Arial,sans-serif; line-height:18px; display: inline-block; zoom: 1;
       margin-top: 30px; left: 40px;
    	 color: #fff; text-align: center; position:relative; -webkit-transition: border .25s linear,
    	 color .25s linear, background-color .25s linear; transition: border .25s linear,
    	 color .25s linear, background-color .25s linear;}

    </style>
    <script language="javascript"></script>
    <script>

      function email_checkz(){
        var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*[.][a-zA-Z]{3}$/i; // 이메일 정규표현식
        var obj = document.registerfrm; // 회원가입 폼 전체 document를 obj 변수로 선언했음

        if(regExp.test(obj.inputmail.value)){ // obj 객체 중 name inputmail을 가진 태그의 값을 가져와서, 정규식을 만족하는지 체크
          document.getElementById("email_check").innerHTML = ('<span style="color:green;">이메일 양식을 만족했습니다</span>');
        } else if(!regExp.test(obj.inputmail.value)){ // 만족하지 않는 경우는 다시 양식을 지켜달라는 안내문구 띄워야 함
          document.getElementById("email_check").innerHTML = ('<span style="color:red;">이메일 양식을 지켜주세요</span>');
          return false;
        }
      }

      function password_checkz(){
        var regex = /^.*(?=^.{8,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/; // 비밀번호 정규표현식
        var obj = document.registerfrm; // 회원가입 폼 전체 document를 obj 변수로 선언했음

        if(regex.test(obj.inputpw.value)){
          document.getElementById("pw_check").innerHTML = ('<span style="color:green;">비밀번호 양식을 만족했습니다</span>');
        } else if(!regex.test(obj.inputpw.value)){
          document.getElementById("pw_check").innerHTML = ('<span style="color:red;">영문 대소문자, 숫자, 특수문자 포함 8~12자</span>');
          return false;
        }
      }

      function pw_confirm(){
        var regex = /^.*(?=^.{8,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/; // 비밀번호 정규표현식
        var obj = document.registerfrm; // 회원가입 폼 전체 document를 obj 변수로 선언했음

        if(obj.pwconfirm.value == obj.inputpw.value){
            if(obj.pwconfirm.value.trim()!="" && regex.test(obj.inputpw.value)){
                document.getElementById("pw_confirm").innerHTML = ('<span style="color:green;">비밀번호가 일치합니다.</span>');
            }
        } else if(obj.pwconfirm.value != obj.inputpw.value){
          document.getElementById("pw_confirm").innerHTML = ('<span style="color:red;">비밀번호가 일치하지 않습니다</span>');
          return false;
        }
      }

/*      $('#pwc').onkeyup(function(){
        if(document.getElementById('#pw').equals(document.getElementById('#pwc'))){
          document.getElementById("pw_confirm").innerHTML = ('<span style="color:green;">비밀번호가 일치합니다.</span>');
        }else if(!document.getElementById('#pw').equals(document.getElementById('#pwc'))){
          document.getElementById("pw_confirm").innerHTML = ('<span style="color:red;">비밀번호가 일치하지 않습니다</span>');
          return false;
        }
      });  */

      function phonenum_check(){
      // var regex = /(^02.{0}|^01.{1}|[0-9]{3})([0-9]{3})([0-9]{4})/g; // 핸드폰번호 정규식
        var regex = /^\d{3}\d{3,4}\d{4}$/;
        var obj = document.registerfrm;

        if(regex.test(obj.inputphonenum.value)){
          document.getElementById("phonenum_check").innerHTML = ('<span style="color:green;">휴대폰 번호 입력을 완료했습니다</span>');
        } else if(!regex.test(obj.inputphonenum.value)){
          document.getElementById("phonenum_check").innerHTML = ('<span style="color:red;">휴대폰 번호를 숫자로만 입력하세요</span>');
          return false;
        }
      }

      function checkz(){
        var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*[.][a-zA-Z]{3}$/i; // 이메일 정규표현식
        var regex = /^.*(?=^.{8,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/; // 비밀번호 정규표현식
        var regexp = /(^02.{0}|^01.{1}|[0-9]{3})([0-9]{3})([0-9]{4})/g; // 핸드폰번호 정규식
        var obj = document.registerfrm; // 회원가입 폼 전체 document를 obj 변수로 선언했음

        if(!regExp.test(obj.inputmail.value)){ // 이메일 정규식 만족하지 않는 경우
          alert("이메일을 조건에 맞게 입력하세요");
          return false;
        }

        if(!regex.test(obj.inputpw.value)){ // 비밀번호 정규식 만족하지 않는 경우
          alert("비밀번호를 조건에 맞게 입력하세요");
          return false;
        }

        if(obj.pwconfirm.value != obj.inputpw.value){ // 비밀번호 확인이 일치하지 않는 경우
          alert("비밀번호 확인의 입력값이 비밀번호값과 다릅니다");
          return false;
        }

        if(!regexp.test(obj.inputphonenum.value)){ // 휴대폰번호 정규식 만족하지 않는 경우
          alert("휴대폰번호 조건을 만족시키세요");
          return false;
        }

        if(obj.inputaddress_number.value == "" || obj.inputaddress_main.value == "" || obj.inputaddress_detail.value == ""){
        alert("주소를 입력하세요");
        return false;
        }

        return true;
      }

      function sample6_execDaumPostcode() {
          new daum.Postcode({
              oncomplete: function(data) {
                  // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                  // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                  // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                  var addr = ''; // 주소 변수
                  var extraAddr = ''; // 참고항목 변수

                  //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                  if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                      addr = data.roadAddress;
                  } else { // 사용자가 지번 주소를 선택했을 경우(J)
                      addr = data.jibunAddress;
                  }

                  // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                  if(data.userSelectedType === 'R'){
                      // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                      // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                      if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                          extraAddr += data.bname;
                      }
                      // 건물명이 있고, 공동주택일 경우 추가한다.
                      if(data.buildingName !== '' && data.apartment === 'Y'){
                          extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                      }
                      // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                      if(extraAddr !== ''){
                          extraAddr = ' (' + extraAddr + ')';
                      }
                      // 조합된 참고항목을 해당 필드에 넣는다.
                      document.getElementById("sample6_extraAddress").value = extraAddr;

                  } else {
                      document.getElementById("sample6_extraAddress").value = '';
                  }

                  // 우편번호와 주소 정보를 해당 필드에 넣는다.
                  document.getElementById('sample6_postcode').value = data.zonecode;
                  document.getElementById("sample6_address").value = addr;
                  // 커서를 상세주소 필드로 이동한다.
                  document.getElementById("sample6_detailAddress").focus();
              }
          }).open();
      }

      function check_id_exist(){
      	var userid = document.getElementById("mail").value;
      	  if(userid) {
          		url = "id_check.php?userid="+userid;
          			window.open(url,"chkid","width=300,height=100");
      		}else{
        			alert("아이디를 입력하세요");
      		}
      }

      $( function(){


        $('#register').click(function(){

                var form = $('form')[0]; // 폼객체를 불러와서
                var formData = new FormData(form); // FormData parameter에 담아줌

          $.ajax({ // DB에서도 클릭한 행의 상품 주문처리상태를 배송대기 => 배송중으로 바꾸기 위해 ajax를 이용함
            url: "register_ajax_complete.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
          }).done(function(data) {
                alert(data);
                  location.href="./login.php"
          });
        });

      });

    </script>
  </head>

  <body>

    <header class="login_bar">
      <span><a id="logo" href="../main.php">mosashop</a></span>
      <div class="login_bar-right">
        <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
    ?> <a href="login.php">로그인</a>
       <a href="register.php">회원가입</a> <?php
    } else { // 세션 있을때 ?>
       <a><?php $_SESSION['name']?>님</a>
       <a href="register.php">장바구니</a>
       <a href="register.php">주문조회</a><?php
    } ?>
      </div>
    </header>

       <h1 style=" margin-left: 800px; margin-top: 50px;">회원가입</h1>

       <form method="post" name="registerfrm" onsubmit="return checkz()" action="register_complete.php">
         <div id="register_form" class="contents">

         <div id="register">
            <label>이메일</label> <input type="email" name="inputmail" id="mail" onkeyup="email_checkz()"/>
              <input type="button" value="중복확인" style="margin-left: 10px;" onclick="check_id_exist();"></input>
              <div class="alert" id="email_check">이메일 양식을 지켜주세요</div>

            <label>비밀번호</label> <input type="password" name="inputpw" onkeyup="password_checkz()" onkeydown="pw_confirm()" id="pw" />
            <div class="alert" id="pw_check">영문 대소문자, 숫자, 특수문자 포함 8~12자</div>

            <label>비밀번호 확인</label> <input type="password" name="pwconfirm" onkeyup="pw_confirm()" onkeydown="pw_confirm()" id="pwc"/>
            <div class="alert" id="pw_confirm">비밀번호가 일치하지 않습니다</div>

            <label>이름</label> <input type="text" name="inputname" style="margin-bottom: 15px;"/><br>

            <label>휴대폰 번호</label> <input type="tel" name="inputphonenum" onkeyup="phonenum_check()" onkeydown="phonenum_check()"/>
            <div class="alert" id="phonenum_check">휴대폰 번호를 숫자로만 입력하세요</div>

            <label style="position: relative; right: 30px;">주소</label>
            <input type="text" style="position: relative; right: 30px; margin-bottom: 5px;" id="sample6_postcode" placeholder="우편번호" name="inputaddress_number">
              <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기" style="position: relative; right: 30px; margin-left: 5px;"><br>
          <!-- 라벨있는 부분과 똑같은 왼쪽간격 주려고 라벨 css tag 참고해서 width(100px)+margin-left(20px) 더한 120px를 왼쪽여백으로 줌 -->
          <input type="text" style="margin-left: 120px; width: 350px; margin-bottom: 5px;" id="sample6_address" placeholder="주소" name="inputaddress_main"><br>
          <input type="text" style="margin-left: 120px; width: 170px;" id="sample6_detailAddress" placeholder="상세주소" name="inputaddress_detail">
          <input type="text" style="width: 158px;" id="sample6_extraAddress" placeholder="참고항목" name="inputaddress_ref">

         </div>

         <div class="col three center">
          <input type="submit" class="btn btn-sunflower" value="회원가입" />
          <!-- <button type="submit" class="btn btn-sunflower" id="register">회원가입</button> -->
         </div>
       </div>
     <!-- </form> -->

  </body>
</html>
