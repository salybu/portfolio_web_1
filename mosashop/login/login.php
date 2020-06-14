<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../common/loginbar.css">
    <meta charset="utf-8">
    <title>모사샵 - 로그인</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
    /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    #login_form {
      /* display: block; 요소들은 중앙정렬할 때 margin: 0 auto; 이용, 이 때 정렬하려는 요소의 넓이를 반드시 지정하고 margin: 0 auto 써야 함
         인라인요소들은 text-align 속성 이용
                    p {
                      width: 100px;
                      margin: 0 auto;
                    }*/
      display: block;
      width: 480px;
      border: 3px solid black;
      padding: 60px;
      margin:0 auto;
      margin-top: 30px;
    }

    #login {
      font-weight: bold;
      display: inline;
    }

    #login label {
      float: left;
      width: 200px;
      text-align: right;
      padding-right: 10px;
    }

    #login label, input{
      margin-bottom: 30px;
    }

    @media screen and (min-width: 767px) {
      .container {
        width: 100%;
        max-width: 1080px;
        margin: 0 auto;
      }

      .container .row {
        width:100%;
        float:left;
        clear:both;
      }

      .container .col {
        display: inline;
        float: left;
        margin: 0 0 1em;
        padding-right: .5em;
        padding-left: .5em;
      }

      .container .col.three { width: 24.99%; }
    }

    /*All the button styles*/
/*    * {-moz-box-sizing: border-box;
      -webkit-box-sizing:
      border-box;
      box-sizing: border-box;}   */
    a {text-decoration:none;}

    /********************
    GENERIC BUTTON STYLES
    ********************/
    .btn {
      float: center;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      font-size: 18px;
      font-family: Open Sans;
      white-space: nowrap;
      width: 50%; /* %로 표현하는 경우, 할당된 영역의 사용할 범위를 %로 표시함 */
      padding:.8em 2em; /* margin, padding 한줄에 적을 때 순서 상,우,하,좌 */
      font-family: Open Sans, Helvetica,Arial,sans-serif;
      line-height:18px;
  /*    display: inline-block; 할당된 영역을 전부 차지하면서 줄바꿈 되도록 함 */
      display: inline;
      zoom: 1;
    	color: #fff;
      text-align: center;
      position:relative;
      -webkit-transition: border .25s linear,
    	color .25s linear, background-color .25s linear;
      transition: border .25s linear,
    	color .25s linear, background-color .25s linear;
     }

    /*DARK BUTTON STYLES*/
    .btn.btn-dark { background-color: #2c3d51; border-color: #2c3d51;
    	-webkit-box-shadow: 0 3px 0 #080c0f; box-shadow: 0 3px 0 #080c0f;}
    .btn.btn-dark:hover {
    	background-color:#202d3d;}
    .btn.btn-dark:active{top: 3px; outline: none;
    	-webkit-box-shadow: none; box-shadow: none;}

    /*SUNFLOWER BUTTON STYLES*/
    .btn.btn-sunflower{background-color: #f2c500; border-color: #f2c500;
    	-webkit-box-shadow: 0 3px 0 #b19001; box-shadow: 0 3px 0 #b19001;}
    .btn.btn-sunflower:hover{background-color:#e3ba02;}
    .btn.btn-sunflower:active{top: 3px; outline: none; -webkit-box-shadow: none; box-shadow: none;}

    </style>
    <script language="javascript">
    function checkz(){
      var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*[.][a-zA-Z]{3}$/i; // 이메일 정규표현식
      var obj = document.loginfrm; // 회원가입 폼 전체 document를 obj 변수로 선언했음

      if(!regExp.test(obj.inputmail.value)){ // 이메일 정규식 만족하지 않는 경우
        alert('이메일을 형식에 맞게 입력하세요');
        return false;
      }

      if(obj.inputpw.value.trim() == ''){ // 비밀번호를 입력하지 않은 경우, trim(): 의미없는 문자 제거해주는 메소드
        alert('비밀번호를 입력하세요');
        return false;
      }
      return true;
    }
    </script>
  </head>

  <body>

    <header class="login_bar">
      <span id="logo">mosashop</span>
      <div class="login_bar-right">
        <?php if(!isset($_SESSION['email']) || !isset($_SESSION['name'])){ // 세션 없을때
    ?> <a href="login.php">로그인</a>
       <a href="register.php">회원가입</a> <?php
    } else { // 세션 있을때 ?>
       <a><?php echo $_SESSION['name']?>님</a>
       <a href="register.php">장바구니</a>
       <a href="register.php">주문조회</a><?php
    } ?>
      </div>
    </header>

       <h1 style="display: block; text-align: center; margin-top: 50px;">로그인</h1>

       <form action="../main.php" method="post" name="loginfrm" onsubmit="return checkz()">
       <div id="login_form">
         <div id="login">
            <label>이메일</label> <input type="email" name="inputmail"/>
            <label>비밀번호</label> <input type="password" name="inputpw"/>
         </div>
         <div class="col three">
          <a href="register.php" class="btn btn-sunflower" style="padding-left: 64px; padding-right: 64px;"/>회원가입</a>
          <input type="submit" class="btn btn-dark" value="로그인"/>
         </div>
       </div>

  </body>
</html>
