<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../common/loginbar.css">
        <link rel="stylesheet" href="../common/table.css">
    <meta charset="utf-8">
    <title>모사샵 - 관리자</title>
    <style>

    #logo {
      font-family: 'Permanent Marker', cursive;
    /*    font-family: Lobster;  */
      font-size: 40px;
      padding-left: 30px;
    }

    #ulTable {
      margin-left: 100px;
      margin-top: 5px;
      line-height: 3em;
      font-family: "맑은 고딕";
      text-align: center;
    }

    #ulTable > li > ul > li:first-child                     {width:10%;} /* No 열 크기*/
    #ulTable > li > ul > li:first-child +li                 {width:10%;} /* 구분 열 크기*/
    #ulTable > li > ul > li:first-child +li+li              {width:10%;} /* 이미지 열 크기*/
    #ulTable > li > ul > li:first-child +li+li+li           {width:30%;} /* 상품이름 열 크기*/
    #ulTable > li > ul > li:first-child +li+li+li+li        {width:10%;} /* 가격 열 크기*/

    #tt li {
      height: 70px;
    }

    </style>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>

            function changeSelect(){
              var mojaSelect = document.getElementById("mojatype"); // id="mojatype"인 선택박스를 mojaSelect 변수에 담음
              var Value = mojaSelect.options[mojaSelect.selectedIndex].value; // mojaSelect에서 ((선택된 인덱스)를 가진 옵션)의 value값을 변수 Value에 담음


                if(Value=="1"){ // 모자분류 "전체"를 선택했을 때
                      var type = "";

                } else if(Value=="2"){ // 모자분류 "볼캡"을 선택했을 때
                      var type = "볼캡";

                } else if(Value=="3"){ // 모자분류 "헌팅캡"을 선택했을 때
                      var type = "헌팅캡";

                } else if(Value=="4"){ // 모자분류 "버킷햇"을 선택했을 때
                  //  $('#sqlsentence').text("<php $sql = "SELECT * FROM product where type = '버킷햇' order by no DESC"; ?>");
                  //  alert("버킷햇");
                      var type = "버킷햇";
                }

                  $("#ulTable > li > ul > li").hide(); // 모든 행을 감춤
                  $("#ulTable > li:first-child > ul > li").show(); // 테이블의 가장 윗줄, 구분해주는 행은 보이게 함 => li의 첫번쩨 태그의 자식태그들이 보이게 해야 함

                  var temp = $("#ulTable > li > ul > li:nth-child(5n+2):contains('"+ type +"')") // 5n+2번째 li 태그, '구분'열에서 type을 포함한 행을 변수 temp에 담음

                  $(temp).parent().children("li").show(); // 화면에 나타나도록 처리하는 요소는 li의 부모인 ul이므로 parent() 메소드로 부모요소를 선택하고 그 자식요소들을 전부 화면에 나타나도록 함
            }
    </script>
  </head>
  <body>

    <header class="login_bar">
      <span id="logo">mosashop</span>
      <div class="login_bar-right">
        <a>관리자님</a>
        <a href="../main.php">로그아웃</a>
       <a href="list_product.php">상품목록</a>
       <a href="list_qna.php">Q&A관리</a>
       <a href="list_review.php">리뷰관리</a>
       <a href="list_order.php">주문관리</a>
      </div>
    </header>

    <SELECT NAME=sltSample SIZE=1 onchange="changeSelect()" id="mojatype" style="margin-top: 30px; margin-left: 150px;">
            <OPTION VALUE="1" SELECTED>전체</OPTION>
            <OPTION VALUE="2">볼캡</OPTION>
            <OPTION VALUE="3">헌팅캡</OPTION>
            <OPTION VALUE=4>버킷햇</OPTION>
    </SELECT>

    <button style="margin-top: 30px; margin-left: 750px;"><a href="product_add.php" style="text-decoration: none; color: black;">상품등록</a></button>

    <ul id ="ulTable">
        <li>   <!-- 첫 줄 li는 게시판 분류 -->
            <ul>
                <li>No</li>
                <li>구분</li>
                <li>사진</li>
                <li>상품이름</li>
                <li>가격</li>
            </ul>
        </li>

        <?php
        $pageNum = ($_GET['page']) ? $_GET['page'] : 1;     // page : default - 1  // (리뷰)현재 표시할 페이지의 번호
        $list = ($_GET['list']) ? $_GET['list'] : 15;  // page : default - 5 // (리뷰)한 페이지 당 보여줄 글의 갯수

        $start = ($pageNum-1) * $listq; // 페이징의 페이지에 따라 DB에서 데이터를 꺼내올 시작점

                     $conn = mysqli_connect('localhost', 'gaeun', 'testtest', 'z_mosashop'); // mysqli_connect()는 php에서 mysql을 연결해주는 함수
                     $sql = "SELECT * FROM product order by no DESC LIMIT $start, $list";// qna 안에 있는 모든 항목들중 no 번호에 따라 내림차순으로 5개를 출력하라
                     $result = mysqli_query($conn, $sql);

  $count = 1; // 게시판에서 상품번호 붙이려고 하는 거
  while($row = mysqli_fetch_array($result)) { ?>

        <li>  <!-- 게시물이 출력될 영역 -->
            <ul id="tt">
                <li><?php echo $start + $count++;?></li>
                <li><?php echo $row['type'];?></li>
                <li><img src="<?php echo $row[image_main];?>" valign="middle" width="50px" height="50px" style="margin-top: 5px; margin-left: 10px; margin-right: 10px;"/></li>
                <li><a href="./readproduct.php?no=<?php echo $row['no'];?>" style="text-decoration: none; color: black;"><?php echo $row['name'];?></a></li>
                <li><?php echo number_format($row['price']);?>원</li>
            </ul>
        </li><?php
  }     ?>


            <div style="padding: 33px;"></div>
    </ul>  <!-- 테이블 전체 닫는 </ul> -->

    <div id="divPaging">
      <?php
                  $b_pageNum_list = 10; // 블럭에 나타낼 페이지 번호 갯수
                  $block = ceil($pageNum/$b_pageNum_list); // 현재 리스트의 블럭 구하기, ceil():소수점을 모두 올려주는 함수

                  $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; // 현재 블럭에서 시작페이지 번호
                  $b_end_page = $b_start_page + $b_pageNum_list - 1; // 현재 블럭에서 마지막 페이지 번호

                  $sqlzx = "SELECT * FROM product"; // mysqli_query([연결객체], [쿼리])는 mysqli_connect를 통해 연결된 객체를 이용해 mysql 쿼리를 실행시키는 함수
                  $resultzx = mysqli_query($conn, $sqlzx); // 위의 쿼리를 mysql DB에 연결함
                  $total_rows = mysqli_num_rows($resultzx); // mysqli_num_rows(): 쿼리문 연결해온 결과의 총 행 갯수를 구하는 함수

                $total_page =  ceil($total_rows/$list); // 총 페이지 수 = 총 행 갯수/ 한 페이지당 나타낼 글의 갯수

                if ($b_end_page > $total_page) // 앞서 구한 끝페이지 번호가 총 페이지수보다 크면 (목록 페이지번호는 있어도 글이 없을 수 있으므로)
                    $b_end_page = $total_page; // 끝페이지 번호를 총 페이지수와 같게 세팅함

                if($total_rows == 0 ){ // 글이 하나도 없으면
                  // 아무것도 출력하지 않음
                } else if ($pageNum <= 1){ // 페이지번호가 1이거나 1보다 작을 때 ?>
                    <div><font size=3><b> << </b></font></div>  <!-- 맨 앞 페이지에 해당하므로 링크 안걸어줘도 됨 -->
          <?php }  else { // 그 외의 경우에는 ?>
                    <div><font size=3><a href="product.php?no=<?php echo $id;?>&page=1&list=<?php echo $list;?>#review"> << </a></font></div> <!-- 맨 앞 페이지로 이동하는 링크 걸어줌 -->
          <?php }

                if($block <=1){ // 블록이 1보다 같거나 작을 때는 ?>
                    <font> </font> <!-- 이전블록이 없으니까 아무 표시 안해줘도 됨 -->
          <?php }  else { ?>
                    <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $b_start_page-1;?>&list=<?php echo $list;?>#review"> < </a></font></div>
          <?php }

                for($j = $b_start_page; $j <=$b_end_page; $j++) { // 시작페이지에서 끝 페이지까지 반복문
                    if($pageNum == $j) { // 본 페이지에 해당하는 페이지에서는 ?>
                          <div><font size=3><b><?php echo $j; ?></b></font></div> <!-- 링크 안 걸어줘도 됨 -->
            <?php   } else { // 그 외의 경우, 이동할 수 있게 링크 걸어줘야 됨 ?>
                          <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $j;?>&list=<?php echo $list;?>#review"> <?php echo $j;?></a></font></div>
            <?php   }
                }

                $total_block = ceil($total_page/$b_pageNum_list); // 총 블록 수 = (총 페이지 수 / 블록에 나타낼 페이지 번호갯수) 올림으로 표시함

                if($block >= $total_block){ // 블록이 총 블록수보다 크거나 같다면 ?>
                      <font></font> <!-- 아무 표시도 하지 않음 -->
          <?php } else { // 그 외의 경우 ?>
                      <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&page=<?php echo $b_end_page+1;?>&list=<?php echo $list;?>#review"> > </a></font></div> <!-- 다음 블록으로 넘어갈 수 있게 링크 걸음 -->
          <?php }

                if($total_rows == 0){ // 글이 하나도 없으면
                  // 아무것도 출력하지 않음
                } else if($pageNum >= $total_page){ // 페이지 수가 총 페이지수보다 크거나 같다면 ?>
                      <div><font size=3><b> >> </b></font></div> <!-- 마지막 페이지로 가는 링크 걸어주지 않음 -->
          <?php } else {?>
                      <div><font size=3 ><a href="product.php?no=<?php echo $id;?>&pager=<?php echo $total_page;?>&listr=<?php echo $list;?>#review"> >> </a></font></div>
          <?php }?>
    </div>

  </body>
</html>
